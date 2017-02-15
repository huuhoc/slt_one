<?php
/**
	* SLT Woocommerce Categories Slider
	* Register Widget Woocommerce Categories Slider
	* @author 		sellertemplate
	* @version     1.0.0
**/
if ( !class_exists('vel_woo_cat_slider_widget') ) {
	class vel_woo_cat_slider_widget extends WP_Widget {
		/**
		 * Widget setup.
		 */
		function __construct(){
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'vel_woo_cat_slider_widget', 'description' => __('SLT Woo Categories Slider', 'yatheme') );

			/* Widget control settings. */
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vel_woo_cat_slider_widget' );

			/* Create the widget. */
			parent::__construct( 'vel_woo_cat_slider_widget', __('SLT Woo Categories Slider widget', 'yatheme'), $widget_ops, $control_ops );
					
			/* Create Shortcode */
			add_shortcode( 'woocat_slide', array( $this, 'WSC_Shortcode' ) );
			
			/* Create Vc_map */
			if ( class_exists('Vc_Manager') ) {
				add_action( 'vc_before_init', array( $this, 'WSC_integrateWithVC' ), 10 );
			}
			/* Add Custom field to category product */
			add_action( 'product_cat_add_form_fields', array( $this, 'add_category_fields' ), 100 );
			add_action( 'product_cat_edit_form_fields', array( $this, 'edit_category_fields' ), 100 );
			add_action( 'created_term', array( $this, 'save_category_fields' ), 10, 3 );
			add_action( 'edit_term', array( $this, 'save_category_fields' ), 10, 3 );
			
			/* Ajax Call */
			add_action( 'wp_ajax_vel_category_callback', array( $this, 'vel_category_callback') );
			add_action( 'wp_ajax_nopriv_vel_category_callback', array( $this, 'vel_category_callback') );
			
		}
		
		/**
		* Add Vc Params
		**/
		function WSC_integrateWithVC(){
			$terms = get_terms( 'product_cat', array( 'parent' => 0, 'hide_emty' => false ) );
			if( count( $terms ) == 0 ){
				return ;
			}
			$term = array( __( 'All Categories', TEXTDOMAIN ) => '' );
			foreach( $terms as $cat ){
				$term[$cat->name] = $cat -> slug;
			}
			vc_map( array(
			  "name" => __( "YA Woo Categories Slider", TEXTDOMAIN ),
			  "base" => "woocat_slide",
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
					"type" => "checkbox",
					"heading" => __( "Categories", TEXTDOMAIN ),
					"param_name" => "category",
					"value" => $term,
					"description" => __( "Select Categories", TEXTDOMAIN )
				 ),
				 array(
					"type" => "textfield",
					"heading" => __( "Number Of Post", TEXTDOMAIN ),
					"param_name" => "numberposts",
					"value" => 5,
					"description" => __( "Number of post for layout 2", TEXTDOMAIN )
				 ),
				 array(
					"type" => "dropdown",
					"heading" => __( "Order By", TEXTDOMAIN ),
					"param_name" => "orderby",
					"value" => array('Name' => 'name', 'Author' => 'author', 'Date' => 'date', 'Title' => 'title', 'Modified' => 'modified', 'Parent' => 'parent', 'ID' => 'ID', 'Random' =>'rand', 'Comment Count' => 'comment_count'),
					"description" => __( "Order by for layout 2", TEXTDOMAIN )
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
					"value" => array( 'Layout Default' => 'layout1', 'Layout Category Ajax' => 'layout2' ),
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
		function WSC_Shortcode( $atts, $content = null ){
			extract( shortcode_atts(
				array(
					'title1' => '',				
					'orderby' => '',
					'category' => '',
					'numberposts' => 5,
					'columns' => 4,
					'columns1' => 4,
					'columns2' => 3,
					'columns3' => 2,
					'columns4' => 1,
					'speed' => 1000,
					'autoplay' => 'true',
					'interval' => 5000,
					'layout'  => 'layout1',
					'scroll' => 1
				), $atts )
			);
			ob_start();		
			if( $layout == 'layout1' ){
				include( plugin_dir_path(dirname(__FILE__)).'/themes/category-slider/default.php' );			
			}elseif( $layout == 'layout2' ){
				include( plugin_dir_path(dirname(__FILE__)).'/themes/category-slider/category_ajax.php' );			
			}
			
			$content = ob_get_clean();
			
			return $content;
		}
		
		/**
		*	Add Custom field on category product
		**/
		public function add_category_fields() { 
	?>
			<div class="form-field">
				<label><?php _e( 'Thumbnail 1', 'woocommerce' ); ?></label>
				<div id="product_cat_thumbnail1" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_cat_thumbnail_id1" name="product_cat_thumbnail_id1" />
					<button type="button" class="upload_image_button1 button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
					<button type="button" class="remove_image_button1 button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
				</div>
				<script type="text/javascript">

					// Only show the "remove image" button when needed
					if ( ! jQuery( '#product_cat_thumbnail_id1' ).val() ) {
						jQuery( '.remove_image_button1' ).hide();
					}

					// Uploading files
					var file_frame1;

					jQuery( document ).on( 'click', '.upload_image_button1', function( event ) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame1 ) {
							file_frame1.open();
							return;
						}

						// Create the media frame.
						file_frame1 = wp.media.frames.downloadable_file = wp.media({
							title: '<?php _e( "Choose an image", "woocommerce" ); ?>',
							button: {
								text: '<?php _e( "Use image", "woocommerce" ); ?>'
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame1.on( 'select', function() {
							var attachment = file_frame1.state().get( 'selection' ).first().toJSON();
							
							jQuery( '#product_cat_thumbnail_id1' ).val( attachment.id );
							jQuery( '#product_cat_thumbnail1 > img' ).attr( 'src', attachment.sizes.thumbnail.url );
							jQuery( '.remove_image_button1' ).show();
						});

						// Finally, open the modal.
						file_frame1.open();
					});

					jQuery( document ).on( 'click', '.remove_image_button1', function() {
						jQuery( '#product_cat_thumbnail1 img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#product_cat_thumbnail_id1' ).val( '' );
						jQuery( '.remove_image_button1' ).hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</div>
			<?php
		}
		
		public function edit_category_fields( $term ) {

			$thumbnail_id = absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id1', true ) );

			if ( $thumbnail_id ) {
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
			} else {
				$image = wc_placeholder_img_src();
			}
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php _e( 'Thumbnail 1', 'woocommerce' ); ?></label></th>
				<td>
					<div id="product_cat_thumbnail1" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
					<div style="line-height: 60px;">
						<input type="hidden" id="product_cat_thumbnail_id1" name="product_cat_thumbnail_id1" value="<?php echo $thumbnail_id; ?>" />
						<button type="button" class="upload_image_button1 button"><?php _e( 'Upload/Add image', 'woocommerce' ); ?></button>
						<button type="button" class="remove_image_button1 button"><?php _e( 'Remove image', 'woocommerce' ); ?></button>
					</div>
					<script type="text/javascript">

						// Only show the "remove image" button when needed
						if ( '0' === jQuery( '#product_cat_thumbnail_id1' ).val() ) {
							jQuery( '.remove_image_button1' ).hide();
						}

						// Uploading files
						var file_frame1;

						jQuery( document ).on( 'click', '.upload_image_button1', function( event ) {

							event.preventDefault();

							// If the media frame already exists, reopen it.
							if ( file_frame1 ) {
								file_frame1.open();
								return;
							}

							// Create the media frame.
							file_frame1 = wp.media.frames.downloadable_file = wp.media({
								title: '<?php _e( "Choose an image", "woocommerce" ); ?>',
								button: {
									text: '<?php _e( "Use image", "woocommerce" ); ?>'
								},
								multiple: false
							});

							// When an image is selected, run a callback.
							file_frame1.on( 'select', function() {
								var attachment = file_frame1.state().get( 'selection' ).first().toJSON();

								jQuery( '#product_cat_thumbnail_id1' ).val( attachment.id );
								jQuery( '#product_cat_thumbnail1 img' ).attr( 'src', attachment.sizes.thumbnail.url );
								jQuery( '.remove_image_button1' ).show();
							});

							// Finally, open the modal.
							file_frame1.open();
						});

						jQuery( document ).on( 'click', '.remove_image_button1', function() {
							jQuery( '#product_cat_thumbnail1 img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
							jQuery( '#product_cat_thumbnail1_id' ).val( '' );
							jQuery( '.remove_image_button1' ).hide();
							return false;
						});

					</script>
					<div class="clear"></div>
				</td>
			</tr>
			<?php
		}
		public function save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
			if ( isset( $_POST['product_cat_thumbnail_id1'] ) && 'product_cat' === $taxonomy ) {
				update_woocommerce_term_meta( $term_id, 'thumbnail_id1', absint( $_POST['product_cat_thumbnail_id1'] ) );
			}
		}
		/**
		* Ajax Callback
		**/
		function vel_category_callback(){
			$catid 			= ( isset( $_POST["catid"] )   && $_POST["catid"] != '' ) ? $_POST["catid"] : '';
			$numberposts	= ( isset( $_POST["number"] )  && $_POST["number"] > 0 ) ? $_POST["number"] : 0;
			$orderby 		= ( isset( $_POST["orderby"] ) && $_POST["orderby"] != '' ) ? $_POST["orderby"] : 'ID';
			$columns		= ( isset( $_POST["columns"] )  && $_POST["columns"] > 0 ) ? $_POST["columns"] : 1;
			$columns1		= ( isset( $_POST["columns1"] )  && $_POST["columns1"] > 0 ) ? $_POST["columns1"] : 1;
			$columns2		= ( isset( $_POST["columns2"] )  && $_POST["columns2"] > 0 ) ? $_POST["columns2"] : 1;
			$columns3		= ( isset( $_POST["columns3"] )  && $_POST["columns3"] > 0 ) ? $_POST["columns3"] : 1;
			$columns4		= ( isset( $_POST["columns4"] )  && $_POST["columns4"] > 0 ) ? $_POST["columns4"] : 1;
			$interval		= ( isset( $_POST["interval"] )  && $_POST["interval"] > 0 ) ? $_POST["interval"] : 1000;
			$speed			= ( isset( $_POST["speed"] )  && $_POST["speed"] > 0 ) ? $_POST["speed"] : 1000;
			$scroll			= ( isset( $_POST["scroll"] )  && $_POST["scroll"] !='' ) ? $_POST["scroll"] : 'true';
			$rtl			= ( isset( $_POST["rtl"] )  && $_POST["number"] !='' ) ? $_POST["rtl"] : 'false';
			$autoplay		= ( isset( $_POST["autoplay"] )  && $_POST["autoplay"] != '' ) ? $_POST["autoplay"] : 'false';
			$default = array(
				'post_type' => 'product',
				'tax_query' => array(
				array(
					'taxonomy'  => 'product_cat',
					'field'     => 'term_id',
					'terms'     => $catid ) ),
				'orderby' => $orderby,
				'post_status' => 'publish',
				'showposts' => $numberposts
			);		
			$thumbnail_id 	= absint( get_metadata( 'woocommerce_term', $catid, 'thumbnail_id1', true ));
			$thumb = wp_get_attachment_image( $thumbnail_id, array(350, 230), 0, array( 'class' => 'category-image pull-left' ) );
			$list = new WP_Query( $default );			
			do_action( 'before' ); 
			if ( $list -> have_posts() ){ ?>
				<div id="<?php echo 'category_ajax_slider_'.$catid; ?>" class="vel-woo-container-slider responsive-slider woo-slider-default loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $hurama_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">       
					<div class="slider-wrapper clearfix">
						<?php echo $thumb; ?>
						<div class="resp-slider-container">
							<div class="slider responsive">	
							<?php while($list->have_posts()): $list->the_post();global $product, $post, $wpdb, $average; ?>
								<div class="item">
									<div class="item-wrap">
										<div class="item-detail">										
											<div class="item-img products-thumb">											
												<!-- quickview & thumbnail  -->
												<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
											</div>										
											<div class="item-content">
												<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h4>								
																							
												<!-- rating  -->
												<?php 
													$rating_count = $product->get_rating_count();
													$review_count = $product->get_review_count();
													$average      = $product->get_average_rating();
												?>
												<div class="reviews-content">
													<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div>
													<div class="item-number-rating">
														<?php echo $review_count; _e(' Review(s)', 'yatheme');?>
													</div>
												</div>	
												<!-- end rating  -->
												<?php if ( $price_html = $product->get_price_html() ){?>
												<div class="item-price">
													<span>
														<?php echo $price_html; ?>
													</span>
												</div>
												<?php } ?>
												<div class="product-addcart-wrapper">
												<?php  
													//var_dump($product->add_to_cart_url());
													echo apply_filters( 'woocommerce_loop_add_to_cart_link',
															sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s"  class="button  %s product_type_%s" title="add to cart">%s</a>',
																esc_url( $product->add_to_cart_url() ),
																esc_attr( $product->id ),
																esc_attr( $product->get_sku() ),
																$product->is_purchasable() ? 'add_to_cart_button' : '',
																esc_attr( $product->product_type ),
																esc_html( $product->add_to_cart_text() )
															),
														$product );
													if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
														if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
															$yith_compare = new YITH_Woocompare_Frontend();
															add_shortcode( 'yith_compare_button', array( $yith_compare , 'compare_button_sc' ) );
															echo do_shortcode('[yith_compare_button]');
														}
														if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
															echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
														}
													}
													$nonce = wp_create_nonce("hurama_quickviewproduct_nonce");
													$link = admin_url('admin-ajax.php?ajax=true&amp;action=hurama_quickviewproduct&amp;post_id='.$product->id.'&amp;nonce='.$nonce);
													$linkcontent ='<a href="'. esc_url( $link ) .'" data-fancybox-type="ajax" class="fancybox fancybox.ajax sm_quickview_handler" title="Quick View Product">'.apply_filters( 'out_of_stock_add_to_cart_text', __( 'Quick View', 'yatheme' ) ).'</a>';
													echo $linkcontent;
												?>
												</div>
											</div>											
										</div>
									</div>
								</div>
							<?php endwhile; wp_reset_postdata();?>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			exit();
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
			$dir =	plugin_dir_path(dirname(__FILE__)).'/themes/category-slider';
			
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
			// int or array
			if ( array_key_exists('category', $new_instance) ){
				if ( is_array($new_instance['category']) ){
					$instance['category'] = array_map( 'intval', $new_instance['category'] );
				} else {
					$instance['category'] = intval($new_instance['category']);
				}
			}		
			if ( array_key_exists('numberposts', $new_instance) ){
				$instance['numberposts'] = intval( $new_instance['numberposts'] );
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

		function category_select( $field_name, $opts = array(), $field_value = null ){
			$default_options = array(
					'multiple' => true,
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
					 
			$title1 			= isset( $instance['title1'] )    		? 	strip_tags($instance['title1']) : '';
			$description1 		= isset( $instance['description1'] )    ? 	strip_tags($instance['description1']) : '';
			$categoryid 		= ( isset( $instance['category'] )  &&  is_array( $instance['category'] ) ) ? $instance['category'] : array();
			$number     		= isset( $instance['numberposts'] ) 	? intval($instance['numberposts']) : 5;
			$orderby    		= isset( $instance['orderby'] )     	? strip_tags($instance['orderby']) : 'ID';
			$columns     		= isset( $instance['columns'] )      	? intval($instance['columns']) : 1;
			$columns1     		= isset( $instance['columns1'] )     	? intval($instance['columns1']) : 1;
			$columns2     		= isset( $instance['columns2'] )      	? intval($instance['columns2']) : 1;
			$columns3     		= isset( $instance['columns3'] )      	? intval($instance['columns3']) : 1;
			$columns4     		= isset( $instance['columns'] )      	? intval($instance['columns4']) : 1;
			$autoplay     		= isset( $instance['autoplay'] )      	? strip_tags($instance['autoplay']) : 'true';
			$interval     		= isset( $instance['interval'] )      	? intval($instance['interval']) : 5000;
			$speed     			= isset( $instance['speed'] )      		? intval($instance['speed']) : 1000;
			$scroll     		= isset( $instance['scroll'] )      	? intval($instance['scroll']) : 1;
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
			
			<p id="wgd-<?php echo $this->get_field_id('category'); ?>">
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category ID', TEXTDOMAIN)?></label>
				<br />
				<?php echo $this->category_select('category', array('allow_select_all' => true), $categoryid); ?>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('Number of Posts', TEXTDOMAIN)?></label>
				<br />
				<input class="widefat" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>"
					type="text"	value="<?php echo esc_attr($number); ?>" />
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
					<option value="childcat" <?php if ($widget_template=='childcat'){?> selected="selected"
					<?php } ?>>
						<?php _e('Child Category Style 1', TEXTDOMAIN)?>
					</option>
					<option value="childcat1" <?php if ($widget_template=='childcat1'){?> selected="selected"
					<?php } ?>>
						<?php _e('Child Category Style 2', TEXTDOMAIN)?>
					</option>
				</select>
			</p>  
		<?php
		}	
	}
}
?>