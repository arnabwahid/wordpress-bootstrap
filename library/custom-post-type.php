<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a seperate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function custom_post_example() { 
	// creating (registering) the custom type 
	register_post_type( 'custom_type', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Custom Types', 'post type general name'), /* This is the Title of the Group */
			'singular_name' => __('Custom Post', 'post type singular name'), /* This is the individual type */
			'add_new' => __('Add New', 'custom post type item'), /* The add new menu item */
			'add_new_item' => __('Add New Custom Type'), /* Add New Display Title */
			'edit' => __( 'Edit' ), /* Edit Dialog */
			'edit_item' => __('Edit Post Types'), /* Edit Display Title */
			'new_item' => __('New Post Type'), /* New Display Title */
			'view_item' => __('View Post Type'), /* View Display Title */
			'search_items' => __('Search Post Type'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example custom post type' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this ads your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'custom_type');
	/* this ads your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'custom_type');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_post_example');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'custom_cat', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Custom Categories' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Custom Category' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Custom Categories' ), /* search title for taxomony */
    			'all_items' => __( 'All Custom Categories' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Category' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Category:' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Category' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Category' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Custom Category' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Category Name' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    );   
    
	// now let's add custom tags (these act like categories)
    register_taxonomy( 'custom_tag', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Custom Tags' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Custom Tag' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Custom Tags' ), /* search title for taxomony */
    			'all_items' => __( 'All Custom Tags' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Tag' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Tag:' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Tag' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Tag' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Custom Tag' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Tag Name' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
	

?>