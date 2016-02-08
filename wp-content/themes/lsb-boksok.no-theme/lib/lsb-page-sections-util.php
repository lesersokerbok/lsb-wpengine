<?php

class LsbPageSectionsUtil {

  private static function tax_query_built_from_term_objects($term_objects, $taxonomy) {
    return array(
      'taxonomy' => $taxonomy,
      'field' => 'term_id',
      'terms' => TaxonomyUtil::get_terms_id_array($term_objects)
    );
  }

  private static function get_selected_terms_in_taxonomy_dictonary() {
    // At the moment only one term in one taxonomy is allowed,
    // but this will allow for future multiple selectiong

    $taxonomy_dictonary = array();

    while( have_rows('lsb_acf_page_section_book_shelf_taxonomy') ) {
      the_row();
      foreach( get_object_taxonomies('lsb_book', 'objects' ) as &$tax_object ) {
        $term_objects = get_sub_field('lsb_page_section_book_shelf_taxonomy_'.$tax_object->name.'_terms');

        if( $term_objects && !is_array( $term_objects ) ) {
          $term_objects = array($term_objects);
        }
        if($term_objects) {
          $taxonomy_dictonary[$tax_object->name] = $term_objects;
        }
      }
    }

    return $taxonomy_dictonary;
  }

  private static function add_tax_query_for_book_shelf(&$args) {
    $selected_terms_in_taxonomy_dictonary = self::get_selected_terms_in_taxonomy_dictonary();
    $tax_query = array_map(
      array('self', 'tax_query_built_from_term_objects'),
      $selected_terms_in_taxonomy_dictonary,
      array_keys($selected_terms_in_taxonomy_dictonary)
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
      break;
    }
  }

  public static function get_books_for_book_shelf() {

    $args = array(
      'post_type' => 'lsb_book',
      'posts_per_page' => 20,
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
      'no_found_rows' => true,
    );

    self::add_tax_query_for_book_shelf($args);
    self::add_order_to_args($args);

    $hashed = get_sub_field('lsb_page_section_title').'-'.get_the_modified_time('G');
    $hashed = hash('md5', $hashed);
    $books = get_transient( $hashed );

    if ( !$books ) {
      $books = new WP_Query($args);
      set_transient($hashed, $books, 3600);
    }

    return $books;
  }


  public static function get_link_for_book_shelf() {
    $selected_terms_in_taxonomy_dictonary = self::get_selected_terms_in_taxonomy_dictonary();
    $taxonomy_keys = array_keys($selected_terms_in_taxonomy_dictonary);
    if( !$taxonomy_keys ) {
      return '';
    }
    $selected_taxonomy = $selected_terms_in_taxonomy_dictonary[$taxonomy_keys[0]];
    $selected_term_object = $selected_taxonomy[0];

    return esc_url(get_term_link( $selected_term_object, $selected_taxonomy ));
  }
}
