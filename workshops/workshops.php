<?php 
    // exit if file is called directly
    if ( ! defined('ABSPATH') ) {
        exit;
    }

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
            'label'   => __( 'workshop' ),
            'description'      => __( 'Workshop News and Reviews' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            // 'title', 'thumbnail', 
            'supports'    => array( 'title', 'revisions', 'page-attributes',  'custom-fields', 'post-formats' ),
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
            'menu_icon'           => 'dashicons-groups',
            'rewrite'             => array('slug' => 'workshop'),

        );  
        // Registering your Custom Post Type
        register_post_type( 'workshop', $args );
    }
    add_action( 'init', 'custom_post_workshop', 0 );

    //Removes Content Editor from Workshop
    function remove_workshop_content_editor () {
        remove_post_type_support( 'workshop', 'editor' );
    }
    add_action('init', 'remove_workshop_content_editor');

    /* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */
    /* SET WORKSHOP TITLE */    
    // function auto_generate_workshop_title($title) {
    //     global $post;
    //     if (isset($post->ID)) {
    //         if (empty($_POST['post_title']) && 'workshop' == get_post_type($post->ID)){
    //             // get the current post ID number
    //             $id = get_the_ID();
    //             // add ID number with order strong
    //             $title = 'workshop-'.$id;
    //         } 
    //     }
    //     return $title; 
    // }
    // add_filter('title_save_pre','auto_generate_workshop_title');

    
    /* ADD WORKSHOP ID COLUMN TO ADMIN UI */
    function workshops_columns_id($defaults){
        $defaults['workshop-id'] = __('Workshop ID');
        return $defaults;
    }
    add_filter('manage_edit-workshop_columns', 'workshops_columns_id', 5);
  
    function workshops_custom_id_columns($column_name, $id){
        if($column_name === 'workshop-id'){
            echo $id;
        }
    }
    add_action('manage_workshop_posts_custom_column', 'workshops_custom_id_columns', 5, 2);

    /* ADDS MODIFIED COLUMN TO WORKSHOPS */
    function add_modified_workshop_columns( $columns ) {
        $columns['modified']    = 'Last Modified';
        return $columns;
    }
    add_filter ( 'manage_edit-workshop_columns', 'add_modified_workshop_columns',  );

    /* ADD LAST MODIFIED COLUMN DATA  */
    function view_workshop_edit_column( $column, $post_id ) {
        switch ( $column ) {
            case 'modified':
                $m_orig     = get_post_field( 'post_modified', $post_id, 'raw' );
                $m_stamp    = strtotime( $m_orig );
                $modified   = date('n/j/y @ g:i a', $m_stamp );
                $modr_id    = get_post_meta( $post_id, '_edit_last', true );
                $auth_id    = get_post_field( 'post_author', $post_id, 'raw' );
                $user_id    = !empty( $modr_id ) ? $modr_id : $auth_id;
                $user_info  = get_userdata( $user_id );

                echo '<p class="mod-date">';
                echo '<em>'.$modified.'</em><br />';
                echo 'by <strong>'.$user_info->display_name.'<strong>';
                echo '</p>';
                break;
            // end all case breaks
        }
    }
    add_action ( 'manage_workshop_posts_custom_column', 'view_workshop_edit_column', 4, 2 );
    

    /* SORTS WORKSHOPS BY LAST MODIFIED */
    function workshop_last_modified_column_register_sortable( $columns ) {
        $columns['modified'] = 'Last Modified';
        return $columns;
    }   
    add_filter( "manage_edit-workshop_columns", "workshop_last_modified_column_register_sortable" );


    /* SHORTCODE FOR SINGLE WORKSHIOP */
    function meta_workshop($attr){
        $output = '';
        $workshop_fields = get_fields($attr['id'], false);
        if ( $workshop_fields ) {
            $output .= '<div class="uk-panel uk-panel-header uk-panel-box g5-padding g5-border-success g5-background-white g5-boxshadow-medium tm-workshop-panel uk-text-center">
                <h3 class="tm-workshop-panel-title">'.$workshop_fields['workshop_name'].'</h3>
                    <div class="g5-padding uk-panel-teaser tm-workshop-panel-teaser">';
                    $size = 'large'; // (thumbnail, medium, large, full or custom size)
                    $attr = 'class="uk-align-center g5-padding-small-all g5-border-small g5-border-primary g5-boxshadow-all-small uk-border-rounded tm-workshop-panel-photo"';
                    if( $workshop_fields['workshop_photo'] ) {
                        $output .= wp_get_attachment_image($workshop_fields['workshop_photo'], $size, false, $attr);
                    }
            $output .= '</div>
                    <div>';
            $output .= '<p class="uk-margin-small-top uk-text-large tm-workshop-panel-date">' . meta_print_date($workshop_fields['workshop_date']) . '</p>';
            $output .= '<p class="uk-margin-small-top tm-workshop-panel-time">' . meta_print_time($workshop_fields['workshop_time']) . '</p>';          
            if ( get_field('workshop_description') ) {
               $output .= '<p class="tm-workshop-panel-description">'.$workshop_fields['workshop_description'].'</p>';
            }
            $output .= '</div></div>';
        } else {
            $output = '<h3>Workshop ID not set</h3>';
        }
        return $output;
    }
    add_shortcode('workshop','meta_workshop');






function rd_duplicate_post_link( $actions, $post ) {

    //print_r($actions);
    //if (current_user_can('edit_posts') || $post->post_type=='movies') {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
   // }
    return $actions;
}

add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);



add_action( 'admin_action_rd_duplicate_post_as_draft', 'dt_dpp_post_as_draft' ); 

  function dt_dpp_post_as_draft()
    {
          global $wpdb;

          /*sanitize_GET POST REQUEST*/
          $post_copy = sanitize_text_field( $_POST["post"] );
          $get_copy = sanitize_text_field( $_GET['post'] );
          $request_copy = sanitize_text_field( $_REQUEST['action'] );

          $opt = get_option('dpp_wpp_page_options');
          $suffix = !empty($opt['dpp_post_suffix']) ? ' -- '.$opt['dpp_post_suffix'] : '';
          $post_status = !empty($opt['dpp_post_status']) ? $opt['dpp_post_status'] : 'draft';
          $redirectit = !empty($opt['dpp_post_redirect']) ? $opt['dpp_post_redirect'] : 'to_list';

            if (! ( isset( $get_copy ) || isset( $post_copy ) || ( isset($request_copy) && 'dt_dpp_post_as_draft' == $request_copy ) ) ) {
            wp_die('No post!');
            }
            $returnpage = '';

            /* Get post id */
            $post_id = (isset($get_copy) ? $get_copy : $post_copy );

            $post = get_post( $post_id );

            $current_user = wp_get_current_user();
            $new_post_author = $current_user->ID;

            /*Create the post Copy */
            if (isset( $post ) && $post != null) {
                /* Post data array */
                $args = array('comment_status' => $post->comment_status,
                'ping_status' => $post->ping_status,
                'post_author' => $new_post_author,
                'post_content' => $post->post_content,
                'post_excerpt' => $post->post_excerpt,
                'post_name' => $post->post_name,
                'post_parent' => $post->post_parent,
                'post_password' => $post->post_password,
                'post_status' => $post_status,
                'post_title' => $post->post_title.$suffix,
                'post_type' => $post->post_type,
                'to_ping' => $post->to_ping,
                'menu_order' => $post->menu_order

               );
               $new_post_id = wp_insert_post( $args );

               $taxonomies = get_object_taxonomies($post->post_type);
               if(!empty($taxonomies) && is_array($taxonomies)):
               foreach ($taxonomies as $taxonomy) {
                  $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                  wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);}
               endif;

               $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
               if (count($post_meta_infos)!=0) {
               $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
               foreach ($post_meta_infos as $meta_info) {
                  $meta_key = $meta_info->meta_key;
                  $meta_value = addslashes($meta_info->meta_value);
                  $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
                  }
                    $sql_query.= implode(" UNION ALL ", $sql_query_sel);
                    $wpdb->query($sql_query);
                  }

                 /*choice redirect */
                 if($post->post_type != 'post'):$returnpage = '?post_type='.$post->post_type;  endif;
                 if(!empty($redirectit) && $redirectit == 'to_list'):wp_redirect( admin_url( 'edit.php'.$returnpage ) );
                 elseif(!empty($redirectit) && $redirectit == 'to_page'):wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
                 else:
                 wp_redirect( admin_url( 'edit.php'.$returnpage ) );
                 endif;
                 exit;
                 } else {
                 wp_die('Error! Post creation failed: ' . $post_id);
                 }
   }


















