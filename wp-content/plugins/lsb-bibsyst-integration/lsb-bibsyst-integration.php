<?php
/**
 * Plugin Name: LSB Bibsyst Integration
 * Description: This plugin creates an endpoint for Bibsyst to acess all ISBNs as simple txt.
 * Version: 1.0.0
 * Author: bGraphic
 * Author URI: http://bGraphic.no
 */


include('class-isbn-feed.php');


$isbn_feed = new Isbn_Feed();

register_activation_hook( __FILE__, array( $isbn_feed, 'on_plugin_registration' ) );
