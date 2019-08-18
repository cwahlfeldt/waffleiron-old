<?php

/**
 * Registers the `areas_of_practice` taxonomy,
 * for use with 'post'.
 */
function areas_of_practice_init() {
	register_taxonomy( 'areas-of-practice', array( 'attorneys' ), array(
		'hierarchical'      => false,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_admin_column' => false,
		'query_var'         => true,
		'rewrite'           => true,
		'capabilities'      => array(
			'manage_terms'  => 'edit_posts',
			'edit_terms'    => 'edit_posts',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts',
		),
		'labels'            => array(
			'name'                       => __( 'Areas of Practices', 'waffleiron' ),
			'singular_name'              => _x( 'Area of Practice', 'taxonomy general name', 'waffleiron' ),
			'search_items'               => __( 'Search Areas of Practices', 'waffleiron' ),
			'popular_items'              => __( 'Popular Areas of Practices', 'waffleiron' ),
			'all_items'                  => __( 'All Areas of Practices', 'waffleiron' ),
			'parent_item'                => __( 'Parent Areas of Practice', 'waffleiron' ),
			'parent_item_colon'          => __( 'Parent Areas of Practice:', 'waffleiron' ),
			'edit_item'                  => __( 'Edit Areas of Practice', 'waffleiron' ),
			'update_item'                => __( 'Update Areas of Practice', 'waffleiron' ),
			'view_item'                  => __( 'View Areas of Practice', 'waffleiron' ),
			'add_new_item'               => __( 'Add New Areas of Practice', 'waffleiron' ),
			'new_item_name'              => __( 'New Areas of Practice', 'waffleiron' ),
			'separate_items_with_commas' => __( 'Separate areas-of-practices with commas', 'waffleiron' ),
			'add_or_remove_items'        => __( 'Add or remove areas-of-practices', 'waffleiron' ),
			'choose_from_most_used'      => __( 'Choose from the most used areas-of-practices', 'waffleiron' ),
			'not_found'                  => __( 'No areas-of-practices found.', 'waffleiron' ),
			'no_terms'                   => __( 'No areas-of-practices', 'waffleiron' ),
			'menu_name'                  => __( 'Areas of Practices', 'waffleiron' ),
			'items_list_navigation'      => __( 'Areas of Practices list navigation', 'waffleiron' ),
			'items_list'                 => __( 'Areas of Practices list', 'waffleiron' ),
			'most_used'                  => _x( 'Most Used', 'areas-of-practice', 'waffleiron' ),
			'back_to_items'              => __( '&larr; Back to Areas of Practices', 'waffleiron' ),
		),
		'show_in_rest'      => true,
		'rest_base'         => 'areas-of-practice',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	) );

}
add_action( 'init', 'areas_of_practice_init' );

/**
 * Sets the post updated messages for the `areas_of_practice` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `areas_of_practice` taxonomy.
 */
function areas_of_practice_updated_messages( $messages ) {

	$messages['areas-of-practice'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Area of Practice added.', 'waffleiron' ),
		2 => __( 'Area of Practice deleted.', 'waffleiron' ),
		3 => __( 'Area of Practice updated.', 'waffleiron' ),
		4 => __( 'Area of Practice not added.', 'waffleiron' ),
		5 => __( 'Area of Practice not updated.', 'waffleiron' ),
		6 => __( 'Area of Practices deleted.', 'waffleiron' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'areas_of_practice_updated_messages' );
