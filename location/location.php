<?php 
function custom_post_location() {
     
     // Set UI labels for Custom Post Type
     $labels = array(
         'name'                => _x( 'Locations', 'Post Type General Name' ),
         'singular_name'       => _x( 'Location', 'Post Type Singular Name' ),
         'menu_name'           => __( 'Location' ),
         'parent_item_colon'   => __( 'Parent Location' ),
         'all_items'           => __( 'All Locations' ),
         'view_item'           => __( 'View Location' ),
         'add_new_item'        => __( 'Add New Location' ),
         'add_new'             => __( 'Add New' ),
         'edit_item'           => __( 'Edit Location' ),
         'update_item'         => __( 'Update Location' ),
         'search_items'        => __( 'Search Location' ),
         'not_found'           => __( 'Not Found' ),
         'not_found_in_trash'  => __( 'Not found in Trash' ),
     );
      
     // Set other options for Custom Post Type
     $args = array(
         'label'               => __( 'location' ),
         'description'         => __( 'Location News and Reviews' ),
         'labels'              => $labels,
         // Features this CPT supports in Post Editor
         'supports'            => array(  'title', 'editor', 'comments', 'revisions', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats' ),
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
         'menu_icon'   => 'dashicons-admin-multisite',
         'rewrite' => array('slug' => 'location'),

     );
      
     // Registering your Custom Post Type
     register_post_type( 'location', $args );
  
 }
  
 /* Hook into the 'init' action so that the function
 * Containing our post type registration is not 
 * unnecessarily executed. 
 */
  
 add_action( 'init', 'custom_post_location', 0 );

 add_filter('title_save_pre','auto_generate_post_title');
 function auto_generate_location_title($title) {
    global $post;
    if (isset($post->ID)) {
       if (empty($_POST['post_title']) && 'location' == get_post_type($post->ID)){
          // get the current post ID number
          $id = get_the_ID();
          // add ID number with order strong
          $title = 'location-'.$id;} }
    return $title; 
 }
?>