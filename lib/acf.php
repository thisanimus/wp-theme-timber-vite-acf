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

add_filter('timber/acf-gutenberg-blocks-templates', function () {
	return ['templates/components']; // default: ['views/blocks']
});


/**
 * ACF Timber Blocks Default Settings
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path) {
	$path = get_stylesheet_directory() . '/acf-json';
	return $path;
}

if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}
