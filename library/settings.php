<?php

//Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , 'wpbs_colorize_register' );

function wpbs_colorize_register ( $wp_customize ){
      
      // Define new sections to the Theme Customizer
      $wp_customize->add_section( 'wpbs_typography', 
         array(
            'title' => __( 'Typography', 'wpbs' ), //Visible title of section
            'priority' => 35, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('General typographical adjustments.', 'wpbs'), //Descriptive tooltip
         ) 
      );

      $wp_customize->add_section( 'wpbs_top_nav', 
         array(
            'title' => __( 'Top Nav', 'wpbs' ), //Visible title of section
            'priority' => 36, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('Top navigation settings.', 'wpbs'), //Descriptive tooltip
         ) 
      );

      // Define settings to use within sections defined above
      $wp_customize->add_setting( 'wpbs_theme_options[headings_font]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
         array(
            'default' => '', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );
      
      //Register new settings to the WP database...
      $wp_customize->add_setting( 'wpbs_theme_options[body_font]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[link_textcolor]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[link_textcolor_hover]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[link_textcolor_active]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[navbar_position]',
         array(
            'default' => 'fixed',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[navbar_bg_color]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[navbar_item_color]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[navbar_item_color_hover]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[navbar_dropdown_item_color]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[navbar_dropdown_item_bg_color_hover]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      $wp_customize->add_setting( 'wpbs_theme_options[navbar_showsearch]',
         array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'postMessage',
         ) 
      );

      // Add controls to the sections defined above
      $wp_customize->add_control(
          'wpbs_headings_font',
          array(
              'type' => 'select',
              'label' => __( 'Headings Font', 'wpbs' ),
              'section' => 'wpbs_typography',
              'settings' => 'wpbs_theme_options[headings_font]',
              'priority' => 10,
              'choices' => array(
                  'Helvetica' => 'Helvetica',
                  'Arial' => 'Arial',
                  'Verdana' => 'Verdana',
                  'Georgia' => 'Georgia',
              ),
          )
      );

      $wp_customize->add_control(
          'wpbs_body_font',
          array(
              'type' => 'select',
              'label' => __( 'Body Font', 'wpbs' ),
              'section' => 'wpbs_typography',
              'settings' => 'wpbs_theme_options[body_font]',
              'priority' => 10,
              'choices' => array(
                  'Helvetica' => 'Helvetica',
                  'Arial' => 'Arial',
                  'Verdana' => 'Verdana',
                  'Georgia' => 'Georgia',
              ),
          )
      );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_link_textcolor', //Set a unique ID for the control
         array(
            'label' => __( 'Link Text Color', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[link_textcolor]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 11, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_link_textcolor_hover', //Set a unique ID for the control
         array(
            'label' => __( 'Link Text Color Hover', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[link_textcolor_hover]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 11, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_link_textcolor_active', //Set a unique ID for the control
         array(
            'label' => __( 'Link Text Color Active', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[link_textcolor_active]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 11, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control(
          'wpbs_navbar_position',
          array(
              'type' => 'radio',
              'label' => __( 'Navbar Position', 'wpbs' ),
              'section' => 'wpbs_top_nav',
              'settings' => 'wpbs_theme_options[navbar_position]',
              'priority' => 12,
              'choices' => array(
                  'fixed' => __( 'Fixed', 'wpbs' ),
                  'scroll' => __( 'Scroll', 'wpbs' ),
              ),
          )
      );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_navbar_bg_color', //Set a unique ID for the control
         array(
            'label' => __( 'Navbar Background Color', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[navbar_bg_color]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 12, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_navbar_item_color', //Set a unique ID for the control
         array(
            'label' => __( 'Navbar Item Color', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[navbar_item_color]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 13, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_navbar_item_color_hover', //Set a unique ID for the control
         array(
            'label' => __( 'Navbar Item Color Hover', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[navbar_item_color_hover]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 14, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_navbar_dropdown_item_color', //Set a unique ID for the control
         array(
            'label' => __( 'Navbar Dropdown Item Color', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[navbar_dropdown_item_color]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 15, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'wpbs_navbar_dropdown_item_bg_color_hover', //Set a unique ID for the control
         array(
            'label' => __( 'Navbar Dropdown Item Color', 'wpbs' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'wpbs_theme_options[navbar_dropdown_item_bg_color_hover]', //Which setting to load and manipulate (serialized is okay)
            'priority' => 16, //Determines the order this control appears in for the specified section
         ) 
      ) );

      $wp_customize->add_control(
          'wpbs_navbar_show_search',
          array(
              'type' => 'checkbox',
              'label' => __( 'Show Search Box?', 'wpbs' ),
              'section' => 'wpbs_top_nav',
              'settings' => 'wpbs_theme_options[navbar_showsearch]',
              'priority' => 17,
          )
      );

	} // end wpbs_colorize_register

?>