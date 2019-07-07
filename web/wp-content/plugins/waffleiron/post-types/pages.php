<?php

/*
 *
 * page acf builder
 *
 */

if( function_exists('acf_register_block_type') ) {

		$header = new StoutLogic\AcfBuilder\FieldsBuilder('header');
		$header
				->addText('title')
				->addWysiwyg('content')
				->addImage('background_image')
				->setLocation('post_type', '==', 'page')
					->or('post_type', '==', 'post');

		add_action('acf/init', function () use ($header) {
			acf_add_local_field_group($header->build());
			acf_register_block_type(array(
				'name'              => 'testimonial',
				'title'             => __('Testimonial'),
				'description'       => __('A custom testimonial block.'),
				'render_template'   => 'template-parts/blocks/testimonial/testimonial.php',
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'testimonial', 'quote' ),
			));
		});

}
