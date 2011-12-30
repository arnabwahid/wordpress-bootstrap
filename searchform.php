<form action="<?php echo home_url( '/' ); ?>" method="get">
    <fieldset>
		<div class="clearfix">
			<label for="s">Search</label>
			<div class="input">
				<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
			</div>
			<div class="actions">
				<button type="submit" class="btn primary">Search</button>
			</div>
		</div>
    </fieldset>
</form>