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

class LSB_Bibsyst_Integration {

	function __construct() {
		add_action( 'admin_init', array( $this, 'check_dependencies' ) );
    }

	function check_dependencies() {
		if ( ! self::dependencies_fullfilled() ) {
            add_action( 'admin_notices', array( $this, 'dependencies_notice' ) );
        }
	}

    function dependencies_notice() {
		echo '<div class="notice notice-warning">';
		echo '<p>' . esc_html__( 'The LSB Bibsyst Integration plugin requires the post type "lsb_book".', 'lsb-bibsyst-integration' ) . '</p>';
		echo '<p>' . esc_html__( 'Deactivate and activate again after "lsb_book" is in place.', 'lsb-bibsyst-integration' ) . '</p>';
		echo '</div>';
    }

    static function dependencies_fullfilled() {
        return post_type_exists( 'lsb_book' );
    }
}

$bibsyst_integration = new LSB_Bibsyst_Integration();
$isbn_feed = new LSB_Bibsyst_Isbn_Feed();
$status_importer = new LSB_Bibsyst_Status_Importer();

register_activation_hook( __FILE__, array( $isbn_feed, 'on_plugin_registration' ) );
register_activation_hook( __FILE__, array( $status_importer, 'on_plugin_activation' ) );
register_deactivation_hook(__FILE__, array( $status_importer, 'on_plugin_deactivation' ) );
