	<form method="get" id="search-form" action="<?php bloginfo('url'); ?>/">
		<fieldset>
		
			<input class="text" type="text" name="s" id="s" size="20" value="<?php if(is_search()){the_search_query();} ?>" />
			<button type="submit" class="button-search" id="search_submit" name="search_submit">
                                Search</button>
		</fieldset>
	</form>
