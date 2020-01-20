<?php 
/**
 * Plugin Name: Meta
 * Plugin URI: 
 * Description: The first e-rehab plugin that I have created.
 * Version: 1.0
 * Author: Jordan Muñoz
 * Author URI: 
 */


// activate_plugin('meta/meta.php');

/*
// Deactivation Function
function meta_on_deactivation() {
	if ( !current_user_can('activate_plugins') ) return;
	flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'meta_on_deactivation' );
wp_die('Meta Plugin has been Deactivated');
*/

//Moves Yoast to Bottom of Admin UI
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

include 'workshops/workshops.php';

?>

