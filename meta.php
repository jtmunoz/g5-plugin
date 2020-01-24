<?php 
/**
 * Plugin Name: Meta
 * Plugin URI: 
 * Description: The first e-rehab plugin that I have created.
 * Version: 1.0
 * Author: Jordan Muñoz
 * Author URI: 
 */



// exit if file is called directly
if ( ! defined('ABSPATH') ) {
	exit;
}



// define( 'META_PATH', plugin_dir_path( __FILE__ ) );
// include( META_PATH . 'includes/acf/include_acf.php');
require_once plugin_dir_path(__FILE__) . 'includes/acf/include_acf.php';

require_once plugin_dir_path(__FILE__) . 'includes/core-functions.php';


require 'workshops/workshops.php';







