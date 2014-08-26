		</div> <!-- end #container -->
			<footer id="mainfooter" role="contentinfo">
			<div id="inner-footer" class="container clearfix">
		          <div id="widget-footer" class="clearfix row">
		            <?php for ($i=1; $i <= get_theme_mod('footer_widget_areas'); $i++){ ?>
			            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("footer$i") ) : ?>
			            <?php endif; ?>
		            <?php }?>
		          </div>
					<nav class="clearfix">
						<?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>