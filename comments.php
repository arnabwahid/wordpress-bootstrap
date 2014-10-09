<?php
/*
The comments page for Bones
*/

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.","wpbootstrap"); ?></div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<h3 id="comments"><?php comments_number('<span>' . __("No","wpbootstrap") . '</span> ' . __("Responses","wpbootstrap") . '', '<span>' . __("One","wpbootstrap") . '</span> ' . __("Response","wpbootstrap") . '', '<span>%</span> ' . __("Responses","wpbootstrap") );?> <?php _e("to","wpbootstrap"); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link( __("Older comments","wpbootstrap") ) ?></li>
	  		<li><?php next_comments_link( __("Newer comments","wpbootstrap") ) ?></li>
	 	</ul>
	</nav>
	
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=wp_bootstrap_comments'); ?>
	</ol>
	
	<?php endif; ?>
	
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<h3 id="pings">Trackbacks/Pingbacks</h3>
		
		<ol class="pinglist">
			<?php wp_list_comments('type=pings&callback=list_pings'); ?>
		</ol>
	<?php endif; ?>
	
	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link( __("Older comments","wpbootstrap") ) ?></li>
	  		<li><?php next_comments_link( __("Newer comments","wpbootstrap") ) ?></li>
		</ul>
	</nav>

	<?php if ( ! comments_open() ) : ?>
	<p class="alert alert-info"><?php _e("Comments are closed","wpbootstrap"); ?>.</p>
	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

	<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>
