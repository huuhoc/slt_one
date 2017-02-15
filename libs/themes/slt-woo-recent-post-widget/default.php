<?php $tag_id = 'recent_post_' .rand().time(); 
	$args = array(
	'post_type' => 'post',
	'posts_per_page' => $limit
	);

	$query = new WP_Query($args);
?>
<?php if($query->have_posts()):?>
<div class="vel-recent-post">
 <div class="block">
 	<?php if(isset($title1) && $title1) { ?>
	<div class="title-block recent-post-title">
		<h2><?php echo $title1; ?></h2>
	</div>
	<?php } ?>
  <div class="block_content">
   <div id="<?php echo $tag_id; ?>" class="owl-carousel">
		<?php while($query->have_posts()):$query->the_post(); ?>
		<!-- Wrapper for slides -->
		<div class="post">			
			<div class="post-content">
				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
					</a>
				</h2>
				<div class="post-info">
					<?php
						echo __('Posted ', 'sellertemplate');
						echo the_time('j/M').' '.__('by', 'sellertemplate').' ';
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
  </div>
 </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function( $ ) {
		var owl = $('#<?php echo $tag_id; ?>');
		owl.owlCarousel({
			nav:true,
			navContainerClass: 'owl-buttons',
			navText: [ '<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>' ],
			navClass: [ 'owl-prev carousel-control left', 'owl-next carousel-control right' ],
			dots:false,
			loop:false,
			margin:30,
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
<?php endif;?>