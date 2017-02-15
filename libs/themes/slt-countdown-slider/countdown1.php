<?php 
/**
	* Layout Countdown 1
	* @version     1.0.0
**/


$hurama_direction = hurama_options()->getCpanelValue( 'direction' );
$default = array(
	'post_type' => 'product',	
	'meta_query' => array(
		array(
			'key' => '_visibility',
			'value' => array('catalog', 'visible'),
			'compare' => 'IN'
		),
		array(
			'key' => '_sale_price',
			'value' => 0,
			'compare' => '>',
			'type' => 'NUMERIC'
		),
		array(
			'key' => '_sale_price_dates_to',
			'value' => 0,
			'compare' => '>',
			'type' => 'NUMERIC'
		)
	),
	'orderby' => $orderby,
	'order' => $order,
	'post_status' => 'publish',
	'showposts' => $numberposts	
);
if( $category != '' ){
	$default['tax_query'] = array(
		array(
			'taxonomy'  => 'product_cat',
			'field'     => 'slug',
			'terms'     => $category ));
}
$id = 'vel-count-down_'.rand().time();
$list = new WP_Query( $default );
if ( $list -> have_posts() ){ ?>
	<div id="<?php echo $category.'_'.$id; ?>" class="vel-woo-container-slider responsive-slider countdown-slider-style1 loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $hurama_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-circle="false">       
		<div class="box-slider-title" >
			<?php echo ( $title1 != '' ) ? '<h2>'. esc_html( $title1 ) .'</h2>' : ''; ?>
			<?php echo ( $description != '' ) ? '<span>'. $description .'</span>' : ''; ?>
		</div>
		<div class="slider-wrapper clearfix">
		<!-- Product Countdown -->
		<?php if( $product_select != '' ){ ?>
		<?php   
			$symboy 			= get_woocommerce_currency_symbol();
			$fstart_time 		= get_post_meta( $product_select, '_sale_price_dates_from', true );
			$fcountdown_time 	= get_post_meta( $product_select, '_sale_price_dates_to', true );	
			$forginal_price 	= get_post_meta( $product_select, '_regular_price', true );	
			$fsale_price 		= get_post_meta( $product_select, '_sale_price', true );
			$fid 				= 'first_countdown_'.rand().time();
		?>
			<div class="first-product-countdown pull-left" id="<?php echo $fid; ?>">
				<div class="first-item-content">
					<a href="<?php echo get_permalink( $product_select ); ?>"><?php echo ( $image !='' ) ? '<img src="'.wp_get_attachment_url( $image ).'" alt="">' : ''; ?></a>
					<div class="first-item-detail">
						<div class="product-countdown" data-price="<?php echo esc_attr( $symboy.$forginal_price ); ?>" data-starttime="<?php echo esc_attr( $fstart_time ); ?>" data-cdtime="<?php echo esc_attr( $fcountdown_time ); ?>" data-id="<?php echo $fid; ?>"></div>
						<div class="item-content">
							<?php if( $fsale_price > 0){ 
								$sale_off = 100 - (($fsale_price/$forginal_price)*100); ?>
								<div class="sale-off">
									<?php echo '-'.round($sale_off).'%';?>
								</div>
							<?php } ?>
							<h3><a href="<?php echo get_permalink( $product_select ); ?>"><?php echo get_the_title( $product_select ); ?></a></h3>
							<div class="item-price">
								<span>
									<del>
										<span class="amount" data-original="<?php echo esc_attr( $symboy.$forginal_price ); ?>" data-price="<?php echo esc_attr( $forginal_price ); ?>" title="Original price:<?php echo esc_attr( $forginal_price ); ?>"><?php echo $symboy.$forginal_price; ?></span>
									</del>
									<ins>
										<span class="amount" data-original="<?php echo esc_attr( $symboy.$fsale_price ); ?>" data-price="<?php echo esc_attr( $fsale_price ); ?>" title="Original price:<?php echo esc_attr( $fsale_price ); ?>"><?php echo esc_attr( $symboy.$fsale_price ); ?></span>
									</ins>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<!-- Slider Countdown -->
			<div class="resp-slider-container">			
				<div class="slider responsive">	
				<?php 
					$count_items = 0;
					$count_items = ( $numberposts >= $list->found_posts ) ? $list->found_posts : $numberposts;
					$i = 0;
					while($list->have_posts()): $list->the_post();					
					global $product, $post, $wpdb, $average;
					$start_time = get_post_meta( $post->ID, '_sale_price_dates_from', true );
					$countdown_time = get_post_meta( $post->ID, '_sale_price_dates_to', true );	
					$orginal_price = get_post_meta( $post->ID, '_regular_price', true );	
					$sale_price = get_post_meta( $post->ID, '_sale_price', true );	
					$symboy = get_woocommerce_currency_symbol( get_woocommerce_currency() );
					if( $i % $item_row == 0 ){
				?>
					<div class="item item-countdown" id="<?php echo 'product_'.$id.$post->ID; ?>">
					<?php } ?>
						<div class="item-wrap">
							<div class="product-countdown"  data-price="<?php echo esc_attr( $symboy.$orginal_price ); ?>" data-starttime="<?php echo esc_attr( $start_time ); ?>" data-cdtime="<?php echo esc_attr( $countdown_time ); ?>" data-id="<?php echo 'product_'.$id.$post->ID; ?>"></div>
							<div class="item-detail">
								<div class="item-image-countdown">								
									<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
									<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>																		
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
										<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*14 ).'px"></span>' : ''; ?></div>
										<div class="item-number-rating">
											<?php //echo $review_count; _e(' Review(s)', 'yatheme');?>
										</div>
									</div>									
									<!-- end rating  -->
									<!-- Price -->
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
					<?php if( ( $i+1 ) % $item_row == 0 || ( $i+1 ) == $count_items ){?> </div><?php } ?>
				<?php $i ++; endwhile; wp_reset_postdata();?>
				</div>
			</div>
		</div>
	</div>
<?php
	} 
?>