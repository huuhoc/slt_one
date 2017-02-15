<?php
	function slt_get_options($option, $default = false) {
		$options = ( get_option( 'slt_options' ) ) ? get_option( 'slt_options' ) : null;
		if ( isset( $options[$option] ) ) {
			return apply_filters( 'slt_options_$option', $options[ $option ]);
		}
		if( get_option( $option ) ){
			return get_option( $option );
		}
		return apply_filters( 'slt_options_$option', $default );
	}
	
	function slt_get_layouts(){
		$path = SLT_THEME_DIR.'/css/layouts/*';
		$files = glob($path , GLOB_ONLYDIR );
		$layouts = array('default' => 'default');
		if(count($files)>0){
			foreach ($files as $key => $file) {
				$layout = str_replace( '.css', '', basename($file) );
				$layouts[$layout]=$layout;
			}
		}
		return $layouts;
	}
	
	function slt_get_footers() {
		$footers = get_posts( array('posts_per_page'=>-1,'post_type'=>'slt_footer') );
		$footer = array('default'=>'Default');
		foreach ($footers as  $value) {
			$footer[$value->ID] = $value->post_title;
		}
		return $footer;
	}

	function slt_custom_login_form( $links ) {
		$links = '<div class="links-more">';
		if ( get_option( 'users_can_register' ) ) {
			$links .= '<p><a href="' . esc_url( wp_registration_url() ) . '">' . __( 'New customer?', TEXTDOMAIN ) . '</a></p>';
		}
		$links .= '<p><a href="'. esc_url( wp_lostpassword_url() ) . '">' . __( 'Forget password?', TEXTDOMAIN ) . '</a></p>';
		$links .= '</div>';
		return $links;
	}
	add_filter( 'login_form_middle', 'slt_custom_login_form' );

	add_action( 'login_enqueue_scripts', 'sourcexpress_login_enqueue_scripts', 10 );
	function sourcexpress_login_enqueue_scripts() {
		$script = "<script type='text/javascript'>jQuery(document).ready(function(){
		    jQuery('#user_login').attr('placeholder', '".__( 'Username', TEXTDOMAIN )."');
		    jQuery('#user_pass').attr('placeholder', '".__( 'Password', TEXTDOMAIN )."');
		});</script>";
		echo $script;
	}

	// Remove each style one by one
	add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
	function jk_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
		unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
		unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
		return $enqueue_styles;
	}

	// Or just remove them all in one line
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	//Get col bootstrap for layout
	function slt_translateColumnWidthToSpan( $width, $front = true ) {
		if ( preg_match( '/^(\d{1,2})\/12$/', $width, $match ) ) {
			$w = 'col-lg-' . $match[1];
		} else {
			$w = 'col-lg-';
			$md = 'col-md-';
			switch ( $width ) {
				case "1/6" :
					$w .= '2';
					$md .= '2';
					break;
				case "1/4" :
					$w .= '3';
					$md .= '3';
					break;
				case "1/3" :
					$w .= '4';
					$md .= '4';
					break;
				case "1/2" :
					$w .= '6';
					$md .= '6';
					break;
				case "2/3" :
					$w .= '8';
					$md .= '8';
					break;
				case "3/4" :
					$w .= '9';
					$md .= '9';
					break;
				case "5/6" :
					$w .= '10';
					$md .= '10';
					break;
				case "1/1" :
					$w .= '12';
					$md .= '12';
					break;
				default :
					$w = $width;
			}
		}
		$col_class = $w.' '.$md;
		$custom = $front ? get_custom_column_class( $col_class ) : false;

		return $custom ? $custom : $col_class;
	}

	function slt_calculator_col( $width, $front = true ) {
			$w = 'col-lg-';
			$md = 'col-md-';
			switch ( $width ) {
				case "1" :
					$w .= '12';
					$md .= '12';
					break;
				case "2" :
					$w .= '6';
					$md .= '6';
					break;
				case "3" :
					$w .= '4';
					$md .= '4';
					break;
				case "4" :
					$w .= '3';
					$md .= '3';
					break;
				case "5" :
					$w .= '2-4';
					$md .= '2-4';
					break;
				case "6" :
					$w .= '2';
					$md .= '2';
					break;
				default :
					$w = $width;
			}
			$col_class = $w.' '.$md;
			return $col_class;
	}

	function create_buttun_cart($product) {
			$bt_cart = apply_filters( 'woocommerce_loop_add_to_cart_link',
				sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="1" class="button ajax_add_to_cart %s product_type_%s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( $product->id ),
					esc_attr( $product->get_sku() ),
					$product->is_purchasable() && $product->is_in_stock() ? ' add_to_cart_button' : '',
					esc_attr( $product->product_type ),
					esc_html( $product->add_to_cart_text() )
				),$product );
			return $bt_cart;
	}
	
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
	    global $woocommerce;
	    ob_start(); 
	    get_template_part( 'woocommerce/minicart-ajax' );
	    $fragments['.mini-cart'] = ob_get_clean();
	    return $fragments;
	}

	function display_view() {
		?>
			<ul class="display pull-left">
        <li>
          	<a class="grid active" class="" href="#"></a>
      	</li>
        <li>
        	<a class="list" href="#"></a>
        </li>
      </ul>
		<?php
	}

	add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
  function wcs_woo_remove_reviews_tab($tabs) {
	  unset($tabs['reviews']);
	  return $tabs;
	}
?>