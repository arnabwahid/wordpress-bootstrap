<?php get_header(); ?>
            
            <div id="content" class="clearfix row">
            
                <div id="main" class="col-sm-12 clearfix" role="main">

                    <article id="post-not-found" class="clearfix">
                        
                        <header>

                            <div class="hero-unit">
                            
                                <h1><?php _e("Epic 404 - Article Not Found", "wpbootstrap"); ?></h1>
                                <p><?php _e("This is embarassing. We can't find what you were looking for.", "wpbootstrap"); ?></p>
                                                            
                            </div>
                                                    
                        </header> <!-- end article header -->
                    
                        <section class="post_content">
                            
                            <p><?php _e("Whatever you were looking for was not found, but maybe try looking again or search using the form below.", "wpbootstrap"); ?></p>

                            <div class="row">
                                <div class="col col-lg-12">
            <?php get_search_form(); ?>
                                </div>
                            </div>
                    
                        </section> <!-- end article section -->
                        
                        <footer>
                            
                        </footer> <!-- end article footer -->
                    
                    </article> <!-- end article -->
            
                </div> <!-- end #main -->
    
            </div> <!-- end #content -->

<?php get_footer(); ?>