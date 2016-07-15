<?php
$squery = get_search_query();
?>
<!-- SEARCH FORM -->
<div class="search">
	<form action="<?php print home_url(); ?>/" method="get" accept-charset="utf-8" class="search-form">
		<input type="text" class="input-text" name="s" value="<?php if(!empty($squery)){ print $squery; }else{ _e('SEARCH', 'four-seasons'); } ?>" onfocus="if(this.value=='<?php _e('SEARCH', 'four-seasons'); ?>'){this.value=''};" onblur="if(this.value==''){this.value='<?php _e('SEARCH', 'four-seasons'); ?>'}" />
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
</div>