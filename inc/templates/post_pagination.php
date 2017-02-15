<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
?>
<?php if (!empty( $prev_post ) || !empty( $next_post )) : ?>
<div class="post-pagination">
	
	<?php if (!empty( $prev_post )) : ?>
	<a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="prev"><i class="fa fa-angle-left"></i> <?php _e( 'Previous Post', 'solopine' ); ?></a>
	<?php endif; ?>
	
	<?php if (!empty( $next_post )) : ?>
	<a href="<?php echo get_permalink( $next_post->ID ); ?>" class="next"><?php _e( 'Next Post', 'solopine' ); ?> <i class="fa fa-angle-right"></i></a>
	<?php endif; ?>
	
</div>
<?php endif ?>