<?php

class LsbBoksokOptions {
  public function __construct() {
    add_action('init', array($this, 'add_options_page'));
    add_action('init', array($this, 'register_options_custom_fields'));
  }

  public function add_options_page() {
    if (function_exists('acf_add_options_page')) {
      acf_add_options_page(__('Boksøk innstillinger', 'lsb_boksok'));
    }
  }

  public function register_options_custom_fields() {
    if( function_exists('register_field_group') ):

      register_field_group(array (
      	'key' => 'lsb_boksok_options_field_group',
      	'title' => 'Boksøk Options',
      	'fields' => array (
      		array (
      			'key' => 'lsb_boksok_options_field_library_loan_link',
      			'label' => __('Lenke til side for Lån boken på biblioteket', 'lsb_boksok'),
      			'name' => 'lsb_boksok_option_page_for_library_loan',
      			'prefix' => '',
      			'type' => 'page_link',
      			'instructions' => '',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'post_type' => array (
      				0 => 'page',
      			),
      			'taxonomy' => '',
      			'allow_null' => 0,
      			'multiple' => 0,
      		),
          array(
            'key' => 'lsb_boksok_option_page_for_buying_book',
            'label' => __('Lenke til side for Kjøp boken', 'lsb_boksok'),
            'name' => 'lsb_boksok_option_page_for_buying_book',
            'prefix' => '',
            'type' => 'page_link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'post_type' => array (
              0 => 'page',
            ),
            'taxonomy' => '',
            'allow_null' => 0,
            'multiple' => 0,
          )
      	),
      	'location' => array (
      		array (
      			array (
      				'param' => 'options_page',
      				'operator' => '==',
      				'value' => 'acf-options-boksok-innstillinger',
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

?>
