<?php
/*
  Plugin Name: WP Media folders
  Plugin URI: https://wordpress.org/plugins/wp-media-folders/
  Description: WP media Folders had the ability to rename and move files under real folders
  Author: Damien Barrère
  Version: 1.0.0
  Text Domain: wp-media-folders
  Domain Path: /languages
  Licence : GNU General Public License version 2 or later; http://www.gnu.org/licenses/gpl-2.0.html
  Copyright : Copyright (C) 2017 Damien Barrère All right reserved
 */

/**
 * @copyright 2017 Damien Barrère
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


// Prohibit direct script loading
defined('ABSPATH') || die('No direct script access allowed!');

// This functionality is only needed on backend
if(!is_admin()) {
    return;
}

//Check plugin requirements
if (version_compare(PHP_VERSION, '5.3', '<')) {
    if( !function_exists('wp_media_folders_disable_plugin') ){
        function wp_media_folders_disable_plugin(){
            if ( current_user_can('activate_plugins') && is_plugin_active( plugin_basename( __FILE__ ) ) ) {
                deactivate_plugins( __FILE__ );
                unset( $_GET['activate'] );
            }
        }
    }

    if( !function_exists('wp_media_folders_show_error') ){
        function wp_media_folders_show_error(){
            echo '<div class="error"><p><strong>WP Media Folders</strong> need at least PHP 5.3 version, please update php before installing the plugin.</p></div>';
        }
    }

    //Add actions
    add_action( 'admin_init', 'wp_media_folders_disable_plugin' );
    add_action( 'admin_notices', 'wp_media_folders_show_error' );

    //Do not load anything more
    return;
}

include_once('classes' . DIRECTORY_SEPARATOR . 'wp-media-folders.php');

new WP_Media_Folders(__FILE__);

