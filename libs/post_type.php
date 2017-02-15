<?php
 /**
  * @author     Opal  Team <sellertemplate@gmail.com >
  * @copyright  Copyright (C) 2014 sellertemplate.com. All Rights Reserved.
  * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
  * @website  http://www.sellertemplate.com
  */

add_action( 'init', 'create_posttype_footer' );

function create_posttype_footer() {
  register_post_type( 'slt_footer',
    array(
      'labels' => array(
        'name' => __( 'SLT Footer' ),
        'singular_name' => __( 'Footer' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'products'),
    )
  );
  
  if($wpb_js_content_types = get_option('wpb_js_content_types')){
	  if(!in_array('slt_footer',$wpb_js_content_types)){
		  $wpb_js_content_types[] = 'slt_footer';
	  }
      $options[] = 'slt_footer';
    update_option( 'wpb_js_content_types',$wpb_js_content_types );
  }else{
    $options = array('page','slt_footer');
  }
}