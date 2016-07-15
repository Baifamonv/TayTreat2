<?php
/*
Template Name: Portfolio
*/
	
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
			print '<section class="content with-sidebar portfolio">';
		}else{
			print '<section class="content portfolio">';
		}
		

	//load page content 	
		if (have_posts()) :		
			while ( have_posts() ) : the_post();
				
					print '<article>';
				
					the_content();
				
					print '</article>';
													
					
				endwhile;
		endif;

	
	//category selector
		$bc = get_post_meta(get_the_ID(), 'fourseasons_blog_cats', true);
		if(is_array($bc)){
			$categories_to_display = implode(',',$bc);
		}
		
		if(!empty($_GET['cat'])){
			$categories_to_display = sanitize_key($_GET['cat']);
		}

		
		$paged = get_query_var('paged');
		if($paged == ''){ $paged = get_query_var('page'); }
		
		if(!empty($categories_to_display)){		
			$args=array(
				'post_type' => 'post',
				'paged' => $paged,
				'category_name' => $categories_to_display,			
				'posts_per_page' => 6
			);		
		}else{
			$args=array(
				'post_type' => 'post',
				'paged' => $paged,			
				'posts_per_page' => 6
			);
		}
		
			
		print '
		<div id="pf-category-selector">';
			
			$currpurl = get_permalink();		
			if(empty($_GET['cat'])){
				$cats[] = '<a href="'.esc_url($currpurl).'" class="active">'.__('SHOW ALL','four-seasons').'</a>';
			}else{
				$cats[] = '<a href="'.esc_url($currpurl).'">'.__('SHOW ALL','four-seasons').'</a>';
			}
													
			
			//show all child cats of current parent cat			

			//foreach array
			if(is_array($bc)){
				foreach($bc as $pfcat){
					$allcats = get_categories(array(
						'type' => 'post',
						'child_of' => get_category_by_slug($pfcat)->term_id
					));
					
					if(!empty($allcats)){
						foreach($allcats as $ccats){
							//create category url
							if(strstr($currpurl,'?')){ 
								$caturl = $currpurl.'&amp;cat='.$ccats->slug;
							}else{
								$caturl = $currpurl.'?cat='.$ccats->slug;
							}
							
							if(!empty($_GET['cat']) && $_GET['cat'] == $ccats->slug){
								$cats[] = '<a href="'.esc_url($caturl).'" class="active">'.$ccats->name.'</a>';
							}else{
								$cats[] = '<a href="'.esc_url($caturl).'">'.$ccats->name.'</a>';
							}
						}
					}												
				}
			}
						
						
		if(!empty($cats)){
			print implode('&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;',$cats);
		}
			
			
		print '		
		</div>';
			
				
				
				
	//load portfolio items
	
			$wp_query = new WP_Query( $args );		
			$pctr = 0;
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();					
				$pctr++;		
				if($pctr == 3){
					print '<div class="one-third last portfolio-item">';					
				}else{
					print '<div class="one-third portfolio-item">';					
				}
									
				get_template_part( 'content-portfolio' );
			
				if($pctr == 3){
					$pctr = 0;
					print '</div><div class="clear"></div>';					
				}else{
					print '</div>';					
				}
			}
			
		
	wp_reset_query();	
	wp_reset_postdata();
		
		
	print '</section>';
	
		
	//sidebar on right
		if(!empty($fourseasons_widget_areas_sidebar) && is_active_sidebar($fourseasons_widget_areas_sidebar) && $fourseasons_default_sidebar_position != 'left'){
			print '<section class="sidebar widget-area">';
			get_sidebar();
			print '</section>';
		}
				
	
	
get_footer();
