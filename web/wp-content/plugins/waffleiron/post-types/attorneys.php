<?php

/**
 * Registers the `attorneys` post type.
 */
function attorneys_init() {
	register_post_type( 'attorneys', array(
		'labels'                => array(
			'name'                  => __( 'Attorneys', 'waffleiron' ),
			'singular_name'         => __( 'Attorneys', 'waffleiron' ),
			'all_items'             => __( 'All Attorneys', 'waffleiron' ),
			'archives'              => __( 'Attorneys Archives', 'waffleiron' ),
			'attributes'            => __( 'Attorneys Attributes', 'waffleiron' ),
			'insert_into_item'      => __( 'Insert into attorneys', 'waffleiron' ),
			'uploaded_to_this_item' => __( 'Uploaded to this attorneys', 'waffleiron' ),
			'featured_image'        => _x( 'Featured Image', 'attorneys', 'waffleiron' ),
			'set_featured_image'    => _x( 'Set featured image', 'attorneys', 'waffleiron' ),
			'remove_featured_image' => _x( 'Remove featured image', 'attorneys', 'waffleiron' ),
			'use_featured_image'    => _x( 'Use as featured image', 'attorneys', 'waffleiron' ),
			'filter_items_list'     => __( 'Filter attorneys list', 'waffleiron' ),
			'items_list_navigation' => __( 'Attorneys list navigation', 'waffleiron' ),
			'items_list'            => __( 'Attorneys list', 'waffleiron' ),
			'new_item'              => __( 'New Attorneys', 'waffleiron' ),
			'add_new'               => __( 'Add New', 'waffleiron' ),
			'add_new_item'          => __( 'Add New Attorneys', 'waffleiron' ),
			'edit_item'             => __( 'Edit Attorneys', 'waffleiron' ),
			'view_item'             => __( 'View Attorneys', 'waffleiron' ),
			'view_items'            => __( 'View Attorneys', 'waffleiron' ),
			'search_items'          => __( 'Search attorneys', 'waffleiron' ),
			'not_found'             => __( 'No attorneys found', 'waffleiron' ),
			'not_found_in_trash'    => __( 'No attorneys found in trash', 'waffleiron' ),
			'parent_item_colon'     => __( 'Parent Attorneys:', 'waffleiron' ),
			'menu_name'             => __( 'Attorneys', 'waffleiron' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_position'         => null,
		'menu_icon'             => 'dashicons-groups',
		'show_in_rest'          => true,
		'rest_base'             => 'attorneys',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'attorneys_init' );

/**
 * Sets the post updated messages for the `attorneys` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `attorneys` post type.
 */
function attorneys_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['attorneys'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Attorneys updated. <a target="_blank" href="%s">View attorneys</a>', 'waffleiron' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'waffleiron' ),
		3  => __( 'Custom field deleted.', 'waffleiron' ),
		4  => __( 'Attorneys updated.', 'waffleiron' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Attorneys restored to revision from %s', 'waffleiron' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Attorneys published. <a href="%s">View attorneys</a>', 'waffleiron' ), esc_url( $permalink ) ),
		7  => __( 'Attorneys saved.', 'waffleiron' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Attorneys submitted. <a target="_blank" href="%s">Preview attorneys</a>', 'waffleiron' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Attorneys scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview attorneys</a>', 'waffleiron' ),
		date_i18n( __( 'M j, Y @ G:i', 'waffleiron' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Attorneys draft updated. <a target="_blank" href="%s">Preview attorneys</a>', 'waffleiron' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'attorneys_updated_messages' );
