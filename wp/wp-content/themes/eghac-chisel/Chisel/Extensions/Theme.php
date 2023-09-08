<?php

namespace Chisel\Extensions;

/**
 * Class Theme
 * Use this class to extend theme functionality
 * @package Chisel\Extensions
 */
class Theme implements ChiselExtension {
	public function extend() {
		$this->addThemeSupports();
		
		add_action( 'wp_enqueue_scripts', array( $this, 'eghac_scripts_and_styles' ), 100 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'eghac_admin_styles' ) );

		if ( function_exists('acf_register_block_type') ) {
			add_action('acf/init', array( $this, 'eghac_register_blocks' ) );
		}

		add_filter( 'render_block', array( $this, 'eghac_block_wrapper' ), 10, 2 );
		add_filter( 'block_editor_settings' , array( $this, 'eghac_remove_guten_wrapper_styles' ) );
	}

	private function addThemeSupports() {
		// add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		
		if ( function_exists('acf_add_options_page') ) {
			acf_add_options_page();
		}
	}

	
	public function eghac_scripts_and_styles() {
		wp_dequeue_script( 'jquery-core' );
		wp_deregister_script( 'jquery-core' );
		wp_enqueue_script( 'jquery-core', '/wp-includes/js/jquery/jquery.js', array(), false, false );
		wp_register_script( 'jquery-core', '/wp-includes/js/jquery/jquery.js', array(), false, false );
		wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap', false );
	}

	public function eghac_admin_styles() {
		wp_enqueue_style( 'admin-google-fonts', 'https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap', false );
		$manifest = json_decode(
			file_get_contents( get_template_directory_uri() . '/dist/rev-manifest.json' ),
			true
		);

		wp_register_style( 'front-styles', get_template_directory_uri() . '/dist/styles/' . $manifest[ 'main.css' ], false, '1.0.0' );
		wp_enqueue_style( 'front-styles' );
		wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/admin/styles/admin.css', false, '1.0.0' );
		wp_register_script( 'admin-scripts-front', get_template_directory_uri() . '/dist/scripts/' . $manifest[ 'app.bundle.js' ], false, '1.0.0' );
		wp_enqueue_script( 'admin-scripts-front' );
		wp_register_script( 'admin-scripts', get_template_directory_uri() . '/admin/scripts/admin.js', false, '1.0.0' );
		wp_enqueue_script( 'admin-scripts' );

		// wp_register_script( 'front-slider-script', get_template_directory_uri() . '/admin/scripts/front.js', false, '1.0.0' );
		// wp_enqueue_script( 'front-slider-script' );
	}

	public function eghac_blocks_render_callback( $block, $content = '', $is_preview = false ) {
		$context = \Timber\Timber::context();
		$context['block'] = $block;
		$context['fields'] = get_fields();
		$context['is_preview'] = $is_preview;
		if ( is_admin() && function_exists( 'acf_maybe_get_POST' ) ) {
			$context['post'] = intval( acf_maybe_get_POST( 'post_id' ) );
		} else {
			global $post;
			if ($post) {
				$context['post'] = $post->ID;
			}
		};
		$block_name = str_replace( 'acf/', '', $block[ 'name' ] );
		if ($block_name == 'latest-news-and-events') {
			$context['fields']['news'] = get_posts(array(
				'category' => $context['fields']['news_taxonomy']->term_id,
				'posts_per_page' => 3,
			));
			$context['fields']['events'] = get_posts(array(
				'post_status' => 'publish',
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
			));
		} 
		\Timber\Timber::render( "templates/components/blocks/$block_name.twig", $context );
	}

	public function eghac_register_blocks() {
		$blocks = array( 
			'Hero',
			'Latest news and events',
			'Actions and projects',
			'Blue waves bg',
			'Page hero',
			'Blue section with icons',
			'Split content',
			'Code',
			'Columns with background',
			'Image on background',
			'Video',
			'Text and image',
			'Gray boxes columns',
			'Downloads',
			'Faq'
		);

		foreach ( $blocks as $block ) {
			$slug = str_replace( ' ', '-', strtolower($block) );
			acf_register_block_type(array(
				'name'              => $slug,
				'title'             => __($block),
				'render_callback'   => array( $this, 'eghac_blocks_render_callback' ),
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( $slug ),
			));
		}
	}

	public function eghac_block_wrapper( $block_content, $block ) {
		// global $post;
		// if ($post->post_type == 'post') {
		// 	if ( $block['blockName'] === 'core/paragraph' ) {
		// 		return "<div class='o-wrapper'>$block_content</div>";
		// 	} elseif ( $block['blockName'] === 'core/heading' ) {
		// 		return "<div class='o-wrapper'>$block_content</div>";
		// 	} elseif ( $block['blockName'] === 'core/list' ) {
		// 		return "<div class='o-wrapper'>$block_content</div>";
		// 	} elseif ( $block['blockName'] !== 'core/image' ) {
		// 		return "<div class='o-wrapper'>$block_content</div>";
		// 	}
		// } else {
		return $block_content;
			// }
	}

	public function eghac_remove_guten_wrapper_styles( $settings ) {
		unset($settings['styles'][0]);

		return $settings;
	}
}
