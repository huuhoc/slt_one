<?php
/**
	* SLT Woocommerce Slider
	* Register Widget Woocommerce Grid
	* @author 		seller template
	* @version     1.0.0
**/
if ( !class_exists('slt_woo_grid_widget') ) {
	class slt_woo_grid_widget extends WP_Widget {
		/**
		 * Widget setup.
		 */
		function __construct(){
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'slt_woo_grid_widget', 'description' => __('SLT Woo Grid Product', 'slt_one') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'slt_woo_grid_widget' );

			/* Create the widget. */
			parent::__construct( 'slt_woo_grid_widget', __('SLT Woo Grid Product Widget', 'slt_one'), $widget_ops, $control_ops );
			
			/* Create Shortcode */
			add_shortcode( 'woo_grid', array( $this, 'WS_Shortcode' ) );
			
			/* Create Vc_map */
			if ( class_exists('Vc_Manager') ) {
				add_action( 'vc_before_init', array( $this, 'WS_integrateWithVC' ), 10 );
			}
			
		}
		
		/**
		* Add Vc Params
		**/
		function WS_integrateWithVC(){
			$terms = get_terms( 'product_cat', array( 'hide_empty' => false, 'fields' => 'all' ) );
			if( count( $terms ) == 0 ){
				return ;
			}
			$term = array( __( 'All Categories', TEXTDOMAIN ) => '' );
			foreach( $terms as $cat ){
				$term[$cat->name] = $cat -> slug;
			}
			vc_map( array(
			  "name" => __( "SLT Woo Grid Product", TEXTDOMAIN ),
			  "base" => "woo_grid",
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
					"type" => "dropdown",
					"heading" => __( "Category", TEXTDOMAIN ),
					"param_name" => "category",
					"value" => $term,
					"description" => __( "Select Categories", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Order By", TEXTDOMAIN ),
					"param_name" => "orderby",
					"value" => array('Name' => 'name', 'Author' => 'author', 'Date' => 'date', 'Title' => 'title', 'Modified' => 'modified', 'Parent' => 'parent', 'ID' => 'ID', 'Random' =>'rand', 'Comment Count' => 'comment_count'),
					"description" => __( "Order By", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Order", TEXTDOMAIN ),
					"param_name" => "order",
					"value" => array('Descending' => 'DESC', 'Ascending' => 'ASC'),
					"description" => __( "Order", TEXTDOMAIN )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Product Show Number", TEXTDOMAIN ),
					"param_name" => "product_show",
					"value" => 4,
					"description" => __( "Product Show Number", TEXTDOMAIN )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Limit Product Number", TEXTDOMAIN ),
					"param_name" => "numberposts",
					"value" => 8,
					"description" => __( "Limit Product Number", TEXTDOMAIN )
				 ),
				  array(
					"type" => "dropdown",
					"heading" => __( "Layout", TEXTDOMAIN ),
					"param_name" => "layout",
					"value" => array( 'Layout Default' => 'default'),
					"description" => __( "Layout", TEXTDOMAIN )
				 ),
				  array(
					"type" => "dropdown",
					"heading" => __( "View Type", TEXTDOMAIN ),
					"param_name" => "type_view",
					"value" => array('Grid' => 'grid', 'Slider' => 'slider'),
					"description" => __( "View Type", TEXTDOMAIN )
				 ),
			  )
		   ) );
		}
		/**
			** Add Shortcode
		**/
		function WS_Shortcode( $atts, $content = null ){
			extract( shortcode_atts(
				array(
					'title1' => '',		
					'orderby' => '',
					'order'	=> '',
					'category' => '',
					'product_show' => 4,
					'numberposts' => 8,
					'layout'  => 'layout1',
					'type_view'  => 'grid'
				), $atts )
			);
			ob_start();		
			if( $layout == 'layout1' ){
				include( plugin_dir_path(dirname(__FILE__)).'/themes/slt-woo-grid-widget/default.php' );
				
			}elseif( $layout == 'layout2' ){
				include( plugin_dir_path(dirname(__FILE__)).'/themes/slt-woo-grid-widget/featured.php' );			
			}
			elseif( $layout == 'layout3' ){
				include( plugin_dir_path(dirname(__FILE__)).'/themes/slt-woo-grid-widget/toprated.php' );			
			}
			elseif( $layout == 'layout4' ){
				include( plugin_dir_path(dirname(__FILE__)).'/themes/slt-woo-grid-widget/bestsales.php' );			
			}
			
			$content = ob_get_clean();
			
			return $content;
		}
		/**
			* Cut string
		**/
		public function hurama_trim_words( $text, $num_words = 30, $more = null ) {
			$text = strip_shortcodes( $text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			return wp_trim_words($text, $num_words, $more);
		}
		/**
		 * Display the widget on the screen.
		 */
		public function widget( $args, $instance ) {
			wp_reset_postdata();
			extract($args);
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			echo $before_widget;
			if (!empty( $title )){ echo $before_title . $title . $after_title; }
			
			if ( !isset($instance['category']) ){
				$instance['category'] = array();
			}
			$id = $this -> number;
			extract($instance);

			if ( !array_key_exists('widget_template', $instance) ){
				$instance['widget_template'] = 'default';
			}

			if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
				_e('Please active woocommerce plugin or install woomcommerce plugin first', TEXTDOMAIN);
				return false;
			}
			if ( $tpl = $this->getTemplatePath( $instance['widget_template'] ) ){ 			
				$link_img = plugins_url('images/', __FILE__);
				$widget_id = $args['widget_id'];		
				include $tpl;
			}
					
			/* After widget (defined by themes). */
			echo $after_widget;
		}    

		protected function getTemplatePath($tpl='default', $type=''){
			$file = '/'.$tpl.$type.'.php';
			$dir =	plugin_dir_path(dirname(__FILE__)).'/themes/slt-woo-grid-widget';
			
			if ( file_exists( $dir.$file ) ){
				return $dir.$file;
			}
			
			return $tpl=='default' ? false : $this->getTemplatePath('default', $type);
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
		
		/**
		 * Update the widget settings.
		 */
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
			
			if ( array_key_exists('orderby', $new_instance) ){
				$instance['orderby'] = strip_tags( $new_instance['orderby'] );
			}

			if ( array_key_exists('order', $new_instance) ){
				$instance['order'] = strip_tags( $new_instance['order'] );
			}

			if ( array_key_exists('product_show', $new_instance) ){
				$instance['product_show'] = intval( $new_instance['product_show'] );
			}

			if ( array_key_exists('numberposts', $new_instance) ){
				$instance['numberposts'] = intval( $new_instance['numberposts'] );
			}

			if ( array_key_exists('length', $new_instance) ){
				$instance['length'] = intval( $new_instance['length'] );
			}

			$instance['widget_template'] = strip_tags( $new_instance['widget_template'] );

			if ( array_key_exists('type_view', $new_instance) ){
				$instance['type_view'] = strip_tags( $new_instance['type_view'] );
			}

			return $instance;
		}

		function category_select( $field_name, $opts = array(), $field_value = null ){
			$default_options = array(
					'multiple' => false,
					'disabled' => false,
					'size' => 5,
					'class' => 'widefat',
					'required' => false,
					'autofocus' => false,
					'form' => false,
			);
			$opts = wp_parse_args($opts, $default_options);
		
			if ( (is_string($opts['multiple']) && strtolower($opts['multiple'])=='multiple') || (is_bool($opts['multiple']) && $opts['multiple']) ){
				$opts['multiple'] = 'multiple';
				if ( !is_numeric($opts['size']) ){
					if ( intval($opts['size']) ){
						$opts['size'] = intval($opts['size']);
					} else {
						$opts['size'] = 5;
					}
				}
				if (array_key_exists('allow_select_all', $opts) && $opts['allow_select_all']){
					unset($opts['allow_select_all']);
					$allow_select_all = '<option value="0">All Categories</option>';
				}
			} else {
				// is not multiple
				unset($opts['multiple']);
				unset($opts['size']);
				if (is_array($field_value)){
					$field_value = array_shift($field_value);
				}
				if (array_key_exists('allow_select_all', $opts) && $opts['allow_select_all']){
					unset($opts['allow_select_all']);
					$allow_select_all = '<option value="0">All Categories</option>';
				}
			}
		
			if ( (is_string($opts['disabled']) && strtolower($opts['disabled'])=='disabled') || is_bool($opts['disabled']) && $opts['disabled'] ){
				$opts['disabled'] = 'disabled';
			} else {
				unset($opts['disabled']);
			}
		
			if ( (is_string($opts['required']) && strtolower($opts['required'])=='required') || (is_bool($opts['required']) && $opts['required']) ){
				$opts['required'] = 'required';
			} else {
				unset($opts['required']);
			}
		
			if ( !is_string($opts['form']) ) unset($opts['form']);
		
			if ( !isset($opts['autofocus']) || !$opts['autofocus'] ) unset($opts['autofocus']);
		
			$opts['id'] = $this->get_field_id($field_name);
		
			$opts['name'] = $this->get_field_name($field_name);
			if ( isset($opts['multiple']) ){
				$opts['name'] .= '[]';
			}
			$select_attributes = '';
			foreach ( $opts as $an => $av){
				$select_attributes .= "{$an}=\"{$av}\" ";
			}
			
			$categories = get_terms('product_cat');
			//print '<pre>'; var_dump($categories);
			// if (!$templates) return '';
			$all_category_ids = array();
			foreach ($categories as $cat) $all_category_ids[] = (int)$cat->term_id;
			
			$is_valid_field_value = is_numeric($field_value) && in_array($field_value, $all_category_ids);
			if (!$is_valid_field_value && is_array($field_value)){
				$intersect_values = array_intersect($field_value, $all_category_ids);
				$is_valid_field_value = count($intersect_values) > 0;
			}
			if (!$is_valid_field_value){
				$field_value = '0';
			}
		
			$select_html = '<select ' . $select_attributes . '>';
			if (isset($allow_select_all)) $select_html .= $allow_select_all;
			foreach ($categories as $cat){			
				$select_html .= '<option value="' . $cat->term_id . '"';
				if ($cat->term_id == $field_value || (is_array($field_value)&&in_array($cat->term_id, $field_value))){ $select_html .= ' selected="selected"';}
				$select_html .=  '>'.$cat->name.'</option>';
			}
			$select_html .= '</select>';
			return $select_html;
		}
		

		/**
		 * Displays the widget settings controls on the widget panel.
		 * Make use of the get_field_id() and get_field_name() function
		 * when creating your form elements. This handles the confusing stuff.
		 */
		public function form( $instance ) {

			/* Set up some default widget settings. */
			$defaults = array();
			$instance = wp_parse_args( (array) $instance, $defaults ); 		
					 
			$title1 				= isset( $instance['title1'] )    		? 	strip_tags($instance['title1']) : '';
			$categoryid 			= ( isset( $instance['category'] )  &&  is_array( $instance['category'] ) ) ? $instance['category'] : array();
			$orderby    			= isset( $instance['orderby'] )     	? strip_tags($instance['orderby']) : 'ID';
			$order      			= isset( $instance['order'] )       	? strip_tags($instance['order']) : 'ASC';
			$number_show    	= isset( $instance['product_show'] ) 	? intval($instance['product_show']) : 4;
			$number     			= isset( $instance['numberposts'] ) 	? intval($instance['numberposts']) : 8;
			$widget_template	= isset( $instance['widget_template'] ) ? strip_tags($instance['widget_template']) : 'default';
			$type_view      	= isset( $instance['type_view'] )       	? strip_tags($instance['type_view']) : 'grid';
					   
					 
			?>		
			</p> 
			  <div style="background: Blue; color: white; font-weight: bold; text-align:center; padding: 3px"> * Data Config * </div>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('title1'); ?>"><?php _e('Title', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>"
					type="text"	value="<?php echo esc_attr($title1); ?>" />
			</p>
			
			<p id="wgd-<?php echo $this->get_field_id('category'); ?>">
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category ID', TEXTDOMAIN)?></label>
				<br />
				<?php echo $this->category_select('category', array('allow_select_all' => true), $categoryid); ?>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby', TEXTDOMAIN)?></label>
				<br />
				<?php $allowed_keys = array('name' => 'Name', 'author' => 'Author', 'date' => 'Date', 'title' => 'Title', 'modified' => 'Modified', 'parent' => 'Parent', 'ID' => 'ID', 'rand' =>'Rand', 'comment_count' => 'Comment Count'); ?>
				<select class="widefat"
					id="<?php echo $this->get_field_id('orderby'); ?>"
					name="<?php echo $this->get_field_name('orderby'); ?>">
					<?php
					$option ='';
					foreach ($allowed_keys as $value => $key) :
						$option .= '<option value="' . $value . '" ';
						if ($value == $orderby){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$key.'</option>';
					endforeach;
					echo $option;
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', TEXTDOMAIN)?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
					<option value="DESC" <?php if ($order=='DESC'){?> selected="selected"
					<?php } ?>>
						<?php _e('Descending', TEXTDOMAIN)?>
					</option>
					<option value="ASC" <?php if ($order=='ASC'){?> selected="selected"	<?php } ?>>
						<?php _e('Ascending', TEXTDOMAIN)?>
					</option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('product_show'); ?>"><?php _e('Product Show Number', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('product_show'); ?>" name="<?php echo $this->get_field_name('product_show'); ?>"
					type="text"	value="<?php echo esc_attr($number_show); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('Number of Posts', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>"
					type="text"	value="<?php echo esc_attr($number); ?>" />
			</p>
			
			
			<p>
				<label for="<?php echo $this->get_field_id('widget_template'); ?>"><?php _e("Template", TEXTDOMAIN)?></label>
				<br/>
				
				<select class="widefat"
					id="<?php echo $this->get_field_id('widget_template'); ?>"	name="<?php echo $this->get_field_name('widget_template'); ?>">
					<option value="default" <?php if ($widget_template=='default'){?> selected="selected"
					<?php } ?>>
						<?php _e('Default', TEXTDOMAIN)?>		
					</option>			
					<option value="featured" <?php if ($widget_template=='featured'){?> selected="selected"
					<?php } ?>>
						<?php _e('Featured Slider', TEXTDOMAIN)?>
					</option>
					<option value="toprated" <?php if ($widget_template=='toprated'){?> selected="selected"
					<?php } ?>>
						<?php _e('Top Rated Slider', TEXTDOMAIN)?>
					</option>
					<option value="bestsales" <?php if ($widget_template=='bestsales'){?> selected="selected"
					<?php } ?>>
						<?php _e('Best Selling Slider', TEXTDOMAIN)?>
					</option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('type_view'); ?>"><?php _e("View type", TEXTDOMAIN)?></label>
				<br/>
				
				<select class="widefat"
					id="<?php echo $this->get_field_id('type_view'); ?>"	name="<?php echo $this->get_field_name('type_view'); ?>">
					<option value="grid_type" <?php if ($type_view=='grid_type'){?> selected="selected"
					<?php } ?>>
						<?php _e('Grid', TEXTDOMAIN)?>		
					</option>			
					<option value="slider_type" <?php if ($type_view=='slider_type'){?> selected="selected"
					<?php } ?>>
						<?php _e('Slider', TEXTDOMAIN)?>
					</option>
				</select>
			</p>  

		<?php
		}	
	}
}
?>