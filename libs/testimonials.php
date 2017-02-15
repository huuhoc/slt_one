<?php
/**
 * SLT Woo Tab Slider Widget
 * Plugin URI: http://www.sellertemplate.com
 * Version: 1.0
 * This Widget help you to show images of product as a beauty tab reponsive slideshow
 */
if(!function_exists('vel_create_type_testimonial')){
    function vel_create_type_testimonial(){
      $labels = array(
        'name' => __( 'Testimonial', TEXTDOMAIN ),
        'singular_name' => __( 'Testimonial', TEXTDOMAIN ),
        'add_new' => __( 'Add New Testimonial', TEXTDOMAIN ),
        'add_new_item' => __( 'Add New Testimonial', TEXTDOMAIN ),
        'edit_item' => __( 'Edit Testimonial', TEXTDOMAIN ),
        'new_item' => __( 'New Testimonial', TEXTDOMAIN ),
        'view_item' => __( 'View Testimonial', TEXTDOMAIN ),
        'search_items' => __( 'Search Testimonials', TEXTDOMAIN ),
        'not_found' => __( 'No Testimonials found', TEXTDOMAIN ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash', TEXTDOMAIN ),
        'parent_item_colon' => __( 'Parent Testimonial:', TEXTDOMAIN ),
        'menu_name' => __( 'SLT Testimonials', TEXTDOMAIN ),
      );

      $args = array(
          'labels' => $labels,
          'hierarchical' => true,
          'description' => 'List Testimonial',
          'supports' => array( 'title', 'editor', 'thumbnail','excerpt'),
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'show_in_nav_menus' => false,
          'publicly_queryable' => true,
          'exclude_from_search' => false,
          'has_archive' => true,
          'query_var' => true,
          'can_export' => true,
          'rewrite' => true,
          'capability_type' => 'post'
      );
      register_post_type( 'testimonial', $args );
    }

    add_action( 'init','vel_create_type_testimonial' );
}


