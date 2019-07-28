<?php
/**
 * Plugin Name:     Waffleiron
 * Plugin URI:      cwahlfeldt@github.io
 * Description:     Waffleiron Framework :)
 * Author:          cwahlfeldt
 * Author URI:      cwahlfeldt.github.io
 * Text Domain:     waffleiron
 * Domain Path:     /languages
 * Version:         0.0.5
 *
 * @package         Waffleiron
 *
**/

require_once 'sc-svg-uploads/sc-svg-uploads.php';

// config requires
$config_path = dirname(__FILE__).'/config/';
foreach (scandir($config_path) as $filename) {
  $path = $config_path . $filename;
  if (is_file($path)) {
    require_once $path;
  }
}

// post types requires
$post_types_path = dirname(__FILE__).'/post-types/';
foreach (scandir($post_types_path) as $filename) {
  $path = $post_types_path . $filename;
  if (is_file($path)) {
    require_once $path;
  }
}

// taxonomy requires
$taxonomy_path = dirname(__FILE__).'/taxonomies/';
foreach (scandir($post_types_path) as $filename) {
  $path = $post_types_path . $filename;
  if (is_file($path)) {
    require_once $path;
  }
}
