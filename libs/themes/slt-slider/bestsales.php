<?php 
$hurama_direction = hurama_options()->getCpanelValue( 'direction' );
if( $category != '' ){
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
}else{
	$default = array(
		'post_type' 			=> 'product',		
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'   => 1,
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
}
$id = 'sw_bestsales_'.rand().time();
$list = new WP_Query( $default );
if ( $list -> have_posts() ){
?>
	<div id="<?php echo $id; ?>" class="vel-woo-container-slider  responsive-slider best-selling-product clearfix loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $hurama_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
		<div class="resp-slider-container">
			<div class="box-slider-title <?php echo $header_style; ?>">
				<?php echo '<h2><span>'. esc_html( $title1 ) .'</span></h2>'; ?>
			</div>
			<div class="slider responsive">			
			<?php
				$i = 1;
				while($list->have_posts()): $list->the_post();global $product, $post, $wpdb, $average;
				?>
				<div class="item">
					<div class="item-wrap">
						<div class="item-detail">										
							<div class="item-img products-thumb">			
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
									<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*11 ).'px"></span>' : ''; ?></div>
								</div>	
								<!-- end rating  -->
								<!-- price -->
								<?php if ( $price_html = $product->get_price_html() ){?>
									<div class="item-price">
										<span>
											<?php echo $price_html; ?>
										</span>
									</div>
								<?php } ?>	
								<!-- add to cart, wishlist, compare -->
								<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
							</div>								
						</div>
					</div>
				</div>
			<?php $i++; endwhile; wp_reset_postdata();?>
			</div>
		</div>					
	</div>
<?php
}	
?>