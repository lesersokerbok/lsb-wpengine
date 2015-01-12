<?php

class LsbSearchUtil {
  
  public static function format_names($names, $binding_word, $capitalize) {
    $formatted_names = "";
    $count = count($names);
    for ($i = 0; $i < $count; $i++) {
      $name = $names[$i];
      if($capitalize)
        $name = ucfirst($name);
      
      if($i == $count-1)
        $formatted_names = $formatted_names.$name;
      elseif ($i == $count-2)
        $formatted_names = $formatted_names.$name." ".$binding_word." ";
      else
        $formatted_names = $formatted_names.$name.", ";
    }
    
    return $formatted_names;
  }
  
  public static function alert_text() {
    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    $tax_names_array_dict = array();
    
    foreach ($lsb_book_tax_objects as $tax_object) {
      $query_var = TaxonomyUtil::get_tax_object_rewrite_slug($tax_object);
      $taxonomy = $tax_object->name;
      $tax_slugs_string = get_query_var($query_var);
      if($tax_slugs_string) {
        $tax_names_array = TaxonomyUtil::get_terms_name_array_from_slugs_array(explode(",", $tax_slugs_string), $taxonomy);
        $tax_names_array_dict[$taxonomy] = $tax_names_array;
      } else {
        $tax_names_array_dict[$taxonomy] = array();
      }
    }
    
    $alert_text = null;
    
    if($tax_names_array_dict['lsb_tax_lsb_cat'] || $tax_names_array_dict['lsb_tax_age'] || $tax_names_array_dict['lsb_tax_audience']) {
      $alert_text = "Viser kun resultater ";
    
      if($tax_names_array_dict['lsb_tax_lsb_cat']) {
        $names_string = self::format_names($tax_names_array_dict['lsb_tax_lsb_cat'], "og", true);
        $alert_text = $alert_text."i ".$names_string;
      }

      if($tax_names_array_dict['lsb_tax_age'] || $tax_names_array_dict['lsb_tax_audience']) {
        $names_string = self::format_names(array_merge($tax_names_array_dict['lsb_tax_age'], $tax_names_array_dict['lsb_tax_audience']), "eller", false);
        $alert_text = $alert_text." som passer for ".$names_string;
      }

      $alert_text = $alert_text.".";
    }
    
    return $alert_text;
  }
  
  public static function activate_menu($classes, $item) {
    
    $classes_string = implode($classes);
    $lsb_cat_slugs_string = get_query_var(TaxonomyUtil::get_tax_rewrite_slug('lsb_tax_lsb_cat'));    
    $lsb_cat_slug_array = explode(",", $lsb_cat_slugs_string);
    
    foreach($lsb_cat_slug_array as $term) {
      if ($term && (strpos($classes_string, $term) !== false)) {
        $classes[] = 'active';
      } 
    }
    
    $classes = array_unique($classes);
    
    return $classes;
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