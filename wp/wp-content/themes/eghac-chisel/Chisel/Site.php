<?php

namespace Chisel;

use Timber\Timber;

/**
 * Class Site
 * @package Chisel
 *
 * Use this class to setup whole site related configuration
 */
class Site extends \Timber\Site {
	/**
	 * Site constructor.
	 */
	public function __construct() {
		// set default twig templates directory
		Timber::$dirname = Settings::TEMPLATES_DIR;

		$this->chiselInit();

		parent::__construct();
	}

	/**
	 * Initiate chisel configuration.
	 */
	public function chiselInit() {
		add_filter( 'timber_context', array( $this, 'addToContext' ) );
		add_filter( 'Timber\PostClassMap', array( '\Chisel\Post', 'overrideTimberPostClass' ) );
	}

	/**
	 * You can add custom global data to twig context
	 *
	 * @param array $context
	 *
	 * @return array
	 */
	public static function addToContext( $context ) {
		global $post;
		$post = Timber::get_post();

		$context['main_nav'] 		  = new \Timber\Menu( 'Main menu' );
		$context['footer_nav_1']  = new \Timber\Menu( 'Footer column 1' );
		$context['footer_nav_2']  = new \Timber\Menu( 'Footer column 2' );
		$context['footer_nav_3']  = new \Timber\Menu( 'Footer column 3' );

		$context['post']    		  = Timber::get_post();
		$context['options'] 	    = get_fields( 'options' );

		$context['posts_page'] 	  = get_option( 'page_for_posts' );

		$context['is_front_page']	= is_front_page();
		
		return $context;
	}
}
