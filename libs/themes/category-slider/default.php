<?php 
//$hurama_direction = hurama_options()->getCpanelValue( 'direction' );
if( $category == '' ){
	return ;
}
if( !is_array( $category ) ){
	$category = explode( ',', $category );
}
$widget_id = isset( $widget_id ) ? $widget_id : 'category_slide_'.rand().time();
?>
<div id="<?php echo $widget_id; ?>" class="responsive-slider vel-woo-container-slider loading"  data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
		<div class="block-title">
			<span class="page-title-slider"><?php echo $title1; ?></span>
			<p class="pre-text"><?php echo $description1; ?></p>
		</div>
		<div class="resp-slider-container">
			
		</div>
	</div>		