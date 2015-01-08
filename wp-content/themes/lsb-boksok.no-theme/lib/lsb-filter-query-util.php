<?php

class LsbFilterQueryUtil {
  
  public static function tax_query_for_terms_string($terms_string, $taxonomy) {
    if(!$terms_string)
      return null;
    
    return array(
      'taxonomy' => $taxonomy,
      'field'    => 'slug',
      'terms'    => explode(",", $terms_string),
    );
  }
  
  public static function tax_query_for_term_objects($term_objects, $taxonomy) {
    
    $tax_util = new TaxonomyUtil();
    
    if(!$term_objects)
      return null;
    
    return array(
      'taxonomy' => $taxonomy,
      'field' => 'id',
      'terms' => array_map(array($tax_util, 'get_id'), $term_objects)
    );
  }
  
  public static function tax_query_for_query_vars() {
    
    $tax_query = array();
    $tax_query['relation'] = 'AND';
    
    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    foreach ($lsb_book_tax_objects as &$tax_object) {
      $terms_string = get_query_var($tax_object->rewrite['slug']);
      if($terms_string)
        $tax_query[] = self::tax_query_for_terms_string($terms_string, $tax_object->name);
    }
    
    return $tax_query;
  }
  
  public static function tax_query_for_book_page() {
    
    $tax_query = array();
    
    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    foreach ($lsb_book_tax_objects as &$tax_object) {
      $term_objects = get_field('lsb_book_page_filter_'.$tax_object->name);
      if($term_objects)
        $tax_query[] = self::tax_query_for_term_objects($term_objects, $tax_object->name);
    }
    
    return $tax_query;
  }
  
}

?>