<?php

class LsbSearchUtil {
  
  public static function activate_menu($classes, $item) {
    
    $classes_string = implode($classes);
    $lsb_cat_terms_string = get_query_var(TaxonomyUtil::get_tax_rewrite_slug('lsb_tax_lsb_cat'));    
    $lsb_cat_array = explode(",", $lsb_cat_terms_string);
    
    foreach($lsb_cat_array as $term) {
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