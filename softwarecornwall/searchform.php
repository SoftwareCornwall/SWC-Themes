<?php
/* ------------------------------------------------------------------------ */
/* Theme's Search Form
/* ------------------------------------------------------------------------ */
?>

<div class="sd-search">
	<form method="get" action="<?php echo home_url(); ?>/">
		<i class="fa fa-search"></i>
		<input class="sd-search-sumbit" type="submit" value="" />
		<input class="sd-search-input" name="s" type="text" size="25"  maxlength="128" value="<?php the_search_query(); ?>" />
	</form>
</div>
