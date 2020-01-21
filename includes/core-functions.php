<?php 

	// exit if file is called directly
    if ( ! defined('ABSPATH') ) {
        exit;
    }

    //Prints Readable Date
	function meta_print_date($date){
		return strftime('%A,%B,%G', $date);
	}

	//Moves Yoast to Bottom of Admin UI
	function yoasttobottom() {
	  return 'low';
	}
	add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


?>