<?php 
$hurama_direction = hurama_options()->getCpanelValue( 'direction' );
if( $category == '' ){
	return ;
}
if( !is_array( $category ) ){
	$category = explode( ',', $category );
}
$widget_id = isset( $widget_id ) ? $widget_id : 'category_slide_'.rand().time();
?>
<div id="<?php echo $widget_id; ?>" class="category-ajax-slider">
	<div class="block-title">
		<span class="page-title-slider"><?php echo $title1; ?></span>
		<p class="pre-text"><?php echo $description1; ?></p>
	</div>
	<ul class="nav nav-tabs">
	<?php
		foreach( $category as $key => $cat ){
			$term = get_term_by('slug', $cat, 'product_cat');							
			$thumbnail_id 	= absint( get_metadata( 'woocommerce_term', $term->term_id, 'thumbnail_id', true ));
			$thumb = wp_get_attachment_image( $thumbnail_id, array(350, 230) );
	?>
		<li class="<?php echo ( $key == 0 ) ? 'active' : '' ?>">
			<a href="#<?php echo 'category_ajax_'. esc_attr( $term->term_id ); ?>" data-toggle="tab" data-catid="<?php echo esc_attr( $term->term_id ); ?>" data-catload="ajax" data-number="<?php echo esc_attr( $numberposts ); ?>" data-orderby="<?php echo esc_attr( $orderby ); ?>" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-rtl="<?php echo ( is_rtl() || $hurama_direction == 'rtl' )? 'true' : 'false';?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
				<div class="item-image">
					<?php echo $thumb; ?>
					<h3><?php echo esc_html( $term->name ); ?></h3>						
				</div>
			</a>
		</li>
		<?php } ?>
	</ul>
	<div class="tab-content">
	<?php
	foreach( $category as $key => $cat ){
		$term = get_term_by('slug', $cat, 'product_cat');	
	?>
		<div id="<?php echo 'category_ajax_'. esc_attr( $term->term_id ); ?>" class="tab-pane fade in <?php echo ( $key == 0 ) ? 'active' : '' ?>"></div>
	<?php } ?>
	</div>
</div>	