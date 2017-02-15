<?php
/**
 * SLT Woocommerce Total Sales Slider
 * Plugin URI: http://sellertemplate.com
 * This Widget help you to show top total sales on period of time.
 */
if ( !class_exists('vel_woott_slider_widget') ) {
	class vel_woott_slider_widget extends WP_Widget {
		/**
		 * Widget setup.
		 */
		function __construct(){
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'vel_woott_slider_content', 'description' => __('SLT Woocommerce Total Sales', 'yatheme') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vel_woott_slider_content' );

			/* Create the widget. */
			parent::__construct( 'vel_woott_slider_content', __('SLT Woocommerce Total Sales widget', 'yatheme'), $widget_ops, $control_ops );
					
			/* Add shortcode */
			add_shortcode( 'total_sale', array( $this, 'CD_Shortcode' ) );
			
			/* Create Vc_map */
			if (class_exists('Vc_Manager')) {
				vc_add_shortcode_param( 'date', array( $this, 'hurama_date_vc_setting' ) );
				add_action( 'vc_before_init', array( $this, 'CD_integrateWithVC' ) );
			}
			
		}
		/**
		* Add Vc Params
		**/
		function hurama_date_vc_setting( $settings, $value ) {
		   return '<div class="vc_date_block">'
					 .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
					 esc_attr( $settings['param_name'] ) . ' ' .
					 esc_attr( $settings['type'] ) . '_field" type="date" value="' . esc_attr( $value ) . '" placeholder="dd-mm-yyyy"/>' .
					'</div>'; 
		}
		function CD_integrateWithVC(){		
			vc_map( array(
			  "name" => __( "Woocommerce Total Sales Slider", TEXTDOMAIN ),
			  "base" => "total_sale",
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
					"heading" => __( "Style Total Sales", TEXTDOMAIN ),
					"param_name" => "style",
					"value" =>array(
						'Style Default' => '',
						'Style 1' => 'style1',
						),
					"description" => ''
				 ),			 
				 array(
					"type" => "textfield",
					"heading" => __( "Number Of Post", TEXTDOMAIN ),
					"param_name" => "numberposts",
					"value" => 5,
					"description" => __( "Number Of Post", TEXTDOMAIN )
				 ),
				 array(
					"type" => "date",
					"heading" => __( "From Date", TEXTDOMAIN ),
					"param_name" => "from_date",
					"value" => '',
					"description" => __( "From Date", TEXTDOMAIN )
				 ),
				 array(
					"type" => "date",
					"heading" => __( "To Date", TEXTDOMAIN ),
					"param_name" => "to_date",
					"value" => '',
					"description" => __( "To Date", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Number row per column", TEXTDOMAIN ),
					"param_name" => "item_row",
					"value" =>array(1,2,3),
					"description" => __( "Number row per column", TEXTDOMAIN )
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
					"type" => "dropdown",
					"heading" => __( "Layout", TEXTDOMAIN ),
					"param_name" => "layout",
					"value" => array( 'Layout Default' => 'default' ),
					"description" => __( "Layout", TEXTDOMAIN )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Total Items Slided", TEXTDOMAIN ),
					"param_name" => "scroll",
					"value" => 1,
					"description" => __( "Total Items Slided", TEXTDOMAIN )
				 ),
			  )
		   ) );
		}
		/**
			** Add Shortcode
		**/
		function CD_Shortcode( $atts, $content = null ){
			extract( shortcode_atts(
				array(
					'title1' 		=> '',
					 'header_style' => '',
					 'style' 		=> '',
					'numberposts' 	=> 5,
					'from_date'		=> '',
					'to_date'		=> '',
					'length' 		=> 25,
					'item_row'		=> 1,
					'columns' 		=> 4,
					'columns1' 		=> 4,
					'columns2' 		=> 3,
					'columns3' 		=> 2,
					'columns4' 		=> 1,
					'speed' 		=> 1000,
					'autoplay' 		=> 'true',
					'interval' 		=> 5000,
					'layout'  		=> 1,
					'scroll' 		=> 1
				), $atts )
			);
			ob_start();			
			include( plugin_dir_path(dirname(__FILE__)).'/themes/vel-total-sales-widget/default.php' );
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
			$description1 = apply_filters( 'widget_description', empty( $instance['description1'] ) ? '' : $instance['description1'], $instance, $this->id_base );
			echo $before_widget;
			if ( !empty( $title ) && !empty( $description1 ) ) { echo $before_title . $title . $after_title . '<h5 class="category_description clearfix">' . $description1 . '</h5>'; }
			else if (!empty( $title ) && $description1==NULL ){ echo $before_title . $title . $after_title; }
			
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
			$dir = plugin_dir_path(dirname(__FILE__)).'/themes/vel-total-sales-widget';
			
			if ( file_exists( $dir.$file ) ){
				return $dir.$file;
			}
			
			return $tpl=='default' ? false : $this->getTemplatePath('default', $type);
		}
		
		/**
		 * Update the widget settings.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// strip tag on text field
			$instance['title1'] = strip_tags( $new_instance['title1'] );
			$instance['description1'] = strip_tags( $new_instance['description1'] );		

			if ( array_key_exists('numberposts', $new_instance) ){
				$instance['numberposts'] = intval( $new_instance['numberposts'] );
			}

			if ( array_key_exists('length', $new_instance) ){
				$instance['length'] = intval( $new_instance['length'] );
			}
			
			if ( array_key_exists('item_row', $new_instance) ){
				$instance['item_row'] = intval( $new_instance['item_row'] );
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
			$instance['widget_template'] = strip_tags( $new_instance['widget_template'] );
			
						
			
			return $instance;
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
					 
			$title1 			= isset( $instance['title1'] )    ? 	strip_tags($instance['title1']) : '';
			$description1 		= isset( $instance['description1'] )    ? 	strip_tags($instance['description1']) : '';		
			$number     		= isset( $instance['numberposts'] ) ? intval($instance['numberposts']) : 5;
			$length     		= isset( $instance['length'] )      ? intval($instance['length']) : 25;
			$item_row     		= isset( $instance['item_row'] )      ? intval($instance['item_row']) : 1;
			$columns     		= isset( $instance['columns'] )      ? intval($instance['columns']) : 1;
			$columns1     		= isset( $instance['columns1'] )      ? intval($instance['columns1']) : 1;
			$columns2     		= isset( $instance['columns2'] )      ? intval($instance['columns2']) : 1;
			$columns3     		= isset( $instance['columns3'] )      ? intval($instance['columns3']) : 1;
			$columns4     		= isset( $instance['columns'] )      ? intval($instance['columns4']) : 1;
			$autoplay     		= isset( $instance['autoplay'] )      ? strip_tags($instance['autoplay']) : 'true';
			$interval     		= isset( $instance['interval'] )      ? intval($instance['interval']) : 5000;
			$speed     			= isset( $instance['speed'] )      ? intval($instance['speed']) : 1000;
			$scroll     		= isset( $instance['scroll'] )      ? intval($instance['scroll']) : 1;
			$widget_template   	= isset( $instance['widget_template'] ) ? strip_tags($instance['widget_template']) : 'default';
					   
					 
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
			<p>
				<label for="<?php echo $this->get_field_id('description1'); ?>"><?php _e('Description', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('description1'); ?>" name="<?php echo $this->get_field_name('description1'); ?>"
					type="text"	value="<?php echo esc_attr($description1); ?>" />
			</p>		

			<p>
				<label for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('Number of Posts', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>"
					type="text"	value="<?php echo esc_attr($number); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('length'); ?>"><?php _e('Excerpt length (in words): ', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat"
					id="<?php echo $this->get_field_id('length'); ?>" name="<?php echo $this->get_field_name('length'); ?>" type="text" 
					value="<?php echo esc_attr($length); ?>" />
			</p> 
			<?php $row_number = array( '1' => 1, '2' => 2, '3' => 3 ); ?>
			<p>
				<label for="<?php echo $this->get_field_id('item_row'); ?>"><?php _e('Number row per column:  ', TEXTDOMAIN)?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('item_row'); ?>"
					name="<?php echo $this->get_field_name('item_row'); ?>">
					<?php
					$option ='';
					foreach ($row_number as $key => $value) :
						$option .= '<option value="' . $value . '" ';
						if ($value == $item_row){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$key.'</option>';
					endforeach;
					echo $option;
					?>
				</select>
			</p> 
			
			<?php $number = array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6); ?>
			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Number of Columns >1200px: ', TEXTDOMAIN)?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('columns'); ?>"
					name="<?php echo $this->get_field_name('columns'); ?>">
					<?php
					$option ='';
					foreach ($number as $key => $value) :
						$option .= '<option value="' . $value . '" ';
						if ($value == $columns){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$key.'</option>';
					endforeach;
					echo $option;
					?>
				</select>
			</p> 
			
			<p>
				<label for="<?php echo $this->get_field_id('columns1'); ?>"><?php _e('Number of Columns on 992px to 1199px: ', TEXTDOMAIN)?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('columns1'); ?>"
					name="<?php echo $this->get_field_name('columns1'); ?>">
					<?php
					$option ='';
					foreach ($number as $key => $value) :
						$option .= '<option value="' . $value . '" ';
						if ($value == $columns1){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$key.'</option>';
					endforeach;
					echo $option;
					?>
				</select>
			</p> 
			
			<p>
				<label for="<?php echo $this->get_field_id('columns2'); ?>"><?php _e('Number of Columns on 768px to 991px: ', TEXTDOMAIN)?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('columns2'); ?>"
					name="<?php echo $this->get_field_name('columns2'); ?>">
					<?php
					$option ='';
					foreach ($number as $key => $value) :
						$option .= '<option value="' . $value . '" ';
						if ($value == $columns2){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$key.'</option>';
					endforeach;
					echo $option;
					?>
				</select>
			</p> 
			
			<p>
				<label for="<?php echo $this->get_field_id('columns3'); ?>"><?php _e('Number of Columns on 480px to 767px: ', TEXTDOMAIN)?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('columns3'); ?>"
					name="<?php echo $this->get_field_name('columns3'); ?>">
					<?php
					$option ='';
					foreach ($number as $key => $value) :
						$option .= '<option value="' . $value . '" ';
						if ($value == $columns3){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$key.'</option>';
					endforeach;
					echo $option;
					?>
				</select>
			</p> 
			
			<p>
				<label for="<?php echo $this->get_field_id('columns4'); ?>"><?php _e('Number of Columns in 480px or less than: ', TEXTDOMAIN)?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('columns4'); ?>"
					name="<?php echo $this->get_field_name('columns4'); ?>">
					<?php
					$option ='';
					foreach ($number as $key => $value) :
						$option .= '<option value="' . $value . '" ';
						if ($value == $columns4){
							$option .= 'selected="selected"';
						}
						$option .=  '>'.$key.'</option>';
					endforeach;
					echo $option;
					?>
				</select>
			</p> 
			
			<p>
				<label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Auto Play', 'yatheme')?></label>
				<br />
				<select class="widefat"
					id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>">
					<option value="false" <?php if ($autoplay=='false'){?> selected="selected"
					<?php } ?>>
						<?php _e('False', 'yatheme')?>
					</option>
					<option value="true" <?php if ($autoplay=='true'){?> selected="selected"	<?php } ?>>
						<?php _e('True', 'yatheme')?>
					</option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('interval'); ?>"><?php _e('Interval', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('interval'); ?>" name="<?php echo $this->get_field_name('interval'); ?>"
					type="text"	value="<?php echo esc_attr($interval); ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Speed', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>"
					type="text"	value="<?php echo esc_attr($speed); ?>" />
			</p>
			
			
			<p>
				<label for="<?php echo $this->get_field_id('scroll'); ?>"><?php _e('Total Items Slided', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('scroll'); ?>" name="<?php echo $this->get_field_name('scroll'); ?>"
					type="text"	value="<?php echo esc_attr($scroll); ?>" />
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
				</select>
			</p>  
		<?php
		}	
	}
}
?>