<?php
/**
 * SLT Woo Tab Slider Widget
 * Plugin URI: http://www.sellertemplate.com
 * Version: 1.0
 * This Widget help you to show images of product as a beauty tab reponsive slideshow
 */
if ( !class_exists('vel_woo_twitter_slider_widget') ) {
	class vel_woo_twitter_slider_widget extends WP_Widget {

		/**
		 * Widget setup.
		 */
		function __construct() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'vel_woo_twitter_slider_widget', 'description' => __('SLT Woo Twitter Slider Widget', 'sellertemplate') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vel_woo_twitter_slider_widget');

			/* Create the widget. */
			parent::__construct( 'vel_woo_twitter_slider_widget', __('SLT Woo Twitter Slider Widget', 'sellertemplate'), $widget_ops, $control_ops );
					
			add_shortcode( 'woo_twitter_slider_widget', array( $this, 'SC_WooTwitterSlider' ) );
			
			/* Create Vc_map */
			if ( class_exists('Vc_Manager') && class_exists( 'WooCommerce' ) ) {
				add_action( 'vc_before_init', array( $this, 'SC_integrateWithVC' ) );
			}
		}

		/**
			* Add Vc Params
		**/
		function SC_integrateWithVC(){
			$yes_no =  array(
					1 => __('Yes', TEXTDOMAIN),
					0 => __('No', TEXTDOMAIN),
			);
			
			vc_map( array(
				"name" => __( "SLT Woo Twitter Slider", TEXTDOMAIN ),
				"base" => "woo_twitter_slider_widget",
				"category" => __( "SLT Shortcode", TEXTDOMAIN),
				"params" => array(
				array(
					"type" => "textfield",
					"heading" => __( "Title", TEXTDOMAIN ),
					"param_name" => "title",
					"value" => __("SLT Twitter Slider Widget", TEXTDOMAIN ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Twitter Name", TEXTDOMAIN),
					"param_name" => "twitter_name",
					"value" => __( "sellertemplate", TEXTDOMAIN ),
				),
				array(
					"type" => "textfield",
					"heading" => __( "Twitter Customer Key", TEXTDOMAIN ),
					"param_name" => "twitter_customer_key",
					"value" => 'vA1kw62CSISJOZKSEpBvNMHPV'
				),	
				array(
					"type" => "textfield",
					"heading" => __( "Twitter Customer Secret", TEXTDOMAIN ),
					"param_name" => "twitter_customer_secret",
					"value" => 'vA1kw62CSISJOZKSEpBvNMHPV'
				),
				array(
					"type" => "textfield",
					"heading" => __( "Twitter Access Token", TEXTDOMAIN ),
					"param_name" => "twitter_access_token",
					"value" => '2811335408-mVDm69N490kUxvIbzBHCNyMJvaOwY2vac0Q1yOn'
				),	
				array(
					"type" => "textfield",
					"heading" => __( "Twitter Access Token Secret", TEXTDOMAIN ),
					"param_name" => "twitter_access_token_secret",
					"value" => 'kyihndCB8UZiT8KLD5YvM6CFxQKGCfGQaiACNfSQFXnCk'
				),
				array(
					"type" => "textfield",
					"heading" => __( "Max Word Text", TEXTDOMAIN ),
					"param_name" => "max_length",
					"value" => 10,
					"description" => __( "Max Word Text", TEXTDOMAIN )
				),										
				array(
					"type" => "textfield",
					"heading" => __( "Limit", TEXTDOMAIN ),
					"param_name" => "limit",
					"value" => 3,
					"description" => __( "Limit", TEXTDOMAIN )
				),				
				array(
					"type" => "dropdown",
					"heading" => __( "Number of Columns >1200px: ", TEXTDOMAIN ),
					"param_name" => "columns",
					"value" => array(1,2,3,4,5,6),
					"description" => __( "Number of Columns >1200px:", TEXTDOMAIN )
				 ),
				array(
					"type" => "dropdown",
					"heading" => __( "Number of Columns on 992px to 1199px:", TEXTDOMAIN ),
					"param_name" => "columns1",
					"value" => array(1,2,3,4,5,6),
					"description" => __( "Number of Columns on 992px to 1199px:", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Number of Columns on 768px to 991px:", TEXTDOMAIN ),
					"param_name" => "columns2",
					"value" => array(1,2,3,4,5,6),
					"description" => __( "Number of Columns on 768px to 991px:", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Number of Columns on 480px to 767px:", TEXTDOMAIN ),
					"param_name" => "columns3",
					"value" => array(1,2,3,4,5,6),
					"description" => __( "Number of Columns on 480px to 767px:", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Number of Columns in 480px or less than:", TEXTDOMAIN ),
					"param_name" => "columns4",
					"value" => array(1,2,3,4,5,6),
					"description" => __( "Number of Columns in 480px or less than:", TEXTDOMAIN )
				 ),		 
				array(
					"type" => "dropdown",
					"heading" => __( "Layout", TEXTDOMAIN ),
					"param_name" => "layout",
					"value" => array( 'Layout Default' => 'default', 'Layout 2' => 'layout2' ),
					"description" => __( "Layout", TEXTDOMAIN )
				 ),
			  )
		   ) );
		}
		/**
			** Add Shortcode
		**/
		function SC_WooTwitterSlider( $atts, $content = null ){
			extract( shortcode_atts(
				array(
					'title' => 'Twitter',
					'twitter_name' => 'sellertemplate',
					'twitter_customer_key' => 'vA1kw62CSISJOZKSEpBvNMHPV',
					'twitter_customer_secret' => 'UfmsUTfFipMvPyftIDGHKh6sJRw7YAWoaFFisd2paCYQ419Aak',
					'twitter_access_token'    => '2811335408-mVDm69N490kUxvIbzBHCNyMJvaOwY2vac0Q1yOn',
					'twitter_access_token_secret'    => 'kyihndCB8UZiT8KLD5YvM6CFxQKGCfGQaiACNfSQFXnCk',
					'limit' => 2,
					'max_length'	=> 10,
					'width' => '180px',
					'height' => '200px',
					'limit'  => 3,					
					'columns' => 3,
					'columns1' => 3,
					'columns2' => 3,
					'columns3' => 1,
					'columns4' => 1,
					'layout'  => 'default',
				), $atts )
			);
			ob_start();	
			if( $layout == 'default' ){
				include(VEL_WOO_THEMES.'vel-woo-twitter-slider-widget/default.php' );
			}else{
				include(VEL_WOO_THEMES.'/vel-woo-twitter-slider-widget/theme1.php' );
			}
			
			$content = ob_get_clean();
			
			return $content;
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// strip tag on text field
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['twitter_name'] = strip_tags( $new_instance['twitter_name'] );
			$instance['twitter_id'] = strip_tags( $new_instance['twitter_id'] );
			$instance['width'] = strip_tags( $new_instance['width'] );
			$instance['height'] = strip_tags( $new_instance['height'] );

			if ( array_key_exists('limit', $new_instance) ){
				$instance['limit'] = intval( $new_instance['limit'] );
			}
			if ( array_key_exists('max_length', $new_instance) ){
				$instance['max_length'] = intval( $new_instance['max_length'] );
			}			
			if ( array_key_exists('show_header', $new_instance) ){
				$instance['show_header'] = intval( $new_instance['show_header'] );
			}			
			if ( array_key_exists('show_footer', $new_instance) ){
				$instance['show_footer'] = intval( $new_instance['show_footer'] );
			}
			if ( array_key_exists('show_border', $new_instance) ){
				$instance['show_border'] = intval( $new_instance['show_border'] );
			}
			if ( array_key_exists('show_scrollbar', $new_instance) ){
				$instance['show_scrollbar'] = intval( $new_instance['show_scrollbar'] );
			}	
			if ( array_key_exists('transparent', $new_instance) ){
				$instance['transparent'] = intval( $new_instance['transparent'] );
			}	
			if ( array_key_exists('show_replies', $new_instance) ){
				$instance['show_replies'] = intval( $new_instance['show_replies'] );
			}				
			if ( array_key_exists('columns', $new_instance) ){
				$instance['columns'] = intval( $new_instance['columns'] );
			}
			if ( array_key_exists('columns1', $new_instance) ){
				$instance['columns1'] = intval( $new_instance['columns1'] );
			}
			if ( array_key_exists('columns2', $new_instance) ){
				$instance['columns2'] = intval( $new_instance['columns2'] );
			}
			if ( array_key_exists('columns3', $new_instance) ){
				$instance['columns3'] = intval( $new_instance['columns3'] );
			}
			if ( array_key_exists('columns4', $new_instance) ){
				$instance['columns4'] = intval( $new_instance['columns4'] );
			}
			
			$instance['widget_template'] = strip_tags( $new_instance['widget_template'] );
			
						
			
			return $instance;
		}
					
			
	}
}
?>