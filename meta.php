<?php 
/**
 * Plugin Name: Meta
 * Plugin URI: 
 * Description: The first e-rehab plugin that I have created.
 * Version: 1.0
 * Author: Jordan Muñoz
 * Author URI: 
 */


/*
// Activation Function
function meta_on_activation(){
	if( !current_user_can('activate_plugins') ) return;
	//do something
	wp_die('Meta Plugin has been Activated');
}
*/

/*
// Deactivation Function
function meta_on_deactivation() {
	if ( !current_user_can('activate_plugins') ) return;
	flush_rewrite_rules();
	wp_die('Meta Plugin has been Deactivated');
}
register_deactivation_hook(__FILE__, 'meta_on_deactivation' );
*/


/*
// Uninstall Function
function meta_on_uninstal(){
	if ( !current_user_can('activate_plugins') ) return;
	//do something
	wp_die('Meta Plugin has been Uninstalled');
}
*/

//Moves Yoast to Bottom of Admin UI
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

include 'workshops/workshops.php';

?>

