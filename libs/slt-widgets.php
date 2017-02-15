<?php
/**
 * sltA WooCommerce Widget Functions
 *
 * Widget related functions and widget registration
 *
 * @author 		sltatheme
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//include_once( 'slt-widgets/slt-woo-instagram-widget.php' );
//include_once( 'slt-widgets/slt-slider-widget.php' );
include_once( 'slt-widgets/slt-woo-grid-widget.php' );
//include_once( 'slt-widgets/slt-slider-countdown-widget.php' );
//include_once( 'slt-widgets/slt-woo-tab-category-slider-widget.php' );
//include_once( 'slt-widgets/slt-woo-tab-slider-widget.php' );
//include_once( 'slt-widgets/slt-category-slider-widget.php' );
//include_once( 'slt-widgets/slt-related-upsell-widget.php' );
//include_once( 'slt-widgets/slt-slider-totalsales-widget.php' );
//include_once( 'slt-widgets/slt-woo-twitter-widget.php' );
//include_once( 'slt-widgets/slt-woo-twitter-slider-widget.php' );
//include_once( 'slt-widgets/slt-woo-testimonial-widget.php');
//include_once( 'slt-widgets/slt-woo-recent-post-widget.php');
include_once( 'slt-widgets/slt_post_category-widget.php');


/**
 * Register Widgets
**/
function slt_register_widgets() {
	//register_widget( 'slt_woo_slider_widget' );
	register_widget( 'slt_woo_grid_widget' );		
	//register_widget( 'slt_woo_slider_countdown_widget' );	
	//register_widget( 'slt_woo_tab_cat_slider_widget' );
	//register_widget( 'slt_woo_tab_slider_widget' );
	//register_widget( 'slt_woo_cat_slider_widget' );
	//register_widget( 'slt_related_upsell_widget' );
	//register_widget( 'slt_woott_slider_widget' );
	//register_widget( 'slt_woo_instagram_widget' );
	//register_widget( 'slt_woo_twitter_widget' );
	//register_widget( 'slt_woo_twitter_slider_widget' );
	//register_widget( 'slt_woo_recent_post_widget');
	register_widget( 'slt_post_category_widget');
	//register_widget( 'slt_woo_testimonial_widget');
}
add_action( 'widgets_init', 'slt_register_widgets' );


//add_action( 'widgets_init', 'override_woocommerce_layered_nav_widgets');
 
function override_woocommerce_layered_nav_widgets() {
  if ( class_exists( 'WC_Widget_Layered_Nav' ) ) {
    unregister_widget( 'WC_Widget_Layered_Nav' );
 
    include_once( 'slt-widgets/slt-woo-widget-layered-nav.php');
 
    register_widget( 'slt_woo_widget_layered_nav' );
  }
}


//add_action( 'widgets_init', 'override_woocommerce_price_filter_widgets');
 
function override_woocommerce_price_filter_widgets() {
  if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
    unregister_widget( 'WC_Widget_Price_Filter' );
 
    include_once( 'slt-widgets/slt-woo-widget-price-filter.php');
 
    register_widget( 'slt_woo_widget_price_filter' );
  }
}



