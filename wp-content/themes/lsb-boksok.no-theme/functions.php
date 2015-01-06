<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
  'lib/lsb-book.php',
  'lib/lsb-book-section.php',
  'lib/lsb-frontpage-filters.php',
  'lib/lsb-feed-util.php',
  'lib/lsb-boksok-options.php',
  'lib/taxonomy-util.php',
  'lib/lsb-query-util.php',
);

foreach ($roots_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// Initialize custom functionality
new LsbBook();
new LsbBookSection();
new LsbFeedUtil();
new LsbBoksokOptions();
new LsbFrontpageFilters();

add_filter( 'query_vars', function ($query_vars) {
  $query_vars[] = TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_lsb_cat');
  $query_vars[] = TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_age');
  $query_vars[] = TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_audience');
  return $query_vars;
});


function tax_query_for_slugs($slugs, $taxonomy) {
  return array(
    'taxonomy' => $taxonomy,
    'field'    => 'slug',
    'terms'    => explode(",", $slugs)
  );
}

function searchwp_include_only_search_vars( $ids, $engine, $terms ) {
  
  $lsb_cat_query_var = get_query_var(TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_lsb_cat'));
  $age_query_var = get_query_var(TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_age'));
  $audience_query_var = get_query_var(TaxonomyUtil::get_rewrite_slug_for_taxonomy('lsb_tax_audience'));
  
  $tax_query = array();
  if($lsb_cat_query_var)
    $tax_query[] = tax_query_for_slugs($lsb_cat_query_var, 'lsb_tax_lsb_cat');
  if($age_query_var)
    $tax_query[] = tax_query_for_slugs($age_query_var, 'lsb_tax_age');
  if($audience_query_var)
    $tax_query[] = tax_query_for_slugs($audience_query_var, 'lsb_tax_audience');
  
  if(count($tax_query) > 1)
    $tax_query['relation'] = 'AND';
  
  // get the IDs of all the posts in this category
  $args = array( 
    'post_type' => 'lsb_book',
    'tax_query' => $tax_query,
    'fields' => 'ids',
    'nopaging' => true
    
  );
  
  $ids = get_posts( $args );
  return $ids;
}
 
add_filter( 'searchwp_include', 'searchwp_include_only_search_vars', 10, 3 );
