<?php
$themename = "Sample Admin";
$shortname = "sample-admin";

$options = array (
	array(
		"name" => $themename." Options",
		"type" => "title",
		"description" => "Use this panel to configure your website"
	),
	array(
		"name" => "General",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Colour Scheme",
		"desc" => "Select the colour scheme for the theme",
		"id" => $shortname."_color_scheme",
		"type" => "select",
		"options" => array(
			"blue",
			"red",
			"green"
		),
		"std" => "blue"
	),
	array(
		"name" => "Logo URL",
		"desc" => "Enter the link to your logo image",
		"id" => $shortname."_logo",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Custom CSS",
		"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
		"id" => $shortname."_custom_css",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Homepage",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Homepage header image",
		"desc" => "Enter the link to an image used for the homepage header.",
		"id" => $shortname."_header_img",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Homepage featured category",
		"desc" => "Choose a category from which featured posts are drawn",
		"id" => $shortname."_feat_cat",
		"type" => "select",
		"options" => $wp_cats,
		"std" => "Choose a category"
	),
	array(
		"type" => "close"
	),
	array(
		"name" => "Footer",
		"type" => "section"
	),
	array(
		"type" => "open"
	),
	array(
		"name" => "Footer copyright text",
		"desc" => "Enter text used in the right side of the footer. It can be HTML",
		"id" => $shortname."_footer_text",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Google Analytics Code",
		"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
		"id" => $shortname."_ga_code",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"name" => "Custom Favicon",
		"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
		"id" => $shortname."_favicon",
		"type" => "text",
		"std" => get_bloginfo('url') ."/favicon.ico"
	),
	array(
		"name" => "Feedburner URL",
		"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website",
		"id" => $shortname."_feedburner",
		"type" => "text",
		"std" => get_bloginfo('rss2_url')
	),
	array(
		"type" => "close"
	)
);

function mytheme_add_admin() {
	global $themename, $shortname, $options;
	if(!isset($options) || !is_array($options) || empty($options)){
		return;
	}
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
			foreach ($options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
				} else { 
					delete_option( $value['id'] );
				}
			}
			header("Location: admin.php?page=admin-config.php&saved=true");
			die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] ); 
			}
			header("Location: admin.php?page=admin-config.php&reset=true");
			die;
		}
	}
	add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init(){
	$file_dir = get_bloginfo('stylesheet_directory');
	wp_enqueue_style("options", $file_dir."/admin/css/admin-settings.css", false, "1.0", "all");
	wp_enqueue_script("script", $file_dir."/admin/js/admin-settings.js", false, "1.0");
}


function mytheme_admin() {
	global $themename, $shortname, $options;
	if(!isset($options) || !is_array($options) || empty($options)){
		return;
	}
	$i=0;
	if ( $_REQUEST['saved'] ) {
		echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	}
	if ( $_REQUEST['reset'] ) {
		echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
	}
	?>
	<div class="wrap rm_wrap">
		<h2><?php echo $themename; ?> Settings</h2>
		<div class="rm_opts">
			<form method="post">
			<?php 
			foreach ($options as $value) {
				switch ( $value['type'] ) {
					case "open":
						?>
						<?php 
						break;
					case "close":
						?>
						</div>
						</div>
						<br />
						<?php 
						break;
					case "title":
						?>
						<p><?php echo $value['description']?></p>
						<?php 
						break;
					case 'text':
						?>
						<div class="rm_input rm_text">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
						<?php
						break;
					case 'textarea':
						?>
						<div class="rm_input rm_textarea">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
						<?php
						break;
					case 'select':
						?>
						<div class="rm_input rm_select">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
							<?php foreach ($value['options'] as $option) { ?>
								<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
							</select>
							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
						<?php
						break;
					case "checkbox":
						?>
						<div class="rm_input rm_checkbox">
							<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
							<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
							<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />		
							<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
						</div>
						<?php break;
					case "section":
						$i++;
						?>
						<div class="rm_section">
							<div class="rm_title">
								<h3>
									<img src="<?php bloginfo('template_directory')?>/admin/images/trans.png" class="inactive" alt=""" />
									<?php echo $value['name']; ?>
								</h3>
								<span class="submit">
									<input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
								</span>
								<div class="clearfix"></div>
							</div>
							<div class="rm_options">
						<?php break;
				}
			}
			?>					
			<input type="hidden" name="action" value="save" />
		</form>
		<form method="post">
			<p class="submit">
				<input name="reset" type="submit" value="Reset" />
				<input type="hidden" name="action" value="reset" />
			</p>
		</form>
		<div style="font-size:9px; margin-bottom:10px;">Icons: <a href="http://www.woothemes.com/2009/09/woofunction/">WooFunction</a></div>
	</div> 
	<?php
}
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>