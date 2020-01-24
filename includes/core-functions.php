<?php 

	// exit if file is called directly
    if ( ! defined('ABSPATH') ) {
        exit;
    }

    //Prints Readable Date
	function meta_print_date($workdshop_date){
		return DateTime::createFromFormat('Ymd', $workdshop_date)->format('M j, Y');		
	}

	//Prints Readable Time
	function meta_print_time($workshop_time){
		return DateTime::createFromFormat('H:i:s', $workshop_time)->format('g:i A');
	}

	//Moves Yoast to Bottom of Admin UI
	function yoasttobottom() {
	  return 'low';
	}
	add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


	/*
	// Activation Function
	function meta_on_activation(){
		if( !current_user_can('activate_plugins') ) return;
		//do something
		wp_die('Meta Plugin has been Activated');
	}
	register_activation_hook(__FILE__, 'meta_on_activation' );
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
	register_uninstall_hook(__FILE__, 'meta_on_uninstall' );
	*/
