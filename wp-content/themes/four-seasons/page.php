<?php

get_header();


	$fourseasons_default_sidebar_position = get_theme_mod('fourseasons_default_sidebar_position');
	$fourseasons_widget_areas_sidebar = get_post_meta($post->ID, 'fourseasons-widget-areas-sidebar', true);	
		
	//sidebar on left
		if(!empty($fourseasons_widget_areas_sidebar) && is_active_sidebar($fourseasons_widget_areas_sidebar) && $fourseasons_default_sidebar_position == 'left'){
			print '<section class="sidebar left widget-area">';
			get_sidebar();
			print '</section>';
		}
	
	
	//page content
		if(!empty($fourseasons_widget_areas_sidebar) && is_active_sidebar($fourseasons_widget_areas_sidebar)){
			print '<section class="content with-sidebar">';
		}else{
			print '<section class="content">';
		}

			if (have_posts()) :
				while ( have_posts() ) : the_post();
				
					the_content();
					
					wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'four-seasons' ), 'after' => '</div>' ) ); 
				endwhile;
			endif;

			
			
			if(comments_open()){
			
				print '
				
				<hr />
					
				<!-- COMMENTS -->							
				
				<section id="comments">';
			
					comments_template( '', true );
						
				print '
				</section>';
			
			}														
			
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
