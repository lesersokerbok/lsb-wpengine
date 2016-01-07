<?php

class LsbFeedTransformer {
  public function __construct() {
    add_filter('the_excerpt_rss', array($this, 'add_featured_image_to_feed_content'));
    add_filter('the_content_feed', array($this, 'add_featured_image_to_feed_content'));
  }

  public function add_featured_image_to_feed_content($content) {
    if  ( is_feed() ) {

      global $post;

      if ( $post->post_type === 'lsb_book' && has_post_thumbnail( $post->ID ) ) {
        $content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '' . $content;
      } else {
        $content = '' . get_the_post_thumbnail( $post->ID, 'medium' ) . '' . $content;
      }

    }

    return $content;
  }
}

?>
