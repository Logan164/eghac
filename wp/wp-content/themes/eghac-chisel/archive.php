<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package eghac
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = \Timber\Timber::get_context();
$queried_object = get_queried_object();
$context['page'] = $queried_object;

$order = 'desc';
if (array_key_exists('order', $_GET) && $_GET['order']) {
	$order = $_GET['order'];
}
$context['order'] = $order;
$args = array(
	'post_type' => 'post',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged' => $paged,
	'post_status' => 'publish',
	'orderby' => 'publish_date',
	'order' => $order,
	'cat' => $queried_object->term_id
);
if ($queried_object->slug == 'events') {
	$args['orderby'] = 'meta_value';
	$args['meta_key'] = 'event_date';
}
$context['posts'] = new Timber\PostQuery($args);
$context['custom_pagination'] = $context['posts']->pagination(4);

\Timber\Timber::render( $templates, $context );
