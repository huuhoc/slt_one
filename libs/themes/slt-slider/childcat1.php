<?php $hurama_direction = hurama_options()->getCpanelValue( 'direction' ); ?>
<?php
if( $category == '' ){
	echo __( 'Please select a category', TEXTDOMAIN );
	return;
}
$widget_id = isset( $widget_id ) ? $widget_id : 'sw_woo_slider_'.rand().time();

$default = array();
if( $category != '' ){
	$default = array(
		'post_type' => 'product',
		'tax_query' => array(
		array(
			'taxonomy'  => 'product_cat',
			'field'     => 'slug',
			'terms'     => $category ) ),
		'orderby' => $orderby,
		'order' => $order,
		'post_status' => 'publish',
		'showposts' => -1
	);
}
$term = get_term_by( 'slug', $category, 'product_cat' );	
$list = new WP_Query( $default );
if ( $list -> have_posts() ){ 
	$pkey = array();
	$parray = $list->posts;
	$array_list = array();
	$count = 0;
	/* Get All Sales Product Price and store in a array */
	foreach( $parray as $key => $item ){
		if( intval( get_post_meta( $item->ID, '_sale_price', true ) ) > 0 ){
			$pkey[$count] = $key;
			$array_list[$count] = intval( get_post_meta( $item->ID, '_sale_price', true ) );
			$count ++;
		}
	}
	/* Check min price and show position in array ( $parray ) */
	$pmin = $array_list[0];
	$main_key = 0;
	for( $i = 0; $i < count( $array_list ); $i++ ){
		if( $array_list[$i] < $pmin ){
			$main_key = $pkey[$i];
		}
	}
	$arr1 = $parray[$main_key];
	unset( $parray[$main_key] );
	$parray =  array_values( $parray );
?>
	<div id="<?php echo $widget_id; ?>" class="vel-woo-container-slider childcat-slider">
		<div class="block-title clearfix">
			<h2 class="page-title-slider"><?php echo $term->name; ?></h2>	
			<a href="<?php echo get_term_link( $term->term_id, 'product_cat' ); ?>"><?php esc_html_e( 'View All Categories', TEXTDOMAIN ); ?></a>
		</div>
		<div class="childcat-slider-content clearfix">
		<?php 
			$termchild = get_term_children( $term->term_id, 'product_cat' );
			if( count( $termchild ) > 0 ){
		?>			
			<div class="childcat-content pull-left">
			<?php 
				$termchild = get_term_children( $term->term_id, 'product_cat' );
				echo '<ul>';
				foreach ( $termchild as $i => $child ) {
					$term = get_term_by( 'id', $child, 'product_cat' );
					echo '<li><a href="' . get_term_link( $child, 'product_cat' ) . '">' . $term->name . '</a></li>';
					if( $i == 6 ){
						break;
					}
				}
				echo '</ul>';
			?>
			</div>
			<?php } ?>
			<div class="resp-slider-container clearfix">
				<div class="first-deal pull-left">
					<h3><?php esc_html_e( 'Deals Of The Day', TEXTDOMAIN )?></h3>
					<div class="first-deal-content">
						<?php 
							global $product;
							$product = new WC_Product( $arr1->ID );
						 ?>
						<div class="item-img products-thumb">											
							<!-- quickview & thumbnail  -->
							<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
							<!-- add to cart, wishlist, compare -->
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
						</div>										
						<div class="item-content">
							<h4><a href="<?php echo get_the_permalink($product->id); ?>"><?php echo $product-> post ->post_title; ?></a></h4>								
																		
							<!-- rating  -->
							<?php 
								$rating_count = $product->get_rating_count();
								$review_count = $product->get_review_count();
								$average      = $product->get_average_rating();
							?>
							<div class="reviews-content">
								<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div>
								<!-- <div class="item-number-rating">
									<?php echo $review_count; _e(' Review(s)', 'yatheme');?>
								</div> -->
							</div>	
							<!-- end rating  -->
							<?php if ( $price_html = $product->get_price_html() ){?>
							<div class="item-price">
								<span>
									<?php echo $price_html; ?>
								</span>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<div id="<?php echo 'child_' . $widget_id; ?>" class="slider-container responsive-slider loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $hurama_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
					<div class="slider responsive">	
					<?php
						wp_reset_postdata();
						$i = 0;
						while( $i < $numberposts ) : 
						global $product;
						$product = new WC_Product( $parray[$i]->ID );
					?>
						<div class="item">
							<div class="item-wrap">
								<div class="item-detail">										
									<div class="item-img products-thumb">											
										<!-- quickview & thumbnail  -->
										<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
										<!-- add to cart, wishlist, compare -->
										<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
									</div>										
									<div class="item-content">
										<h4><a href="<?php echo get_the_permalink($product->id); ?>"><?php echo $product-> post ->post_title; ?></a></h4>																				
										<!-- rating  -->
										<?php 
											$rating_count = $product->get_rating_count();
											$review_count = $product->get_review_count();
											$average      = $product->get_average_rating();
										?>
										<div class="reviews-content">
											<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div>
											<!-- <div class="item-number-rating">
												<?php echo $review_count; _e(' Review(s)', 'yatheme');?>
											</div> -->
										</div>	
										<!-- end rating  -->
										<?php if ( $price_html = $product->get_price_html() ){?>
										<div class="item-price">
											<span>
												<?php echo $price_html; ?>
											</span>
										</div>
										<?php } ?>								
									</div>											
								</div>
							</div>
						</div>
					<?php $i++; endwhile; wp_reset_postdata();?>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<?php
	}
?>