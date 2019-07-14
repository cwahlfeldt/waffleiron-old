<?php

// set options page
if (function_exists( 'acf_add_options_page')) {
  acf_add_options_page();
}

/* $delete_menus = ( */
/* 	function ( */
/* 		$submenu_slugs = array( */
/* 			array( 'customize.php', 'themes.php' ), */
/* 			array( 'customize.php', 'themes.php' ), */
/* 			array( 'customize.php', 'themes.php' ), */
/* 		)) */
/* 	{ */
/* 		for ( $i=0; $i < $submenu_slugs.length; $i++ ) { */

/* 		} */
/* 	} */
/* )(); */

add_action( 'admin_menu', function() {
  remove_menu_page( 'edit-comments.php');
});

// reorder the menu
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;

    return array(
        'index.php', // Dashboard
        'upload.php', // Media
        'separator1', // First separator
        'edit.php', // Posts
    );
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');

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
add_filter('allowed_block_types', function() {
  return array(
	'core/paragraph',
    'acf/header',
  );
});
