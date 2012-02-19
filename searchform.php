<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-stacked">
    <fieldset>
		<div class="clearfix">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-search"></i></span>
				<input type="text" name="s" id="search" placeholder="Search" value="<?php the_search_query(); ?>" />			
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
        </div>
    </fieldset>
</form>