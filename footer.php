			<footer role="contentinfo">
				<div id="inner-footer" class="<?php if (get_post_meta( $post->ID, '_layout_width_meta', '' )[0] != "container") echo "container";?> clearfix">
		          <hr />
		          <div id="widget-footer" class="clearfix row">
		          	<?php for ($i=1; $i <= get_theme_mod('footer_widget_areas'); $i++){ ?>
			            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("footer$i") ) : ?>
			            <?php endif; ?>
		            <?php }?>
		          </div>
					
					<nav class="clearfix">
						<?php wp_bootstrap_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
					
					<p class="pull-right"><a href="http://320press.com" id="credit320" title="By the dudes of 320press">320press</a></p>
			
					<p class="attribution">&copy; <?php bloginfo('name'); ?></p>
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>