<?php
/**
 * Plugin Name:     Waffleiron
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     waffleiron
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Waffleiron
 *
 *
 *
 * Utility functions and shite like that!
 *
 *
 */

// set options page
if (function_exists( 'acf_add_options_page')) {
  acf_add_options_page();
}

add_action( 'admin_menu', function() {
  //remove_menu_page( 'edit.php');
  remove_menu_page( 'edit-comments.php');
  remove_menu_page( 'edit-comments.php');
});

// reorder the menu
add_filter( 'menu_order', function($menu_ord) {
  if (!$menu_ord) return true;
  return array(
	'index.php',
	'upload.php',
	'edit.php',
	'edit.php?post_type=page',
	'edit.php?post_type=product',
	/* 'seperatorLast', */
	/* 'themes.php', */
	/* 'plugins.php', */
	/* 'users.php', */
	/* 'tools.php', */
	/* 'options-general.php', */
	/* 'admin.php?page=acf-options', */
	/* 'edit.php?post_type=shop_order', */
  );
});

add_action( 'admin_enqueue_scripts', function() {
  wp_enqueue_style( 'admin_css', plugin_dir_url(__FILE__) . 'styles/admin.css', false, '1.0.0' );
});

add_filter( 'site_transient_update_plugins', function( $value ) {
    unset( $value->response['akismet/akismet.php'] );
    return $value;
});

// Remove update notifications
add_filter( 'site_transient_update_plugins', function( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
		// remove for admin colmuns pro
        unset( $value->response[ 'admin-columns-pro/admin-columns-pro.php' ] );
    }

    return $value;
});

//add SVG to allowed file uploads
add_action('upload_mimes', function($file_types) {
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes );
  return $file_types;
});

// allowed_block_types has 1 arg: $allowed_blocks
add_filter( 'allowed_block_types', function() {
  return array(
    'core/paragraph',
    'core/heading',
  );
});
