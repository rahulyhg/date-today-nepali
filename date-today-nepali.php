<?php
/**
 * The WordPress Plugin
 *
 * @package   Date_Today_Nepali
 * @author    Nilambar Sharma<nilambar@outlook.com>
 * @license   GPL-2.0+
 * @link      http://nilambar.net
 * @copyright 2013 Nilambar Sharma
 *
 * @wordpress-plugin
 * Plugin Name:       Date Today Nepali
 * Plugin URI:        http://www.nilambar.net/2013/10/date-today-nepali-wordpress-plugin.html
 * Description:       A small widget plugin to display Nepali date.
 * Version:           2.0.0
 * Author:            Nilambar Sharma
 * Author URI:        http://nilambar.net/
 * Text Domain:       date-today-nepali-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define
define( 'DATE_TODAY_NEPALI_NAME', 'Date Today Nepali' );
define( 'DATE_TODAY_NEPALI_SLUG', 'date-today-nepali' );
define( 'DATE_TODAY_NEPALI_VERSION', '2.0.0' );
define( 'DATE_TODAY_NEPALI_BASENAME', basename( dirname( __FILE__ ) ) );
define( 'DATE_TODAY_NEPALI_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'DATE_TODAY_NEPALI_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'DATE_TODAY_NEPALI_LIB_DIR', DATE_TODAY_NEPALI_DIR . '/lib' );
define( 'DATE_TODAY_NEPALI_CORE_DIR', DATE_TODAY_NEPALI_DIR . '/core' );

// Include core
require_once( DATE_TODAY_NEPALI_CORE_DIR . '/init.php' );


/**
 * Load plugin textdomain.
 */
function date_today_nepali_load_textdomain() {

  load_plugin_textdomain( 'date-today-nepali', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}

add_action( 'plugins_loaded', 'date_today_nepali_load_textdomain' );

