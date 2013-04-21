<?php 

	// check wp user level
	get_currentuserinfo(); 
	// store to use later
	global $user_level; 

	// get list of post names to use in 'typeahead' plugin for search bar
	if(of_get_option('search_bar', '1')) { // only do this if we're showing the search bar in the nav

		global $post;
		$tmp_post = $post;
		$get_num_posts = 40; // go back and get this many post titles
		$args = array( 'numberposts' => $get_num_posts );
		$myposts = get_posts( $args );
		$post_num = 0;

		global $typeahead_data;
		$typeahead_data = "[";

		foreach( $myposts as $post ) :	setup_postdata($post);
			$typeahead_data .= '"' . get_the_title() . '",';
		endforeach;

		$typeahead_data = substr($typeahead_data, 0, strlen($typeahead_data) - 1);

		$typeahead_data .= "]";

		$post = $tmp_post;

	} // end if search bar is used

?>