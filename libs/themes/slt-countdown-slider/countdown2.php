<?php 
/**
	* Layout Countdown 2
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
$id = 'sw_countdown_'.rand().time();
$list = new WP_Query( $default );
if ( $list -> have_posts() ){ ?>
	<div id="<?php echo $category.'_'.$id; ?>" class="responsive-slider countdown-slider countdown-slide-style2" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $hurama_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-fade="true" data-circle="false">       
		<div class="box-slider-title <?php echo esc_html($header_style);?>" >
			<?php echo '<h2><span>'. esc_html( $title1 ) .'</span></h2>'; ?>
			<?php echo ( $description != '' ) ? '<p>'. $description .'</p>' : ''; ?>
		</div>
		<div class="resp-slider-container">
			<div class="slider responsive">	
			<?php 
				$count_items = 0;
				$count_items = ( $numberposts >= $list->found_posts ) ? $list->found_posts : $numberposts;
				$i = 0;
				while($list->have_posts()): $list->the_post();					
				global $product, $post;
				$id 			= get_the_ID();
				$gallery 		= get_post_meta($id, '_product_image_gallery', true);
				$start_time 	= get_post_meta( $post->ID, '_sale_price_dates_from', true );
				$countdown_time = get_post_meta( $post->ID, '_sale_price_dates_to', true );	
				$orginal_price 	= get_post_meta( $post->ID, '_regular_price', true );	
				$sale_price 	= get_post_meta( $post->ID, '_sale_price', true );	
				$symboy 		= get_woocommerce_currency_symbol( get_woocommerce_currency() );
				if(!empty($gallery)) {
					$gallery = explode(',', $gallery);
				}
			?>
				<div class="item item-countdown" id="<?php echo 'product_'.$id.$post->ID; ?>">
					<div class="item-wrapper">
						<div class="item-left">
							<div class="product-countdown"  data-price="<?php echo esc_attr( $symboy.$orginal_price ); ?>" data-starttime="<?php echo esc_attr( $start_time ); ?>" data-cdtime="<?php echo esc_attr( $countdown_time ); ?>" data-id="<?php echo 'product_'.$id.$post->ID; ?>"></div>									
						</div>
						<div class="item-right">							
							<div class="item-content">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<!-- Rating -->
								<?php 
									$rating_count = $product->get_rating_count();
									$review_count = $product->get_review_count();
									$average      = $product->get_average_rating();
								?>
								<div class="reviews-content">
									<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*11 ).'px"></span>' : ''; ?></div>
								</div>
								<!-- Images -->
								<?php if( has_post_thumbnail() ){ ?>
								<div class="item-img">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'shop_catalog' ) ?></a>
								</div>
								<?php } ?>
								<!-- Short Description -->
								<?php if ( $post->post_excerpt != '' ) {?>
								<div class="item-description"><?php echo wp_trim_words( $post->post_excerpt, 20 ); ?></div>
								<?php } ?>
								<!-- Price -->
								<?php if ( $price_html = $product->get_price_html() ){?>								
								<div class="item-price">
									<span>
										<?php echo $price_html; ?>
									</span>
								</div>
								<?php } ?>
							</div>
							<!-- img left and right -->
							<?php if( count($gallery) >=2 ){ ?>
							<div class="img-left">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_get_attachment_image( $gallery[0] , 'full', false, array('class' => 'hover-image back') ); ?></a>
							</div>
							<div class="img-right">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo wp_get_attachment_image( $gallery[1] , 'full', false, array('class' => 'hover-image back') ); ?></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php $i ++; endwhile; wp_reset_postdata();?>
			</div>
		</div>		         
	</div>
<?php
	} 
?>