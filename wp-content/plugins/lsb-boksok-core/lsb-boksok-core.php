<?php
/**
 * Plugin Name: LSB Boksøk: Kjernefunksjonalitet
 * Description: Legger til innholdstypen bøker og Boksøk forsidefunksjoanlitet
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Boksok\Core;

include('class-lsb-book.php');

new LsbBook();

function boksok_get_search_form($form) {
	ob_start();
	require( 'searchform-boksok.php' );
	$form = ob_get_clean();
	return $form;
}
add_filter('get_search_form', __NAMESPACE__ .'\\boksok_get_search_form');
