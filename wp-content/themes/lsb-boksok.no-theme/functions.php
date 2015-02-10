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

function add_book_page_filter_css( $classes) {
  if(is_page_template( 'template-boksok-book-page.php' )) {
    $term_objects = get_field('lsb_book_page_filter_lsb_tax_lsb_cat');
    $term_slugs = TaxonomyUtil::get_terms_slug_array($term_objects);
    return array_merge($classes, $term_slugs);
  }
  
  return $classes;
}

function searchwp_activate_cat_menu_item( $classes) {
  if(is_search()) {
    var_dump("SEARCH");
    return LsbSearchUtil::activate_cat_menu_item($classes);
  }
  
  return $classes;
}

function searchwp_filter_search( $ids, $engine, $terms ) {
  return LsbSearchUtil::filter_search();
}

add_filter( 'body_class', 'add_book_page_filter_css', 100, 2);
add_filter( 'nav_menu_css_class', 'searchwp_activate_cat_menu_item', 100, 2);
add_filter( 'searchwp_include', 'searchwp_filter_search', 10, 3 );
