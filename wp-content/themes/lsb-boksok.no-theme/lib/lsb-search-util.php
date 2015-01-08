<?php

class LsbSearchUtil {
    
  public static function tax_query_for_taxonomy($term_slugs, $taxonomy) {
    return array(
      'taxonomy' => $taxonomy,
      'field'    => 'slug',
      'terms'    => explode(",", $term_slugs),
    );
  }
  
  public static function filter_search() {
   
    $args = array( 
      'post_type' => 'lsb_book',
      'tax_query' => LsbFilterQueryUtil::tax_query_for_query_vars(),
      'fields' => 'ids',
      'nopaging' => true
    );

    $ids = get_posts( $args );
    
    return $ids;
  }

}

?>