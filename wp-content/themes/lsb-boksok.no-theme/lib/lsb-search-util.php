<?php

/**
 * Collection of book queries for frontpage sections
 * - All queries respect frontpage book filters
 *
 */
class LsbSearchUtil {
    
  public static function tax_query_for_taxonomy($term_slugs, $taxonomy) {
    return array(
      'taxonomy' => $taxonomy,
      'field'    => 'slug',
      'terms'    => explode(",", $term_slugs)
    );
  }
  
  public static function tax_query_for_query_vars() {
    $lsb_cat_query_var_name = TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_lsb_cat');
    $age_query_var_name = TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_age');
    $audience_query_var_name = TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_audience');
    
    $lsb_cat_query_var = get_query_var($lsb_cat_query_var_name);
    $age_query_var = get_query_var($age_query_var_name);
    $audience_query_var = get_query_var($audience_query_var_name);

    $tax_query = array();
    $tax_query['relation'] = 'AND';
    $tax_query[0] = array();
    $tax_query[0]['relation'] = 'OR';
    $tax_query[1] = array();
    $tax_query[1]['relation'] = 'OR';

    if($lsb_cat_query_var)
      $tax_query[0][] = self::tax_query_for_taxonomy($lsb_cat_query_var, 'lsb_tax_lsb_cat');
    if($age_query_var)
      $tax_query[1][] = self::tax_query_for_taxonomy($age_query_var, 'lsb_tax_age');
    if($audience_query_var)
      $tax_query_[1][] = self::tax_query_for_taxonomy($audience_query_var, 'lsb_tax_audience');
    
    return $tax_query;
  }
  
  public static function filter_search() {
   
    // get the IDs of all the posts in this category
    $args = array( 
      'post_type' => 'lsb_book',
      'tax_query' => self::tax_query_for_query_vars(),
      'fields' => 'ids',
      'nopaging' => true
    );

    $ids = get_posts( $args );
    
    return $ids;
  }

}

?>