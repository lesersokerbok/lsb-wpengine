<?php

class LsbFeedUtil {
  public function __construct() {
    add_filter('the_excerpt_rss', array($this, 'add_book_cover_image_to_feed_content'));
    add_filter('the_content_feed', array($this, 'add_book_cover_image_to_feed_content'));
  }

  public function add_book_cover_image_to_feed_content($content) {
    if  ( is_feed() ) {

      global $post;

      if ( $post->post_type === 'lsb_book' && has_post_thumbnail( $post->ID ) ) {
        $content = '' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '' . $content;
      }

    }

    return $content;
  }
}

?>
