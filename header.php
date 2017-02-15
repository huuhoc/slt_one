<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title( '-', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<?php if(get_theme_mod('slt_favicon')) : ?>
	<link rel="shortcut icon" href="<?php echo get_theme_mod('slt_favicon'); ?>" />
	<?php endif; ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<header id="header">
		<div class="container">
			<div class="inner-header">
				<div class="row flex-items-xs-middle header-top">
					<div id="logo" class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
						
						<?php if(!get_theme_mod('slt_logo')) : ?>
							
							<?php if(is_front_page()) : ?>
								<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></h1>
							<?php else : ?>
								<h2><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></h2>
							<?php endif; ?>
							
						<?php else : ?>
							
							<?php if(is_front_page()) : ?>
								<h1><a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url(get_theme_mod('slt_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h1>
							<?php else : ?>
								<h2><a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url(get_theme_mod('slt_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h2>
							<?php endif; ?>
							
						<?php endif; ?>

					</div>
					<div id="header-center" class="col-lg-7 col-md-6 col-sm-9 col-xs-12">
					</div>
					<div id="header-right" class="col-lg-3 col-md-3 col-sm-9 col-xs-12">
							<div id="top-search">
								<div class="show-search">
									<?php get_search_form(); ?>
								</div>
								<div class="infomation">
									<span><i class="fa fa-mobile"></i> 0123.456.789</span>
									<span><i class="fa fa-envelope-o"></i> <a href="mailto:noithatanthinh@gmail.com" target="_top">noithatanthinh@gmail.com</a></span>
								</div>
							</div>
					</div>
				</div>

				<div class="row flex-items-xs-middle menu-wapper">
					
					<div id="nav-wrapper" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<button type="button" class="btn btn-navbar menu-together">
		          <span class="fa fa-bars"></span>
		        </button>
						<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'main-menu', 'menu_class' => 'menu clearfix' ) ); ?>
					</div>

				</div>
			</div>
		</div>
		
	</header>