<div class="featured-area <?php if(!get_theme_mod('sp_promo')) : ?>nopromo<?php endif; ?>">
			
	<div class="sideslides">
	
		<div class="bxslider">
		
			<?php
				
				$featured_cat = get_theme_mod( 'sp_featured_cat' );
				$get_featured_posts = get_theme_mod('sp_featured_id');
				$number = get_theme_mod( 'sp_featured_slider_slides' );
				
				if($get_featured_posts) {
					$featured_posts = explode(',', $get_featured_posts);
					$args = array( 'showposts' => $number, 'post_type' => array('post', 'page'), 'post__in' => $featured_posts, 'orderby' => 'post__in' );
				} else {
					$args = array( 'cat' => $featured_cat, 'showposts' => $number );
				}
				
			?>
			
			<?php $feat_query = new WP_Query( $args ); ?>
		
			<?php if ($feat_query->have_posts()) : while ($feat_query->have_posts()) : $feat_query->the_post(); ?>
			
			<?php 
				
				// Get slider image
				if(get_post_meta( get_the_ID(), 'meta-image', true )) :
				
					$feat_image = get_post_meta( get_the_ID(), 'meta-image', true );
					
				else :
				
					if(has_post_thumbnail()) {
						$get_feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
						$feat_image = $get_feat_image[0];
					} else {
						$feat_image = get_template_directory_uri() . '/img/slider-default.png';
					}
				
				endif;
			
			?>
			
			<div class="feat-item" style="background-image:url(<?php echo $feat_image; ?>)">
				
				<div class="feat-overlay">
					<div class="feat-inner">
						<?php if(!get_theme_mod('sp_featured_hide_cat')) : ?>
						<span class="cat"><?php the_category(' '); ?></span>
						<?php endif; ?>
						<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
						<span class="feat-title-divider"></span>
						<a href="<?php echo get_permalink(); ?>" class="feat-more"><?php _e( 'Read More', 'solopine' ); ?></a>
					</div>
				</div>
				
			</div>
			
			<?php endwhile; endif; ?>
			
		</div>
	
	</div>
	
</div>