<?php

/**
 * Collection of book queries for frontpage sections
 * - All queries respect frontpage book filters
 *
 */
class LsbQueryUtil {

  /**
   * Query for books for advanced frontpage section
   * - Frontpage book filters always outrank section fields
   *
   * @return $books query
   *
   */
  public static function boksok_frontpage_advanced_section_query() {

    $taxQuery = null;
    $terms = array();

    if ( get_field('lsb_frontpage_filter_age') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_age', get_field('lsb_frontpage_filter_age'), &$taxQuery, &$terms
      );
    } else if ( get_sub_field('section_age') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_age', get_sub_field('section_age'), &$taxQuery, &$terms
      );
    }

    if ( get_field('lsb_frontpage_filter_lsb_cat') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_lsb_cat', get_field('lsb_frontpage_filter_lsb_cat'), &$taxQuery, &$terms
      );
    } else if ( get_sub_field('section_lsb_cat') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_lsb_cat', get_sub_field('section_lsb_cat'), &$taxQuery, &$terms
      );
    }

    if ( get_field('lsb_frontpage_filter_audience') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_audience', get_field('lsb_frontpage_filter_audience'), &$taxQuery, &$terms
      );
    } else if ( get_sub_field('section_audience') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_audience', get_sub_field('section_audience'), &$taxQuery, &$terms
      );
    }

    if ( get_sub_field('section_customization') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_customization', get_sub_field('section_customization'), &$taxQuery, &$terms
      );
    }

    if ( get_sub_field('section_author') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_author', get_sub_field('section_author'), &$taxQuery, &$terms
      );
    }

    if ( get_sub_field('section_genre') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_genre', get_sub_field('section_genre'), &$taxQuery, &$terms
      );
    }

    if ( get_sub_field('section_topic') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_topic', get_sub_field('section_topic'), &$taxQuery, &$terms
      );
    }

    if ( get_sub_field('section_language') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_language', get_sub_field('section_language'), &$taxQuery, &$terms
      );
    }

    if ( get_sub_field('section_publisher') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_publisher', get_sub_field('section_publisher'), &$taxQuery, &$terms
      );
    }

    if ( get_sub_field('section_series') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_series', get_sub_field('section_series'), &$taxQuery, &$terms
      );
    }

    $args = self::query_args_with_tax_query($taxQuery);

    $orderby = null;
    $orderby = get_sub_field('section_orderby');
    $order = get_sub_field('section_order');

    if ($orderby) {
      switch($orderby) {
        case 'random':
        $args['orderby'] = 'rand';
        break;
        case 'added':
        $args['orderby'] = 'date';
        $args['order'] = $order;
        break;
        case 'published':
        $args['meta_key'] = 'lsb_published_year';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = $order;
        $args['meta_query'] = array(
        array(
        'key' => 'lsb_published_year'
        )
        );
        break;
        default:
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        break;
      }
    }
    $terms[] = $orderby;
    $terms[] = $order;

    $books = self::get_books('section_advanced', $terms, $args);

    // Remove non-queryable terms
    $terms = array_filter($terms, function ($term) {
      return $term !== "none"
      && $term !== "rand"
      && $term !== "date"
      && $term !== "DESC"
      && $term !== "ASC";
    });

    return array($books, $terms);
  }

  /**
    * Query for books for frontpage list section
    *
    * @return $books query
    *
    */
  public static function boksok_frontpage_list_section_query() {

    $list = get_sub_field('section_list');
    $taxQuery = null;
    $terms = array();

    self::construct_taxonomy_query_partial(
      'lsb_tax_list', array($list), &$taxQuery, &$terms
    );

    if ( get_field('lsb_frontpage_filter_age') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_age', get_field('lsb_frontpage_filter_age'), &$taxQuery, &$terms
      );
    }

    if ( get_field('lsb_frontpage_filter_lsb_cat') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_lsb_cat', get_field('lsb_frontpage_filter_lsb_cat'), &$taxQuery, &$terms
      );
    }

    if ( get_field('lsb_frontpage_filter_audience') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_audience', get_field('lsb_frontpage_filter_audience'), &$taxQuery, &$terms
      );
    }

    $args = self::query_args_with_tax_query($taxQuery);

    $books = self::get_books('section_list', $terms, $args);
    return array($books, $list);
  }

  /**
    * Query for books for frontpage list section
    *
    * @return $books query
    *
    */
  public static function boksok_frontpage_singlecustomization_section_query() {

    $customization = get_sub_field('section_singlecustomization');
    $taxQuery = null;
    $terms = array();

    self::construct_taxonomy_query_partial(
      'lsb_tax_customization', array($customization), &$taxQuery, &$terms
    );

    if ( get_field('lsb_frontpage_filter_age') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_age', get_field('lsb_frontpage_filter_age'), &$taxQuery, &$terms
      );
    }

    if ( get_field('lsb_frontpage_filter_lsb_cat') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_lsb_cat', get_field('lsb_frontpage_filter_lsb_cat'), &$taxQuery, &$terms
      );
    }

    if ( get_field('lsb_frontpage_filter_audience') ) {
      self::construct_taxonomy_query_partial(
        'lsb_tax_audience', get_field('lsb_frontpage_filter_audience'), &$taxQuery, &$terms
      );
    }

    $args = self::query_args_with_tax_query($taxQuery);
    $books = self::get_books('section_customization', $terms, $args);

    return array($books, $customization);
  }

  /**
   * Get array of books
   *
   * @param $section Name of section
   * @param $terms Array of hashable terms (for caching)
   * @param $args WP_Query arguments array
   *
   * @return Array of books
   *
   */
  private static function get_books($section, $terms, $args) {

    $hashed = $section . '_' . implode($terms);
    $hashed = hash('md5', $hashed);

    if ( false == ( $books = get_transient( $hashed ) ) ) {
      $books = new WP_Query($args);
      set_transient($hashed, $books, 3600);
    }

    return $books;
  }

  /**
   * Construct partial query for taxonomy
   *
   * @param $taxonomy The taxonomy
   * @param $objects Array of taxonomy term objects
   *
   * In-out parameters
   * @param &$tax_query
   * @param &$hashable_terms
   *
   */
  private static function construct_taxonomy_query_partial($taxonomy, $objects, &$tax_query, &$hashable_terms) {

    $util = new TaxonomyUtil();

    if ( !is_array($objects) ) {
      $objects = array( $objects );
    }

    $tax_query[] = array(
      'taxonomy' => $taxonomy,
      'field' => 'id',
      'terms' => array_map(array($util, 'get_id'), $objects)
    );
    $hashable_terms = array_merge( $hashable_terms, array_map(array($util, 'get_name'), $objects) );
  }

  /**
   * Get WP Query args array with taxonomy query
   *
   * @param $tax_query
   *
   * @return WP_Query args
   *
   */
  private static function query_args_with_tax_query($tax_query) {
    return array(
      'post_type' => 'lsb_book',
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
      'no_found_rows' => true,
      'post_status'=>'publish',
      'tax_query' => $tax_query
    );
  }
}
