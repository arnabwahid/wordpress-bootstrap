<?php
/**
 * Custom Post Type Video
 */

if ( ! ( class_exists( 'ClassVideoPost' ) ) ) {

	class ClassVideoPost {

		function __construct() {

			add_action( 'init', array( &$this, 'video_post_register' ) );

			add_action( 'init', array( &$this, 'video_post_taxonomy' ), 0 );

		}

		/*Register Video Post Type*/
		function video_post_register() {

			$slug = 'video-post';

			$labels = array(
				'name'               => esc_html__( 'Video', 'wpbootstrap' ),
				'singular_name'      => esc_html__( 'Video Post', 'wpbootstrap' ),
				'add_new'            => esc_html__( 'Add New', 'wpbootstrap' ),
				'add_new_item'       => esc_html__( 'Add New Video Post', 'wpbootstrap' ),
				'edit_item'          => esc_html__( 'Edit Video Post', 'wpbootstrap' ),
				'new_item'           => esc_html__( 'New Video Post', 'wpbootstrap' ),
				'all_items'          => esc_html__( 'All Video Posts', 'wpbootstrap' ),
				'view_item'          => esc_html__( 'View Video Post', 'wpbootstrap' ),
				'search_items'       => esc_html__( 'Search Video', 'wpbootstrap' ),
				'not_found'          => esc_html__( 'Nothing found', 'wpbootstrap' ),
				'not_found_in_trash' => esc_html__( 'Nothing found in Trash', 'wpbootstrap' ),
				'parent_item_colon'  => '',
				'menu_name'          => esc_html__( 'Video', 'wpbootstrap' )
			);

			$args = array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'menu_icon'          => 'dashicons-format-gallery',
				'capability_type'    => 'post',
				'taxonomies'         => array( 'video-tag' ),
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 8,
				'rewrite'            => array(
					'slug'       => $slug,
					'with_front' => false,
					'feed'       => true,
					'pages'      => true
				),
				'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
			);

			register_post_type( 'video', $args );

		}

		/*Video Tag Taxonomy*/
		function video_post_taxonomy() {

			$slug = 'video';

			// Add new taxonomy, make it hierarchical ( like categories )
			$labels = array(
				'name'              => __( 'Video Tags', 'wpbootstrap' ),
				'singular_name'     => __( 'Video Tag', 'wpbootstrap' ),
				'search_items'      => __( 'Search Video Tags', 'wpbootstrap' ),
				'all_items'         => __( 'All Video Tags', 'wpbootstrap' ),
				'parent_item'       => __( 'Parent Video Tag', 'wpbootstrap' ),
				'parent_item_colon' => __( 'Parent Video Tag:', 'wpbootstrap' ),
				'edit_item'         => __( 'Edit Video Tag', 'wpbootstrap' ),
				'update_item'       => __( 'Update Video Tag', 'wpbootstrap' ),
				'add_new_item'      => __( 'Add New Video Tag', 'wpbootstrap' ),
				'new_item_name'     => __( 'New Video Tag Name', 'wpbootstrap' ),
				'menu_name'         => __( 'Tags', 'wpbootstrap' ),
			);

			register_taxonomy( 'video-tag', array( 'video' ),
				array(
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => $slug . '-tag' ),
				) );
		}

	}

}

if ( class_exists( 'ClassVideoPost' ) ) {
	$ClassVideoPost = new ClassVideoPost;
}
