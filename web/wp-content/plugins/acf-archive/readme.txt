=== Advanced Custom Fields: Archive Templates ===
Contributors: imarkimage,yehudah,idofri,rellect 
Tags: advanced custom fields, acf, acf archive
Requires at least: 4.1
Tested up to: 5.1.1
Stable tag: 1.0.5
Requires PHP: 5.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

ACF Archive is a little plugin for helping you attach ACF fields to the archive template.

== Description ==

ACF Archives is a little plugin for helping you attach ACF fields to the archive template.
The plugin will add a submenu for each public custom post type with archive defined
and then you can select under ACF rules box.

### Want to add or remove the submenu for other custom post types? ###

Here is a code example you can add to to your theme functions.php

<code>
	add_filter( 'acf_archive_post_types', 'change_acf_archive_cpt' );
	function change_acf_archive_cpt( $cpts ) {
		// 'book' and 'movie' are the cpt key.
			
		// Remove cpt
		unset( $cpts['book'] );
		
		// Add cpt
		$cpts['movie'] = Movies Archive;
		
		return $cpts;
	}
</code>

### Get the acf field on archive page ###

<code>
	$object = get_queried_object();
	$field = get_field( 'field_name', $object->name );
	
	var_dump( $field );
</code>

== Installation ==

=== From within WordPress ===

1. Visit 'Plugins > Add New'
1. Search for 'acf archive'
1. Activate ACF Archive from your Plugins page.

=== Manually ===

1. Upload the `acf-archive` folder to the `/wp-content/plugins/` directory
1. Activate the ACF Archive plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. New Archive ACF rule under ACF rules
1. ACF Archive menu page under each custom post type with archive enabled.

== Changelog ==

= 1.0.4 =
Fixed: Rule match bug

= 1.0.3 =
Compability when ACF is loaded on the theme

= 1.0.2 =
Code refactor and better combability

= 1.1 =
Minor fix for CPT UI

= 1.0 =
Initial Release
