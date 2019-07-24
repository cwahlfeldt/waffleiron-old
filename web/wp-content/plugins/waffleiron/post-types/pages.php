<?php

/*
 *
 * page acf builder
 *
 */

$header = new StoutLogic\AcfBuilder\FieldsBuilder('header');

if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', function () use ($header) {
		acf_add_local_field_group($header->build());
		acf_register_block_type(array(
			'name'              => 'header',
			'title'             => __('Header'),
			'description'       => __('Page header fields'),
			'render_template'   => 'views/blocks/header.php',
			'category'          => 'layout',
			'icon'              => 'layout',
			'mode'              => 'edit',
			'align'             => array( 'left', 'right', 'full', 'center' ),
			'multiple'			=> true,
			'keywords'          => array( 'header', 'heading', 'intro' ),
			'post_types'		=> array('post', 'page'),
		));
	});
}
