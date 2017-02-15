<?php $tag_id = 'recent_post_' .rand().time(); 
	$args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);

	$query = new WP_Query($args);
?>
<?php if($query->have_posts()):?>
<div class="vel-testimonial">
 <div class="block">
	<div class="title-block testimonial-title">
		<?php
			if (isset($title1) && $title1)
			echo '<h2>'. $title1 .'</h2>';
		?>
	</div>
  <div class="block_content">
   <div id="<?php echo $tag_id; ?>" class="owl-carousel">
		<?php while($query->have_posts()):$query->the_post(); ?>
			<!-- Wrapper for slides -->
			<div class="testimonial-item">
				<div class="testimonial-description">
					<?php the_content() ?>
				</div>
				<div class="carousel-body testimonial-info">
					<!-- <h5 class="testimonial-customer-name text-skin"><?php //the_title(); ?></h5> -->
					<div class="testimonial-customer-position">
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
   </div>
  </div>
 </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		var owl = $('#<?php echo $tag_id; ?>');
		owl.owlCarousel({
			nav:false,
			navContainerClass: 'owl-buttons',
			navText: [ '<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>' ],
			navClass: [ 'owl-prev carousel-control left', 'owl-next carousel-control right' ],
			dots:true,
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
<?php endif;?>