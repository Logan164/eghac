<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display tag-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package eghac
 */

$templates = array( 'tags.twig', 'archive.twig', 'index.twig' );

$context = \Timber\Timber::get_context();

$queried_object = get_queried_object();
$tag_name = $queried_object->name;
$context['title'] = "Tag: $tag_name";

$context['posts'] = new Timber\PostQuery();
$context['custom_pagination'] = $context['posts']->pagination(4);

\Timber\Timber::render( $templates, $context );
