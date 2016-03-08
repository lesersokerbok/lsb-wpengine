<?php
/**
 * Plugin Name: LSB Bibsyst Integration
 * Description: This plugin creates an endpoint for Bibsyst to acess all ISBNs as simple txt.
 * Version: 1.0.0
 * Author: bGraphic
 * Author URI: http://bGraphic.no
 */


include('lsb-bibsyst-isbn-feed.php');

$isbnFeed = new isbn_feed();

register_activation_hook( __FILE__, array( $isbnFeed, 'on_plugin_registration' ) );
