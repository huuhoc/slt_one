<?php get_header(); ?>
	
	<div id="main-container">
		
		<div id="content" class="container">
			<div class="row">
		
			<div id="main" class="<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>col-lg-9 <?php endif; ?>flex-lg-unordered flex-xs-first">
				<div class="inner-content">
					<div class="archive-box">
						<h1><?php printf( __( '%s', 'solopine' ), single_cat_title( '', false ) ); ?></h1>
					</div>
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
							<?php get_template_part('content', 'grid'); ?>
							
					<?php endwhile; ?>
					
						<?php slt_pagination(); ?>
					
					<?php else : ?>
						
						<?php get_template_part('content', 'none'); ?>
						
					<?php endif; ?>
					</div>
				
			</div>


			<?php get_sidebar(); ?>
<?php get_footer(); ?>