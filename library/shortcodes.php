<?php

// shortcodes

// Gallery shortcode

// remove the standard shortcode
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'gallery_shortcode_tbs');

function gallery_shortcode_tbs($attr) {
	global $post, $wp_locale;

	$output = "";

	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
	$attachments = get_posts($args);
	if ($attachments) {
		$output = '<div class="row-fluid"><ul class="thumbnails">';
		foreach ( $attachments as $attachment ) {
			$output .= '<li class="span2">';
			$att_title = apply_filters( 'the_title' , $attachment->post_title );
			$output .= wp_get_attachment_link( $attachment->ID , 'thumbnail', true );
			$output .= '</li>';
		}
		$output .= '</ul></div>';
	}

	return $output;
}



// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'default', /* mini, small, default, large */
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	if($type == "default"){
		$type = "";
	}
	else{ 
		$type = "btn-" . $type;
	}
	
	if($size == "default"){
		$size = "";
	}
	else{
		$size = "btn-" . $size;
	}
	
	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 

// Rows, Columns, Layout

function clean_paragraphs( $string )
{

    $string = preg_replace("#<p[^>]*><div#", '<div', $string);
    $string = preg_replace("#div></p>#", 'div>', $string);
    $string = preg_replace("#(<div[^>]*>)</p>#", '$1', $string);
    $string = preg_replace("#<p></div>#", '</div>', $string);
    return $string;
}


function boxed( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'id' => '',
	'class' => '',
	), $atts ) );
	$output = '<div id="'. $id .'" class="container '. $class .'">'. do_shortcode($content) .'</div>';
	return clean_paragraphs($output);
}

add_shortcode('boxed', 'boxed'); 


function row( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'id' => '',
	'class' => '',
	), $atts ) );
	$output = '<div id="'. $id .'" class="row clearfix '. $class .'">'. do_shortcode($content) .'</div>';
	return clean_paragraphs($output);
}

add_shortcode('row', 'row'); 


function column( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'sm', //xs | sm | md | lg
	'width' => 1,
	'id' => '',
	'class' => '',
	), $atts ) );
	$output = '<div id="'. $id .'" class="col-'. $type .'-'. $width .' '. $class .'">'. do_shortcode($content) .'</div>';
	return $output;
}

add_shortcode('column', 'column');


function accordion( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'id' => 'accordion',
	'class' => '',
	), $atts ) );
	
	$output = '<div id="'. $id .'" class="panel-group '. $class .'">'. do_shortcode($content) .'</div>';
	return clean_paragraphs($output);
}

add_shortcode('accordion', 'accordion');

function accordion_item( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'parent_id' => 'accordion',
	'title' => 'Accordion Item Title',
	'opened' => false,
	), $atts ) );
	$href = "panel-".uniqid();
	$output = '<div class="panel panel-default">';
	$output .= '<div class="panel-heading">';
	$output .= '<h4 class="panel-title">';
	$output .= '<a class="'.($opened?'':'collapsed').'" data-toggle="collapse" data-parent="#'.$parent_id.'" href="#'.$href.'">'.$title.'</a>';
	$output .= '</h4></div>';
	$output .= '<div id="'.$href.'" class="panel-collapse collapse '.($opened?'in':'').'">';
	$output .= '<div class="panel-body">'.do_shortcode($content).'</div>';
	$output .= '</div></div>';
	return $output;
}

add_shortcode('accordion_item', 'accordion_item');
?>