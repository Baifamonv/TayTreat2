<?php
	
	
		//thumb
			if(has_post_thumbnail()){
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
				print '<a href="'.esc_url(get_permalink()).'"><div class="post-thumb" style="background-image: url(\''.$src[0].'\')"></div></a>';				
			} 
		
			//title
				print '
				<h3><a href="'.esc_url(get_permalink()).'">';												
					$title = get_the_title();
					if(!empty($title)){
						print $title;
					}else{
						print __('Untitled','four-seasons');
					}
				print '</a></h3>';
				
				
			//category
				print '<p class="category">'.str_replace('rel="category"','',get_the_category_list( __( ', ', 'four-seasons' ) )).'</p>';
		
	
			//excerpt
				if(has_excerpt()){
					print '<p class="excerpt">'.get_the_excerpt().'</p>';
				}
	