<?php
$my_custom_post_types = array(
	'my_custom_post' => array(
		'config' => array(
			'labels' => array(
				'name' 				=> 'My Custom Posts',
				'singular_name' 	=> 'My Post',
			),
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true,
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'menu_position' 		=> null,
			'supports' 				=> array('title','editor')
		),
		'panels' => array(
			'details_meta' => array(
				'config' => array(
					'label' => 'My Custom Post Details',
				),
				'content' => array(
					array(
						'name' => 'text_field',
						'label' => 'Text Field',
						'type' => 'text',
					),
					array(
						'name' => 'text_area_field',
						'label' => 'Text Area Field',
						'type' => 'textarea',
					),
					array(
						'name' => 'image_field',
						'label' => 'Image Field',
						'type' => 'image',
					),
					array(
						'name' => 'upload_field',
						'label' => 'Upload Field',
						'type' => 'file',
					),
					array(
						'name' => 'wysiwyg_field',
						'label' => 'Editor Field',
						'type' => 'wysiwyg',
					),
				)
			),
		),
	),
);

/* Create custom post types */
function admin_init(){
	global $my_custom_post_types;
	if(is_array($my_custom_post_types) && count($my_custom_post_types)){
		foreach($my_custom_post_types as $post_name => $custom_post){
			register_post_type($post_name,$custom_post['config']);
			flush_rewrite_rules();
			if(isset($custom_post['columns']) && count($custom_post['columns'])){
				add_filter("manage_edit-".$post_name."_columns", "custom_edit_columns");
			}
		}
	}
}
add_action("init", "admin_init");
/* Configures the post custom types created before */
function custom_posts_config(){
	global $my_custom_post_types;
	if(is_array($my_custom_post_types) && count($my_custom_post_types)){
		foreach($my_custom_post_types as $post_name => $custom_post){
			if(is_array($custom_post['panels']) && count($custom_post['panels'])){
				foreach($custom_post['panels'] as $panel_id => $panel){
					add_meta_box($panel_id, $panel['config']['label'], 'generate_form', $post_name, "normal", "low",$panel['content']);
				}
			}
			if(is_array($custom_post['taxonomies']) && count($custom_post['taxonomies'])){
				foreach($custom_post['taxonomies'] as $taxonomy_id => $taxonomy){
					register_taxonomy($taxonomy_id, array($post_name), $taxonomy);
				}
			}
		}
	}
}
add_action("admin_init", "custom_posts_config");
/* Helper function to generate the form depending on the fields and its types */
function generate_form($post,$arg1){
	global $post;
	$custom = get_post_custom($post->ID);
	//wp_debug($arg1);
	$data = $arg1['args'];
	if(is_array($data) && count($data)){
		?>
		<table>
			<?php
			foreach($data as $field){
				?>
				<tr style="border-bottom:#CCC solid 1px;">
					<th style="text-align:right;padding:10px;font-weight:bold;width:220px;">
						<label for="input_<?php echo $field['name']?>"><?php echo ucwords($field['label'])?>:</label>
					</th>
					<td style="text-align:left;padding:10px;">
						<?php
						switch($field['type']){
							case 'image':
								echo '<input type="file" id="input_'.$field['name'].'" style="width:400px;" size="40" name="'.$field['name'].'" /><br /><br />';
								echo ucwords($field['label']).':<br />';
								echo '<img style="color:red;max-width:60px" src="'.$custom[$field['name']][0].'" alt="Can\'t load image" />';
								break;
							case 'textarea':
								echo '<textarea cols="40" rows="10" id="input_'.$field['name'].'" style="width:400px;height:200px" name="'.$field['name'].'">'.$custom[$field['name']][0].'</textarea>';
								break;
							case 'wysiwyg':
								echo '<textarea cols="40" rows="10" id="input_'.$field['name'].'" name="'.$field['name'].'" class="tinymce">'.$custom[$field['name']][0].'</textarea>';
								echo '<script>
									jQuery(document).ready(function(){
										jQuery(\'#input_'.$field['name'].'\').addClass("mceEditor");
										if(typeof(tinyMCE) == "object" && typeof(tinyMCE.execCommand == "function")){
											tinyMCE.execCommand("mceAddControl",false,"input_'.$field['name'].'");
										}
									});
								</script>';
								break;
							default:
								echo '<input type="text" id="input_'.$field['name'].'" name="'.$field['name'].'" style="width:400px;" value="'.$custom[$field['name']][0].'" />';
								break;
						}
						?>
					</td>
				</tr>
				<?php
				echo '<p>';
			}
			?>
			<tr>
				<td colspan="2" style="text-align:right;padding-top:20px;">
					<input type="submit" value="Update" class="button-primary" />
				</td>
			</tr>
		</table>
		<?php
	}
}
/* This function takes care of saving the information of each custom post type */
function save_details($post_id = null){
	global $my_custom_post_types, $post;
	if(!isset($post_id) || is_null($post_id)){
		$post_id = $post->ID;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return $post_id;
	}
	if(isset($_POST) && count($_POST)){
		if(isset($my_custom_post_types[$_POST['post_type']])){
			$post_data = $my_custom_post_types[$_POST['post_type']];
			$panels_data = array();
			if(is_array($post_data['panels']) && count($post_data['panels'])){
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				foreach($post_data['panels'] as $panel_id => $panel_data){
					$data = $panel_data['content'];
					if(is_array($data) && count($data)){
						foreach($data as $field){
							switch($field['type']){
								case 'image':
								case 'file':
									if(!empty($_FILES[$field['name']]['name'])){
										$override['action'] = 'editpost';
										$uploaded_file = wp_handle_upload($_FILES[$field['name']], $override);
										
										$post_id = $post->ID;
										$attachment = array(
											'post_title' => $_FILES[$field['name']]['name'],
											'post_content' => '',
											'post_type' => 'attachment',
											'post_parent' => $post_id,
											'post_mime_type' => $_FILES[$field['name']]['type'],
											'guid' => $uploaded_file['url']
										);
										// Save the data
										$id = wp_insert_attachment( $attachment,$_FILES[$field['name']][ 'file' ], $post_id );
										wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $_FILES[$field['name']]['file'] ) );
										update_post_meta($post_id, $field['name'], $uploaded_file['url']);
									}
									break;
								default:
									if(isset($_POST[$field['name']])){
										update_post_meta($post_id, $field['name'], $_POST[$field['name']]);
									}
									break;
							}
						}
					}
				}
			}
		}
	}
}
add_action('save_post', 'save_details');

function fileupload_metabox_header(){
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('form#post').attr('enctype','multipart/form-data');
	jQuery('form#post').attr('encoding','multipart/form-data');
});
</script>
<?php
}
add_action('admin_head', 'fileupload_metabox_header');

add_action("manage_posts_custom_column",  "custom_columns_values");
function custom_columns_values($column){
	global $post;
	global $my_custom_post_types;
	
	$column_values = $my_custom_post_types[$post->post_type]['columns']['values'];
	if(isset($column_values[$column])){
		$custom = get_post_custom();
		$custom_field = str_replace('%','',$column_values[$column]);
		if(isset($custom[$custom_field]) && !empty($custom[$custom_field])){
			echo substr(strip_tags($custom[$custom_field][0]),0,150);
		}
	}
}
function custom_edit_columns($column){
	global $post;
	global $my_custom_post_types;
	return $my_custom_post_types[$post->post_type]['columns']['labels'];
}
?>