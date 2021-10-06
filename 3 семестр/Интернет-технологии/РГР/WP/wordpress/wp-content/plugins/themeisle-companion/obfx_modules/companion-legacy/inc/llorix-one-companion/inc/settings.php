<?php

function llorix_one_companion_customize_register( $wp_customize ) {
	
	if( class_exists('Llorix_One_Lite_General_Repeater') ) {
		
		/********************************************************/
		/****************** SERVICES OPTIONS  *******************/
		/********************************************************/
		
		/* SERVICES SECTION */
		$wp_customize->add_section( 'llorix_one_lite_services_section' , array(
			'title'       => esc_html__( 'Services section', 'themeisle-companion' ),
			'priority'    => 40,
			'panel'       => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		));
		
		/* Services show/hide */
		$wp_customize->add_setting( 'llorix_one_lite_our_services_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		
		$wp_customize->add_control( 'llorix_one_lite_our_services_show', array(
			'type' => 'checkbox',
			'label' => __('Disable the Services section?','themeisle-companion'),
			'section' => 'llorix_one_lite_services_section',
			'priority'    => 1,
		));
		
		/* Services title */
		$wp_customize->add_setting( 'llorix_one_lite_our_services_title', array(
			'default' => esc_html__('Our Services','themeisle-companion'),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		$wp_customize->add_control( 'llorix_one_lite_our_services_title', array(
			'label'    => esc_html__( 'Main title', 'themeisle-companion' ),
			'section'  => 'llorix_one_lite_services_section',
			'priority'    => 10
		));
		
		/* Services subtitle */
		$wp_customize->add_setting( 'llorix_one_lite_our_services_subtitle', array(
			'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','themeisle-companion'),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		$wp_customize->add_control( 'llorix_one_lite_our_services_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'themeisle-companion' ),
			'section'  => 'llorix_one_lite_services_section',
			'priority'    => 20
		));
		
		
		/* Services content */
		$default = llorix_one_companion_sevices_get_default_content();
		$wp_customize->add_setting( 'llorix_one_lite_services_content', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
			'default' => $default,
		));
		$wp_customize->add_control( new Llorix_One_Lite_General_Repeater( $wp_customize, 'llorix_one_lite_services_content', array(
			'label'   => esc_html__('Add new service box','themeisle-companion'),
			'section' => 'llorix_one_lite_services_section',
			'priority' => 30,
			'llorix_one_lite_image_control' => true,
			'llorix_one_lite_icon_control' => true,
			'llorix_one_lite_title_control' => true,
			'llorix_one_lite_text_control' => true,
			'llorix_one_lite_link_control' => true
		) ) );
		
		/********************************************************/
		/*******************  TEAM OPTIONS  *********************/
		/********************************************************/

		$wp_customize->add_section( 'llorix_one_lite_team_section' , array(
			'title'       => esc_html__( 'Team section', 'themeisle-companion' ),
			'priority'    => 60,
			'panel'       => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		));
		
		/* Team show/hide */
		$wp_customize->add_setting( 'llorix_one_lite_our_team_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		
		$wp_customize->add_control( 'llorix_one_lite_our_team_show', array(
			'type' => 'checkbox',
			'label' => __('Disable the Team section?','themeisle-companion'),
			'section' => 'llorix_one_lite_team_section',
			'priority'    => 1,
		));
		
		/* Team title */
		$wp_customize->add_setting( 'llorix_one_lite_our_team_title', array(
			'default' => esc_html__('Our Team','themeisle-companion'),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		$wp_customize->add_control( 'llorix_one_lite_our_team_title', array(
			'label'    => esc_html__( 'Main title', 'themeisle-companion' ),
			'section'  => 'llorix_one_lite_team_section',
			'priority'    => 10,
		));
		
		/* Team subtitle */
		$wp_customize->add_setting( 'llorix_one_lite_our_team_subtitle', array(
			'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.','themeisle-companion'),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		$wp_customize->add_control( 'llorix_one_lite_our_team_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'themeisle-companion' ),
			'section'  => 'llorix_one_lite_team_section',
			'priority'    => 20,
		));
		
		/* Team Background	*/
		$wp_customize->add_setting( 'llorix_one_lite_our_team_background', array(
			'default' 				=> llorix_one_lite_get_file('/images/background-images/parallax-img/team-img.jpg'),
			'sanitize_callback'		=> 'esc_url',
		));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'llorix_one_lite_our_team_background', array(
			'label'    			=> esc_html__( 'Team Background', 'themeisle-companion' ),
			'section'  			=> 'llorix_one_lite_team_section',
			'priority'    		=> 30
		)));
		
		/* Team content */
		$default = llorix_one_companion_team_get_default_content();
		$wp_customize->add_setting( 'llorix_one_lite_team_content', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
			'default' => $default,
		) );
		$wp_customize->add_control( new Llorix_One_Lite_General_Repeater( $wp_customize, 'llorix_one_lite_team_content', array(
			'label'   => esc_html__('Add new team member','themeisle-companion'),
			'section' => 'llorix_one_lite_team_section',
			'priority' => 40,
			'llorix_one_lite_image_control' => true,
			'llorix_one_lite_title_control' => true,
			'llorix_one_lite_subtitle_control' => true
		) ) );
		
		/********************************************************/
		/********** TESTIMONIALS OPTIONS  ***********************/
		/********************************************************/
		
		$wp_customize->add_section( 'llorix_one_lite_testimonials_section' , array(
			'title'       => esc_html__( 'Testimonials section', 'themeisle-companion' ),
			'priority'    => 70,
			'panel'       => 'llorix_one_lite_front_page_sections',
			'active_callback' => 'llorix_one_lite_show_on_front',
		));
		
		/* Testimonials show/hide */
		$wp_customize->add_setting( 'llorix_one_lite_happy_customers_show', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		
		$wp_customize->add_control( 'llorix_one_lite_happy_customers_show', array(
			'type' => 'checkbox',
			'label' => __('Disable the Testimonials section?','themeisle-companion'),
			'section' => 'llorix_one_lite_testimonials_section',
			'priority'    => 1,
		));
		
		/* Testimonials title */
		$wp_customize->add_setting( 'llorix_one_lite_happy_customers_title', array(
			'default' => esc_html__('Happy Customers','themeisle-companion'),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		$wp_customize->add_control( 'llorix_one_lite_happy_customers_title', array(
			'label'    => esc_html__( 'Main title', 'themeisle-companion' ),
			'section'  => 'llorix_one_lite_testimonials_section',
			'priority'    => 10,
		));
		
		/* Testimonials subtitle */
		$wp_customize->add_setting( 'llorix_one_lite_happy_customers_subtitle', array(
			'default' => esc_html__('Cloud computing subscription model out of the box proactive solution.','themeisle-companion'),
			'sanitize_callback' => 'llorix_one_lite_sanitize_text',
		));
		$wp_customize->add_control( 'llorix_one_lite_happy_customers_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'themeisle-companion' ),
			'section'  => 'llorix_one_lite_testimonials_section',
			'priority'    => 20,
		));
		
		
		/* Testimonials content */
		$default = llorix_one_companion_testimonials_get_default_content();
		$wp_customize->add_setting( 'llorix_one_lite_testimonials_content', array(
			'sanitize_callback' => 'llorix_one_lite_sanitize_repeater',
			'default' => $default,
		));
		$wp_customize->add_control( new Llorix_One_Lite_General_Repeater( $wp_customize, 'llorix_one_lite_testimonials_content', array(
			'label'   => esc_html__('Add new testimonial','themeisle-companion'),
			'section' => 'llorix_one_lite_testimonials_section',
			'priority' => 30,
			'llorix_one_lite_image_control' => true,
			'llorix_one_lite_title_control' => true,
			'llorix_one_lite_subtitle_control' => true,
			'llorix_one_lite_text_control' => true
		) ) );
	
	}
}
add_action( 'customize_register', 'llorix_one_companion_customize_register', 999 );
?>