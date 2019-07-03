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
 * Utility functions and shite like that!
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
  wp_enqueue_style( 'admin_css', plugin_dir_url(__FILE__) . 'styles/mod.css', false, '1.0.0' );
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
function mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}
add_filter( 'upload_mimes', 'mime_types' );

/**
 * Enqueue SVG javascript and stylesheet in admin
 * @author
 * @TODO
 */

function svg_enqueue_scripts( $hook ) {
	wp_enqueue_style( 'svg-style', get_plugin_file_uri( '/assets/css/svg.css' ) );
	wp_enqueue_script( 'svg-script', get_theme_file_uri( '/assets/js/svg.js' ), 'jquery' );
	wp_localize_script( 'svg-script', 'script_vars',
		array( 'AJAXurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'admin_enqueue_scripts', 'svg_enqueue_scripts' );

/**
 * Ajax get_attachment_url_media_library
 * @author  */
function get_attachment_url_media_library() {
	$url          = '';
	$attachmentID = isset( $_REQUEST['attachmentID'] ) ? $_REQUEST['attachmentID'] : '';
	if ( $attachmentID ) {
		$url = wp_get_attachment_url( $attachmentID );
	}

	echo $url;

	die();
}
add_action( 'wp_ajax_svg_get_attachment_url', 'get_attachment_url_media_library' );
