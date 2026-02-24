<?php

/**
 * Custom Block Category
 */
add_filter('block_categories_all', function ($categories) {

	// Adding a new category.
	$categories[] = array(
		'slug'  => 'custom-acf-blocks',
		'title' => 'Custom ACF Blocks'
	);
	return $categories;
});


/**
 * ACF Timber Blocks Default Settings
 */
add_filter('timber/acf-gutenberg-blocks-default-data', function ($data) {
	$data['default'] = array(
		'post_types' => ['post', 'page'],
		'category' => 'Custom ACF Blocks',
		'supports' => [
			'align' => ['none', 'center', 'wide', 'full'],
			'mode' => true,
			'anchor' => true,
			'custom_class_name' => true,
		]
	);
	return $data;
});
