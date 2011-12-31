<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-stacked">
    <fieldset>
		<div class="clearfix">
			<div class="input">
				<input type="text" name="s" id="search" placeholder="Search" value="<?php the_search_query(); ?>" />			
				<button type="submit" class="btn primary">Search</button>
			</div>
        </div>
    </fieldset>
</form>