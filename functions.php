<?php
// Theme set up
//////////////////////////////////////////////////////////////////
add_action( 'after_setup_theme', 'slt_template_setup' );

if ( !function_exists('slt_template_setup') ) {

	function slt_template_setup() {
	
		// Register navigation menu
		register_nav_menus(
			array(
				'main-menu' => 'Primary Menu',
			)
		);
		
		// Localization support
		load_theme_textdomain('slt', get_template_directory() . '/lang');
		
		// Post formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );
		
		// Featured image
		add_theme_support( 'post-thumbnails' );
		
		// Feed Links
		add_theme_support( 'automatic-feed-links' );
	
	}

}



//////////////////////////////////////////////////////////////////
// Include files
//////////////////////////////////////////////////////////////////

// Theme Options
include('functions/customizer/slt_custom_controller.php');
include('functions/customizer/slt_customizer_settings.php');

// Widgets
include("inc/widgets/about_widget.php");
include("inc/widgets/social_widget.php");
include("inc/widgets/post_widget.php");
include("inc/widgets/facebook_widget.php");


//////////////////////////////////////////////////////////////////
// Register widgets
//////////////////////////////////////////////////////////////////
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Main Content',
		'id' => 'main-content',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Instagram Footer',
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="instagram-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="instagram-title">',
		'after_title' => '</h4>',
		'description' => 'Use the "Instagram" widget here. IMPORTANT: For best result set number of photos to 8.',
	));
}


//////////////////////////////////////////////////////////////////
// COMMENTS LAYOUT
//////////////////////////////////////////////////////////////////

	function slt_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			
			<div class="thecomment">
						
				<div class="author-img">
					<?php echo get_avatar($comment,$args['avatar_size']); ?>
				</div>
				
				<div class="comment-text">
					<span class="reply">
						<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'slt'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
						<?php edit_comment_link(__('Edit', 'slt')); ?>
					</span>
					<h6 class="author"><?php echo get_comment_author_link(); ?></h6>
					<span class="date"><?php printf(__('%1$s at %2$s', 'slt'), get_comment_date(),  get_comment_time()) ?></span>
					<?php if ($comment->comment_approved == '0') : ?>
						<em><i class="icon-info-sign"></i> <?php _e('Comment awaiting approval', 'slt'); ?></em>
						<br />
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>
						
			</div>
			
			
		</li>

		<?php 
	}
	
//////////////////////////////////////////////////////////////////
// PAGINATION
//////////////////////////////////////////////////////////////////
function slt_pagination() {
	
	?>
	
	<div class="pagination">

		<div class="older"><?php next_posts_link(__( 'Older Posts <i class="fa fa-angle-double-right"></i>', 'slt')); ?></div>
		<div class="newer"><?php previous_posts_link(__( '<i class="fa fa-angle-double-left"></i> Newer Posts', 'slt')); ?></div>
		
	</div>
					
	<?php
	
}

//////////////////////////////////////////////////////////////////
// PREVENT SCROLL ON READ MORE LINK
//////////////////////////////////////////////////////////////////
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


//////////////////////////////////////////////////////////////////
// AUTHOR SOCIAL LINKS
//////////////////////////////////////////////////////////////////
function slt_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = 'Twitter Username';
	$contactmethods['facebook']  = 'Facebook Username';
	$contactmethods['google']    = 'Google Plus Username';
	$contactmethods['tumblr']    = 'Tumblr Username';
	$contactmethods['instagram'] = 'Instagram Username';
	$contactmethods['pinterest'] = 'Pinterest Username';

	return $contactmethods;
}
add_filter('user_contactmethods','slt_contactmethods',10,1);


//////////////////////////////////////////////////////////////////
// TITLE TAG
//////////////////////////////////////////////////////////////////
function slt_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'slt' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'slt_wp_title', 10, 2 );

//////////////////////////////////////////////////////////////////
// TWITTER AMPERSAND ENTITY DECODE
//////////////////////////////////////////////////////////////////
function slt_social_title( $title ) {
    $title = html_entity_decode( $title );
    $title = urlencode( $title );
    return $title;
}

//////////////////////////////////////////////////////////////////
// THE EXCERPT
//////////////////////////////////////////////////////////////////
function custom_excerpt_length( $length ) {
	return 200;
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function slt_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	
	if(count($words) > $word_limit) {
		array_pop($words);
	}
	
	return implode(' ', $words);
}

define( 'SLT_THEME_URI', get_template_directory_uri());
define( 'SLT_THEME_DIR', get_template_directory() );
define( 'SLT_THEME_CSS_DIR', SLT_THEME_DIR.'/css/' );
define( 'SLT_THEME_CSS_LIB', SLT_THEME_DIR.'/libs/' );
define( 'SLT_WOO_THEMES', SLT_THEME_DIR.'/libs/themes/');
define( 'TEXTDOMAIN', 'SLT_THEME_NAME');
define( 'SLT_WOOCOMMERCE_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
define( 'SLT_VISUAL_COMPOSER_ACTIVED', in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

require_once( SLT_THEME_CSS_LIB . 'function.php' );
require_once( SLT_THEME_CSS_LIB . 'customizer.php' );
require_once( SLT_THEME_CSS_LIB . 'post_type.php');
require_once( SLT_THEME_CSS_LIB . 'slt-widgets.php' );
require_once( SLT_THEME_CSS_LIB . 'testimonials.php');
require_once( SLT_THEME_CSS_LIB . 'brands.php');
require_once( SLT_THEME_CSS_LIB . 'loader.php' );

