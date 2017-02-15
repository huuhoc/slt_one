<?php $hurama_direction = hurama_options()->getCpanelValue( 'direction' ); ?>
<?php
if( $category == '' ){
	echo __( 'Please select a category', TEXTDOMAIN );
	return;
}
$widget_id = isset( $widget_id ) ? $widget_id : 'sw_woo_slider_'.rand().time();

$default = array();
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
	'showposts' => $numberposts
);
$term = get_term_by( 'slug', $category, 'product_cat' );	
$list = new WP_Query( $default );
if ( $list -> have_posts() ){ ?>
	<div id="<?php echo $widget_id; ?>" class="vel-woo-container-slider responsive-slider woo-slider-default loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $hurama_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
		<div class="block-title clearfix">
			<h2 class="page-title-slider"><?php echo $term->name; ?></h2>
			<?php 
				$termchild = get_term_children( $term->term_id, 'product_cat' );
				if( count( $termchild ) > 0 ){
			?>
			<div class="childcat-slider">				
				<div class="childcat-content">
				<?php 
					$termchild = get_term_children( $term->term_id, 'product_cat' );
					echo '<ul>';
					foreach ( $termchild as $child ) {
						$term = get_term_by( 'id', $child, 'product_cat' );
						echo '<li><a href="' . get_term_link( $child, 'product_cat' ) . '">' . $term->name . '</a></li>';
					}
					echo '</ul>';
				?>
				</div>
			</div>
			<?php } ?>
		</div>          
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
								<!-- add to cart, wishlist, compare -->
								<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
							</div>											
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata();?>
			</div>
		</div>            
	</div>
	<?php
	}
?>