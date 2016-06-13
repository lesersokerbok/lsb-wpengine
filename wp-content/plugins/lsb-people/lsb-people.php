<?php
/**
 * Plugin Name: LSB: Personer
 * Description: Legger til innholdstype Person. Brukes for ansatte og styremedlemmer.
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\People;

include('class-person.php');

new PersonContentType();
