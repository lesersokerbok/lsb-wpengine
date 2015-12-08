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
  
  public static function get_term_name_from_slug($term_slug, $taxonomy) {
    $term_object = get_term_by('slug', $term_slug, $taxonomy);
    return self::get_term_name($term_object);
  }
  
  public static function get_terms_slug_array($term_objects) {
    if ($term_objects && is_array($term_objects)) {
      return array_map(array('TaxonomyUtil', 'get_term_slug'), $term_objects);
    } else {
      return [];
    }
  }
  
  public static function get_terms_name_array($term_objects) {
    if ($term_objects && is_array($term_objects)) {
      return array_map(array('TaxonomyUtil', 'get_term_name'), $term_objects);
    } else {
      return [];
    }
  }
  
  public static function get_terms_name_array_from_slugs_array($slugs_array, $taxonomy) {
    if ($slugs_array && is_array($slugs_array)) {
      return array_map(array('TaxonomyUtil', 'get_term_name_from_slug'), $slugs_array, array_fill(0,count($slugs_array),$taxonomy));
    } else {
      return [];
    }
  }
  
  public static function get_terms_id_array($term_objects) {
    if ($term_objects && is_array($term_objects)) {
      return array_map(array('TaxonomyUtil', 'get_term_id'), $term_objects);
    } else {
      return [];
    }
  }
  
  public static function get_tax_object_rewrite_slug($tax_object) {
    if($tax_object)
      return $tax_object->rewrite['slug'];
    else
      return null;
  }
  
  public static function get_tax_rewrite_slug($taxonomy) {
    $tax_object = get_taxonomy( $taxonomy );
    return self::get_tax_object_rewrite_slug($tax_object);
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


  // Edited version of get_the_term_list — Using the get_field to check if lsb_tax_topic_hide_term is true for the term.

  public static  function get_the_tax_topics( $id, $taxonomy, $before = '', $sep = '', $after = '' ) {
    $terms = get_the_terms( $id, $taxonomy );
    if ( is_wp_error( $terms ) )
      return $terms;

    if ( empty( $terms ) )
      return false;

    $links = array();
     
    foreach ( $terms as $term ) {
      if (!get_field('lsb_tax_topic_hide_term', $term )) { // If the term's lsb_tax_topic_hide_term is TRUE 

        $link = get_term_link( $term, $taxonomy );

        if ( is_wp_error( $link ) ) {
          return $link;
        }

        $links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
      }

    }
     
    $term_links = apply_filters( "term_links-$taxonomy", $links );
    return $before . join( $sep, $term_links ) . $after;
  }


}

?>
