<?php


get_header();


	$this_page_id = get_option('page_for_posts');
	
	$fourseasons_default_sidebar_position = get_theme_mod('fourseasons_default_sidebar_position');
	$fourseasons_widget_areas_sidebar = get_post_meta($this_page_id, 'fourseasons-widget-areas-sidebar', true);	
		
	//sidebar on left
		if(!empty($fourseasons_widget_areas_sidebar) && is_active_sidebar($fourseasons_widget_areas_sidebar) && $fourseasons_default_sidebar_position == 'left'){
			print '<section class="sidebar left widget-area">';
			get_sidebar();
			print '</section>';
		}
	
	
	//page content
		if(!empty($fourseasons_widget_areas_sidebar) && is_active_sidebar($fourseasons_widget_areas_sidebar)){
			print '<section class="content with-sidebar blog">';
		}else{
			print '<section class="content blog">';
		}
		
		
	//load posts
		if (have_posts()){							
			while(have_posts()){
				the_post();							
			
				get_template_part( 'content-blog' );
			}
		}
		
					
	
	//pagination
		if(function_exists('wp_paginate')) {					
			wp_paginate();		
		} 
		else{
			//display default next/prev links
			
			if($the_query->max_num_pages > 1 ){								
				
				print '<p class="pages-left">'; previous_posts_link(__('&lharu; Previous Page ','four-seasons')); print '</p>';
				
					print '<p class="pages-number">- ';
						$page_curr = (get_query_var('paged')) ? get_query_var('paged') : 1;								
						print sprintf(__('PAGE %d OF %d','four-seasons'),$page_curr,$the_query->max_num_pages);
					print ' -</p>';
					
					
					print '<p class="pages-right">'; next_posts_link(__('Next Page &rharu;','four-seasons'),$the_query->max_num_pages); print '</p>';
									
				
			}
		}			
		
		wp_reset_query();	
		wp_reset_postdata();
	
		
		
		print '
			</section>
		';
		
		
	
	//sidebar on right
		if(!empty($fourseasons_widget_areas_sidebar) && is_active_sidebar($fourseasons_widget_areas_sidebar) && $fourseasons_default_sidebar_position != 'left'){
			print '<section class="sidebar widget-area">';
			get_sidebar();
			print '</section>';
		}
				
				
get_footer();