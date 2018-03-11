<?php
/**
 * Plugin Name: LSB: Migration
 * Description: Migration
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

function lsb_supported_migration() {
  error_log("MIGRATE");
  $books = get_posts(array(
    'numberposts'	=> -1,
    'post_type'		=> 'lsb_book',
    'meta_key'		=> 'lsb_supported',
	  'meta_value'	=> '1'
  ));

  error_log(count($books));

  foreach($books as $book) {
    error_log($book->ID);
    wp_set_post_terms( $book->ID, ['lsb'], 'lsb_tax_supported_by', false);
  }
}
register_activation_hook( __FILE__, 'lsb_supported_migration' );