
<?php
$widget_id = isset( $widget_id ) ? $widget_id : 'vel_woo_slider_'.rand().time();
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
		'showposts' => $numberposts
	);
}else{
	$default = array(
		'post_type' => 'product',		
		'orderby' => $orderby,
		'order' => $order,
		'post_status' => 'publish',
		'showposts' => $numberposts
	);
}
$list = new WP_Query( $default );
do_action( 'before' ); 
if ( $list -> have_posts() ){ ?>
	<div id="<?php echo $widget_id; ?>" class="vel-woo-slider responsive-slider woo-slider-default arrow-middle special">
		<?php if($title1) { ?>
		<div class="block-title">
			<div class="page-title-slider"><?php echo $title1; ?></div>
			<div class="page-description-slider"><?php echo $description; ?></div>
		</div> 
		<?php } ?>         
		<div class="slider owl-carousel">	
		<?php while($list->have_posts()): $list->the_post();global $product, $post, $wpdb, $average; ?>
			<div class="item">
				<div class="item-wrap">
					<div class="product-container product">
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
		<?php endwhile; wp_reset_postdata();?>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function( $ ) {
				var owl = $('.slider','#<?php echo $widget_id; ?>');
				owl.owlCarousel({
					nav:true,
					navContainerClass: 'owl-buttons',
					navText: [ '<i class="icon-arrow-left icons"></i>','<i class="icon-arrow-right icons"></i>' ],
					navClass: [ 'owl-prev carousel-control left', 'owl-next carousel-control right' ],
					dots:false,
					loop:true,
					margin:0,
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
	<?php
	}
?>