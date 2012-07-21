<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span12 clearfix" role="main">

					<article id="post-not-found" class="clearfix">
						
						<header>

							<div class="hero-unit">
							
								<h1>Epic 404 - Article Not Found</h1>
								<p>This is embarassing. We can't find what you were looking for.</p>
															
							</div>
													
						</header> <!-- end article header -->
					
						<section class="post_content">
							
							<p>Whatever you were looking for was not found, but maybe try looking again or search using the form below.</p>

							<div class="row-fluid">
								<div class="span12">
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