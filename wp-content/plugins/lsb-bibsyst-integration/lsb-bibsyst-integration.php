<?php
/**
 * Plugin Name: LSB Bibsyst Integration
 * Description: This plugin creates an endpoint for Bibsyst to acess all ISBNs as simple txt.
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */


include('class-isbn-feed.php');
include('class-status-importer.php');


$isbn_feed = new Isbn_Feed();
$status_importer = new Status_Importer();

register_activation_hook( __FILE__, array( $isbn_feed, 'on_plugin_registration' ) );
register_activation_hook( __FILE__, array( $status_importer, 'on_plugin_activation' ) );
register_deactivation_hook(__FILE__, array( $status_importer, 'on_plugin_deactivation' ) );
