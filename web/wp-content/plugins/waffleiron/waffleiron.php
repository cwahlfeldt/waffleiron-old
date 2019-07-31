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

require_once 'sc-svg-uploads/sc-svg-uploads.php';

$paths = array (
	'config',
	'post-types',
	'taxonomies',
);

$dir = dirname( __FILE__ );

foreach ( $paths as $path ) {
	$p = "{$dir}/{$path}";

	foreach ( scandir($p) as $f ) {
		$p = "{$p}/{$f}";
		if (is_file( $p )) {
			require_once $p;
		}
	}
}
