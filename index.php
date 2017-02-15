<?php get_header(); ?>
	
	<div id="main-container">
		
		<div id="content" class="container">
			<div class="row">
				<div id="main" class="<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>col-lg-9 <?php endif; ?>flex-lg-unordered flex-xs-first">

					<?php echo do_shortcode('[rev_slider slider_home]'); ?>
					
					<?php if(get_theme_mod('sp_home_layout') == 'grid' || get_theme_mod('sp_home_layout') == 'full_grid') : ?><ul class="sp-grid"><?php endif; ?>
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php get_template_part('content'); ?>
					<?php endwhile; ?>
					
					<?php endif; ?>
				</div>

				<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
					<aside id="sidebar" class="col-lg-3 flex-lg-first flex-xs-unordered">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</aside><!-- .sidebar .widget-area -->
				<?php endif; ?>
			
			</div>

<?php get_footer(); ?>