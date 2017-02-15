<?php get_header(); ?>
	<div id="main-container">
		<div id="content" class="container">
			<div class="row">

				<div id="main" class="col-lg-9 flex-lg-unordered flex-xs-first">
					<div class="inner-content">
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<?php get_template_part('content'); ?>
							
					<?php endwhile; ?>
					
					<?php endif; ?>
					
					</div>
					
				</div>
				<?php get_sidebar(); ?>

<?php get_footer(); ?>