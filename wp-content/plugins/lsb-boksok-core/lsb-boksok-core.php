<?php
/**
 * Plugin Name: LSB Boksøk: Kjernefunksjonalitet
 * Description: Legger til innholdstypen bøker og Boksøk forsidefunksjoanlitet
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Boksok\Core;

include('class-lsb-book.php');
include('class-page-sections.php');
include('lsb-filter-query-util.php');
include('lsb-page-sections-util.php');
include('taxonomy-util.php');

new LsbBook();
new PageSections();

function boksok_get_search_form($form) {
	ob_start();
	require( 'searchform-boksok.php' );
	$form = ob_get_clean();
	return $form;
}
add_filter('get_search_form', __NAMESPACE__ .'\\boksok_get_search_form');

add_filter( 'query_vars', function ($query_vars) {
  return array_merge($query_vars, \LsbFilterQueryUtil::possible_query_vars_for_lsb_book());
});

function add_book_page_filter_css( $classes) {
  if(is_page_template( 'template-boksok-book-page.php' )) {
    $term_objects = get_field('lsb_book_page_filter_lsb_tax_lsb_cat');
    $term_slugs = TaxonomyUtil::get_terms_slug_array($term_objects);
    return array_merge($classes, $term_slugs);
  }

  return $classes;
}
add_filter( 'body_class', __NAMESPACE__ .'\\add_book_page_filter_css', 100, 2);
