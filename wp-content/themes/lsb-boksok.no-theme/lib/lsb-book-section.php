<?php

class LsbBookSection {
  public function __construct() {
    add_action('init', array($this, 'register_field_group_book_section_field_group'));
  }

  public function register_field_group_book_section_field_group()
  {
    if( function_exists('register_field_group') )
    {
      register_field_group(array (
        'key' => 'group_53e470310af9e',
        'title' => _x('Boksøk', 'boksok field group title', 'lsb_boksok'),
        'fields' => array (
          array (
            'key' => 'field_53ea178ee2481',
            'label' => __('Bokseksjon', 'lsb_boksok'),
            'name' => 'book_section',
            'prefix' => '',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'min' => '',
            'max' => '',
            'layout' => 'row',
            'button_label' => _x('Legg til seksjon', 'boksok add section button label', 'lsb_boksok'),
            'sub_fields' => array (
              array (
                'key' => 'field_53ea181ee2483',
                'label' => __('Seksjonstype', 'lsb_boksok'),
                'name' => 'section_type',
                'prefix' => '',
                'type' => 'radio',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'column_width' => '',
                'choices' => array (
                  'list' => _x('Liste', 'boksok section type list', 'lsb_boksok'),
                  'singlecustomization' => _x('Tilpasning', 'boksok section type customization', 'lsb_boksok'),
                  'advanced' => _x('Avansert', 'boksok section type advanced', 'lsb_boksok'),
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'horizontal',
              ),
              array (
                'key' => 'field_53ea1856e2484',
                'label' => _x('Liste', 'boksok section type list', 'lsb_boksok'),
                'name' => 'section_list',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'list',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_list',
                'field_type' => 'select',
                'allow_null' => 0,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53f33d52edaf0',
                'label' => 'Tilpasning',
                'name' => 'section_singlecustomization',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'singlecustomization',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_customization',
                'field_type' => 'select',
                'allow_null' => 0,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1bce16a41',
                'label' => _x('Overskrift', 'boksok section header', 'lsb_boksok'),
                'name' => 'section_header',
                'prefix' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
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
                'key' => 'field_53ea1c1d16a44',
                'label' => _x('Underoverskrift', 'boksok section subheader', 'lsb_boksok'),
                'name' => 'section_sub_header',
                'prefix' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
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
                'key' => 'field_53ea1c3716a45',
                'label' => _x('Beskrivelse', 'boksok section description', 'lsb_boksok'),
                'name' => 'section_description',
                'prefix' => '',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => 'wpautop',
                'readonly' => 0,
                'disabled' => 0,
              ),
              array (
                'key' => 'lsb_book_section_field_target_page',
                'label' => __('Lenke til side', 'lsb_boksok'),
                'name' => 'section_target_page',
                'prefix' => '',
                'type' => 'page_link',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                    array (
                      'rule_0' => array (
                        'field' => 'field_53ea181ee2483',
                        'operator' => '==',
                        'value' => 'advanced',
                      ),
                    ),
                ),
                'column_width' => '',
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => 'wpautop',
                'readonly' => 0,
                'disabled' => 0,
              ),
              array (
                'key' => 'field_53ea1c5616a46',
                'label' => __('Forfatter', 'lsb_boksok'),
                'name' => 'section_author',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_author',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1cbc16a47',
                'label' => __('Illustratør', 'lsb_boksok'),
                'name' => 'section_illustrator',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_illustrator',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1cec0dcca',
                'label' => __('Oversetter', 'lsb_boksok'),
                'name' => 'section_translator',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_translator',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1d100dccb',
                'label' => __('Forlag', 'lsb_boksok'),
                'name' => 'section_publisher',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_publisher',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1d3c0dccc',
                'label' => __('Sjanger', 'lsb_boksok'),
                'name' => 'section_genre',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_genre',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1d5d0dccd',
                'label' => __('Alder', 'lsb_boksok'),
                'name' => 'section_age',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_age',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'lsb_book_section_field_tax_lsb_cat',
                'label' => __('Hovedkategori', 'lsb_boksok'),
                'name' => 'section_tax_lsb_cat',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_lsb_cat',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'lsb_book_section_field_tax_audience',
                'label' => __('Målgruppe', 'lsb_boksok'),
                'name' => 'section_tax_audience',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_audience',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1d847e637',
                'label' => __('Tilpasning', 'lsb_boksok'),
                'name' => 'section_customization',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_customization',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1dad7e638',
                'label' => __('Emne', 'lsb_boksok'),
                'name' => 'section_topic',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_topic',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea1dce7e639',
                'label' => __('Språk', 'lsb_boksok'),
                'name' => 'section_language',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_language',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea27e5b8a7b',
                'label' => __('Serie', 'lsb_boksok'),
                'name' => 'section_series',
                'prefix' => '',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'taxonomy' => 'lsb_tax_series',
                'field_type' => 'multi_select',
                'allow_null' => 1,
                'load_save_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
              ),
              array (
                'key' => 'field_53ea21dc631b0',
                'label' => __('Sorteringskriterium', 'lsb_boksok'),
                'name' => 'section_orderby',
                'prefix' => '',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                  ),
                ),
                'column_width' => '',
                'choices' => array (
                  'none' => 'Ingen',
                  'random' => 'Tilfeldig',
                  'published' => 'Publisert',
                  'added' => 'Lagt til',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'none',
                'layout' => 'horizontal',
              ),
              array (
                'key' => 'field_53ea2219631b1',
                'label' => __('Sorteringsrekkefølge', 'lsb_boksok'),
                'name' => 'section_order',
                'prefix' => '',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array (
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                    '53ea2246631b2' => array (
                      'field' => 'field_53ea21dc631b0',
                      'operator' => '==',
                      'value' => 'published',
                    ),
                  ),
                  array (
                    'rule_0' => array (
                      'field' => 'field_53ea181ee2483',
                      'operator' => '==',
                      'value' => 'advanced',
                    ),
                    '53ea225b631b4' => array (
                      'field' => 'field_53ea21dc631b0',
                      'operator' => '==',
                      'value' => 'added',
                    ),
                  ),
                ),
                'column_width' => '',
                'choices' => array (
                  'DESC' => _x('Synkende', 'Section sort order descending', 'lsb_boksok'),
                  'ASC' => _x('Stigende', 'Section sort order ascending', 'lsb_boksok'),
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'DESC',
                'layout' => 'horizontal',
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

?>
