<?php $tag_id = 'recent_post_' .rand().time(); 
	$args = array(
	'post_type' => 'post',
	'posts_per_page' => $limit
	);

	$query = new WP_Query($args);
?>
<?php if($query->have_posts()):?>
<div class="vel-recent-post special">
 <div class="block">
  <div class="block_content">
   <div id="<?php echo $tag_id; ?>" class="owl-carousel">
		<?php while($query->have_posts()):$query->the_post(); ?>
		<!-- Wrapper for slides -->
		<div class="post">			
			<div class="post-content">
				<?php if(isset($title1) && $title1) { ?>
				<div class="title-block recent-post-title">
					<h2><?php echo $title1; ?></h2>
				</div>
				<?php } ?>
				<h3 class="post-title">
					<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
					</a>
				</h3>
				<div class="post-info">
					<?php
						echo __('Posted ', 'sellertemplate');
						echo the_time('j/M').' '.__('By', 'sellertemplate').' ';
						the_author_posts_link();
					?>
				</div>
				<div class="read-more">
					<a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'sellertemplate'); ?></a>
				</div>
			</div>
			<div class="post-img">						
				<?php the_post_thumbnail('blog-thumbnails');?>
			</div>	
		</div>
		<?php endwhile; ?>
   </div>
	<script type="text/javascript">
		jQuery(document).ready(function( $ ) {
			var owl = $('#<?php echo $tag_id; ?>');
			owl.owlCarousel({
				nav:false,
				navContainerClass: 'owl-buttons',
				navText: [ '<i class="icon-arrow-left icons"></i>','<i class="icon-arrow-right icons"></i>' ],
				navClass: [ 'owl-prev carousel-control left', 'owl-next carousel-control right' ],
				dots:false,
				loop:true,
				animateOut: 'fadeOutLeftBig',
                animateIn: 'fadeInRightBig',
				margin:0,
				responsiveClass:true,
				responsive:{
					0:{
						items:<?php echo $columns3; ?>
					},
					480:{
						items:<?php echo $columns2; ?>
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
 </div>
</div>
<?php endif;?>