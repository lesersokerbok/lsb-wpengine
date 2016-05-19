<?php

class LsbFilterQueryUtil {

  public static function tax_query_built_from_term_strings($terms_string, $taxonomy) {
    return array(
      'taxonomy' => $taxonomy,
      'field'    => 'slug',
      'terms'    => explode(",", $terms_string),
    );
  }

  public static function tax_query_built_from_term_objects($term_objects, $taxonomy) {
    return array(
      'taxonomy' => $taxonomy,
      'field' => 'id',
      'terms' => TaxonomyUtil::get_terms_id_array($term_objects)
    );
  }

  public static function filter_as_string($term_objects, $taxonomy) {
    return TaxonomyUtil::get_tax_label($taxonomy).
      ": ".implode(TaxonomyUtil::get_terms_name_array($term_objects), ', ');
  }

  public static function possible_query_vars_for_lsb_book() {
    $query_vars = array();
    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    foreach ($lsb_book_tax_objects as &$tax_object) {
      $query_vars[] = TaxonomyUtil::get_tax_object_rewrite_slug($tax_object);
    }
    return $query_vars;
  }

  public static function tax_query_built_from_query_vars() {

    $tax_query = array();
    $tax_query['relation'] = 'AND';

    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    foreach ($lsb_book_tax_objects as &$tax_object) {
      $terms_string = get_query_var($tax_object->rewrite['slug']);
      if($terms_string) {
        $tax_query[] = self::tax_query_built_from_term_strings($terms_string, $tax_object->name);
      }
    }

    return $tax_query;
  }

  public static function filters_for_book_page() {
    $filters = array();

    $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
    foreach ($lsb_book_tax_objects as &$tax_object) {
      $term_objects = get_field('lsb_book_page_filter_'.$tax_object->name);
      if($term_objects) {
        $filters[$tax_object->name] = $term_objects;
      }
    }

    return $filters;
  }

  public static function tax_query_for_book_page() {
    $filters = self::filters_for_book_page();
    $tax_query = array_map(array('LsbFilterQueryUtil', 'tax_query_built_from_term_objects'), $filters, array_keys($filters));

    return $tax_query;
  }

  public static function filters_string_for_book_page() {
    $filters = self::filters_for_book_page();
    $filters_string_array = array_map(array('LsbFilterQueryUtil', 'filter_as_string'), $filters, array_keys($filters));

    return implode($filters_string_array, " | ");
  }

  public static function add_order_to_args(&$args, $default = 'date') {
    $args['order'] = get_field('lsb_book_page_filter_sort_order');

    switch(get_field('lsb_book_page_filter_sort_orderby')) {
      case 'added':
        $args['orderby'] = 'date';
      break;
      case 'published':
        $args['meta_key'] = 'lsb_published_year';
        $args['orderby'] = 'meta_value_num';
        $args['meta_query'] = array(
          array(
            'key' => 'lsb_published_year'
          )
        );
      break;
      default:
        $args['orderby'] = $default;
      break;
    }
  }

  public static function get_books_args() {
    return array(
      'post_type' => 'lsb_book',
      'tax_query' => self::tax_query_for_book_page(),
    );
  }

  public static function get_books_for_book_page($paged = 0) {

    $args = self::get_books_args();

    $args['paged'] = $paged;

    self::add_order_to_args($args);

    if(!count($args['tax_query'])) {
      return new WP_Query();
    }

    $books = new WP_Query($args);
    return $books;
  }

  public static function get_books_for_book_shelf() {

    $args = self::get_books_args();

    $args['posts_per_page'] = 20;
    $args['update_post_term_cache'] = false;
    $args['update_post_meta_cache'] = false;
    $args['no_found_rows'] = true;

    self::add_order_to_args($args, 'rand');

    if(!count($args['tax_query'])) {
      return new WP_Query();
    }

    $hashed = get_the_permalink()."-".get_the_modified_time('G');
    $hashed = hash('md5', $hashed);

    if ( false == ( $books = get_transient( $hashed ) ) ) {
      $books = new WP_Query($args);
      set_transient($hashed, $books, 3600);
    }

    return $books;
  }

}

?>
