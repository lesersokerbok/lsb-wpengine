<?php

class LsbBookPage {
  public function __construct() {
    add_action('init', array($this, 'register_field_group_book_page_filters_group'));
  }
  
  public function register_field_group_book_page_filters_group()
  {
    if( function_exists('register_field_group') )
    {
      $tax_fields = array();
      
      $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
      foreach ($lsb_book_tax_objects as &$tax_object) {
        $tax_fields[] = array (
                  'key' => 'lsb_acf_book_page_filter_'.$tax_object->name,
                  'label' => $tax_object->labels->name,
                  'name' => 'lsb_book_page_filter_'.$tax_object->name,
                  'prefix' => '',
                  'type' => 'taxonomy',
                  'instructions' => '',
                  'required' => 0,
                  'conditional_logic' => 0,
                  'wrapper' => array (
                      'width' => '33%',
                      'class' => '',
                      'id' => '',
                  ),
                  'taxonomy' => $tax_object->name,
                  'field_type' => 'multi_select',
                  'allow_null' => 1,
                  'load_save_terms' => 0,
                  'return_format' => 'object',
                  'multiple' => 0,
              );
      }
      
      register_field_group(array (
          'key' => 'lsb_acf_book_page_filter_lsb_tax',
          'title' => 'Forsidefilter',
          'fields' => $tax_fields,
          'location' => array (
              array (
                  array (
                      'param' => 'page_template',
                      'operator' => '==',
                      'value' => 'template-boksok-book-page.php',
                  ),
              ),
          ),
          'menu_order' => 0,
          'position' => 'normal',
          'style' => 'default',
          'label_placement' => 'top',
          'instruction_placement' => 'label',
          'hide_on_screen' => array (
              0 => 'the_content',
          ),
      ));
    }
  }
  
  public static function get_books($paged) {
    
    $args = array(
      'post_type' => 'lsb_book',
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
//      'no_found_rows' => true,
      'post_status'=>'publish',
      'tax_query' => LsbFilterQueryUtil::tax_query_for_book_page(),
      'page' => $paged
    );
    
    $books = new WP_Query($args);
    
    return $books;
  }
}