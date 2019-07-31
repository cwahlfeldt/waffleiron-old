<?php
/**
 * Plugin Name:     Waffleiron
 * Plugin URI:      cwahlfeldt@github.io
 * Description:     Waffleiron Framework :)
 * Author:          cwahlfeldt
 * Author URI:      cwahlfeldt.github.io
 * Text Domain:     waffleiron
 * Domain Path:     /languages
 * Version:         0.6.9
 *
 * @package         Waffleiron
 *
**/

$dir = dirname( __FILE__ );
$paths = array (
	'config',
	'post-types',
	'taxonomies',
);

foreach ( $paths as $path ) {
	$p = $dir . '/' . $path . '/';

	foreach ( scandir($p) as $filename ) {
		$f = $p . $filename;
		if (is_file( $f )) {
			require_once $f;
		}
	}
}

