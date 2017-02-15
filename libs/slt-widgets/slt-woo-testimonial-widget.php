<?php
/**
 * SLT Woo Tab Slider Widget
 * Plugin URI: http://www.sellertemplate.com
 * Version: 1.0
 * This Widget help you to show images of product as a beauty tab reponsive slideshow
 */
if ( !class_exists('vel_woo_testimonial_widget') ) {
	class vel_woo_testimonial_widget extends WP_Widget {

		/**
		 * Widget setup.
		 */
		function __construct() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'vel_woo_testimonial_widget', 'description' => __('SLT Woo Testimonial Widget', 'sellertemplate') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vel_woo_testimonial_widget' );

			/* Create the widget. */
			parent::__construct( 'vel_woo_testimonial_widget', __('SLT Woo Testimonial Widget', 'sellertemplate'), $widget_ops, $control_ops );
					
			add_shortcode( 'woo_testimonial_widget', array( $this, 'SC_WooTestimonial' ) );
			
			/* Create Vc_map */
			if ( class_exists('Vc_Manager') && class_exists( 'WooCommerce' ) ) {
				add_action( 'vc_before_init', array( $this, 'SC_integrateWithVC' ) );
			}
		}

		/**
			* Add Vc Params
		**/
		function SC_integrateWithVC(){
			
			vc_map( array(
				"name" => __( "SLT Woo Testimonial", TEXTDOMAIN ),
				"base" => "woo_testimonial_widget",
				"category" => __( "SLT Shortcode", TEXTDOMAIN),
				"params" => array(
				array(
					"type" => "textfield",
					"heading" => __( "Title", TEXTDOMAIN ),
					"param_name" => "title1",
					"value" => 'SLT Testimonial Widget',
					"description" => __( "Title", TEXTDOMAIN )
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
		function SC_WooTestimonial( $atts, $content = null ){
			extract( shortcode_atts(
				array(
					'title1' => '',
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
				include(VEL_WOO_THEMES.'vel-woo-testimonial-widget/default.php' );
			}else{
				include(VEL_WOO_THEMES.'/vel-woo-testimonial-widget/theme1.php' );
			}
			
			$content = ob_get_clean();
			
			return $content;
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// strip tag on text field
			$instance['title1'] = strip_tags( $new_instance['title1'] );
		
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