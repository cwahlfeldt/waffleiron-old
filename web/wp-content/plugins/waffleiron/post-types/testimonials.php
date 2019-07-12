<?php

/**
 * Registers the `testimonials` post type.
 */
function testimonials_init() {
	register_post_type( 'testimonials', array(
		'labels'                => array(
			'name'                  => __( 'Testimonials', 'waffleiron' ),
			'singular_name'         => __( 'Testimonials', 'waffleiron' ),
			'all_items'             => __( 'All Testimonials', 'waffleiron' ),
			'archives'              => __( 'Testimonials Archives', 'waffleiron' ),
			'attributes'            => __( 'Testimonials Attributes', 'waffleiron' ),
			'insert_into_item'      => __( 'Insert into testimonials', 'waffleiron' ),
			'uploaded_to_this_item' => __( 'Uploaded to this testimonials', 'waffleiron' ),
			'featured_image'        => _x( 'Featured Image', 'testimonials', 'waffleiron' ),
			'set_featured_image'    => _x( 'Set featured image', 'testimonials', 'waffleiron' ),
			'remove_featured_image' => _x( 'Remove featured image', 'testimonials', 'waffleiron' ),
			'use_featured_image'    => _x( 'Use as featured image', 'testimonials', 'waffleiron' ),
			'filter_items_list'     => __( 'Filter testimonials list', 'waffleiron' ),
			'items_list_navigation' => __( 'Testimonials list navigation', 'waffleiron' ),
			'items_list'            => __( 'Testimonials list', 'waffleiron' ),
			'new_item'              => __( 'New Testimonials', 'waffleiron' ),
			'add_new'               => __( 'Add New', 'waffleiron' ),
			'add_new_item'          => __( 'Add New Testimonials', 'waffleiron' ),
			'edit_item'             => __( 'Edit Testimonials', 'waffleiron' ),
			'view_item'             => __( 'View Testimonials', 'waffleiron' ),
			'view_items'            => __( 'View Testimonials', 'waffleiron' ),
			'search_items'          => __( 'Search testimonials', 'waffleiron' ),
			'not_found'             => __( 'No testimonials found', 'waffleiron' ),
			'not_found_in_trash'    => __( 'No testimonials found in trash', 'waffleiron' ),
			'parent_item_colon'     => __( 'Parent Testimonials:', 'waffleiron' ),
			'menu_name'             => __( 'Testimonials', 'waffleiron' ),
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
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_rest'          => true,
		'rest_base'             => 'testimonials',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'testimonials_init' );

/**
 * Sets the post updated messages for the `testimonials` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `testimonials` post type.
 */
function testimonials_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['testimonials'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Testimonials updated. <a target="_blank" href="%s">View testimonials</a>', 'waffleiron' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'waffleiron' ),
		3  => __( 'Custom field deleted.', 'waffleiron' ),
		4  => __( 'Testimonials updated.', 'waffleiron' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Testimonials restored to revision from %s', 'waffleiron' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Testimonials published. <a href="%s">View testimonials</a>', 'waffleiron' ), esc_url( $permalink ) ),
		7  => __( 'Testimonials saved.', 'waffleiron' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Testimonials submitted. <a target="_blank" href="%s">Preview testimonials</a>', 'waffleiron' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Testimonials scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonials</a>', 'waffleiron' ),
		date_i18n( __( 'M j, Y @ G:i', 'waffleiron' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Testimonials draft updated. <a target="_blank" href="%s">Preview testimonials</a>', 'waffleiron' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'testimonials_updated_messages' );
