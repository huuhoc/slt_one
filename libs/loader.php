<?php
		//////////////////////////////////////////////////////////////////
		// Register & enqueue styles/scripts
		//////////////////////////////////////////////////////////////////
		add_action( 'wp_enqueue_scripts', 'slt_add_style' );
		function slt_add_style() {
			// Register CSS
			wp_register_style('bootstrap-1', SLT_THEME_URI . '/css/bootstrap4/bootstrap-reboot.min.css');
			wp_register_style('bootstrap-2', SLT_THEME_URI . '/css/bootstrap4/bootstrap-grid.min.css');
			wp_register_style('bootstrap-3', SLT_THEME_URI . '/css/bootstrap4/bootstrap-flex.min.css');
			wp_register_style('bootstrap-4', SLT_THEME_URI . '/css/bootstrap4/bootstrap.min.css');
			wp_register_style('font-awesome', SLT_THEME_URI . '/css/font-awesome.min.css');
			wp_register_style('slt_style', SLT_THEME_URI . '/style.css');
			wp_register_style('owl', SLT_THEME_URI . '/css/owl/owl.carousel.min.css');
			wp_register_style('owl-theme', SLT_THEME_URI . '/css/owl/owl.theme.default.min.css');
			wp_register_style('template-css', SLT_THEME_URI . '/css/template.css');
			wp_register_style('responsive', SLT_THEME_URI . '/css/responsive.css');

			// Enqueue CSS
			wp_enqueue_style('bootstrap-1');
			wp_enqueue_style('bootstrap-2');
			wp_enqueue_style('bootstrap-3');
			wp_enqueue_style('bootstrap-4');
			wp_enqueue_style('font-awesome');
			wp_enqueue_style('slt_style');
			wp_enqueue_style('owl');
			wp_enqueue_style('owl-theme');
			wp_enqueue_style('template-css');
			wp_enqueue_style('responsive');

		}


		add_action( 'wp_enqueue_scripts', 'slt_add_scripts' );
		function slt_add_scripts() {
			//Register JS
			wp_register_script('slicknav', SLT_THEME_URI . '/js/slick.min.js', 'jquery', '', true);
			wp_register_script('owl_js', SLT_THEME_URI . '/js/owl.carousel.min.js', 'jquery', '', true);
			//wp_register_script('template_scripts', SLT_THEME_URI . '/js/template.js', 'jquery', '', true);
			wp_register_script('base_gmap_api_js','http://maps.google.com/maps/api/js?sensor=true', true);
			//wp_register_script('base_twitter_js', SLT_THEME_URI . '/js/instafeed.min.js', 'jquery', '', true);

			// Enqueue JS
			wp_enqueue_script('jquery');
			wp_enqueue_script('base_twitter_js');
			wp_enqueue_script('slicknav');
			wp_enqueue_script('template_scripts');
			wp_enqueue_script('owl_js');
			
			if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');

		}
?>


