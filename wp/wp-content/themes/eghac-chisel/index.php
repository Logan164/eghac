<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * @package eghac
 */

if ( ! \Chisel\Helpers::isTimberActivated() ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}

global $paged;
if (!isset($paged) || !$paged){
	$paged = 1;
}

function pp_sql_join_meta_event_date( $meta_sql ) {
	$meta_sql = " LEFT JOIN oyvy0dz8_postmeta ON (oyvy0dz8_posts.ID = oyvy0dz8_postmeta.post_id AND oyvy0dz8_postmeta.meta_key = 'event_date') ";
	return $meta_sql;
}

function pp_sql_where_meta_event_date( $meta_sql ) {
	$meta_sql .= " AND (oyvy0dz8_postmeta.meta_value IS NULL OR oyvy0dz8_postmeta.meta_value IS NOT NULL OR oyvy0dz8_postmeta.meta_value = '')";
	return $meta_sql;
}

function pp_sql_orderby_meta_event_date( $orderby ) {
	$order = 'desc';
	if (array_key_exists( 'order', $_GET ) && $_GET['order']) {
		$order = $_GET['order'];
	}
	$orderby = 'COALESCE(IF(oyvy0dz8_postmeta.meta_value IS NULL or oyvy0dz8_postmeta.meta_value = "", null, oyvy0dz8_postmeta.meta_value), DATE_FORMAT(oyvy0dz8_posts.post_date, "%Y%m%d")) '. $order;
	return $orderby;
}

$context = \Timber\Timber::get_context();
$queried_object = get_queried_object();
$context['page'] = $queried_object;
$pinned = get_field('pinned_news_event', $queried_object->ID);
$context['pinned'] = $pinned;
$order = 'desc';
if (array_key_exists( 'order', $_GET ) && $_GET['order']) {
	$order = $_GET['order'];
}
$context['order'] = $order;
$args = array(
	'post_type' => 'post',
	'posts_per_page' => get_option( 'posts_per_page' ),
	'paged' => $paged,
	'post_status' => 'publish',
);
if ($pinned) {
	$args['post__not_in'] = array($pinned->ID);
}

add_filter('posts_join_paged', 'pp_sql_join_meta_event_date');
add_filter('posts_where_paged', 'pp_sql_where_meta_event_date');
add_filter('posts_orderby', 'pp_sql_orderby_meta_event_date');
$context['posts'] = new Timber\PostQuery($args);
remove_filter('posts_join_paged', 'pp_sql_join_meta_event_date');
remove_filter('posts_where_paged', 'pp_sql_where_meta_event_date');
remove_filter('posts_orderby', 'pp_sql_orderby_meta_event_date');

$context['custom_pagination'] = $context['posts']->pagination(4);

$templates = array( 'index.twig' );

if ( is_home() ) {
	array_unshift( $templates, 'home.twig' );
}
\Timber\Timber::render( $templates, $context );


/*
'meta_key' => 'event_date',
'orderby'	 => 'meta_value',
'order'		 => 'ASC',
'meta_query'    => array(
	'key' => 'event_date',
	'value' => date('Y-m-d'),
	'compare' => '>=',
	'type' => 'DATE'
),
'posts_per_page' => 3, 
*/