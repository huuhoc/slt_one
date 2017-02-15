<?php 
	if ( is_front_page() ) {				
		echo '<h1 class="hidden">Trang chủ - Kho đá Việt Tiến</h1>';
	} else {
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-header">
		<h1><?php the_title(); ?></h1>
	</div>
	<?php 
	}
	?>

	<div class="post-img hidden">
		
		<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('full-thumb'); ?></a>
		
	</div>

	<div class="post-entry">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>
	<?php 
	if ( is_front_page() ) {				
		
	} else {
	?>
	</article>
	<?php 
	}
?>