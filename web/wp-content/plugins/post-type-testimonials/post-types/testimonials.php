<?php

/**
 * Registers the `testimonials` post type.
 */
function testimonials_init() {
	register_post_type( 'testimonials', array(
		'labels'                => array(
			'name'                  => __( 'Testimonials', 'post-type-testimonials' ),
			'singular_name'         => __( 'Testimonials', 'post-type-testimonials' ),
			'all_items'             => __( 'All Testimonials', 'post-type-testimonials' ),
			'archives'              => __( 'Testimonials Archives', 'post-type-testimonials' ),
			'attributes'            => __( 'Testimonials Attributes', 'post-type-testimonials' ),
			'insert_into_item'      => __( 'Insert into testimonials', 'post-type-testimonials' ),
			'uploaded_to_this_item' => __( 'Uploaded to this testimonials', 'post-type-testimonials' ),
			'featured_image'        => _x( 'Featured Image', 'testimonials', 'post-type-testimonials' ),
			'set_featured_image'    => _x( 'Set featured image', 'testimonials', 'post-type-testimonials' ),
			'remove_featured_image' => _x( 'Remove featured image', 'testimonials', 'post-type-testimonials' ),
			'use_featured_image'    => _x( 'Use as featured image', 'testimonials', 'post-type-testimonials' ),
			'filter_items_list'     => __( 'Filter testimonials list', 'post-type-testimonials' ),
			'items_list_navigation' => __( 'Testimonials list navigation', 'post-type-testimonials' ),
			'items_list'            => __( 'Testimonials list', 'post-type-testimonials' ),
			'new_item'              => __( 'New Testimonials', 'post-type-testimonials' ),
			'add_new'               => __( 'Add New', 'post-type-testimonials' ),
			'add_new_item'          => __( 'Add New Testimonials', 'post-type-testimonials' ),
			'edit_item'             => __( 'Edit Testimonials', 'post-type-testimonials' ),
			'view_item'             => __( 'View Testimonials', 'post-type-testimonials' ),
			'view_items'            => __( 'View Testimonials', 'post-type-testimonials' ),
			'search_items'          => __( 'Search testimonials', 'post-type-testimonials' ),
			'not_found'             => __( 'No testimonials found', 'post-type-testimonials' ),
			'not_found_in_trash'    => __( 'No testimonials found in trash', 'post-type-testimonials' ),
			'parent_item_colon'     => __( 'Parent Testimonials:', 'post-type-testimonials' ),
			'menu_name'             => __( 'Testimonials', 'post-type-testimonials' ),
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
		'menu_icon'             => 'dashicons-text-page',
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
		1  => sprintf( __( 'Testimonials updated. <a target="_blank" href="%s">View testimonials</a>', 'post-type-testimonials' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'post-type-testimonials' ),
		3  => __( 'Custom field deleted.', 'post-type-testimonials' ),
		4  => __( 'Testimonials updated.', 'post-type-testimonials' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Testimonials restored to revision from %s', 'post-type-testimonials' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Testimonials published. <a href="%s">View testimonials</a>', 'post-type-testimonials' ), esc_url( $permalink ) ),
		7  => __( 'Testimonials saved.', 'post-type-testimonials' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Testimonials submitted. <a target="_blank" href="%s">Preview testimonials</a>', 'post-type-testimonials' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Testimonials scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonials</a>', 'post-type-testimonials' ),
		date_i18n( __( 'M j, Y @ G:i', 'post-type-testimonials' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Testimonials draft updated. <a target="_blank" href="%s">Preview testimonials</a>', 'post-type-testimonials' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'testimonials_updated_messages' );
