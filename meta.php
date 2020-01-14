<?php 
/**
 * Plugin Name: Meta
 * Plugin URI: 
 * Description: The first e-rehab plugin that I have created.
 * Version: 1.0
 * Author: Jordan Muñoz
 * Author URI: 
 */


activate_plugin('meta/meta.php');


function yoasttobottom() {
  return 'low';
}

add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

include 'workshops.php';

?>

