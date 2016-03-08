<?php
class isbn_feed {

	public $feed = 'ftp/isbn.txt';

	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );
		add_filter( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
		add_filter( 'post_limits', array( $this, 'post_limits' ) );
	}

	public function init() {

		add_feed( $this->feed, array( $this, 'feed' ) );

	}

	public function on_plugin_registration() {
		add_feed( $this->feed, array( $this, 'feed' ) );

		global $wp_rewrite;
  		$wp_rewrite->flush_rules( false );
	}

	public function pre_get_posts( $query ) {

		if ( $query->is_main_query() && $query->is_feed( $this->feed ) ) {

			// modify query here eg. show all posts
			$query->set( 'post_type', 'lsb_book' );
			$query->set( 'nopaging', true );
			$query->set( 'post_per_page', -1 );
		}

		return $query;

	}

	public function post_limits( $limit ) {

		if ( is_feed( $this->feed ) ) {
			$limit = '';
		}

		return $limit;
	}

	public function feed() {

		// either output template & loop here or include a template

		if ( have_posts() ) : while( have_posts() ) : the_post();

			echo the_field('lsb_isbn')."\n";

		endwhile; endif;

	}

}
