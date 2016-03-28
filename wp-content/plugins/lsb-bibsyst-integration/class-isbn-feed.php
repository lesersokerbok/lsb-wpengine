<?php
class LSB_Bibsyst_Isbn_Feed {

	public $feedname = 'ftp/isbn.txt';

	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
		add_filter( 'post_limits', array( $this, 'post_limits' ) );
	}

	public function init() {

		add_feed( $this->feedname, array( $this, 'feed' ) );
	}

	public function on_plugin_activation() {

		$this->init();

		global $wp_rewrite;
		$wp_rewrite->flush_rules( false );
	}

	public function pre_get_posts( $query ) {

		if ( $query->is_main_query() && $query->is_feed( $this->feedname ) ) {

			// modify query here eg. show all posts
			$query->set( 'post_type', 'lsb_book' );
			$query->set( 'nopaging', true );
			$query->set( 'post_per_page', -1 );
		}

		return $query;
	}

	public function post_limits( $limit ) {

		if ( is_feed( $this->feedname ) ) {
			$limit = '';
		}

		return $limit;
	}

	public function feed() {

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				echo get_field('lsb_isbn')."\n";
			}
		}
	}

}
