<?php

class LsbFeedUtil {
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
        $content = '' . get_the_post_thumbnail( $post->ID, 'large' ) . '' . $content;
      }

    }

    return $content;
  }

  public static function get_image_from_feed_item_description($item) {
    $doc = new DOMDocument();
    $doc->loadHTML(mb_convert_encoding($item->get_description(), 'HTML-ENTITIES', 'UTF-8'));
    $xpath = new DOMXPath($doc);
    $image = $xpath->evaluate("string(//img/@src)");
    if ( is_a($image, 'DOMNodeList') ) {
      //if more than one image
      return $image->item(0);
    }

    return $image;
  }

  public static function get_image_from_feed_item($item) {
    return LsbFeedUtil::get_image_from_feed_item_description($item);
  }

  public static function print_error_message($feed_url, $rss) {
    if(is_wp_error($rss)) {
      printf( esc_html__( 'Det er noe galt med feeden (%1$s): %2$s', 'lsb' ), $feed_url, $rss->get_error_message() );
    } else {
      printf( esc_html__( 'Det er ingen elementer i feeden (%1$s)', 'lsb' ), $feed_url );
    }
  }
}

?>
