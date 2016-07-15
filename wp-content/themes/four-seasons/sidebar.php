<?php

if((is_search() || is_404()) && is_active_sidebar('search-widget-area')){
	dynamic_sidebar('search-widget-area');
	
}elseif(is_archive() && is_active_sidebar('posts-widget-area')){		
	dynamic_sidebar('posts-widget-area');
		
}elseif(is_home() && is_active_sidebar('posts-widget-area')){
	dynamic_sidebar('posts-widget-area');
	
}else{		
	$fourseasons_sidebar_to_load = get_post_meta($post->ID, 'fourseasons-widget-areas-sidebar', true);		
	if(!empty($fourseasons_sidebar_to_load) && is_active_sidebar($fourseasons_sidebar_to_load)){
		dynamic_sidebar($fourseasons_sidebar_to_load);
	}
	
}

