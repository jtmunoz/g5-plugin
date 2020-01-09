<?php 


    //activation hook on mulitsite - https://core.trac.wordpress.org/ticket/14170#comment:68

    function custom_post_workshop() {
        // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Workshops', 'Post Type General Name' ),
            'singular_name'       => _x( 'Workshop', 'Post Type Singular Name' ),
            'menu_name'           => __( 'Workshops' ),
            'parent_item_colon'   => __( 'Parent Workshop' ),
            'all_items'           => __( 'All Workshops' ),
            'view_item'           => __( 'View Workshop' ),
            'add_new_item'        => __( 'Add New Workshop' ),
            'add_new'             => __( 'Add New' ),
            'edit_item'           => __( 'Edit Workshop' ),
            'update_item'         => __( 'Update Workshop' ),
            'search_items'        => __( 'Search Workshop' ),
            'not_found'           => __( 'Not Found' ),
            'not_found_in_trash'  => __( 'Not found in Trash' ),
        );
        // Set other options for Custom Post Type
        $args = array(
            'label'               => __( 'workshop' ),
            'description'         => __( 'Workshop News and Reviews' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array(  'title', 'revisions', 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats' ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon'   => 'dashicons-groups',
            'rewrite' => array('slug' => 'workshop'),

        );  
        // Registering your Custom Post Type
        register_post_type( 'workshop', $args );
    }
    add_action( 'init', 'custom_post_workshop', 0 );

         
    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */

    function auto_generate_workshop_title($title) {
        global $post;
        if (isset($post->ID)) {
            if (empty($_POST['post_title']) && 'workshop' == get_post_type($post->ID)){
                // get the current post ID number
                $id = get_the_ID();
                // add ID number with order strong
                $title = 'workshop-'.$id;
            } 
        }
        return $title; 
    }
    add_filter('title_save_pre','auto_generate_workshop_title');

    
    add_filter('manage_edit-workshop_columns', 'workshops_columns_id', 5);
    add_action('manage_workshop_posts_custom_column', 'workshops_custom_id_columns', 5, 2);

    function workshops_columns_id($defaults){
        $defaults['workshop-id'] = __('Workshop ID');
        return $defaults;
    }
    
    function workshops_custom_id_columns($column_name, $id){
        if($column_name === 'workshop-id'){
            echo $id;
        }
    }
?>