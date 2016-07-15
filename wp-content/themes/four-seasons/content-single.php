<?php
	
	$postclass = get_post_class();
	if(has_post_thumbnail()){
		$postclass[] = 'has-thumb';
		
	}
	
	if(is_sticky()){
		$postclass[] = 'sticky';
	}
	
	print '<article class="'.implode(' ',$postclass).'">';
			
				
			print '			
				<p class="post-info">';
				
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
				</p>';
				
				//title
				print '
				<h1>';												
					$title = get_the_title();
					if(!empty($title)){
						print $title;
					}else{
						print __('Untitled','four-seasons');
					}
				print '</h1>';
			
		
		
			the_content();
		
						
		
		wp_link_pages( array( 'before' => '<div class="page-links">' . __( '<strong>Pages:</strong>', 'four-seasons' ), 'after' => '</div>' ) ); 
	
	print '</article>	
	';
	
	
	