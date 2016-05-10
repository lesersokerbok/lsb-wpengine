<?php
/**
 * Plugin Name: LSB Seksjoner
 * Description: Legger til seksjoner på forside template.
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Page;

include('class-section.php');

new Section();

function the_text_block_url() {
	if ('external' == get_sub_field('text_block_url_type') && get_sub_field('text_block_external_url')) {
		echo get_sub_field('text_block_external_url');
	} elseif ('internal' == get_sub_field('text_block_url_type') && get_sub_field('text_block_internal_url')) {
		echo get_sub_field('text_block_internal_url');
	} else {
		error_log('LSB/PageSection: Text block missing url');
	}
}

function get_text_block_icon_url() {
	$icon = get_sub_field('text_block_icon');
	if( is_array( $icon) && array_key_exists ('sizes', $icon) && array_key_exists ( 'thumbnail', $icon['sizes'] ) ) {
		return $icon['sizes']['thumbnail'];
	} else {
		return '';
	}
}

function the_text_block_icon_url() {
	echo get_text_block_icon_url();
}
