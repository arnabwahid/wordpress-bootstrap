<?php get_header(); ?>
            
            <div id="content" class="clearfix row">
            
                <div id="main" class="col-sm-8 clearfix" role="main">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                        
                        <header>
                        
        <?php the_post_thumbnail('wpbs-featured'); ?>
                            
                            <div class="page-header"><h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1></div>
                            
                            <p class="meta"><?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('F jS, Y', '', '', false); ?></time> <?php _e("by", "wpbootstrap"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "wpbootstrap"); ?> <?php the_category(', '); ?>.</p>
                        
                        </header> <!-- end article header -->
                    
                        <section class="post_content clearfix" itemprop="articleBody">
        <?php the_content(); ?>
                            
        <?php wp_link_pages(); ?>
                    
                        </section> <!-- end article section -->
                        
                        <footer>
            
        <?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags", "wpbootstrap") . ':</span> ', ' ', '</p>'); ?>
                            
        <?php 
        // only show edit button if user has permission to edit posts
        if($user_level > 0 ) { 
        ?>
        <a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post", "wpbootstrap"); ?></a>
        <?php } ?>
                            
                        </footer> <!-- end article footer -->
                    
                    </article> <!-- end article -->
                    
        <?php comments_template('', true); ?>
                    
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
    
                <?php get_sidebar(); // sidebar 1 ?>
    
            </div> <!-- end #content -->

<?php get_footer(); ?>