<?php
/**
 * Plugin Name: Boksøk: Bibsyst-integrasjon
 * Description: Denne pluginen tar seg av Boksøks integrasjon med Bibsyst.
 * Version: 1.0.0
 * Text Domain: lsb-bibsyst-integration
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */


include('class-isbn-feed.php');
include('class-status-importer.php');

class LSB_Bibsyst_Integration {

	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
		add_action( 'admin_init', array( $this, 'check_dependencies' ) );
    }

	function load_text_domain() {
		load_plugin_textdomain( 'lsb-bibsyst-integration', false, plugin_basename( dirname( __FILE__ ) ) );
	}

	function check_dependencies() {
		if ( ! self::dependencies_fullfilled() ) {
            add_action( 'admin_notices', array( $this, 'dependencies_notice' ) );
        }
	}

    function dependencies_notice() {
		echo '<div class="notice notice-warning">';
		echo '<p>' . esc_html__( 'LSB Bibsyst er avhengig av post-typen "lsb_book".', 'lsb-bibsyst-integration' ) . '</p>';
		echo '<p>' . esc_html__( 'Deaktiver og aktiver på ny når "lsb_book" er på plass.', 'lsb-bibsyst-integration' ) . '</p>';
		echo '</div>';
    }

    static function dependencies_fullfilled() {
        return post_type_exists( 'lsb_book' );
    }
}

$bibsyst_integration = new LSB_Bibsyst_Integration();
$isbn_feed = new LSB_Bibsyst_Isbn_Feed();
$status_importer = new LSB_Bibsyst_Status_Importer();

register_activation_hook( __FILE__, array( $isbn_feed, 'on_plugin_activation' ) );
register_activation_hook( __FILE__, array( $status_importer, 'on_plugin_activation' ) );
register_deactivation_hook(__FILE__, array( $status_importer, 'on_plugin_deactivation' ) );
