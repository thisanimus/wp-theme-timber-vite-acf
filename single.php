<?php

/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

use Timber\Timber;

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;

if (post_password_required($timber_post->ID)) {
	Timber::render('pages/single-password/single-password.twig', $context);
} else {
	$templates = [
		'pages/single-' . $timber_post->ID . '/single-' . $timber_post->ID . '.twig',
		'pages/single-' . $timber_post->post_type . '/single-' . $timber_post->post_type . '.twig',
		'pages/single-' . $timber_post->slug . '/single-' . $timber_post->slug . '.twig',
		'pages/single/single.twig'
	];
	Timber::render($templates, $context);
}
