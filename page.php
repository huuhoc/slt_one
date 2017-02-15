<?php

get_header(); ?>
	
	<div id="main-container">
		
		<div id="content" class="container">
			<div class="row">
				<div id="main" class="<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>col-lg-9 <?php endif; ?>flex-lg-unordered flex-xs-first <?php if(get_theme_mod('sp_sidebar_homepage') == true) : ?>fullwidth<?php endif; ?>">
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<?php get_template_part('content', 'page'); ?>
							
					<?php endwhile; ?>
					
					<?php endif; ?>
					
				</div>

			<?php get_sidebar(); ?>
<?php get_footer(); ?>