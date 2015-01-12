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
  'lib/lsb-book-page.php',
  'lib/lsb-feed-util.php',
  'lib/lsb-boksok-options.php',
  'lib/taxonomy-util.php',
  'lib/lsb-filter-query-util.php',
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
new LsbFeedUtil();
new LsbBoksokOptions();
new LsbBookPage();

add_filter( 'query_vars', function ($query_vars) {
  $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
  foreach ($lsb_book_tax_objects as &$tax_object) {
    $query_vars[] = TaxonomyUtil::get_tax_object_rewrite_slug($tax_object);
  }
  return $query_vars;
});

function searchwp_activate_menu( $classes, $item ) {
  return LsbSearchUtil::activate_menu($classes, $item);
}

add_filter('nav_menu_css_class', 'searchwp_activate_menu', 100, 2);

function searchwp_include_only_search_vars( $ids, $engine, $terms ) {
  return LsbSearchUtil::filter_search();
}
 
add_filter( 'searchwp_include', 'searchwp_include_only_search_vars', 10, 3 );
