<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
            
            <div id="content" class="clearfix row">
            
                <div id="main" class="col-sm-12 clearfix" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
                    
                        <header>

        <?php 
                                $post_thumbnail_id = get_post_thumbnail_id();
                                $featured_src = wp_get_attachment_image_src($post_thumbnail_id, 'wpbs-featured-home');
        ?>

                            <div class="jumbotron" style="background-image: url('<?php echo $featured_src[0]; ?>'); background-repeat: no-repeat; background-position: 0 0;">
                
                                <div class="page-header">
                                    <h1><?php bloginfo('title'); ?><small><?php echo get_post_meta($post->ID, 'custom_tagline', true);?></small></h1>
                                </div>                
                                
                            </div>
                        
                        </header>
                        
                        <section class="row post_content">
                        
                            <div class="col-sm-8">
                        
                                <?php the_content(); ?>
                                
                            </div>
                            
        <?php get_sidebar('sidebar2'); // sidebar 2 ?>
                                                    
                        </section> <!-- end article header -->
                        
                        <footer>
            
                            <p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags", "wpbootstrap") . ': ', ', ', '</span>'); ?></p>
                            
                        </footer> <!-- end article footer -->
                    
                    </article> <!-- end article -->
                    
        <?php 
        // No comments on homepage
        //comments_template();
        ?>
                    
        <?php endwhile; ?>    
                    
        <?php else : ?>
                    
                    <article id="post-not-found">
                        <header>
                            <h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
                        </header>
                        <section class="post_content">
                            <p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
                        </section>
                        <footer>
                        </footer>
                    </article>
                    
        <?php endif; ?>
            
                </div> <!-- end #main -->
    
                <?php //get_sidebar(); // sidebar 1 ?>
    
            </div> <!-- end #content -->

<?php get_footer(); ?>