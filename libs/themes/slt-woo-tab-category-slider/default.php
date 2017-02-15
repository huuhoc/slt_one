<?php 
	$id = $this->number;
	$this->number = $id + 1;
	$tag_id = 'vel_woo_tab_'. $id;
	if( !is_array( $category ) ){
		$category = explode( ',', $category );
	}
?>
<div class="vel-woo-tab-cat loading" id="<?php echo esc_attr( $tag_id ); ?>" >
	<div class="vel-tabs-category">
		<div class="top-tab-slider clearfix">
			<?php if($title1) { ?>
			<div class="title-block">
				<h2><?php echo $title1; ?></h2>
			</div>
			<?php } ?>
			<ul class="nav nav-tabs">
			<?php
				foreach($category as $key => $cat){
					$terms = get_term_by('id', $cat, 'product_cat');				
			?>
				<?php if($cat == 0){?>
					<li class="<?php if( ( $key + 1 ) == $tab_active ){echo 'active'; }?>">
						<a href="#<?php echo $select_order.'_category_'.$cat; ?>" data-toggle="tab">
							<?php echo __( "All Category", TEXTDOMAIN); ?>
						</a>
					</li>
				<?php }else{?>
					<li class="<?php if( ( $key + 1 ) == $tab_active ){echo 'active'; }?>">
						<a href="#<?php echo $select_order.'_category_'.$cat; ?>" data-toggle="tab">
							<?php echo $terms->name; ?>
						</a>
					</li>						
				<?php }?>	
			<?php } ?>
			</ul>
		</div>
		<div class="tab-content">
			<?php
				foreach($category as $key => $cat){
					switch ($select_order) {
						case 'latest':
							$default = array(
								'post_type'	=> 'product',
								'tax_query'	=> array(
									array(
										'taxonomy'	=> 'product_cat',
										'field'		=> 'id',
										'terms'		=> $cat)),
								'orderby' => 'date',
								'order' => $order,
								'post_status' => 'publish',
								'showposts' => $numberposts
							);
							break;
						case 'rating':
							$default = array(
								'post_type' 			=> 'product',
								'post_status' 			=> 'publish',
								'ignore_sticky_posts'   => 1,
								'tax_query'	=> array(
								array(
									'taxonomy'	=> 'product_cat',
									'field'		=> 'id',
									'terms'		=> $cat)),
								'orderby' 				=> $orderby,
								'order'					=> $order,
								'showposts' 		=> $numberposts,
								'meta_query' 			=> array(
									array(
										'key' 			=> '_visibility',
										'value' 		=> array('catalog', 'visible'),
										'compare' 		=> 'IN'
									)
								)
							);
							add_filter( 'posts_clauses',  array( $this, 'order_by_rating_post_clauses' ) );
							break;
						case 'bestsales':
							$default = array(
								'post_type' 			=> 'product',
								'post_status' 			=> 'publish',
								'ignore_sticky_posts'   => 1,
								'tax_query'	=> array(
									array(
										'taxonomy'	=> 'product_cat',
										'field'		=> 'id',
										'terms'		=> $cat)),
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
								'post_type'				=> 'product',
								'post_status' 			=> 'publish',
								'tax_query'	=> array(
									array(
										'taxonomy'	=> 'product_cat',
										'field'		=> 'id',
										'terms'		=> $cat)),
								'ignore_sticky_posts'	=> 1,
								'posts_per_page' 		=> $numberposts,
								'orderby' 				=> $orderby,
								'order' 				=> $order,
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
				if($cat == 0)
					unset($default['tax_query']);	
				
				$list = new WP_Query( $default );
				do_action( 'before' ); 
			?>
			<div class="tab-pane<?php if( ( $key + 1 ) == $tab_active ){echo ' active'; }?>" id="<?php echo $select_order.'_category_'.$cat; ?>">
				<div class="owl-buttons <?php echo $select_order.'owl-buttons'; ?>">
					<div class="owl-prev carousel-control left"><i class="icon-arrow-left icons"></i></div>
					<div class="owl-next carousel-control right"><i class="icon-arrow-right icons"></i></div>
				</div>
				<div id="<?php echo $select_order.'_category_id_'.$cat; ?>" class="woo-tab-container-slider responsive-slider clearfix" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>"  data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
					<div class="resp-slider-container">
						<div class="slider owl-carousel">
						<?php 
							$i = 1;
							while($list->have_posts()): $list->the_post();
							global $product, $post, $wpdb, $average;
						?>
							<div class="item">
								<div class="item-wrap">
									<div class="product-container">
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
												<div class='product-button'>
													<div class="cart-button">
														<?php echo create_buttun_cart($product); ?>
													</div>
													<?php
														if( class_exists( 'YITH_WCWL' ) )
															echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
														remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
														do_action( 'woocommerce_after_shop_loop_item' );
												    ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php $i++; endwhile; wp_reset_postdata();?>
						</div>
						<script type="text/javascript">
							jQuery(document).ready(function( $ ) {
								var owl = $('.slider','#<?php echo $select_order.'_category_id_'.$cat; ?>');
								owl.owlCarousel({
									nav:false,
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
								$('.<?php echo $select_order.'owl-buttons'; ?> .owl-prev').click(function($) {
								    owl.trigger('prev.owl.carousel');
								});
								$('.<?php echo $select_order.'owl-buttons'; ?> .owl-next').click(function($) {
								    owl.trigger('next.owl.carousel');
								});
							});
						</script>
					</div>
				</div>			
			</div>
			<?php
			} 
			?>
		</div>
	</div>
</div>