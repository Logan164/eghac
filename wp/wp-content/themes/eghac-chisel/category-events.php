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

$templates = array( 'archive-events.twig', 'archive.twig', 'index.twig' );

$context = \Timber\Timber::get_context();
$queried_object = get_queried_object();
$context['page'] = $queried_object;

$args_upcoming = array(
	'post_type' 		 => 'post',
	'posts_per_page' => -1,
	// 'paged' 				 => $paged,
	'post_status' 	 => 'publish',
	'cat' 					 => $queried_object->term_id,
	'meta_key' 			 => 'event_date',
	'orderby'	 			 => 'meta_value',
	'order'		 			 => 'ASC',
	'meta_query'     => array(
		'relation' => 'OR',
		array(
			'key'     => 'event_date',
			'value'   => date('Y-m-d'),
			'compare' => '>=',
			'type'    => 'DATE'
		),
		array(
			'key'     => 'event_date_end',
			'value'   => date('Y-m-d'),
			'compare' => '>=',
			'type'    => 'DATE'
		),
	),
);
$context['upcoming_posts'] = new Timber\PostQuery($args_upcoming);
// $context['custom_pagination_upcoming'] = $context['upcoming_posts']->pagination(4);


$args_past = array(
	'post_type' 		 => 'post',
	'posts_per_page' => -1,
	// 'paged' 				 => $paged,
	'post_status' 	 => 'publish',
	'cat' 					 => $queried_object->term_id,
	'meta_key' 			 => 'event_date',
	'orderby'	 			 => 'meta_value',
	'order'		 			 => 'DESC',
	'meta_query'     => array(
		'relation' => 'AND',
		array(
			'key'     => 'event_date',
			'value'   => date('Y-m-d'),
			'compare' => '<',
			'type'    => 'DATE'
		),
		array(
			'key'     => 'event_date_end',
			'value'   => date('Y-m-d'),
			'compare' => '<',
			'type'    => 'DATE'
		),
	),
);
$context['past_posts'] = new Timber\PostQuery($args_past);
// $context['custom_pagination_past'] = $context['past_posts']->pagination(4);

\Timber\Timber::render( $templates, $context );
