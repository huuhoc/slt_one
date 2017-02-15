<?php

//////////////////////////////////////////////////////////////////
// Customizer - Add Custom Styling
//////////////////////////////////////////////////////////////////
function slt_customizer_style()
{
	wp_enqueue_style('customizer-css', get_stylesheet_directory_uri() . '/functions/customizer/css/customizer.css');
}
add_action('customize_controls_print_styles', 'slt_customizer_style');

//////////////////////////////////////////////////////////////////
// Customizer - Add Settings
//////////////////////////////////////////////////////////////////
function slt_register_theme_customizer( $wp_customize ) {
 	
	// Add Sections
	
	$wp_customize->add_section( 'slt_new_section_custom_css' , array(
   		'title'      => 'Custom CSS',
   		'description'=> 'Add your custom CSS which will overwrite the theme CSS',
   		'priority'   => 106,
	) );
	
	$wp_customize->add_section( 'slt_new_section_footer' , array(
   		'title'      => 'Footer Settings',
   		'description'=> '',
   		'priority'   => 99,
	) );
	
	$wp_customize->add_section( 'slt_new_section_social' , array(
   		'title'      => 'Social Media Settings',
   		'description'=> 'Enter your social media usernames. Icons will not show if left blank.',
   		'priority'   => 98,
	) );
	
	$wp_customize->add_section( 'slt_new_section_page' , array(
   		'title'      => 'Page Settings',
   		'description'=> '',
   		'priority'   => 97,
	) );
	
	$wp_customize->add_section( 'slt_new_section_post' , array(
   		'title'      => 'Post Settings',
   		'description'=> '',
   		'priority'   => 96,
	) );
	
	$wp_customize->add_section( 'slt_new_section_topbar' , array(
		'title'      => 'Top Bar Settings',
		'description'=> '',
		'priority'   => 92,
	) );
	
	$wp_customize->add_section( 'slt_new_section_logo_header' , array(
   		'title'      => 'Logo and Header Settings',
   		'description'=> '',
   		'priority'   => 91,
	) );
	
	$wp_customize->add_section( 'slt_new_section_general' , array(
   		'title'      => 'General Settings',
   		'description'=> '',
   		'priority'   => 90,
	) );
	
	// Add Setting

		// General
		$wp_customize->add_setting(
			'slt_favicon'
		);
		
		$wp_customize->add_setting(
			'slt_responsive'
		);
		
		$wp_customize->add_setting(
	        'slt_home_layout',
	        array(
	            'default'     => 'full'
	        )
	    );
		
		$wp_customize->add_setting(
	        'slt_archive_layout',
	        array(
	            'default'     => 'full'
	        )
	    );
		
		$wp_customize->add_setting(
	        'slt_sidebar_homepage',
	        array(
	            'default'     => false
	        )
	    );
		
		$wp_customize->add_setting(
	        'slt_sidebar_post',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_sidebar_archive',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_summary',
	        array(
	            'default'     => 'full'
	        )
	    );
		
		// Header & Logo
		$wp_customize->add_setting(
	        'slt_logo'
	    );

		
		// Top Bar

		
		// Post Settings
		$wp_customize->add_setting(
	        'slt_post_tags',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_author',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_related',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_share',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_share_author',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_comment_link',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_thumb',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_date',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_cat',
	        array(
	            'default'     => false
	        )
	    );
		$wp_customize->add_setting(
	        'slt_post_pagination',
	        array(
	            'default'     => false
	        )
	    );
		
		// Page
		$wp_customize->add_setting(
	        'slt_page_share',
	        array(
	            'default'     => false
	        )
	    );
		
		// Social Media
		
		$wp_customize->add_setting(
	        'slt_facebook',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_twitter',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_instagram',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_pinterest',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_tumblr',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_bloglovin',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_tumblr',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_google',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_youtube',
	        array(
	            'default'     => ''
	        )
	    );
	  $wp_customize->add_setting(
	        'slt_dribbble',
	        array(
	            'default'     => ''
	        )
	    );
	  $wp_customize->add_setting(
	        'slt_soundcloud',
	        array(
	            'default'     => ''
	        )
	    );
	  $wp_customize->add_setting(
	        'slt_vimeo',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_linkedin',
	        array(
	            'default'     => ''
	        )
	    );
		$wp_customize->add_setting(
	        'slt_rss',
	        array(
	            'default'     => ''
	        )
	    );
		
		// Footer
		$wp_customize->add_setting(
	        'slt_footer_copyright',
	        array(
	            'default'     => '&copy; 2016 - Solo Pine. All Rights Reserved. Designed & Developed by Seller Template.</a>'
	        )
	    );
		$wp_customize->add_setting(
	        'slt_footer_share',
	        array(
	            'default'     => false
	        )
	    );
		
	// Add Control
	
		// General
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_favicon',
				array(
					'label'      => 'Upload Favicon',
					'section'    => 'slt_new_section_general',
					'settings'   => 'slt_favicon',
					'priority'	 => 1
				)
			)
		);
	
		// Header and Logo
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'upload_logo',
				array(
					'label'      => 'Upload Logo',
					'section'    => 'slt_new_section_logo_header',
					'settings'   => 'slt_logo',
					'priority'	 => 20
				)
			)
		);
		
		
		// Post Settings
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_thumb',
				array(
					'label'      => 'Hide Featured Image from top of Post',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_thumb',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_cat',
				array(
					'label'      => 'Hide Category',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_cat',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_date',
				array(
					'label'      => 'Hide Date',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_date',
					'type'		 => 'checkbox',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_tags',
				array(
					'label'      => 'Hide Tags',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_tags',
					'type'		 => 'checkbox',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_share',
				array(
					'label'      => 'Hide Share Buttons',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_share',
					'type'		 => 'checkbox',
					'priority'	 => 5
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_share_author',
				array(
					'label'      => 'Hide Author Name',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_share_author',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_comment_link',
				array(
					'label'      => 'Hide Comment Link',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_comment_link',
					'type'		 => 'checkbox',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_author',
				array(
					'label'      => 'Hide Author Box',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_author',
					'type'		 => 'checkbox',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_related',
				array(
					'label'      => 'Hide Related Posts Box',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_related',
					'type'		 => 'checkbox',
					'priority'	 => 9
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_pagination',
				array(
					'label'      => 'Display Post Pagination',
					'section'    => 'slt_new_section_post',
					'settings'   => 'slt_post_pagination',
					'type'		 => 'checkbox',
					'priority'	 => 10
				)
			)
		);
		
		// Page
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'page_share',
				array(
					'label'      => 'Hide Share Buttons',
					'section'    => 'slt_new_section_page',
					'settings'   => 'slt_page_share',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		
		// Social Media
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'facebook',
				array(
					'label'      => 'Facebook',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_facebook',
					'type'		 => 'text',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'twitter',
				array(
					'label'      => 'Twitter',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_twitter',
					'type'		 => 'text',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'instagram',
				array(
					'label'      => 'Instagram',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_instagram',
					'type'		 => 'text',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pinterest',
				array(
					'label'      => 'Pinterest',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_pinterest',
					'type'		 => 'text',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bloglovin',
				array(
					'label'      => 'Bloglovin',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_bloglovin',
					'type'		 => 'text',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'google',
				array(
					'label'      => 'Google Plus',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_google',
					'type'		 => 'text',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'tumblr',
				array(
					'label'      => 'Tumblr',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_tumblr',
					'type'		 => 'text',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'youtube',
				array(
					'label'      => 'Youtube',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_youtube',
					'type'		 => 'text',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'dribbble',
				array(
					'label'      => 'Dribbble',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_dribbble',
					'type'		 => 'text',
					'priority'	 => 9
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'soundcloud',
				array(
					'label'      => 'Soundcloud',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_soundcloud',
					'type'		 => 'text',
					'priority'	 => 10
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'vimeo',
				array(
					'label'      => 'Vimeo',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_vimeo',
					'type'		 => 'text',
					'priority'	 => 11
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'linkedin',
				array(
					'label'      => 'Linkedin (Use full URL to your Linkedin profile)',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_linkedin',
					'type'		 => 'text',
					'priority'	 => 12
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'rss',
				array(
					'label'      => 'RSS Link',
					'section'    => 'slt_new_section_social',
					'settings'   => 'slt_rss',
					'type'		 => 'text',
					'priority'	 => 13
				)
			)
		);
		
		// Footer
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_copyright',
				array(
					'label'      => 'Footer Copyright Text',
					'section'    => 'slt_new_section_footer',
					'settings'   => 'slt_footer_copyright',
					'type'		 => 'text',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'footer_share',
				array(
					'label'      => 'Hide Footer Share Links',
					'section'    => 'slt_new_section_footer',
					'settings'   => 'slt_footer_share',
					'type'		 => 'checkbox',
					'priority'	 => 2
				)
			)
		);

	// Remove Sections
	$wp_customize->remove_section( 'title_tagline');
	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_section( 'background_image');
	
 
}
add_action( 'customize_register', 'slt_register_theme_customizer' );
?>