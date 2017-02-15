<?php
/**
 * SLT Woo Tab Slider Widget
 * Plugin URI: http://www.sellertemplate.com
 * Version: 1.0
 * This Widget help you to show images of product as a beauty tab reponsive slideshow
 */
if ( !class_exists('vel_woo_tab_slider_widget') ) {
	class vel_woo_tab_slider_widget extends WP_Widget {

		/**
		 * Widget setup.
		 */
		function __construct() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'vel_woo_tab_slider', 'description' => __('SLT Woo Tab Slider', 'vel_maxive') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vel_woo_tab_slider' );

			/* Create the widget. */
			parent::__construct( 'vel_woo_tab_slider', __('SLT Woo Tab Slider widget', 'vel_maxive'), $widget_ops, $control_ops );
					
			add_shortcode( 'woo_tab_slider', array( $this, 'SC_WooTab' ) );
			
			/* Create Vc_map */
			if ( class_exists('Vc_Manager') && class_exists( 'WooCommerce' ) ) {
				add_action( 'vc_before_init', array( $this, 'SC_integrateWithVC' ) );
			}
		}

		/**
			* Add Vc Params
		**/
		function SC_integrateWithVC(){
			$terms = get_terms( 'product_cat', array( 'parent' => 0, 'hide_emty' => false ) );
			if( count( $terms ) == 0 ){
				return ;
			}
			$term = array( __( 'All Category Product', 'js_composer' ) => 'all' );
			foreach( $terms as $cat ){
				$term[$cat->name] = $cat->slug;
			}		
			
			vc_map( array(
				"name" => __( "Woocommerce Tab Slider", TEXTDOMAIN ),
				"base" => "woo_tab_slider",
				"category" => __( "SLT Shortcode", TEXTDOMAIN),
				"params" => array(
				 array(
					"type" => "textfield",
					"heading" => __( "Title", TEXTDOMAIN ),
					"param_name" => "title1",
					"value" => '',
					"description" => __( "Title", TEXTDOMAIN )
				),
				  array(
					"type" => "textfield",
					"heading" => __( "Description", TEXTDOMAIN ),
					"param_name" => "description",
					"value" => '',
					"description" => __( "Description", TEXTDOMAIN )
				 ),
				  array(
					"type" => "dropdown",
					"heading" => __( "Category", TEXTDOMAIN ),
					"param_name" => "category",
					"value" => $term,
					"description" => __( "Select Categories", TEXTDOMAIN )
				 ),
				 array(
					"type" => "checkbox",
					"heading" => __( "Select Order Product", TEXTDOMAIN ),
					"param_name" => "select_order",
					"value" => array('Latest Products' => 'latest', 'Best Sellers' => 'bestsales', 'Featured Products' => 'featured', 'Top Rating Products' => 'rating'),
					"description" => __( "Select Order Product", TEXTDOMAIN )
				 ),			 
				 array(
					"type" => "textfield",
					"heading" => __( "Number Of Post", TEXTDOMAIN ),
					"param_name" => "numberposts",
					"value" => 5,
					"description" => __( "Number Of Post", TEXTDOMAIN )
				 ),
				  array(
					"type" => "dropdown",
					"heading" => __( "Number row per column", TEXTDOMAIN ),
					"param_name" => "item_row",
					"value" =>array(1,2,3),
					"description" => __( "Number row per column", TEXTDOMAIN )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Length", TEXTDOMAIN ),
					"param_name" => "length",
					"value" => 15,
					"description" => __( "Number character to show", TEXTDOMAIN )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Tab Active", TEXTDOMAIN ),
					"param_name" => "tab_active",
					"value" => 1,
					"description" => __( "Select tab active", TEXTDOMAIN )
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
					"type" => "textfield",
					"heading" => __( "Speed", TEXTDOMAIN ),
					"param_name" => "speed",
					"value" => 1000,
					"description" => __( "Speed Of Slide", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Auto Play", TEXTDOMAIN ),
					"param_name" => "autoplay",
					"value" => array( 'True' => 'true', 'False' => 'false' ),
					"description" => __( "Auto Play", TEXTDOMAIN )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Interval", TEXTDOMAIN ),
					"param_name" => "interval",
					"value" => 5000,
					"description" => __( "Interval", TEXTDOMAIN )
				 ),			  
				 array(
					"type" => "textfield",
					"heading" => __( "Total Items Slided", TEXTDOMAIN ),
					"param_name" => "scroll",
					"value" => 1,
					"description" => __( "Total Items Slided", TEXTDOMAIN )
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
		function SC_WooTab( $atts, $content = null ){
			extract( shortcode_atts(
				array(
					'title1' => '',
					'description' => '',	
					'header_style' => '',
					'category' => 'all',
					'select_order' => 'latest',				
					'numberposts' => 5,
					'length' => 25,
					'item_row'=> 1,
					'tab_active' => 1,
					'columns' => 4,
					'columns1' => 4,
					'columns2' => 3,
					'columns3' => 2,
					'columns4' => 1,
					'speed' => 1000,
					'autoplay' => 'false',
					'interval' => 5000,
					'show_more'  => 'yes',
					'layout'  => 'default',
					'scroll' => 1
				), $atts )
			);
			ob_start();	
			if( $layout == 'default' ){
				include(VEL_WOO_THEMES.'vel-woo-tab-slider/default.php' );
			}else{
				include(VEL_WOO_THEMES.'/vel-woo-tab-slider/layout-2.php' );
			}
			
			$content = ob_get_clean();
			
			return $content;
		}
		
		/*Call to order clause*/
		public static function order_by_rating_post_clauses( $args ) {
			global $wpdb;

			$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

			$args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

			$args['join'] .= "
				LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
				LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
			";

			$args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";

			$args['groupby'] = "$wpdb->posts.ID";

			return $args;
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// strip tag on text field
			$instance['title1'] = strip_tags( $new_instance['title1'] );

			// int or array
			if ( array_key_exists('category', $new_instance) ){
				if ( is_array($new_instance['category']) ){
					$instance['category'] = array_map( 'intval', $new_instance['category'] );
				} else {
					$instance['category'] = intval($new_instance['category']);
				}
			}	
			if ( array_key_exists('select_order', $new_instance) ){
				if ( is_array($new_instance['select_order']) ){
					$instance['select_order'] = array_map( $new_instance['select_order'] );
				} else {
					$instance['select_order'] = strip_tags( $new_instance['select_order'] );
				}
			}		
			if ( array_key_exists('numberposts', $new_instance) ){
				$instance['numberposts'] = intval( $new_instance['numberposts'] );
			}
			if ( array_key_exists('length', $new_instance) ){
				$instance['length'] = intval( $new_instance['length'] );
			}
			if ( array_key_exists('item_row', $new_instance) ){
				$instance['item_row'] = intval( $new_instance['item_row'] );
			}		
			if ( array_key_exists('tab_active', $new_instance) ){
				$instance['tab_active'] = intval( $new_instance['tab_active'] );
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
			if ( array_key_exists('interval', $new_instance) ){
				$instance['interval'] = intval( $new_instance['interval'] );
			}
			if ( array_key_exists('speed', $new_instance) ){
				$instance['speed'] = intval( $new_instance['speed'] );
			}
			if ( array_key_exists('start', $new_instance) ){
				$instance['start'] = intval( $new_instance['start'] );
			}
			if ( array_key_exists('scroll', $new_instance) ){
				$instance['scroll'] = intval( $new_instance['scroll'] );
			}	
			if ( array_key_exists('autoplay', $new_instance) ){
				$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
			}
			if ( array_key_exists('show_more', $new_instance) ){
				$instance['show_more'] = strip_tags( $new_instance['show_more'] );
			}
			$instance['widget_template'] = strip_tags( $new_instance['widget_template'] );
			
						
			
			return $instance;
		}
			
	}
}
?>