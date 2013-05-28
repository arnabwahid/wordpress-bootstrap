<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline">
	<fieldset>
		<div class="clearfix">
			<div class="input-group col col-lg-7">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-search"></span>
				</span>
				<input type="text" name="s" id="search" placeholder="<?php _e("Search","bonestheme"); ?>" value="<?php the_search_query(); ?>" />
				<!--<button type="submit" class="btn btn-primary"><?php _e("Search","bonestheme"); ?></button>-->
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary" type="button"><?php _e("Search","bonestheme"); ?></button>
				</span>
			</div>
		</div>
	</fieldset>
</form>