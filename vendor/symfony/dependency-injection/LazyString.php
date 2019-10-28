<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection;

/**
 * A string whose value is computed lazily by a callback.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class LazyString
{
    private $value;

    /**
     * @param callable $callback A callable or a [Closure, method] lazy-callable
     *
     * @return static
     */
    public static function fromCallable($callback, ...$arguments): self
    {
        if (!\is_callable($callback) && !(\is_array($callback) && isset($callback[0]) && $callback[0] instanceof \Closure && 2 >= \count($callback))) {
            throw new \TypeError(sprintf('Argument 1 passed to %s() must be a callable or a [Closure, method] lazy-callable, %s given.', __METHOD__, \gettype($callback)));
        }

        $lazyString = new static();
        $lazyString->value = static function () use (&$callback, &$arguments, &$value): string {
            if (null !== $arguments) {
                if (!\is_callable($callback)) {
                    $callback[0] = $callback[0]();
                    $callback[1] = $callback[1] ?? '__invoke';
                }
                $value = $callback(...$arguments);
                $callback = self::getPrettyName($callback);
                $arguments = null;
            }

            return $value ?? '';
        };

        return $lazyString;
    }

    public function __toString()
    {
        if (\is_string($this->value)) {
            return $this->value;
        }

        try {
            return $this->value = ($this->value)();
        } catch (\Throwable $e) {
            if (\TypeError::class === \get_class($e) && __FILE__ === $e->getFile()) {
                $type = explode(', ', $e->getMessage());
                $type = substr(array_pop($type), 0, -\strlen(' returned'));
                $r = new \ReflectionFunction($this->value);
                $callback = $r->getStaticVariables()['callback'];

                $e = new \TypeError(sprintf('Return value of %s() passed to %s::fromCallable() must be of the type string, %s returned.', $callback, static::class, $type));
            }

            if (\PHP_VERSION_ID < 70400) {
                // leverage the ErrorHandler component with graceful fallback when it's not available
                return trigger_error($e, E_USER_ERROR);
            }

            throw $e;
        }
    }

    private function __construct()
    {
    }

    private static function getPrettyName(callable $callback): string
    {
        if (\is_string($callback)) {
            return $callback;
        }

        if (\is_array($callback)) {
            $class = \is_object($callback[0]) ? \get_class($callback[0]) : $callback[0];
            $method = $callback[1];
        } elseif ($callback instanceof \Closure) {
            $r = new \ReflectionFunction($callback);

            if (false !== strpos($r->name, '{closure}') || !$class = $r->getClosureScopeClass()) {
                return $r->name;
            }

            $class = $class->name;
            $method = $r->name;
        } else {
            $class = \get_class($callback);
            $method = '__invoke';
        }

        if (isset($class[15]) && "\0" === $class[15] && 0 === strpos($class, "class@anonymous\x00")) {
            $class = get_parent_class($class).'@anonymous';
        }

        return $class.'::'.$method;
    }
}
