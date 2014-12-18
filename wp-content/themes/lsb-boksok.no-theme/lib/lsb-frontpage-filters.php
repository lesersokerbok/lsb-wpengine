<?php

class LsbFrontpageFilters {
  public function __construct() {
    add_action('init', array($this, 'register_field_group_frontpage_filters_group'));
  }

  public function register_field_group_frontpage_filters_group()
  {
    if( function_exists('register_field_group') )
    {
      register_field_group(array (
          'key' => 'group_5492d99ec476f',
          'title' => 'Forsidefilter',
          'fields' => array (
              array (
                  'key' => 'field_5492d9a87f48d',
                  'label' => 'Hovedkategori',
                  'name' => 'lsb_frontpage_filter_lsb_cat',
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
                  'taxonomy' => 'lsb_tax_lsb_cat',
                  'field_type' => 'radio',
                  'allow_null' => 1,
                  'load_save_terms' => 0,
                  'return_format' => 'object',
                  'multiple' => 0,
              ),
              array (
                  'key' => 'field_5492da807f48e',
                  'label' => 'Alder',
                  'name' => 'lsb_frontpage_filter_age',
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
                  'taxonomy' => 'lsb_tax_age',
                  'field_type' => 'checkbox',
                  'allow_null' => 1,
                  'load_save_terms' => 0,
                  'return_format' => 'object',
                  'multiple' => 0,
              ),
              array (
                  'key' => 'field_5492db9b13515',
                  'label' => 'Målgruppe',
                  'name' => 'lsb_frontpage_filter_audience',
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
                  'taxonomy' => 'lsb_tax_audience',
                  'field_type' => 'checkbox',
                  'allow_null' => 1,
                  'load_save_terms' => 0,
                  'return_format' => 'object',
                  'multiple' => 0,
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
          'hide_on_screen' => array (
              0 => 'the_content',
          ),
      ));
    }
  }
}

?>
