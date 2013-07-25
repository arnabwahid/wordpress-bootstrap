<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-inline">
    <fieldset>
		<div class="input-group col col-lg-12">
			<input type="text" name="s" id="search" placeholder="<?php _e("Search","bonestheme"); ?>" value="<?php the_search_query(); ?>" />
			<span class="input-group-btn">
				<button type="submit" class="btn btn-default"><?php _e("Search","bonestheme"); ?></button>
			</span>
		</div>
    </fieldset>
</form>