<?php

/*
Bones Plugins & Extra Functionality
Author: Eddie Machado
URL: http://themble.com/bones/

This file contains extra features not 100% ready to be included
in the core. Feel free to edit anything here or even help us fix
and optimize the code! 

IF YOU WANT TO SUBMIT A FIX OR CORRECTION, JOIN US ON GITHUB:
https://github.com/eddiemachado/bones/issues

IF YOU WANT TO DISABLE THIS FILE, REMOVE IT'S CALL IN THE FUNCTIONS.PHP FILE

*/


/* 
Social Integration
This is a collection of snippets I edited or reused from
social plugins. No need to use a plugin when you can 
replicate it in only a few lines I say, so here we go.
For more info, or to add more open graph stuff, check
out: http://yoast.com/facebook-open-graph-protocol/
*/

// get the image for the google + and facebook integration 
function bones_get_socialimage() {
  $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', '' );
  if ( has_post_thumbnail($post->ID) ) {
    $socialimg = $src[0];
  } else {
    global $post, $posts;
    $socialimg = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
    $post->post_content, $matches);
    $socialimg = $matches [1] [0];
  }
  if(empty($socialimg)) {
	$socialimg = get_template_directory_uri() . '/library/images/nothumb.gif';
  }
  return $socialimg;
}

// facebook share correct image fix (thanks to yoast)
function bones_facebook_connect() {
	echo "\n" . '<!-- facebook open graph stuff -->' . "\n";
	echo '<!-- place your facebook app id below -->';
	echo '<meta property="fb:app_id" content="1234567890"/>' . "\n";
	global $post;	
	echo '<meta property="og:site_name" content="'. get_bloginfo("name") .'"/>' . "\n";
	echo '<meta property="og:url" content="'. get_permalink() .'"/>' . "\n";
	echo '<meta property="og:title" content="'.get_the_title().'" />' . "\n";
	if (is_singular()) {
		echo '<meta property="og:type" content="article"/>' . "\n";
		echo '<meta property="og:description" content="' .strip_tags( get_the_excerpt() ).'" />' . "\n";
	}
	echo '<meta property="og:image" content="'. bones_get_socialimage() .'"/>' . "\n";
	echo '<!-- end facebook open graph -->' . "\n";
}

// google +1 meta info
function bones_google_header() {
	if (is_singular()) {
		echo '<!-- google +1 tags -->' . "\n";
		global $post;
		echo '<meta itemprop="name" content="'.get_the_title().'">' . "\n";
		echo '<meta itemprop="description" content="' .strip_tags( get_the_excerpt() ).'">' . "\n";
		echo '<meta itemprop="image" content="'. bones_get_socialimage() .'">' . "\n";
		echo '<!-- end google +1 tags -->' . "\n";
	}
}
	
	// add this in the header 
	add_action('wp_head', 'bones_facebook_connect');
	add_action('wp_head', 'bones_google_header');

	
// adding the rel=me thanks to yoast	
function yoast_allow_rel() {
	global $allowedtags;
	$allowedtags['a']['rel'] = array ();
}
add_action( 'wp_loaded', 'yoast_allow_rel' );

// adding facebook, twitter, & google+ links to the user profile
function bones_add_user_fields( $contactmethods ) {
	// Add Facebook
	$contactmethods['user_fb'] = 'Facebook';
	// Add Twitter
	$contactmethods['user_tw'] = 'Twitter';
	// Add Google+
	$contactmethods['google_profile'] = 'Google Profile URL';
	// Save 'Em
	return $contactmethods;
}
add_filter('user_contactmethods','bones_add_user_fields',10,1);


?>