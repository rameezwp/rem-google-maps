<?php
/**
 * Plugin Name: REM - Map Filters and Radius Search
 * Plugin URI: https://wp-rem.com/addons/rem-google-map-filters/
 * Description: Search on Map with Radius and other filters
 * Version: 3.2
 * Author: WebCodingPlace
 * Author URI: https://webcodingplace.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rem-map-filters
 * Domain Path: /languages
 */

require_once('plugin.class.php');
require_once('inc/find.php');
require_once('inc/geo-query.php');

/**
 * Iniliatizing main class object for setting up import/export
 */
if( class_exists('REM_Map_Filters')){
    $rem_map_filters = new REM_Map_Filters;
}

if (defined('REM_PATH')) {
	require_once REM_PATH.'/inc/update/wp-package-updater/class-wp-package-updater.php';
	$cfields_updater = new WP_Package_Updater(
		'https://kb.webcodingplace.com/',
		wp_normalize_path( __FILE__ ),
		wp_normalize_path( plugin_dir_path( __FILE__ ) )
	);
}

?>