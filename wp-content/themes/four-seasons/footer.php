<?php
//footer widget areas
	

	if(!empty($post->ID)){
		$fourseasons_widget_areas_first_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-first-footer', true);	
		$fourseasons_widget_areas_second_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-second-footer', true);	
		$fourseasons_widget_areas_third_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-third-footer', true);	
		$fourseasons_widget_areas_fourth_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-fourth-footer', true);	
	}
	
	
	//footer area 1		
		if(!empty($fourseasons_widget_areas_first_footer) && is_active_sidebar($fourseasons_widget_areas_first_footer)){
			$footer_widget_areas[] = $fourseasons_widget_areas_first_footer;
		}			
	//footer area 2		
		if(!empty($fourseasons_widget_areas_second_footer) && is_active_sidebar($fourseasons_widget_areas_second_footer)){
			$footer_widget_areas[] = $fourseasons_widget_areas_second_footer;
		}			
	//footer area 3		
		if(!empty($fourseasons_widget_areas_third_footer) && is_active_sidebar($fourseasons_widget_areas_third_footer)){
			$footer_widget_areas[] = $fourseasons_widget_areas_third_footer;
		}			
	//footer area 4		
		if(!empty($fourseasons_widget_areas_fourth_footer) && is_active_sidebar($fourseasons_widget_areas_fourth_footer)){
			$footer_widget_areas[] = $fourseasons_widget_areas_fourth_footer;
		}			
		
				
	
	
	
	//print footer area
		
		if(!empty($footer_widget_areas)){
			$num_of_fa = count($footer_widget_areas);		
			if($num_of_fa == '4'){
				$fa_class = 'one-fourth';
			}elseif($num_of_fa == '3'){
				$fa_class = 'one-third';
			}elseif($num_of_fa == '2'){
				$fa_class = 'one-half';
			}else{
				$fa_class = '';
			}
			
			print '<section class="footer-widgets widget-area">';
			$fawctr = '0';
			foreach($footer_widget_areas as $faw){
				$fawctr++;
				if($fawctr == $num_of_fa){
					print '<div class="'.$fa_class.' last">';
				}else{
					print '<div class="'.$fa_class.'">';
				}
				
				dynamic_sidebar( $faw );
				
				print '</div>';
			}
			print '</section>';
		}
		
	
		
?>
</div><!-- #PAGE ENDS -->


<footer>						
	<?php
	//SOCIAL ICONS	
	
	$fourseasons_footer_icons_behance = get_theme_mod('fourseasons_footer_icons_behance');
	$fourseasons_footer_icons_dribbble = get_theme_mod('fourseasons_footer_icons_dribbble');
	$fourseasons_footer_icons_facebook = get_theme_mod('fourseasons_footer_icons_facebook');
	$fourseasons_footer_icons_gplus = get_theme_mod('fourseasons_footer_icons_gplus');
	$fourseasons_footer_icons_instagram = get_theme_mod('fourseasons_footer_icons_instagram');
	$fourseasons_footer_icons_linkedin = get_theme_mod('fourseasons_footer_icons_linkedin');
	$fourseasons_footer_icons_pinterest = get_theme_mod('fourseasons_footer_icons_pinterest');
	$fourseasons_footer_icons_rss = get_theme_mod('fourseasons_footer_icons_rss');
	$fourseasons_footer_icons_twitter = get_theme_mod('fourseasons_footer_icons_twitter');
	if(!empty($fourseasons_footer_icons_behance) || !empty($fourseasons_footer_icons_dribbble) || !empty($fourseasons_footer_icons_facebook) || !empty($fourseasons_footer_icons_gplus) || !empty($fourseasons_footer_icons_instagram) || !empty($fourseasons_footer_icons_linkedin) || !empty($fourseasons_footer_icons_pinterest) || !empty($fourseasons_footer_icons_rss) || !empty($fourseasons_footer_icons_twitter)){
		print '<ul class="social-icons">';		
			
			if(!empty($fourseasons_footer_icons_behance)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_behance).'"><i class="fa fa-behance"></i> '.__('BEHANCE','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_dribbble)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_dribbble).'"><i class="fa fa-dribbble"></i> '.__('DRIBBBLE','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_facebook)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_facebook).'"><i class="fa fa-facebook"></i> '.__('FACEBOOK','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_gplus)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_gplus).'"><i class="fa fa-google-plus"></i> '.__('GOOGLE+','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_instagram)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_instagram).'"><i class="fa fa-instagram"></i> '.__('INSTAGRAM','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_linkedin)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_linkedin).'"><i class="fa fa-linkedin"></i> '.__('LINKEDIN','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_pinterest)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_pinterest).'"><i class="fa fa-pinterest"></i> '.__('PINTEREST','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_rss)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_rss).'"><i class="fa fa-rss"></i> '.__('RSS','four-seasons').'</a></li>'; }
			if(!empty($fourseasons_footer_icons_twitter)){ print '<li><a href="'.esc_url($fourseasons_footer_icons_twitter).'"><i class="fa fa-twitter"></i> '.__('TWITTER','four-seasons').'</a></li>'; }
		
		print '</ul>';
	}
	
	?>

	<p class="copyright"><?php _e('A WORDPRESS THEME FROM <a href="http://divpusher.com" target="_blank">DIVPUSHER.COM</a>','four-seasons'); ?></p>
		
		
	<!-- SEASON DECORATIONS -->
	<div class="deco-spring"></div>
	
	<div class="deco-summer">
		<img src="<?php print get_template_directory_uri().'/images/deco-summer-coconut.png'; ?>" alt="coconut" class="coconut" />
		<img src="<?php print get_template_directory_uri().'/images/deco-summer-starfish.png'; ?>" alt="coconut" class="starfish" />
	</div>
	
	<div class="deco-fall"></div>	
	
	<div class="deco-winter">
		<div class="footer"></div>
		<img src="<?php print get_template_directory_uri().'/images/deco-winter-cone.png'; ?>" class="cone" alt="cone" />
	</div>
	
</footer>


	
	<!-- CUSTOM PHOTO VIEWER -->
	<div id="dp-photo-viewer">
		<div id="dp-pv-loading"><img src="<?php print get_template_directory_uri().'/images/dp-pv-loading.gif'; ?>" alt="<?php _e('loading','four-seasons'); ?>" /></div>
		<div id="dp-pv-img"></div>
		<div id="dp-pv-close">&times;</div>
		<div id="dp-pv-prev"><i class="fa fa-angle-left"></i></div>
		<div id="dp-pv-next"><i class="fa fa-angle-right"></i></div>
	</div>


<!-- WP FOOTER STARTS -->
<?php wp_footer(); ?>
<!-- WP FOOTER ENDS -->


</body>
</html>