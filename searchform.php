<div class="row form-inline">
	<form action="<?php echo home_url( '/' ); ?>" method="get" class="col col-lg-12">
		<div class="input-group">
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-search"></span></span>
			<input type="text" name="s" id="search" placeholder="<?php _e("Search for anything","bonestheme"); ?>" value="<?php the_search_query(); ?>" />
			<span class="input-group-btn">
				<button class="btn btn-primary" type="submit"><?php _e("Search","bonestheme"); ?></button>
			</span>
		</div>
	</form>
</div>