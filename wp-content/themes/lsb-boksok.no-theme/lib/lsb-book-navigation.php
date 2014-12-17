<?php

class LsbBookNavigation {
  public function __construct() {
    add_action('init', array($this, 'register_book_navigation_custom_field_group'));
  }

  public function register_book_navigation_custom_field_group() {
    if( function_exists('register_field_group') ):

      register_field_group(array (
          'key' => 'lsb_field_group_book_navigation',
          'title' => __('Book navigation', 'lsb_boksok'),
          'fields' => array (
            array (
              'key' => 'lsb_show_book_navigation_field',
              'label' => __('Vis boknavigasjon', 'lsb_boksok'),
              'name' => 'lsb_show_book_navigation_field',
              'prefix' => '',
              'type' => 'true_false',
              'instructions' => '',
              'required' => 1,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'message' => '',
              'default_value' => 0,
            ),
            array (
              'key' => 'lsb_show_book_navigation_top_level_field',
              'label' => __('Toppnivå', 'lsb_boksok'),
              'name' => 'lsb_show_book_navigation_top_level_field',
              'prefix' => '',
              'type' => 'repeater',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => array (
                  array (
                    array (
                      'field' => 'lsb_show_book_navigation_field',
                      'operator' => '==',
                      'value' => '1',
                    ),
                  ),
                ),
                'wrapper' => array (
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'min' => '',
                'max' => '',
                'layout' => 'row',
                'button_label' => __('Legg til rad', 'lsb_boksok'),
                'sub_fields' => array (
                    array (
                      'key' => 'lsb_show_book_navigation_top_level_title_field',
                      'label' => __('Tittel', 'lsb_boksok'),
                      'name' => 'title',
                      'prefix' => '',
                      'type' => 'text',
                      'instructions' => '',
                      'required' => 1,
                      'conditional_logic' => 0,
                      'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                      ),
                      'default_value' => '',
                      'placeholder' => '',
                      'prepend' => '',
                      'append' => '',
                      'maxlength' => '',
                      'readonly' => 0,
                      'disabled' => 0,
                    ),
                    array (
                      'key' => 'lsb_show_book_navigation_top_level_url_field',
                      'label' => __('URL', 'lsb_boksok'),
                      'name' => 'url',
                      'prefix' => '',
                      'type' => 'url',
                      'instructions' => '',
                      'required' => 1,
                      'conditional_logic' => 0,
                      'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                      ),
                      'default_value' => '',
                      'placeholder' => '',
                    ),
                    array (
                      'key' => 'lsb_show_book_navigation_sublevel_field',
                      'label' => __('Undernivå', 'lsb_boksok'),
                      'name' => 'sub_level',
                      'prefix' => '',
                      'type' => 'repeater',
                      'instructions' => '',
                      'required' => 0,
                      'conditional_logic' => 0,
                      'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                      ),
                      'min' => '',
                      'max' => '',
                      'layout' => 'row',
                      'button_label' => __('Legg til rad', 'lsb_boksok'),
                      'sub_fields' => array (
                          array (
                            'key' => 'lsb_show_book_navigation_sublevel_title_field',
                            'label' => __('Tittel', 'lsb_boksok'),
                            'name' => 'title',
                            'prefix' => '',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                              'width' => '',
                              'class' => '',
                              'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'maxlength' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                          ),
                          array (
                            'key' => 'lsb_show_book_navigation_sublevel_url_field',
                            'label' => __('URL', 'lsb_boksok'),
                            'name' => 'url',
                            'prefix' => '',
                            'type' => 'url',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array (
                              'width' => '',
                              'class' => '',
                              'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                          ),
                      ),
                  ),
              ),
            ),
          ),
          'location' => array (
              array (
                array (
                  'param' => 'page_template',
                  'operator' => '==',
                  'value' => 'template-boksok-frontpage.php',
                ),
              ),
          ),
          'menu_order' => 0,
          'position' => 'normal',
          'style' => 'default',
          'label_placement' => 'top',
          'instruction_placement' => 'label',
          'hide_on_screen' => '',
        ));
    endif;
  }
}
