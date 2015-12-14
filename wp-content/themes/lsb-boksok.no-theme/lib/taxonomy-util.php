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

  public static function the_unhidden_term_list( $id, $taxonomy, $before = '', $sep = '', $after = '' ) {
    $terms = get_the_terms( $id, $taxonomy );
    if ( is_wp_error( $terms ) )
      return;

    if ( empty( $terms ) )
      return;

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
    echo $before . join( $sep, $term_links ) . $after;
  }

  public static function term_has_icon($term) {
    $icon = get_field('lsb_acf_tax_term_icon', $term );
    $icon_caption = get_field('lsb_acf_tax_term_icon_with_caption', $term );

    if(!empty($icon) || !empty($icon_caption)) {
      return true;
    } else {
      return false;
    }
  }

  public static function get_single_term_icon( $term, $caption = false ) {

    $icon = get_field('lsb_acf_tax_term_icon', $term );
    $icon_caption = get_field('lsb_acf_tax_term_icon_with_caption', $term );

    if($caption && !empty($icon_caption)) {
      $icon = $icon_caption;
    }

    if( !empty($icon) ) {
      return '<img src="' . esc_url($icon['sizes']['thumbnail']) . '" />';
    } else {
      return '';
    }
  }

  public static function the_terms_as_icons( $id, $taxonomy, $before = '', $sep = '', $after = '' ) {
    $terms = get_the_terms( $id, $taxonomy );
    if ( is_wp_error( $terms ) )
      return;

    if ( empty( $terms ) )
      return;

    $links = array();

    foreach ( $terms as $term ) {

      $icon = TaxonomyUtil::get_single_term_icon( $term , true);

      if ( !empty($icon) ) { // If there is an icon

        $link = get_term_link( $term, $taxonomy );

        if ( is_wp_error( $link ) ) {
          return $link;
        }

        $links[] = '<a href="' . esc_url( $link ) . '" class="term-icon" rel="tag">' . $icon . '</a>';
      }
    }

    $term_links = apply_filters( "term_links-$taxonomy", $links );
    echo $before . join( $sep, $term_links ) . $after;
  }

  public static function the_single_term_icon( $term, $caption = false ) {
    if(!$term) {
      $term = get_queried_object();
    }

    echo TaxonomyUtil::get_single_term_icon( $term , $caption);
  }

  public static function get_terms_with_icons($taxonomy) {
    $terms = get_terms( $taxonomy );
    return array_filter( $terms, array('TaxonomyUtil', 'term_has_icon') );
  }

}

?>
