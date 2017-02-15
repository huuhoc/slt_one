<?php
 
add_action( 'customize_register', 'slt_customizer' );

function slt_customizer($customize){
		
	$customize->add_section( 'slt_theme_setting', array(
        'priority' => 12,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'SLT Theme Setting', TEXTDOMAIN ),
        'description' => '',
    ) );

    $customize->add_setting( 'slt_options[layout]', array(
        'type'       		=> 'option',
        'capability' 		=> 'manage_options',
        'default' 	 		=> 'default',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $customize->add_control( 'slt_options[layout]', array(
        'label'      		=> __( 'Default Theme', TEXTDOMAIN ),
        'section'    		=> 'slt_theme_setting',
        'type'    			=> 'select',
        'choices'    		=> slt_get_layouts(),
    ) );
	
	$customize->add_setting( 'slt_options[slt-footer]', array(
        'type'       		=> 'option',
        'capability' 		=> 'manage_options',
        'default' 	 		=> 'default',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $customize->add_control( 'slt_options[slt-footer]', array(
        'label'      		=> __( 'SLT Footer', TEXTDOMAIN ),
        'section'    		=> 'slt_theme_setting',
        'type'    			=> 'select',
        'choices'    		=> slt_get_footers(),
    ) );
	
}


?>
