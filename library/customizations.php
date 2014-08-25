<?php

/************* LAYOUT META BOX *****************/

/**
 * Adds a box to the side column on the Post and Page edit screens.
 */

function layout_width_add_meta_box() {

  $screens = array( 'page' );

  foreach ( $screens as $screen ) {

    add_meta_box(
      'layout_width_sectionid',
      __( 'Layout Width', 'layout_width_textdomain' ),
      'layout_width_meta_box_callback',
      $screen,
      'side'
    );
  }
}
add_action( 'add_meta_boxes', 'layout_width_add_meta_box' );


function layout_width_meta_box_callback( $post ) {

  wp_nonce_field( 'layout_width_meta_box', 'layout_width_meta_box_nonce' );

  $value = get_post_meta( $post->ID, '_layout_width_meta', true );

  echo '<select id="layout_width_meta_field" name="layout_width_meta_field" value="' . esc_attr( $value ) . '">';
  echo '<option '. (esc_attr( $value ) == 'container' ? 'selected' : '') .' value="container">Boxed</option>';
  echo '<option '. (esc_attr( $value ) == 'container-full' ? 'selected' : '') .' value="container-full">100%</option>';
  echo '</select>';
}


function layout_width_save_meta_box_data( $post_id ) {


  if ( ! isset( $_POST['layout_width_meta_box_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['layout_width_meta_box_nonce'], 'layout_width_meta_box' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }

  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }

  if ( ! isset( $_POST['layout_width_meta_field'] ) ) {
    return;
  }

  $my_data = sanitize_text_field( $_POST['layout_width_meta_field'] );

  update_post_meta( $post_id, '_layout_width_meta', $my_data );
}
add_action( 'save_post', 'layout_width_save_meta_box_data' );



function wp_bootstrap_customize_register( $wp_customize ) {
    
    $wp_customize->add_section( 'wp_bootstrap_header_options', 
       array(
          'title' => __( 'Header', 'wpbootstrap' ),
          'priority' => 35,
          'capability' => 'edit_theme_options',
       ) 
    );
    
    $wp_customize->add_setting( 'logo',
       array(
          'default' => '',
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
          'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
       )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
       $wp_customize, //Pass the $wp_customize object (required)
       'wp_bootstrap_logo', //Set a unique ID for the control
       array(
          'label' => __( 'Logo', 'wpbootstrap' ), //Admin-visible name of the control
          'section' => 'wp_bootstrap_header_options', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
          'settings' => 'logo', //Which setting to load and manipulate (serialized is okay)
          'priority' => 10, //Determines the order this control appears in for the specified section
       ) 
    ) );

    $wp_customize->add_setting( 'header_type',
       array(
          'default' => 'navbar-fixed-top',
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
          'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
       )
    );

    $wp_customize->add_control( 'wp_bootstrap_header_type', 
      array(
        'label'    => __( 'Header Type', 'wpbootstrap' ),
        'section'  => 'wp_bootstrap_header_options',
        'settings' => 'header_type',
        'type'     => 'radio',
        'default' => 'navbar-fixed-top',
        'choices'  => array(
          'navbar-fixed-top'  => 'Fixed',
          'navbar-static-top' => 'Static',
        ),
      )
    );

    $wp_customize->add_setting( 'body_padding_top',
       array(
          'default' => '60px',
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
          'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
       )
    );

    $wp_customize->add_control( 'wp_bootstrap_body_padding_top', 
      array(
        'label'    => __( 'Body Padding Top (use with fixed header)', 'wpbootstrap' ),
        'section'  => 'wp_bootstrap_header_options',
        'settings' => 'body_padding_top',
        'type'     => 'text',
        'default' => '60px',
      )
    );

    $wp_customize->add_setting( 'show_search',
       array(
          'default' => true,
          'type' => 'theme_mod', 
          'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
          'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
       )
    );

    $wp_customize->add_control( 'wp_bootstrap_show_search', 
      array(
        'label'    => __( 'Show Search Bar', 'wpbootstrap' ),
        'section'  => 'wp_bootstrap_header_options',
        'settings' => 'show_search',
        'type'     => 'checkbox',
        'default' => true,
      )
    );
}

add_action( 'customize_register', 'wp_bootstrap_customize_register' );

function wp_bootstrap_customize_css()
{
    ?>
         <style type="text/css">
            <?php if(get_theme_mod('header_type') == 'navbar-fixed-top'):?>
              body { padding-top:<?php echo get_theme_mod('body_padding_top'); ?>; }
            <?php else:?>
              body { padding-top:0px; }
            <?php endif;?>
         </style>
    <?php
}
add_action( 'wp_head', 'wp_bootstrap_customize_css');

?>