<!DOCTYPE html>
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	
	<!-- DISPLAY MESSAGE IF JAVA IS TURNED OFF -->	
	<noscript>		
		<div id="notification"><strong><?php print __('This website requires JavaScript!</strong> Please enable JavaScript in your browser and reload the page!','four-seasons'); ?></div>	
	</noscript>

	
	<!-- SEASON DECORATIONS -->
	<div class="deco-spring">
		<img src="<?php print get_template_directory_uri().'/images/deco-spring.png'; ?>" alt="decoration" class="leaves" />
		<img src="<?php print get_template_directory_uri().'/images/deco-spring-2.png'; ?>" alt="decoration" class="branch" />
		<img src="<?php print get_template_directory_uri().'/images/deco-spring-3.png'; ?>" alt="decoration" class="bird" />
		
	</div>
	
	<div class="deco-summer">
		<img src="<?php print get_template_directory_uri().'/images/deco-summer.png'; ?>" alt="decoration" class="palm" />
		
	</div>
		
	<div class="deco-fall">
		<img src="<?php print get_template_directory_uri().'/images/deco-fall-1.png'; ?>" alt="leaf" class="leaf" id="leaf1" />
		<img src="<?php print get_template_directory_uri().'/images/deco-fall-2.png'; ?>" alt="leaf" class="leaf" id="leaf2" />
		<img src="<?php print get_template_directory_uri().'/images/deco-fall-3.png'; ?>" alt="leaf" class="leaf" id="leaf3" />
		<img src="<?php print get_template_directory_uri().'/images/deco-fall-4.png'; ?>" alt="leaf" class="leaf" id="leaf4" />
		<img src="<?php print get_template_directory_uri().'/images/deco-fall-5.png'; ?>" alt="leaf" class="leaf" id="leaf5" />
	</div>
	
	<div class="deco-winter">
		<img src="<?php print get_template_directory_uri().'/images/deco-winter-top.png'; ?>" alt="decoration" class="page-top" />
		
		<img src="<?php print get_template_directory_uri().'/images/deco-winter-branch.png'; ?>" alt="decoration" class="pine" />		
		
		<div class="snow"></div>
	</div>
	
	
	
	
	<!-- PAGE SHADOW -->
	<div id="page-shadow"></div>
	
	<!-- PAGE -->
	<div id="page">
			
		
		<!-- HEADER -->
		<header class="header">
			<nav class="responsive-res">
			<?php	
				//logo
					if(function_exists( 'has_custom_logo' ) && has_custom_logo()){
						print '<div class="logo">'.get_custom_logo().'</div>';
					}else{				
						//site title and tagline				
							print '<p class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></p>';
					
					}
					
				print '
				<div id="responsive-menu"><i class="fa fa-bars"></i></div>				
				';	
			?>
			</nav>
			
			<nav class="desktop-res">
			<?php		
				//logo
					if(function_exists( 'has_custom_logo' ) && has_custom_logo()){
						print '<div class="logo">'.get_custom_logo().'</div>';
					}else{
				
						//site title and tagline				
							print '<p class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a></p>';
						
						
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ){
							print '<p class="site-description">'.$description.'</p>';
						}
					}
				
							
				if(has_nav_menu( 'primary' )){
					$def = array('container' => 'ul',
					'theme_location' => 'primary',
					'menu_id' => 'menu-main',
					'menu_class' => 'menu',
					'echo' => true);
					wp_nav_menu($def);				
				}				
			?>
			</nav>	
					
					
			<div id="respo-menu-holder">
				<?php			
				if(has_nav_menu( 'primary' )){
					$def = array('container' => 'ul',
					'theme_location' => 'primary',
					'menu_id' => 'menu-main',
					'menu_class' => 'menu-responsive',
					'echo' => true);
					wp_nav_menu($def);				
				}				
				?>
			</div>
		</header>
		
	
	
	
