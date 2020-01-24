<?php 
if ( ! defined('ABSPATH') ) {
    exit;
}


define( 'MY_ACF_PATH',  plugin_dir_path(META_PATH) . 'advanced-custom-fields-pro/acf.php' );
define( 'MY_ACF_URL',  plugin_dir_path(META_PATH) . 'advanced-custom-fields-pro/acf.php' );

// // Include the ACF plugin.
include_once( MY_ACF_PATH );


// (Optional) Hides the ACF admin menu item. Currently set to FALSE
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}



// // // Hides ACF depending on User's role
// // add_filter('acf/settings/show_admin', 'my_acf_show_admin');
// // function my_acf_show_admin( $show ) {
// //     return current_user_can('activate_plugins');
// // }

// // Customize the url setting to fix incorrect asset URLs.
// add_filter('acf/settings/url', 'my_acf_settings_url');
// function my_acf_settings_url( $url ) {
//     return MY_ACF_URL;
// }



// /** Start: Detect ACF Pro plugin. Include if not present. */
// if ( !class_exists('acf') ) { // if ACF Pro plugin does not currently exist
// 	/** Start: Customize ACF path */
// 	add_filter('acf/settings/path', 'cysp_acf_settings_path');
// 	function cysp_acf_settings_path( $path ) {
// 		$path = plugin_dir_path( __FILE__ ) . 'acf/';
// 		return $path;
// 	}
// 	/** End: Customize ACF path */
// 	/** Start: Customize ACF dir */
// 	add_filter('acf/settings/dir', 'cysp_acf_settings_dir');
// 	function cysp_acf_settings_dir( $path ) {
// 		$dir = plugin_dir_url( __FILE__ ) . 'acf/';
// 		return $dir;
// 	}
// 	/** End: Customize ACF path */
// 	/** Start: Hide ACF field group menu item */
// 	add_filter('acf/settings/show_admin', '__return_true');
// 	/** End: Hide ACF field group menu item */
// 	/** Start: Include ACF */
// 	include_once( plugin_dir_path( __FILE__ ) . 'acf/acf.php' );
// 	/** End: Include ACF */
// 	/** Start: Create JSON save point */
// 	add_filter('acf/settings/save_json', 'cysp_acf_json_save_point');
// 	function cysp_acf_json_save_point( $path ) {
// 		$path = plugin_dir_path( __FILE__ ) . 'acf-json/';
// 		return $path;
// 	}
// 	/** End: Create JSON save point */
// 	/** Start: Create JSON load point */
// 	add_filter('acf/settings/load_json', 'cysp_acf_json_load_point');
// 	/** End: Create JSON load point */
// 	/** Start: Stop ACF upgrade notifications */
// 	add_filter( 'site_transient_update_plugins', 'cysp_stop_acf_update_notifications', 11 );
// 	function cysp_stop_acf_update_notifications( $value ) {
// 		unset( $value->response[ plugin_dir_path( __FILE__ ) . 'acf/acf.php' ] );
// 		return $value;
// 	}
// 	/** End: Stop ACF upgrade notifications */
// } else { // else ACF Pro plugin does exist
// 	/** Start: Create JSON load point */
// 	add_filter('acf/settings/load_json', 'cysp_acf_json_load_point');
// 	/** End: Create JSON load point */
// } // end-if ACF Pro plugin does not currently exist
// /** End: Detect ACF Pro plugin. Include if not present. */
// /** Start: Function to create JSON load point */
// function cysp_acf_json_load_point( $paths ) {
// 	$paths[] = plugin_dir_path( __FILE__ ) . 'acf-json-load';
// 	return $paths;
// }
