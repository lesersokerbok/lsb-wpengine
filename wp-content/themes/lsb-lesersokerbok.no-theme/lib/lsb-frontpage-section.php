<?php

  class LsbFrontpageSection {
    public function __construct() {
      add_action('init', array($this, 'register_field_group_frontpage_section_field_group'));
    }

    public function register_field_group_frontpage_section_field_group()
    {
      if( function_exists('register_field_group') ):

        register_field_group(array (
        	'key' => 'group_53fefb126eb1b',
        	'title' => 'Forsideseksjoner',
        	'fields' => array (
        		array (
        			'key' => 'field_53fefb2ae5856',
        			'label' => 'Seksjon',
        			'name' => 'section',
        			'prefix' => '',
        			'type' => 'repeater',
        			'instructions' => '',
        			'required' => 0,
        			'conditional_logic' => 0,
        			'min' => '',
        			'max' => 2,
        			'layout' => 'row',
        			'button_label' => 'Legg til seksjon',
        			'sub_fields' => array (
        				array (
        					'key' => 'field_53fefb90e5858',
        					'label' => 'Seksjonstype',
        					'name' => 'section_type',
        					'prefix' => '',
        					'type' => 'radio',
        					'instructions' => '',
        					'required' => 0,
        					'conditional_logic' => 0,
        					'column_width' => '',
        					'choices' => array (
        						'textarea' => 'Tekstområde',
        						'services' => 'Tjenester',
                    'normal_feed' => 'Vanlig feed',
                    'lsb_book_feed' => 'Bok-feed',
        					),
        					'other_choice' => 0,
        					'save_other_choice' => 0,
        					'default_value' => '',
        					'layout' => 'horizontal',
        				),
                array (
                  'key' => 'field_5406c8eeaa18d',
                  'label' => 'Overskrift',
                  'name' => 'section_feed_header',
                  'prefix' => '',
                  'type' => 'text',
                  'instructions' => '',
                  'required' => 0,
                  'conditional_logic' => array (
                    array (
                      'rule_0' => array (
                        'field' => 'field_53fefb90e5858',
                        'operator' => '==',
                        'value' => 'normal_feed',
                      ),
                    ),
                    array (
                      'rule_0' => array (
                        'field' => 'field_53fefb90e5858',
                        'operator' => '==',
                        'value' => 'lsb_book_feed',
                      ),
                    ),
                  ),
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
                  'key' => 'field_5406c918aa18f',
                  'label' => 'Feed URL',
                  'name' => 'section_feed_url',
                  'prefix' => '',
                  'type' => 'text',
                  'instructions' => '',
                  'required' => 0,
                  'conditional_logic' => array (
                    array (
                      'rule_0' => array (
                        'field' => 'field_53fefb90e5858',
                        'operator' => '==',
                        'value' => 'normal_feed',
                      ),
                    ),
                    array (
                      'rule_0' => array (
                        'field' => 'field_53fefb90e5858',
                        'operator' => '==',
                        'value' => 'lsb_book_feed',
                      ),
                    ),
                  ),
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
        					'key' => 'field_53fefc5d98de6',
        					'label' => 'Tekst',
        					'name' => 'section_text',
        					'prefix' => '',
        					'type' => 'wysiwyg',
        					'instructions' => '',
        					'required' => 0,
        					'conditional_logic' => array (
        						array (
        							array (
        								'field' => 'field_53fefb90e5858',
        								'operator' => '==',
        								'value' => 'textarea',
        							),
        						),
        					),
        					'column_width' => '',
        					'default_value' => '',
        					'toolbar' => 'basic',
        					'media_upload' => 0,
        				),
        				array (
        					'key' => 'field_53ff0ed34ee21',
        					'label' => 'Tjeneste',
        					'name' => 'section_service',
        					'prefix' => '',
        					'type' => 'repeater',
        					'instructions' => '',
        					'required' => 0,
        					'conditional_logic' => array (
        						array (
        							array (
        								'field' => 'field_53fefb90e5858',
        								'operator' => '==',
        								'value' => 'services',
        							),
        						),
        					),
        					'column_width' => '',
        					'min' => '',
        					'max' => '',
        					'layout' => 'row',
        					'button_label' => 'Add Row',
        					'sub_fields' => array (
        						array (
        							'key' => 'field_53ff0eec4ee22',
        							'label' => 'Overskrift',
        							'name' => 'section_service_heading',
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
        							'key' => 'field_53ff0f0a4ee23',
        							'label' => 'Tekst',
        							'name' => 'section_service_text',
        							'prefix' => '',
        							'type' => 'wysiwyg',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => 0,
        							'column_width' => '',
        							'default_value' => '',
        							'toolbar' => 'basic',
        							'media_upload' => 0,
        						),
        						array (
        							'key' => 'field_5405af887ace5',
        							'label' => 'Lenketype',
        							'name' => 'section_service_link_type',
        							'prefix' => '',
        							'type' => 'radio',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => 0,
        							'column_width' => '',
        							'choices' => array (
        								'internal' => 'Internt innhold',
        								'external' => 'Ekstern lenke',
        							),
        							'other_choice' => 0,
        							'save_other_choice' => 0,
        							'default_value' => '',
        							'layout' => 'horizontal',
        						),
        						array (
        							'key' => 'field_5405afd97ace6',
        							'label' => 'Lenke til innhold',
        							'name' => 'section_service_link_internal',
        							'prefix' => '',
        							'type' => 'page_link',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => array (
        								array (
        									array (
        										'field' => 'field_5405af887ace5',
        										'operator' => '==',
        										'value' => 'internal',
        									),
        								),
        							),
        							'column_width' => '',
        							'post_type' => array (
        								0 => 'post',
        								1 => 'page',
        							),
        							'taxonomy' => '',
        							'allow_null' => 0,
        							'multiple' => 0,
        						),
        						array (
        							'key' => 'field_5405b0107ace7',
        							'label' => 'Ekstern lenke',
        							'name' => 'section_service_link_external',
        							'prefix' => '',
        							'type' => 'text',
        							'instructions' => '',
        							'required' => 0,
        							'conditional_logic' => array (
        								array (
        									array (
        										'field' => 'field_5405af887ace5',
        										'operator' => '==',
        										'value' => 'external',
        									),
        								),
        							),
        							'column_width' => '',
        							'default_value' => '',
        							'placeholder' => 'http://',
        							'prepend' => '',
        							'append' => '',
        							'maxlength' => '',
        							'readonly' => 0,
        							'disabled' => 0,
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
        				'value' => 'template-frontpage.php',
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

      endif;
    }

  }

?>
