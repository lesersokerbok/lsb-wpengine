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
include('lsb-search-util.php');
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

function searchwp_activate_cat_menu_item( $classes) {
  if(is_search()) {
    return \LsbSearchUtil::activate_cat_menu_item($classes);
  }

  return $classes;
}
add_filter( 'nav_menu_css_class', __NAMESPACE__ .'\\searchwp_activate_cat_menu_item', 100, 2);

function searchwp_filter_search( $ids, $engine, $terms ) {
  /* Use this filter to define the pool of potential results SearchWP can use when running searches. */
  /* https://searchwp.com/docs/hooks/searchwp_include/ */
  return \LsbSearchUtil::books_matching_current_query_vars();
}
add_filter( 'searchwp_include', __NAMESPACE__ .'\\searchwp_filter_search', 10, 3 );

function add_search_alert() {
	$alert_text = \LsbSearchUtil::alert_text();
	if($alert_text) {
		echo '<p>';
		printf(__('Viser kun treff i %s', 'lsb'), $alert_text);
		echo '<br/>';
		printf(__('Det er mulig å søke etter <strong>%1$s</strong> <a href="/?s=%1$s">i alle bøker</a>', 'lsb'), get_search_query());
		echo '</p>';
	}
}
add_action( 'search_alert', __NAMESPACE__ .'\\add_search_alert' );
