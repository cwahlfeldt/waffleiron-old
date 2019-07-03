<?php

/**
 * Registers the `attorneys` post type.
 */
function attorneys_init() {
	register_post_type( 'attorneys', array(
		'labels'                => array(
			'name'                  => __( 'Attorneys', 'post-type-attorneys' ),
			'singular_name'         => __( 'Attorneys', 'post-type-attorneys' ),
			'all_items'             => __( 'All Attorneys', 'post-type-attorneys' ),
			'archives'              => __( 'Attorneys Archives', 'post-type-attorneys' ),
			'attributes'            => __( 'Attorneys Attributes', 'post-type-attorneys' ),
			'insert_into_item'      => __( 'Insert into attorneys', 'post-type-attorneys' ),
			'uploaded_to_this_item' => __( 'Uploaded to this attorneys', 'post-type-attorneys' ),
			'featured_image'        => _x( 'Featured Image', 'attorneys', 'post-type-attorneys' ),
			'set_featured_image'    => _x( 'Set featured image', 'attorneys', 'post-type-attorneys' ),
			'remove_featured_image' => _x( 'Remove featured image', 'attorneys', 'post-type-attorneys' ),
			'use_featured_image'    => _x( 'Use as featured image', 'attorneys', 'post-type-attorneys' ),
			'filter_items_list'     => __( 'Filter attorneys list', 'post-type-attorneys' ),
			'items_list_navigation' => __( 'Attorneys list navigation', 'post-type-attorneys' ),
			'items_list'            => __( 'Attorneys list', 'post-type-attorneys' ),
			'new_item'              => __( 'New Attorneys', 'post-type-attorneys' ),
			'add_new'               => __( 'Add New', 'post-type-attorneys' ),
			'add_new_item'          => __( 'Add New Attorneys', 'post-type-attorneys' ),
			'edit_item'             => __( 'Edit Attorneys', 'post-type-attorneys' ),
			'view_item'             => __( 'View Attorneys', 'post-type-attorneys' ),
			'view_items'            => __( 'View Attorneys', 'post-type-attorneys' ),
			'search_items'          => __( 'Search attorneys', 'post-type-attorneys' ),
			'not_found'             => __( 'No attorneys found', 'post-type-attorneys' ),
			'not_found_in_trash'    => __( 'No attorneys found in trash', 'post-type-attorneys' ),
			'parent_item_colon'     => __( 'Parent Attorneys:', 'post-type-attorneys' ),
			'menu_name'             => __( 'Attorneys', 'post-type-attorneys' ),
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
		1  => sprintf( __( 'Attorneys updated. <a target="_blank" href="%s">View attorneys</a>', 'post-type-attorneys' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'post-type-attorneys' ),
		3  => __( 'Custom field deleted.', 'post-type-attorneys' ),
		4  => __( 'Attorneys updated.', 'post-type-attorneys' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Attorneys restored to revision from %s', 'post-type-attorneys' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Attorneys published. <a href="%s">View attorneys</a>', 'post-type-attorneys' ), esc_url( $permalink ) ),
		7  => __( 'Attorneys saved.', 'post-type-attorneys' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Attorneys submitted. <a target="_blank" href="%s">Preview attorneys</a>', 'post-type-attorneys' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Attorneys scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview attorneys</a>', 'post-type-attorneys' ),
		date_i18n( __( 'M j, Y @ G:i', 'post-type-attorneys' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Attorneys draft updated. <a target="_blank" href="%s">Preview attorneys</a>', 'post-type-attorneys' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'attorneys_updated_messages' );
