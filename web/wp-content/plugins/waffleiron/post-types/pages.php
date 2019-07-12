<?php

/*
 *
 * page acf builder
 *
 */

$header = new StoutLogic\AcfBuilder\FieldsBuilder('header');

if( function_exists('acf_register_block_type') ) {
	$header
		->addText('heading')
		->addText('sub_heading')
		->addImage('image')
		->setLocation('block', '==', 'acf/header');

	add_action('acf/init', function () use ($header) {
		acf_add_local_field_group($header->build());
		acf_register_block_type(array(
			'name'              => 'header',
			'title'             => __('Header'),
			'description'       => __('Page header fields'),
			'render_template'   => 'views/blocks/header.php',
			'category'          => 'layout',
			'icon'              => 'layout',
			'keywords'          => array( 'header', 'heading', 'intro' ),
			'post_types'		=> array('post', 'page'),
		));
	});
}
