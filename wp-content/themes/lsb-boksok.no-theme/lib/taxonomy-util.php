<?php

class TaxonomyUtil {

  public static function get_id($object) {
    if ( is_object($object) && isset($object->term_id) ) {
      return $object->term_id;
    } else {
      return null;
    }
  }

  public static function get_name($object) {
    if ( is_object($object) && isset($object->name) ) {
      return $object->name;
    } else {
      return null;
    }
  }

  public static function the_terms_slug($post_id, $taxonomy) {
    if($post_id && $taxonomy) {
      $terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ));
      echo implode( ' ', $terms );
    }
  }
  
  public static function get_names_from_slugs($term_slugs, $taxonomy) {
    $names = "";
    $term_count = count($term_slugs);
      
    for ($i = 0; $i < $term_count; $i++) {
      $name = ucfirst(TaxonomyUtil::get_name_from_slug($term_slugs[$i], $taxonomy));
      if($i == $term_count-1)
        $names = $names.$name;
      elseif ($i == $term_count-2)
        $names = $names.$name." og ";
      else
        $names = $names.$name.", ";
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
  
  public static function get_slug($term_object, $taxonomy) {
    if ($term_object && $taxonomy) {
      return get_term($term_object, $taxonomy)->slug;
    } else {
      return null;
    }
  }

  public static function get_slugs($terms, $taxonomy) {
    if ($terms && $taxonomy && is_array($terms)) {
      $slugs;
      foreach ($terms as $term) {
        $slugs[] = get_term($term, $taxonomy)->slug;
      }
      return implode(',', $slugs);
    } else {
      return null;
    }
  }
  
  public static function get_rewrite_slug_for_taxonomy($taxonomy) {
    $taxObject = get_taxonomy( $taxonomy );
    return $taxObject->rewrite['slug'];
  }

}

?>
