# Introduction

Lando is for developers who want to:

* Quickly specify and painlessly spin up the [services](./../config/services.md) and [tooling](./../config/tooling.md) needed to develop _all_ their projects.
* Ship these local development dependencies in a per-project, lives-in-git [config file](./../config/lando.md)
* Automate complex [build steps](./../config/services.md#build-steps), testing setups, deployments or other [repeated-more-than-once workflows](./../config/events.md)
* Avoid the built-in-masochism of directly using `docker` or `docker-compose`

It's a free, open source, cross-platform, **local** development environment and DevOps tool built on [Docker](http://docker.com) container technology and developed by [Tandem](http://thinktandem.io). Designed to work with most major languages, frameworks and services, Lando provides an easy way for developers of all skill levels to specify simple or complex requirements for their projects, and then quickly get to work on them.

::: tip This is development tool!
Note that while you _can_ run Lando in production it is _highly_ discouraged, not recommended and 100% not supported! DON'T DO IT!
:::

**Think of it as your local development dependency management and automation tool.**

## What is it good for?

*   Mimicking your production environment locally
*   Standardizing your teams dev environments and tooling on OSX, Windows and Linux
*   Integrating with hosting providers like [Pantheon](https://pantheon.io)
*   Customizing or extending tooling, deployment options and basically any other functionality
*   Running CI tests locally, running local tests in CI
*   Using a single local development environment for *all* your projects
*   Freeing yourself from the tyranny of inferior local development products

## Wait, doesn't Docker Compose do this?

Yes! Well, sort of. You can think of Lando as both an abstraction layer and superset of Docker Compose as well as a Docker Compose utility.

**As an abstraction layer** Lando vastly reduces the complexity of spinning up containers by exposing only the most relevant config for a given "service" and setting "sane defaults". Lando also provides "recipes" which are common combinations of services and their tooling that satisfy a given development use case eg Drupal, Python, Laravel, Dotnet, etc.

**As a superset** Lando provides ways for developers to run complex commands, build steps and automation on their services without the hassle of custom Dockerfiles or long "docker exec" commands. Think `lando yarn add express`. Think clear my applications cache after I import a database. Think install this `php-extension` before my appserver starts and then `composer install` after it does.

**As a utility** Lando handles some of the more arduous setup required for a *good* Docker Compose setup eg proxying, nice urls, cross-application networking (think Vue.js frontend talking to separate Laravel backend), host-container file permission handling, file sharing, per-container SSL certificate handling, ssh-key handling, etc.

**And!** If you don't like the default choices we've made all of the above is highly configurable down to the Docker Compose level itself!
