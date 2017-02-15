<?php 
	if( $category == '' ){
		return ;
	}

	$id = $this -> number;
	$id ++;
	$tag_id = 'vel_woo_tab_' .rand().time();
	//var_dump( $select_order );
	if( !is_array( $select_order ) ){
		$select_order = explode( ',', $select_order );
	}
	$term = get_term_by( 'slug', $category, 'product_cat' );	
?>
<div id="<?php echo esc_attr( $tag_id ); ?>" class="vel-woo-tab layout-2 loading">
	<?php if($title1) { ?>
	<div class="title-block">
		<h2><?php echo $title1; ?></h2>
		<div class="title-description"><?php echo $description; ?></div>
	</div>
	<?php } ?>
	<div class="category-slider-content clearfix">
		<!-- End get child category -->		
		<div class="tab-content clearfix">
			<div class="top-tab-slider clearfix">
				<ul class="nav nav-tabs">
					<?php 
						$tab_title = '';
						foreach( $select_order as $i  => $select ){						
							switch ($select) {
							case 'latest':
								$tab_title = __( 'Latest', TEXTDOMAIN );
							break;
							case 'bestsales':
								$tab_title = __( 'Best', TEXTDOMAIN );
							break;						
							case 'featured':
								$tab_title = __( 'Featured', TEXTDOMAIN );
							break;
							default:
								$tab_title = __( 'Sale', TEXTDOMAIN );
							}
					?>
							<li <?php echo ( $i == $tab_active - 1 )? 'class="active"' : ''; ?>>
								<a href="#<?php echo $select . '_' . $category.$id; ?>" data-toggle="tab">
									<?php echo esc_html( $tab_title ); ?>
								</a>
							</li>
					<?php } ?>
				</ul>
			</div>
			<!-- Product tab slider -->
			<?php foreach( $select_order as $i  => $select ){ ?>
				<div class="tab-pane <?php echo ( $i == $tab_active - 1 ) ? 'active' : ''; ?>" id="<?php echo $select . '_' . $category.$id; ?>">
					<?php
					global $woocommerce;
					$default = array();
					
					switch ($select) {
						case 'latest':
							$default = array(
								'post_type'	=> 'product',
								'tax_query' => array(
									array(
										'taxonomy'	=> 'product_cat',
										'field'		=> 'slug',
										'terms'		=> $category,
										'operator' 	=> 'IN'
									)
								),
								'paged'		=> 1,
								'showposts'	=> $numberposts,
								'orderby'	=> 'date'
							);
							break;
						case 'rating':
							$default = array(
								'post_type'		=> 'product',
								'tax_query' => array(
									array(
										'taxonomy'	=> 'product_cat',
										'field'		=> 'slug',
										'terms'		=> $category,
										'operator' 	=> 'IN'
									)
								),
								'post_status' 	=> 'publish',
								'no_found_rows' => 1,					
								'showposts' 	=> $numberposts						
							);
							$default['meta_query'] = WC()->query->get_meta_query();
							add_filter( 'posts_clauses',  array( $this, 'order_by_rating_post_clauses' ) );
							break;
						case 'bestsales':
							$default = array(
									'post_type' 			=> 'product',
									'tax_query' => array(
										array(
											'taxonomy'	=> 'product_cat',
											'field'	=> 'slug',
											'terms'	=> $category,
											'operator' => 'IN'
										)
									),
									'post_status' 			=> 'publish',
									'ignore_sticky_posts'   => 1,
									'paged'	=> 1,
									'showposts'				=> $numberposts,
									'meta_key' 		 		=> 'total_sales',
									'orderby' 		 		=> 'meta_value_num',
									'meta_query' 			=> array(
										array(
											'key' 		=> '_visibility',
											'value' 	=> array( 'catalog', 'visible' ),
											'compare' 	=> 'IN'
										)
									)
								);
							break;
						case 'featured':
							$default = array(
								'post_type'	=> 'product',
								'tax_query' => array(
									array(
										'taxonomy'	=> 'product_cat',
										'field'	=> 'slug',
										'terms'	=> $category,
										'operator' => 'IN'
									)
								),
								'post_status' 			=> 'publish',
								'ignore_sticky_posts'	=> 1,
								'posts_per_page' 		=> $numberposts,
								'meta_query'			=> array(
									array(
										'key' 		=> '_visibility',
										'value' 	=> array('catalog', 'visible'),
										'compare'	=> 'IN'
									),
									array(
										'key' 		=> '_featured',
										'value' 	=> 'yes'
									)
								)
							);
							break;							
					}
					if($category == 'all')
						unset($default['tax_query']);
				
					$list = new WP_Query( $default );
					$post_count = (int)$list->post_count;

					$count_items = ( $numberposts >= $post_count ) ? $post_count : $numberposts;
					
					$max_page = $list -> max_num_pages;
					if( $select == 'rating' ){
						remove_filter( 'posts_clauses',  array( $this, 'order_by_rating_post_clauses' ) );
					}
					?>
					<div id="<?php echo $select.'_category_id_'.$category.$id; ?>" class="woo-tab-container-slider responsive-slider clearfix" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>"  data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
						<div class="resp-slider-container">
							<div class="slider owl-carousel">
								<?php 
								$i = 1;
								while($list->have_posts()): $list->the_post();

								global $product, $post, $wpdb, $average;
								if( $i % $item_row == 1 || $item_row == 1 ){
								?>
								
								<div class="item">
								<?php } ?>
									<div class="item-wrap">
										<div class="product-container no-effect">
											<div class="product-wapper">
												<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
												<div class='product-image-wrapper'>
													<div class='product-content-image'>
														<a title="<?php the_title(); ?>" href="<?php echo (get_option( 'woocommerce_enable_lightbox' )=='yes' && is_product()) ? $image_attributes[0] : the_permalink(); ?>" 
														   class="product-image <?php echo (get_option( 'woocommerce_enable_lightbox' )=='yes' &&  is_product())?'zoom':'' ;?>">
															<?php
																/**
																 * woocommerce_before_shop_loop_item_title hook
																 *
																 * @hooked woocommerce_template_loop_product_thumbnail - 10
																 */
																remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
												                do_action( 'woocommerce_before_shop_loop_item_title' );
															?>
														</a>
													</div>
												</div>
												<div class='product-details'>
													<div class='product-name'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
													<?php
														/**
														 * woocommerce_after_shop_loop_item_title hook
														 *
														 * @hooked woocommerce_template_loop_rating - 5
														 * @hooked woocommerce_template_loop_price - 10
														 */
														remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
														do_action( 'woocommerce_after_shop_loop_item_title' );
													?>
												</div>
											</div>
										</div>
									</div>
								<?php if( ( $i % $item_row == 0) || ($i == $count_items) || $item_row == 1 ){?> 
								</div>
								<?php } ?>

								<?php $i++; endwhile; wp_reset_postdata();?>

								<script type="text/javascript">
									jQuery(document).ready(function( $ ) {
										var owl = $('.slider','#<?php echo $select.'_category_id_'.$category.$id; ?>');
										owl.owlCarousel({
											nav:true,
											navContainerClass: 'owl-buttons',
											navText: [ '<i class="icon-arrow-left icons"></i>','<i class="icon-arrow-right icons"></i>' ],
											navClass: [ 'owl-prev carousel-control left', 'owl-next carousel-control right' ],
											dots:false,
											loop:false,
											margin:30,
											responsiveClass:true,
											responsive:{
												0:{
													items:<?php echo $columns2; ?>
												},
												480:{
													items:<?php echo $columns1; ?>
												},
												768:{
													items:<?php echo $columns1; ?>
												},
												1024:{
													items:<?php echo $columns; ?>
												}
											},
										});
									});
								</script>
							</div>	
						</div>
					</div>			
				</div>
			<?php } ?>
			<!-- End product tab slider -->
		</div>
	</div>
</div>