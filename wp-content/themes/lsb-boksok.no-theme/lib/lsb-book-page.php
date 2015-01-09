<?php

class LsbBookPage {
  public function __construct() {
    add_action('init', array($this, 'register_field_group_book_page_filters_group'));
    add_action('init', array($this, 'register_field_group_book_page_info_group'));
  }
  
  public function register_field_group_book_page_info_group()
  {
    if( function_exists('register_field_group') )
    {
      
      $info_fields = array(
        array (
          'key' => 'lsb_acf_book_page_info_sub_title',
          'label' => _x('Underoverskrift', 'boksok section subheader', 'lsb_boksok'),
          'name' => 'lsb_book_page_sub_title',
          'prefix' => '',
          'type' => 'text',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'column_width' => '',
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'maxlength' => '',
          'readonly' => 0,
          'disabled' => 0,
        ),
        array (
          'key' => 'lsb_acf_book_page_info_description',
          'label' => _x('Beskrivelse', 'boksok section description', 'lsb_boksok'),
          'name' => 'lsb_book_page_description',
          'prefix' => '',
          'type' => 'textarea',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'column_width' => '',
          'default_value' => '',
          'placeholder' => '',
          'maxlength' => '',
          'rows' => '',
          'new_lines' => 'wpautop',
          'readonly' => 0,
          'disabled' => 0,
        ),
      );
      
      register_field_group(array (
          'key' => 'lsb_acf_book_page_info',
          'title' => 'Forsideinfo',
          'fields' => $info_fields,
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
  
  public function register_field_group_book_page_filters_group()
  {
    if( function_exists('register_field_group') )
    {
      $tax_fields = array();
      $tax_fields[] = array (
        'key' => 'lsb_acf_book_page_filter_sort_orderby',
        'label' => __('Sorteringskriterium', 'lsb_boksok'),
        'name' => 'lsb_book_page_filter_sort_orderby',
        'prefix' => '',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'column_width' => '',
        'choices' => array (
          'none' => 'Tilfeldig når bokhylle, Lagt til når side',
          'published' => 'Publisert',
          'added' => 'Lagt til',
        ),
        'other_choice' => 0,
        'save_other_choice' => 0,
        'default_value' => 'none',
        'layout' => 'horizontal',
      );
        
      $tax_fields[] = array (
        'key' => 'lsb_acf_book_page_filter_sort_order',
        'label' => __('Sorteringsrekkefølge', 'lsb_boksok'),
        'name' => 'lsb_book_page_filter_sort_order',
        'prefix' => '',
        'type' => 'radio',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'column_width' => '',
        'choices' => array (
            'DESC' => _x('Synkende', 'Section sort order descending', 'lsb_boksok'),
            'ASC' => _x('Stigende', 'Section sort order ascending', 'lsb_boksok'),
          ),
        'other_choice' => 0,
        'save_other_choice' => 0,
        'default_value' => 'DESC',
        'layout' => 'horizontal',
      );
      
      $lsb_book_tax_objects = get_object_taxonomies('lsb_book', 'objects' );
      foreach ($lsb_book_tax_objects as &$tax_object) {
        $tax_fields[] = array (
                  'key' => 'lsb_acf_book_page_filter_'.$tax_object->name,
                  'label' => $tax_object->label,
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
          'menu_order' => 10,
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
}