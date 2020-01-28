<?php 
/**
 * Plugin Name: Meta
 * Plugin URI: 
 * Description: A create custom post types.
 * Version: 1.0
 * Author: Jordan Muñoz
 * Author URI: 
 */



// exit if file is called directly
if ( ! defined('ABSPATH') ) {
	exit;
}


define( 'META_PATH', plugin_dir_path( __FILE__ ) );
include( META_PATH . 'includes/acf/include_acf.php');
require_once plugin_dir_path(__FILE__) . 'includes/acf/include_acf.php';


require_once plugin_dir_path(__FILE__) . 'includes/core-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/security-uninstall.php';


require 'workshops/workshops.php';







