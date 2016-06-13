<?php

class LsbPageSectionsUtil {

  private static function tax_query_built_from_term_objects($term_objects, $taxonomy) {
    return array(
      'taxonomy' => $taxonomy,
      'field' => 'term_id',
      'terms' => TaxonomyUtil::get_terms_id_array($term_objects)
    );
  }

  private static function get_selected_terms_dictonary($section_type) {
    // At the moment only one term in one taxonomy is allowed,
    // but this will allow for future multiple selectiong

    $taxonomy_dictonary = array();

    while( have_rows('lsb_acf_page_section_'.$section_type.'_taxonomy') ) {
      the_row();
      foreach( get_object_taxonomies('lsb_book', 'objects' ) as &$tax_object ) {
        $terms = get_sub_field('lsb_page_section_'.$section_type.'_taxonomy_'.$tax_object->name.'_terms');

        if($terms) {
          if(!is_array($terms)) {
            $terms = array($terms);
          }
          $taxonomy_dictonary[$tax_object->name] = $terms;
        }
      }
    }

    if(is_tax()) {
      $archive_term = get_queried_object();
      $taxonomy_dictonary[$archive_term->taxonomy] = array($archive_term);
    }

    return $taxonomy_dictonary;
  }

  private static function add_tax_query_for_book_shelf(&$args, $selected_terms) {
    $tax_query = array_map(
      array('self', 'tax_query_built_from_term_objects'),
      $selected_terms,
      array_keys($selected_terms)
    );
    $args['tax_query'] = $tax_query;
  }

  public static function add_order_to_args(&$args) {

    switch(get_sub_field('lsb_page_section_book_shelf_orderby')) {
      case 'published':
        $args['meta_key'] = 'lsb_published_year';
        $args['orderby'] = 'meta_value_num';
        $args['meta_query'] = array(
          array(
            'key' => 'lsb_published_year'
          )
        );
      break;
      case 'random':
        $args['orderby'] = 'rand';
      break;
      default:
        // Do nothing as default i date
        $args['orderby'] = 'date';
      break;
    }
  }

  public static function get_terms_for_navigation() {
    $selected_terms = self::get_selected_terms_dictonary('navigation');
    $navigation_terms = array();

    foreach($selected_terms as $taxonomy_terms) {
      $navigation_terms = array_merge($navigation_terms, $taxonomy_terms);
    }

    usort($navigation_terms, array('TaxonomyUtil', 'sort_terms_by_name'));

    return (object) array(
      'with_icons' => array_filter($navigation_terms, array('TaxonomyUtil', 'term_has_icon')),
      'without_icons' => array_filter($navigation_terms, array('TaxonomyUtil', 'term_has_no_icon')),
      'all' => $navigation_terms
    );
  }


  public static function get_books_for_book_shelf() {

    $args = array(
      'post_type' => 'lsb_book',
      'posts_per_page' => 20,
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
      'no_found_rows' => true,
    );

    self::add_tax_query_for_book_shelf($args, self::get_selected_terms_dictonary('book_shelf'));
    self::add_order_to_args($args);

    $hashed = get_sub_field('lsb_page_section_title').'-'.get_the_modified_time('G');
    $hashed = hash('md5', $hashed);
    $books = get_transient( $hashed );

    if ( !$books || WP_DEBUG ) {
      $books = new WP_Query($args);
      set_transient($hashed, $books, 3600);
    }

    return $books;
  }


  public static function get_link_for_book_shelf() {
    $selected_terms = self::get_selected_terms_dictonary('book_shelf');
    $taxonomy_keys = array_keys($selected_terms);
    if( !$taxonomy_keys ) {
      return '';
    }
    $selected_taxonomy = $selected_terms[$taxonomy_keys[0]];
    $selected_term = $selected_taxonomy[0];

    return esc_url(get_term_link( $selected_term, $selected_taxonomy ));
  }
}
