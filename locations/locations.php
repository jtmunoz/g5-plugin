<?php 

    function custom_post_location() {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'        => _x( 'Locatons', 'Post Type General Name' ),
            'singular_name'    => _x( 'Location', 'Post Type Singular Name' ),
            'menu_name'     => __( 'Locatons' ),
            'parent_item_colon'   => __( 'Parent Location' ),
            'all_items'     => __( 'All Locatons' ),
            'view_item'     => __( 'View Location' ),
            'add_new_item'    => __( 'Add New Location' ),
            'add_new'          => __( 'Add New' ),
            'edit_item'     => __( 'Edit Location' ),
            'update_item'       => __( 'Update Location' ),
            'search_items'    => __( 'Search Location' ),
            'not_found'     => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );
        // Set other options for Custom Post Type
        $args = array(
            'label'   => __( 'location' ),
            'description'     => __( 'Location News and Reviews' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            // 'title', 'thumbnail', 
            'supports'  => array( 'title', 'revisions', 'page-attributes',  'custom-fields', 'post-formats' ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'    => true,
            'public'              => true,
            'show_ui'          => true,
            'show_in_menu'    => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'show_in_rest'    => true,
            'menu_position'    => 5,
            'can_export'          => true,
            'has_archive'       => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'    => 'page',
            'menu_icon'     => 'dashicons-location',
            'rewrite'          => array('slug' => 'location'),

        );  
        // Registering your Custom Post Type
        register_post_type( 'location', $args );
    }
    add_action( 'init', 'custom_post_location', 0 );