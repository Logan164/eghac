<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package eghac
 */

global $post;

$context = \Timber\Timber::get_context();

$related_title = 'Related ';
$cat = $post->get_category();
if ($cat) {
	$context['related_title'] = $related_title . strtolower($cat->name);
}

$related_items = array();
$tags = wp_get_post_tags($post->ID);
if ($tags) {
	$tags_arr = array();
	foreach( $tags as $tag ) {
		array_push( $tags_arr, $tag->term_id );
	}
	$args = array(
		'tag__in' => $tags_arr,
		'cat' => $cat->term_id,
		'post__not_in' => array($post->ID),
		'posts_per_page'=> 3,
	);
	$related_items = new Timber\PostQuery($args);
}
$context['related_items'] = $related_items;

if ( post_password_required( $post->ID ) ) {
	\Timber\Timber::render( 'single-password.twig', $context );
} else {
	\Timber\Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
