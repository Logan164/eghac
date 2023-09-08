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

$templates = array( 'archive-project.twig', 'index.twig' );

$context = \Timber\Timber::get_context();
$context['body_class'] .= ' has-page-hero';

$orderby = '';
$order = 'ASC';
$args = array(
	'post_type' => 'project',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	'orderby' => $orderby,
	'order' => $order,
);
if ($_GET['order']) {
	$orderby = $_GET['order'];
	if ($orderby == 'a_z') {
		$args['order'] = 'ASC';
		$args['orderby'] = 'title';
	} elseif ($orderby == 'z_a') {
		$args['order'] = 'DESC';
		$args['orderby'] = 'title';
	} elseif ($orderby == 'region') {
		$args['meta_key'] = 'project_location';
		$args['orderby'] = 'meta_value';
	} elseif ($orderby == 'value_chain') {
		$args['meta_key'] = 'project_value_chain';
		$args['orderby'] = 'meta_value';
	}
	$context['orderby'] = $_GET['order'];
}
$context['posts'] = new Timber\PostQuery($args);
$context['custom_pagination'] = $context['posts']->pagination(4);


\Timber\Timber::render( $templates, $context );
