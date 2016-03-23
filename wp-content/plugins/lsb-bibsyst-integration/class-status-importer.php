<?php
class Status_Importer {

	public $libraries_url = 'http://bibsyst.no/lesersokerbok_bib.txt';
	public $books_status_url = 'http://bibsyst.no/lesersokerbok_svar.txt';
	public $weekday = 'Monday';

	public function __construct() {
		add_action( 'daily_lsb_bibsyst_event', array( $this, 'weekly_import' ) );
		add_action( 'hourly_lsb_bibsyst_event', array( $this, 'weekly_import' ) );
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		echo date( 'D M j G:i:s');
		echo '<br/>';
		echo date( 'D M j G:i:s', wp_next_scheduled( 'daily_lsb_bibsyst_event' ) );
		echo '<br/>';
		echo date( 'D M j G:i:s', wp_next_scheduled( 'hourly_lsb_bibsyst_event' ) );
	}

	public function on_plugin_activation() {
		wp_schedule_event( strtotime('midnight'), 'daily', 'daily_lsb_bibsyst_event' );
		wp_schedule_event( time(), 'hourly', 'hourly_lsb_bibsyst_event' );
	}

	public function on_plugin_deactivation() {
		wp_clear_scheduled_hook( 'daily_lsb_bibsyst_event' );
		wp_clear_scheduled_hook( 'hourly_lsb_bibsyst_event' );
	}

	public function weekly_import() {
		if( date('l') == $this->weekday ) {
			error_log('Weekday is same, run import.');
			$this->import();
		} else {
			error_log('Weekday is not same, do not run import');
		}
	}

	public function import() {

	}
}
