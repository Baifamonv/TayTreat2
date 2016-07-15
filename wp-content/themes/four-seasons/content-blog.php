<?php
	
	$postclass = get_post_class();
	if(has_post_thumbnail()){
		$postclass[] = 'has-thumb';
	}
	
	if(is_sticky()){
		$postclass[] = 'sticky';
	}
	
	print '<article class="'.implode(' ',$postclass).'">';
			
		
		//thumb
			if(has_post_thumbnail()){
				print '<div class="post-thumb"><a href="'.esc_url(get_permalink()).'">'.get_the_post_thumbnail().'</a></div>';				
			} 
		
			print '			
			<div class="post-text">
				<div class="post-info">';
				
					//sticky
					if(is_sticky()){
						print '<img src="'.get_template_directory_uri().'/images/sticky.png" alt="'.__('sticky post','four-seasons').'" class="icon-sticky" />';
					}
					
					//date
					print get_the_date('M d., Y');
					
					print '&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;';
					
					//category
					print str_replace('rel="category"','',get_the_category_list( __( ', ', 'four-seasons' ) ));
				
				print '
				</div>';
				
				//title
				print '
				<h1><a href="'.esc_url(get_permalink()).'">';												
					$title = get_the_title();
					if(!empty($title)){
						print $title;
					}else{
						print __('Untitled','four-seasons');
					}
				print '</a></h1>';
			
		
		
			
		if(has_excerpt()){
			the_excerpt();
		}else{
			the_content();
		}
				
						
	
	print '</article>	
	';
	
	
	
	