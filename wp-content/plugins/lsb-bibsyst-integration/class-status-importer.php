<?php
class Status_Importer {

	public $libraries_url = 'http://bibsyst.no/lesersokerbok_bib.txt';
	public $status_url = 'http://bibsyst.no/lesersokerbok_svar.txt';
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
		echo '<br>';

//		$this->import();
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

		echo "Weekly import <br/>";

		if( date('l') == $this->weekday ) {
			error_log('Weekday is same, run import.');
			$this->import();
		} else {
			error_log('Weekday is not same, do not run import');
		}
	}

	private function import() {
		$this->import_status();
	}



	private function import_status() {

		$handle = fopen( $this->status_url, 'r' );
		if ( $handle ) {

			$isbn_temp = null;
			$status_temp = null;

    		while ( ( $buffer = fgetcsv($handle, 500, ';' ) ) !== false) {

				if( count( $buffer ) != 4 ) {
					continue;
				}

        		if( $isbn_temp != $buffer[1] )	{

					$this->save_book_status_as_transient( $isbn_temp, $status_temp );

					$isbn_temp = $buffer[1];
					$status_temp = array();
				}

				array_push( $status_temp, array( 'library_id' => $buffer[0], 'copies' => $buffer[2], 'url' => $buffer[3] ) );
    		}

			$this->save_book_status_as_transient( $isbn_temp, $status_temp );
    		fclose( $handle );
		}
	}

	private function save_book_status_as_transient( $isbn, $status ) {

		if ( !$isbn || !$status ) {
			return;
		}

		set_transient( $isbn.'-status', $status, DAY_IN_SECONDS );
	}
}
