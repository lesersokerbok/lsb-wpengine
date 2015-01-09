<?php

class TaxonomyUtil {

  public static function get_term_id($term_object) {
    if ( is_object($term_object) && isset($term_object->term_id) ) {
      return $term_object->term_id;
    } else {
      return null;
    }
  }
  
  public static function get_term_slug($term_object) {
    if ( is_object($term_object) && isset($term_object->slug) ) {
      return $term_object->slug;
    } else {
      return null;
    }
  }
  
  public static function get_term_name($term_object) {
    if ( is_object($term_object) && isset($term_object->name) ) {
      return $term_object->name;
    } else {
      return null;
    }
  }
  
  public static function get_terms_slug_array($term_objects) {
    if ($term_objects && is_array($term_objects)) {
      return array_map(array('TaxonomyUtil', 'get_term_slug'), $term_objects);
    } else {
      return null;
    }
  }
  
  public static function get_terms_name_array($term_objects) {
    if ($term_objects && is_array($term_objects)) {
      return array_map(array('TaxonomyUtil', 'get_term_name'), $term_objects);
    } else {
      return null;
    }
  }
  
  public static function get_terms_id_array($term_objects) {
    if ($term_objects && is_array($term_objects)) {
      return array_map(array('TaxonomyUtil', 'get_term_id'), $term_objects);
    } else {
      return null;
    }
  }
  
  public static function get_tax_rewrite_slug($taxonomy) {
    $tax_object = get_taxonomy( $taxonomy );
    
    if($tax_object)
      return $tax_object->rewrite['slug'];
    else
      return null;
  }
  
  public static function get_tax_label($taxonomy) {
    $tax_object = get_taxonomy( $taxonomy );
    
    if($tax_object)
      return $tax_object->label;
    else
      return null;
  }
  
  public static function get_names_from_slugs($term_slugs, $taxonomy) {
    $names = array();
      
    foreach ($term_slugs as &$term_slug) {
      $names[] = TaxonomyUtil::get_name_from_slug($term_slug, $taxonomy);
    }
  
    return $names;
  }
  

  public static function get_name_from_slug($term_slug, $taxonomy) {
    if ($term_slug && $taxonomy) {
      if(get_term_by('slug', $term_slug, $taxonomy))
        return get_term_by('slug', $term_slug, $taxonomy)->name;
      else
        return null;
    } else {
      return null;
    }
  }

}

?>
