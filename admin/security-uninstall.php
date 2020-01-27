<?php 

	if ( ! is_super_admin() ) {
		return;
	}
	
	check_admin_referer( 'bulk-plugins' );

	if ( __FILE__ != WP_UNINSTALL_PLUGIN ) {
		return;
	}
