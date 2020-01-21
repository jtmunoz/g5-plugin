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


