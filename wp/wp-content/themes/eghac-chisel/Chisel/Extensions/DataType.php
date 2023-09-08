<?php

namespace Chisel\Extensions;

/**
 * Class DataType
 * Use this class to register custom post types and taxonomies
 * @package Chisel\Extensions
 */
class DataType implements ChiselExtension {
	public function extend() {
		add_action( 'init', array( $this, 'registerPostTypes' ) );
		add_action( 'init', array( $this, 'registerTaxonomies' ) );
	}

	/**
	 * Use this method to register custom post types
	 */
	public function registerPostTypes() {
		register_post_type('project', array(
			'labels' => array(
				'name' => __('Project', 'eghac'),
				'singular_name' => __('Project', 'eghac'),
				'add_new' => __('Add New', 'eghac'),
				'add_new_item' => __('Add New Project', 'eghac'),
				'edit_item' => __('Edit Project', 'eghac'),
				'new_item' => __('New Project', 'eghac'),
				'all_items' => __('All Projects', 'eghac'),
				'view_item' => __('View Project', 'eghac'),
				'search_items' => __('Search Projects', 'eghac'),
				'not_found' => __('No Project found', 'eghac'),
				'not_found_in_trash' => __('No Project found in trash', 'eghac'),
				'menu_name' => __('Projects', 'eghac')
			),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'query_var' => true,
			'rewrite' => array(
				'slug' => 'projects'
			),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 5,
			'taxonomies' => array('project_tag'),
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
			)
		));
	}

	/**
	 * Use this method to register custom taxonomies
	 */
	public function registerTaxonomies() {
		$labels = array(
			'name'                       => _x( 'Project tags', 'taxonomy general name', 'textdomain' ),
			'singular_name'              => _x( 'Project tag', 'taxonomy singular name', 'textdomain' ),
			'search_items'               => __( 'Search Project tags', 'textdomain' ),
			'popular_items'              => __( 'Popular Project tags', 'textdomain' ),
			'all_items'                  => __( 'All Project tags', 'textdomain' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Project tag', 'textdomain' ),
			'update_item'                => __( 'Update Project tag', 'textdomain' ),
			'add_new_item'               => __( 'Add New Project tag', 'textdomain' ),
			'new_item_name'              => __( 'New Project tag Name', 'textdomain' ),
			'separate_items_with_commas' => __( 'Separate writers with commas', 'textdomain' ),
			'add_or_remove_items'        => __( 'Add or remove writers', 'textdomain' ),
			'choose_from_most_used'      => __( 'Choose from the most used writers', 'textdomain' ),
			'not_found'                  => __( 'No writers found.', 'textdomain' ),
			'menu_name'                  => __( 'Project tags', 'textdomain' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'show_in_rest'				  => true,
			'rewrite'               => array( 'slug' => 'project_tag' ),
		);

		register_taxonomy( 'project_tag', 'project', $args );
	}
}
