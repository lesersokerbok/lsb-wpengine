<?php

	namespace LSB\Page;

	class Section {

		public function __construct() {

//			add_action( 'acf/init', array( &$this, 'register_adcf_field_groups' ) );
		}

		public function register_adcf_field_groups() {

			acf_add_local_field_group(array (
				'key' => 'group_5710b1673bd2b',
				'title' => 'Seksjoner',
				'fields' => array (
					array (
						'key' => 'field_5710b171df4e4',
						'label' => 'Seksjoner',
						'name' => 'sections',
						'type' => 'flexible_content',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => 'lsb-section',
							'id' => '',
						),
						'button_label' => 'Legg til seksjon',
						'min' => '',
						'max' => '',
						'layouts' => array (
							array (
								'key' => '5710bf9fdd718',
								'name' => 'intro',
								'label' => 'Intro',
								'display' => 'table',
								'sub_fields' => array (
									array (
										'key' => 'field_5710bfbbdd719',
										'label' => 'Video',
										'name' => 'intro_video',
										'type' => 'oembed',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array (
											'width' => '41.66',
											'class' => '',
											'id' => '',
										),
										'width' => '',
										'height' => '',
									),
									array (
										'key' => 'field_5710bfcadd71a',
										'label' => 'Introtekst',
										'name' => 'intro_text',
										'type' => 'wysiwyg',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array (
											'width' => '66%',
											'class' => '',
											'id' => '',
										),
										'default_value' => '',
										'tabs' => 'all',
										'toolbar' => 'full',
										'media_upload' => 0,
									),
								),
								'min' => '',
								'max' => '',
							),
							array (
								'key' => '5710b4d9170f9',
								'name' => 'books',
								'label' => 'Siste fra boksok.no',
								'display' => 'row',
								'sub_fields' => array (
									array (
										'key' => 'field_5710c23e6c4a9',
										'label' => 'Overskrift',
										'name' => 'books_heading',
										'type' => 'text',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array (
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 'Nyeste anmeldelser fra boksøk.no',
										'placeholder' => '',
										'prepend' => '',
										'append' => '',
										'maxlength' => '',
										'readonly' => 0,
										'disabled' => 0,
									),
									array (
										'key' => 'field_5710b4fc170fa',
										'label' => 'Boksøk feed url',
										'name' => 'books_feed_url',
										'type' => 'url',
										'instructions' => '',
										'required' => 1,
										'conditional_logic' => 0,
										'wrapper' => array (
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 'http://boksok.no/bok/feed/',
										'placeholder' => '',
									),
									array (
										'key' => 'field_5710c2716c4ab',
										'label' => 'Overskriftslenke',
										'name' => 'books_heading_link',
										'type' => 'url',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array (
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'default_value' => 'http://boksok.no',
										'placeholder' => '',
									),
								),
								'min' => '',
								'max' => '',
							),
							array (
								'key' => '5710cd98d96d2',
								'name' => 'grid',
								'label' => 'Grid',
								'display' => 'row',
								'sub_fields' => array (
									array (
										'key' => 'field_5710cdb1d96d3',
										'label' => 'Blokker',
										'name' => 'blocks',
										'type' => 'flexible_content',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array (
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'button_label' => 'Legg til blokk',
										'min' => '',
										'max' => 6,
										'layouts' => array (
											array (
												'key' => '5714d33c032d6',
												'name' => 'grid_block_text',
												'label' => 'Tekstblokk',
												'display' => 'block',
												'sub_fields' => array (
													array (
														'key' => 'field_5714d3a0d13fd',
														'label' => 'Tittel',
														'name' => 'grid_block_text_title',
														'type' => 'text',
														'instructions' => '',
														'required' => 0,
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
														'key' => 'field_5714d3c9d13fe',
														'label' => 'Innhold',
														'name' => 'grid_block_text_content',
														'type' => 'wysiwyg',
														'instructions' => '',
														'required' => 0,
														'conditional_logic' => 0,
														'wrapper' => array (
															'width' => '',
															'class' => '',
															'id' => '',
														),
														'default_value' => '',
														'tabs' => 'all',
														'toolbar' => 'basic',
														'media_upload' => 1,
													),
													array (
														'key' => 'field_5714e3715b2b2',
														'label' => 'Lenketype',
														'name' => 'grid_block_text_url_type',
														'type' => 'radio',
														'instructions' => 'Blokkens lenke, brukes av overskrift og les mer lenke.',
														'required' => 0,
														'conditional_logic' => 0,
														'wrapper' => array (
															'width' => '',
															'class' => '',
															'id' => '',
														),
														'choices' => array (
															'none' => 'Ingen',
															'internal' => 'Intern',
															'external' => 'Ekstern',
														),
														'other_choice' => 0,
														'save_other_choice' => 0,
														'default_value' => 'none',
														'layout' => 'horizontal',
													),
													array (
														'key' => 'field_5714e2fa5b2b0',
														'label' => 'Intern url',
														'name' => 'grid_block_text_internal_url',
														'type' => 'page_link',
														'instructions' => '',
														'required' => 0,
														'conditional_logic' => array (
															array (
																array (
																	'field' => 'field_5714e3715b2b2',
																	'operator' => '==',
																	'value' => 'internal',
																),
															),
														),
														'wrapper' => array (
															'width' => '',
															'class' => '',
															'id' => '',
														),
														'post_type' => array (
														),
														'taxonomy' => array (
														),
														'allow_null' => 0,
														'multiple' => 0,
													),
													array (
														'key' => 'field_5714e3225b2b1',
														'label' => 'Ekstern url',
														'name' => 'grid_block_text_external_url',
														'type' => 'url',
														'instructions' => '',
														'required' => 0,
														'conditional_logic' => array (
															array (
																array (
																	'field' => 'field_5714e3715b2b2',
																	'operator' => '==',
																	'value' => 'external',
																),
															),
														),
														'wrapper' => array (
															'width' => '',
															'class' => '',
															'id' => '',
														),
														'default_value' => '',
														'placeholder' => '',
													),
												),
												'min' => '',
												'max' => '',
											),
											array (
												'key' => '5714d40be4557',
												'name' => 'grid_block_oembed',
												'label' => 'Video/oembed-blokk',
												'display' => 'block',
												'sub_fields' => array (
													array (
														'key' => 'field_5714d421e4558',
														'label' => 'Video/oembed',
														'name' => 'grid_block_oembed',
														'type' => 'oembed',
														'instructions' => '',
														'required' => 0,
														'conditional_logic' => 0,
														'wrapper' => array (
															'width' => '',
															'class' => '',
															'id' => '',
														),
														'width' => '',
														'height' => '',
													),
												),
												'min' => '',
												'max' => '',
											),
										),
									),
								),
								'min' => '',
								'max' => '',
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
				'position' => 'acf_after_title',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array (
					0 => 'the_content',
				),
				'active' => 1,
				'description' => '',
			));

		}
	}

?>
