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
  'lib/lsb-search-util.php'
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

function searchwp_include_only_search_vars( $ids, $engine, $terms ) {
  return LsbSearchUtil::filter_search();;
}
 
add_filter( 'searchwp_include', 'searchwp_include_only_search_vars', 10, 3 );
