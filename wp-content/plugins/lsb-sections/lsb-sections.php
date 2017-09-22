<?php
/**
 * Plugin Name: LSB: Nye Seksjoner
 * Description: De ny seksjonene kan legges til på både sider og innlegg.
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Section;
include('lib/add-custom-fields.php');

add_action( 'acf/init', __NAMESPACE__ . '\\add_custom_fields' );
