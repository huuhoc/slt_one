<?php
$widget_id = isset( $widget_id ) ? $widget_id : 'slt_woo_grid_'.rand().time();
$default = array();
if( $category != '' ){
	$default = array(
		'post_type' => 'product',
		'tax_query' => array(
			array(
			'taxonomy'  => 'product_cat',
			'field'     => 'slug',
			'terms'     => $category 
			) 
		),
		'orderby' => $orderby,
		'order' => $order,
		'post_status' => 'publish',
		'showposts' => $numberposts
	);
	$idObj = get_term_by('slug', $category, 'product_cat');
	$cat_link = get_category_link( $idObj->term_id );
} else {
	$default = array(
		'post_type' => 'product',		
		'orderby' => $orderby,
		'order' => $order,
		'post_status' => 'publish',
		'showposts' => $numberposts
	);
}

if ($type_view == 'grid') {

$class_item = slt_calculator_col($product_show);
$list = new WP_Query( $default );
//do_action( 'before' ); 
if ( $list -> have_posts() ) { ?>
	<div id="<?php echo $widget_id; ?>" class="widget slt-woo-grid woo-grid-default <?php if(empty($title1)) echo 'no-title'; ?>">
		<?php if($title1 || $description) { ?>
		<div class="widget-title">
			<?php if($title1) { ?>
			<h2 class="page-title-slider"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo $title1; ?></a></h2>
			<a class="view-more" href="<?php echo esc_url( $cat_link ); ?>">Xem tất cả</a>
			<?php } ?>
		</div> 
		<?php } ?>
		<div class="grid clearfix row">	
			<?php while($list->have_posts()): $list->the_post();global $product, $post, $wpdb, $average; ?>
			<div class="item <?php echo $class_item;?> col-sm-4 col-xs-6">
				<div class="item-wrap">
					<div class="product-container product">
						<div class="product-wapper">
							<?php //do_action( 'woocommerce_before_shop_loop_item' ); ?>
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
			</div>
			<?php endwhile; wp_reset_postdata();?>
		</div>
	</div>
	<?php
	}
} else {
	$list = new WP_Query( $default );
	//do_action( 'before' ); 
	if ( $list -> have_posts() ) { ?>
		<div id="<?php echo $widget_id; ?>" class="widget slt-woo-grid woo-grid-default <?php if(empty($title1)) echo 'no-title'; ?>">
			<?php if($title1 || $description) { ?>
			<div class="widget-title">
				<?php if($title1) { ?>
				<h2 class="page-title-slider"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo $title1; ?></a></h2>
				<a class="view-more" href="<?php echo esc_url( $cat_link ); ?>">Xem tất cả</a>
				<?php } ?>
			</div> 
			<?php } ?>
			<div class="grid owl-carousel owl-theme">	
				<?php while($list->have_posts()): $list->the_post();global $product, $post, $wpdb, $average; ?>
				<div class="item">
					<div class="item-wrap">
						<div class="product-container product">
							<div class="product-wapper">
								<?php //do_action( 'woocommerce_before_shop_loop_item' ); ?>
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
				</div>
				<?php endwhile; wp_reset_postdata();?>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function( $ ) {
				var owl = $('.owl-carousel','#<?php echo $widget_id; ?>');
				owl.owlCarousel({
					nav:true,
					navContainerClass: 'owl-buttons',
					navText: [ '<i class="fa fa-long-arrow-left "></i>','<i class="fa fa-long-arrow-right"></i>' ],
					navClass: [ 'owl-prev left', 'owl-next right' ],
					dots:false,
					loop:true,
					margin: 10,
					responsiveClass:true,
					responsive:{
						0:{
							items: 2
						},
						480:{
							items: 2
						},
						768:{
							items:<?php echo $product_show; ?>
						},
						1024:{
							items:<?php echo $product_show; ?>
						}
					},
				});
			});
		</script>
	<?php
	}	
}

?>