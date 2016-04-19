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
	if ('external' == get_sub_field('grid_block_text_url_type') && get_sub_field('grid_block_text_external_url')) {
		echo get_sub_field('grid_block_text_external_url');
	} elseif ('internal' == get_sub_field('grid_block_text_url_type') && get_sub_field('grid_block_text_internal_url')) {
		echo get_sub_field('grid_block_text_internal_url');
	} else {
		error_log('LSB/PageSection: Text block missing url');
	}
}

function the_text_block_icon_url() {
	$icon = get_sub_field('grid_block_text_icon');
	echo $icon['sizes']['thumbnail'];
}
