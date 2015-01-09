<?php

class LsbFilterQueryUtil {
  
  public static function tax_query_for_terms_string($terms_string, $taxonomy) {
    return array(
      'taxonomy' => $taxonomy,
      'field'    => 'slug',
      'terms'    => explode(",", $terms_string),
    );
  }
  
  public static function tax_query_for_term_objects($term_objects, $taxonomy) {    
    return array(
      'taxonomy' => $taxonomy,
      'field' => 'id',
      'terms' => TaxonomyUtil::get_terms_id_array($term_objects)
    );
  }
  
  public static function filter_string_for_term_objects($term_objects, $taxonomy) {
    return TaxonomyUtil::get_tax_label($taxonomy).
      ": ".implode(TaxonomyUtil::get_terms_name_array($term_objects), ', ');
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
  
  public static function filters_for_book_page() {
    $filters = array();
    
    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    foreach ($lsb_book_tax_objects as &$tax_object) {
      $term_objects = get_field('lsb_book_page_filter_'.$tax_object->name);
      if($term_objects)
        $filters[$tax_object->name] = $term_objects;
    }
    
    return $filters;
  }
  
  public static function tax_query_for_book_page() {
    $filters = self::filters_for_book_page();
    $tax_query = array_map(array('LsbFilterQueryUtil', 'tax_query_for_term_objects'), $filters, array_keys($filters));
    
    return $tax_query;
  }
  
  public static function filters_string_for_book_page() {
    $filters = self::filters_for_book_page();
    $filters_string_array = array_map(array('LsbFilterQueryUtil', 'filter_string_for_term_objects'), $filters, array_keys($filters));
    
    return implode($filters_string_array, " | ");
    
  }
  
}

?>