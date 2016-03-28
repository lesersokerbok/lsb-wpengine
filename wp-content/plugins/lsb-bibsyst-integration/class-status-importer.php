<?php
class LSB_Bibsyst_Status_Importer {

	public $libraries_url = 'http://bibsyst.no/lesersokerbok_bib.txt';
	public $status_url = 'http://bibsyst.no/lesersokerbok_svar.txt';
	public $import_day = 'Monday';

	public function __construct() {
		add_action( 'daily_lsb_bibsyst_event', array( $this, 'weekly_import' ) );
		add_action( 'single_lsb_bibsyst_event', array( $this, 'import' ) );

		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {

	}

	public function on_plugin_activation() {
		wp_schedule_event( strtotime('midnight'), 'daily', 'daily_lsb_bibsyst_event' );
		wp_schedule_single_event( time(), 'single_lsb_bibsyst_event' );
	}

	public function on_plugin_deactivation() {
		wp_clear_scheduled_hook( 'daily_lsb_bibsyst_event' );
	}

	public function weekly_import() {

		if( date('l') == $this->import_day ) {
			error_log('Today is import day, run weekly import.');
			$this->import();
		} else {
			error_log('Today is _not_ import day, do not run weekly import.');
		}
	}

	public function import() {
		$this->import_libraries();
		$this->import_status();
		$this->add_status_to_books();
	}

	private function import_libraries() {
		$handle = fopen( $this->libraries_url, 'r' );
		if ( $handle ) {

			$libraries_temp = array();
			$i = 0;

			while ( ( $buffer = fgetcsv($handle, 500, ';' ) ) !== false) {

				if( count( $buffer ) != 9 ) {
					continue;
				}

				$libraries_temp[ ''.$buffer[0] ] = array(
					'name' => utf8_encode( $buffer[1] ),
					'url' => utf8_encode( $buffer[3] ),
					'county' => utf8_encode( $buffer[4] ),
					'municipality' => utf8_encode( $buffer[5] ),
					'municipality_id' => utf8_encode( $buffer[6]),
					'phone_number' => utf8_encode( $buffer[7])
				);

				$i++;
			}

			set_transient( 'lsb_libraries', $libraries_temp, DAY_IN_SECONDS );
			fclose( $handle );

			error_log( $i.' libraries imported');
		}
	}

	private function import_status() {

		$handle = fopen( $this->status_url, 'r' );
		if ( $handle ) {

			$isbn_temp = null;
			$status_temp = null;
			$i = 0;

			while ( ( $buffer = fgetcsv($handle, 500, ';' ) ) !== false) {

				if( count( $buffer ) != 4 ) {
					continue;
				}

				if( $isbn_temp != $buffer[1] )	{

					$this->save_book_status_as_transient( $isbn_temp, $status_temp );

					$isbn_temp = $buffer[1];
					$status_temp = array();
				}

				array_push( $status_temp, array(
						'library_id' => $buffer[0],
						'copies' => $buffer[2],
						'book_url' => utf8_encode( $buffer[3] )
					)
				);

				$i ++;
			}

			$this->save_book_status_as_transient( $isbn_temp, $status_temp );
			fclose( $handle );

			error_log( $i.' status lines imported');
		}
	}

	private function save_book_status_as_transient( $isbn, $status ) {

		if ( !$isbn || !$status ) {
			return;
		}

		set_transient( 'lsb_'.$isbn.'_library_status', $status, DAY_IN_SECONDS );
	}

	private function add_status_to_books() {
		$libraries = get_transient('lsb_libraries');

		if( !$libraries ) {
			return;
		}

		$offset = 0;
		$post_per_page = 50;
		$i = 0;

		while( TRUE ) {
			$args =  array(
				'post_type' => 'lsb_book',
				'posts_per_page' => $post_per_page,
				'offset' => $offset,
				'no_found_rows' => false,
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
			);

			$books = get_posts( $args );

			if( ! $books ) {
				break;
			}


			foreach( $books as $book ) {

				$isbn = get_field( 'lsb_isbn', $book->ID);
				$status = get_transient('lsb_'.$isbn.'_library_status');
				$i++;

				if( !$status ) {
					error_log( 'Book "'.$book->post_title.'" ('.$isbn.') has no library status');
					continue;
				}

				foreach( $status as $key => $library ) {
					$status[ $key ] = array_merge( $library, $libraries[ $library['library_id'] ] );
				}

				$counties = $this->sort_status_into_counties($status);

				$added = add_post_meta($book->ID, 'lsb_library_status', $counties, true);

				if( ! $added ) {
					update_post_meta($book->ID, 'lsb_library_status', $counties);
				}

			}

			$offset += $post_per_page;
		}

		error_log( 'Added status to '.$i.' books' );
	}

	private function sort_status_into_counties( $status ) {

		$counties = array();

		foreach( $status as $library ) {
			if( array_key_exists($library['county'], $counties ) ) {
				array_push( $counties[$library['county']], $library );
			} else {
				$counties[$library['county']] = array( $library );
			}
		}

		ksort($counties);

//		foreach( $counties as $key => $county_libraries ) {
//			usort($county_libraries, function($a, $b) {
//				strcmp( $a['name'], $b['name'] );
//			});
//
//			$counties[ $key ] = $county_libraries;
//		}

		return $counties;
	}
}
