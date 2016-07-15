<?php

get_header();



	$fourseasons_default_sidebar_position = get_theme_mod('fourseasons_default_sidebar_position');
									
	//sidebar on left
		if(is_active_sidebar('search-widget-area') && $fourseasons_default_sidebar_position == 'left'){
			print '<section class="sidebar left widget-area">';
			get_sidebar();
			print '</section>';
		}
		
		
		if(is_active_sidebar('search-widget-area')){
			print '<section class="content with-sidebar blog">';
		}else{
			print '<section class="content blog">';
		}
				
	
	//404 message
		print '<h1>'.__('PAGE NOT FOUND','four-seasons').'</h1>
		<p class="aligncenter"><strong>'.__('Sorry!','four-seasons').'</strong> '. __( 'The page you\'re looking for is not available!<br />Maybe you want to try a search?', 'four-seasons' ).'</p>
		';
	
		
		
		print '
			</section>
		';
		
		
		
	//sidebar on right
		if(is_active_sidebar('search-widget-area') && $fourseasons_default_sidebar_position != 'left'){
			print '<section class="sidebar widget-area">';
			get_sidebar();
			print '</section>';
		}
	
	
	
get_footer('nowidget');


