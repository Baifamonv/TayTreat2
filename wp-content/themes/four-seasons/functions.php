<?php


// theme url
	$theme_text_domain = 'four-seasons';		
	
	
	
// sets up the content width value based on the theme's design and stylesheet
	global $content_width;
	if ( ! isset( $content_width ) ){
		$content_width = 1000;
	}
	
	

// set up theme defaults
	function fourseasons_fw_setup() {
		
		
		// makes theme available for translation
		load_theme_textdomain( 'four-seasons', get_template_directory() . '/languages' );
		
			
				
		// this theme uses wp_nav_menu() in one location
		register_nav_menu( 'primary', __( 'Primary Menu', 'four-seasons' ) );
				
				
		//editor-style.css		
		add_editor_style( array( 'editor-style.css', '//fonts.googleapis.com/css?family=Lato:400,300,700' ) );
		
			
		//remove gallery inline style
		add_filter( 'use_default_gallery_style', '__return_false' );
		
		
		//gallery images always link to file
		function fourseasons_gal_link($out){
			$out['link'] = 'file'; 
			return $out;
		}
		add_filter( 'shortcode_atts_gallery','fourseasons_gal_link');

		
		// set thumbnail sizes
		set_post_thumbnail_size( 225, 200, true ); // width, height, crop = true		
		
		
		//limit excerpt
		function fourseasons_excerpt_length($length) {
			return 30;
		}
		add_filter('excerpt_length', 'fourseasons_excerpt_length');
		
		
		
		// this theme uses a custom image size for featured images, displayed on "standard" posts
		add_theme_support( 'post-thumbnails' );
		
				
		// adds rss feed links to <head> for posts and comments
		add_theme_support( 'automatic-feed-links' );
		
		//theme is not defining titles on its own
		add_theme_support( 'title-tag' );
				
		//logo changing supported
		add_theme_support( 'custom-logo' );
		
		
		
	}
	add_action( 'after_setup_theme', 'fourseasons_fw_setup' );
	
		
		
					
	
	
//frontend scipts and styles
	function fourseasons_frontend_load(){
	
		//css
		wp_enqueue_style('fourseasons-reset', get_template_directory_uri().'/css/reset.css',array(),null,'all');
		wp_enqueue_style('fourseasons-font', 'https://fonts.googleapis.com/css?family=Lato:400,300,700',array(),null,'all');
		wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.css',array(),null,'all');				
		wp_enqueue_style('fourseasons-default', get_stylesheet_uri(),array(),null,'all');	
		wp_enqueue_style('fourseasons-responsive-style', get_template_directory_uri().'/style-responsive.css',array(),null,'all');
		
		
		//ie-only style sheets
		global $wp_styles;				
		wp_enqueue_style('fourseasons-ltie9-def', get_template_directory_uri(). '/style.css',array(),null);
		$wp_styles->add_data('fourseasons-ltie9-def', 'conditional', 'lt IE 9');		
			
		
		
		//js		
		wp_enqueue_script('retina_js', get_template_directory_uri() . '/js/retina.min.js', '', '', true );		
		wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', '', '', true );		
		wp_enqueue_script('fourseasons-startup', get_template_directory_uri().'/js/startup.js', array('jquery'));
		wp_enqueue_script('fourseasons-imageviewer', get_template_directory_uri().'/js/dp.imageviewer.js', array('jquery'));	
		
		
		
		if( is_single() && comments_open() && get_option( 'thread_comments' )){
			wp_enqueue_script( 'comment-reply' );
		}

		
		//custom colors
		$fourseasons_header_textcolor = get_theme_mod('header_textcolor'); 		
		$fourseasons_main_text_color = get_theme_mod('fourseasons_main_text_color'); 
		$fourseasons_link_color = get_theme_mod('fourseasons_link_color'); 
		$fourseasons_link_hover_color = get_theme_mod('fourseasons_link_hover_color'); 
		if(!empty($fourseasons_header_textcolor) || !empty($fourseasons_main_text_color) || !empty($fourseasons_link_color) || !empty($fourseasons_link_hover_color)){
			$custom_css = '';			
			
			if(!empty($fourseasons_header_textcolor)){			
				$custom_css .= '
					.site-title, .site-title a{
						color: #'.wp_filter_nohtml_kses($fourseasons_header_textcolor).';
					}
				';
			}	
			
			if(!empty($fourseasons_main_text_color) && $fourseasons_main_text_color != '#666666'){			
				$custom_css .= '
					body{
						color: '.wp_filter_nohtml_kses($fourseasons_main_text_color).';
					}
				';
			}	
			
			if(!empty($fourseasons_link_color) && $fourseasons_link_color != '#d27506'){			
				$custom_css .= '
					a, #page a{
						color: '.wp_filter_nohtml_kses($fourseasons_link_color).';
					}
				';
			}
			
			if(!empty($fourseasons_link_hover_color) && $fourseasons_link_hover_color != '#333333'){			
				$custom_css .= '
					a:hover, #page a:hover{
						color: '.wp_filter_nohtml_kses($fourseasons_link_hover_color).';
					}
				';
			}
				
			wp_add_inline_style( 'fourseasons-default', $custom_css );
		}
	}
	add_action( 'wp_enqueue_scripts', 'fourseasons_frontend_load' );
	
	
	
// enqueues scripts and styles for backend
	function fourseasons_admin_load(){		
		$screen = get_current_screen();		
		if ( $screen->post_type == 'page' ){	
			wp_enqueue_style('fourseasons-admin', get_template_directory_uri().'/css/admin.css',array(),null,'all');		
			wp_enqueue_script('fourseasons-admin', get_template_directory_uri().'/js/admin_scripts.js', array('jquery'));			
		}
	}
	add_action('admin_enqueue_scripts', 'fourseasons_admin_load');
	
	

//change seasons	
	function fourseasons_body_classes( $classes ) {	
		$fourseasons_season = get_theme_mod('fourseasons_season');
	
		if(!empty($_GET['season'])){
			if($_GET['season'] == 'spring'){ $classes[] = 'season-spring';  }
			if($_GET['season'] == 'summer'){ $classes[] = 'season-summer';  }			
			if($_GET['season'] == 'winter'){ $classes[] = 'season-winter';  }
		}elseif(!empty($fourseasons_season)){
			$classes[] = 'season-'.$fourseasons_season;
		}
	
		return $classes;
	}
	add_filter( 'body_class', 'fourseasons_body_classes' );
	
	

// register widgetized areas, and load custom ones also!
	function fourseasons_fw_widgets_init() {
				
		register_sidebar( array(
			'name' => __( 'Archives Sidebar', 'four-seasons' ),
			'id' => 'posts-widget-area',
			'description' => __( 'Sidebar for all Archives, Categories, Tags pages.', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		
		register_sidebar( array(
			'name' => __( 'Search & 404 Sidebar', 'four-seasons' ),
			'id' => 'search-widget-area',
			'description' => __( 'Sidebar for Search & 404 pages', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		
		register_sidebar( array(
			'name' => __( 'Widget Area #1', 'four-seasons' ),
			'id' => 'widget-area-one',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		
		
		register_sidebar( array(
			'name' => __( 'Widget Area #2', 'four-seasons' ),
			'id' => 'widget-area-two',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
	
	
		register_sidebar( array(
			'name' => __( 'Widget Area #3', 'four-seasons' ),
			'id' => 'widget-area-three',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		
		register_sidebar( array(
			'name' => __( 'Widget Area #4', 'four-seasons' ),
			'id' => 'widget-area-four',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		
		register_sidebar( array(
			'name' => __( 'Widget Area #5', 'four-seasons' ),
			'id' => 'widget-area-five',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

	
		register_sidebar( array(
			'name' => __( 'Widget Area #6', 'four-seasons' ),
			'id' => 'widget-area-six',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

	
		register_sidebar( array(
			'name' => __( 'Widget Area #7', 'four-seasons' ),
			'id' => 'widget-area-seven',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

	
		register_sidebar( array(
			'name' => __( 'Widget Area #8', 'four-seasons' ),
			'id' => 'widget-area-eight',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

	
		register_sidebar( array(
			'name' => __( 'Widget Area #9', 'four-seasons' ),
			'id' => 'widget-area-nine',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

	
		register_sidebar( array(
			'name' => __( 'Widget Area #10', 'four-seasons' ),
			'id' => 'widget-area-ten',
			'description' => __( 'Widget area for sidebar or footer', 'four-seasons' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );

		
	}	
	add_action( 'widgets_init', 'fourseasons_fw_widgets_init' );
	
	
	

// removes the default styles that are packaged with the recent comments widget
	function fourseasons_fw_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'fourseasons_fw_remove_recent_comments_style' );
		
	
	
	
// comment functions

	function fourseasons_comments( $comment, $args, $depth ){		
		print '
		<li>'. get_avatar($comment,'60');
		
		
		print '
			<div class="holder">
				<p class="comment-author"><b>'.get_comment_author().'</b>&nbsp;&nbsp; / &nbsp;&nbsp;';
					printf( __( '%1$s., %2$s','four-seasons'), get_comment_date(),  get_comment_time() ); 
					edit_comment_link( __( '(Edit)' ,'four-seasons'), ' ' );					
					
					
					comment_reply_link( 
						array_merge( $args, array( 
							'depth' => $depth, 
							'max_depth' => $args['max_depth'], 
							'reply_text' => __('Reply','four-seasons')
						) ) );
				print '</p>		
				<p class="comment">'.get_comment_text().'</p>
			</div>';
					
	}
		
		
		
		
// put theme options in customizer
	function fourseasons_theme_customizer( $wp_customize ) {    			
				
		
	//season
		$wp_customize->add_section( 'fourseasons_season_section' , array(
			'title'       => __( 'Season Layouts', 'four-seasons' ),
			'priority'    => 30,
			'description' => __( 'Select a layout for your website!', 'four-seasons' )
		) );
		
		
			$wp_customize->add_setting( 'fourseasons_season', array( 'sanitize_callback' => 'fourseasons_sanitize_season' ) );
			$wp_customize->add_control( 'fourseasons_season', array(								
				'section'  => 'fourseasons_season_section',
				'type' => 'radio',
				'choices' => array(
							'spring' => 'Spring',
							'summer' => 'Summer',
							'fall' => 'Fall',
							'winter' => 'Winter'
						),				
			) );
			
			
			function fourseasons_sanitize_season($input){
				$seasons = array('spring','summer','fall','winter');
				if(in_array($input,$seasons)){
					return $input;
				}
			}
			
		
	//colors
		//add link color setting and control
			$wp_customize->add_setting( 'fourseasons_link_color', array(
				'default'           => '#d27506',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fourseasons_link_color', array(
				'label'       => __( 'Link Color', 'four-seasons' ),
				'section'     => 'colors',
			) ) );
			
			$wp_customize->add_setting( 'fourseasons_link_hover_color', array(
				'default'           => '#333333',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fourseasons_link_hover_color', array(
				'label'       => __( 'Link Hover Color', 'four-seasons' ),
				'section'     => 'colors',
			) ) );

		//add main text color setting and control
			$wp_customize->add_setting( 'fourseasons_main_text_color', array(
				'default'           => '#666666',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fourseasons_main_text_color', array(
				'label'       => __( 'Main Text Color', 'four-seasons' ),
				'section'     => 'colors',
			) ) );
		
			
			
		
	//sidebar & footer
		$wp_customize->add_section( 'fourseasons_sidebar_footer_section' , array(
			'title'       => __( 'Sidebar & Footer', 'four-seasons' ),
			'priority'    => 100
		) );
		
		
		
		
		//sidebar position
			$wp_customize->add_setting( 'fourseasons_default_sidebar_position', array(
				'sanitize_callback' => 'fourseasons_sanitize_sb_position'
			) );
			$wp_customize->add_control( 'fourseasons_default_sidebar_position', array(
				'label'    => __( 'Default sidebar position', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'select',
				'choices' => array(
					'' => __('Right','four-seasons'),
					'left' => __('Left','four-seasons')
				)
			) );
			
			function fourseasons_sanitize_sb_position( $input ) {
				if($input == 'left'){
					return $input;
				}else{
					return '';
				}
			}
					
			
			
		//footer social icons			
			$wp_customize->add_setting( 'fourseasons_footer_icons_behance', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_behance', array(
				'label'    => __( 'Footer icons - Behance', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );	
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_dribbble', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_dribbble', array(
				'label'    => __( 'Footer icons - Dribbble', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_facebook', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_facebook', array(
				'label'    => __( 'Footer icons - Facebook', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_gplus', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_gplus', array(
				'label'    => __( 'Footer icons - Google+', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_instagram', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_instagram', array(
				'label'    => __( 'Footer icons - Instagram', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_linkedin', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_linkedin', array(
				'label'    => __( 'Footer icons - LinkedIN', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_pinterest', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_pinterest', array(
				'label'    => __( 'Footer icons - Pinterest', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_rss', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_rss', array(
				'label'    => __( 'Footer icons - RSS', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );
			
			$wp_customize->add_setting( 'fourseasons_footer_icons_twitter', array( 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control( 'fourseasons_footer_icons_twitter', array(
				'label'    => __( 'Footer icons - Twitter', 'four-seasons' ),
				'section'  => 'fourseasons_sidebar_footer_section',
				'type' => 'text'
			) );				
			
	}
	add_action( 'customize_register', 'fourseasons_theme_customizer' );
	
	
	
	

	
	

// user can decide which post categories to load on a portfolio page template	
	if ( is_admin() ) {		
		$fourseasons_new_meta_boxes_blogcats  = array(
			"sc_gen" => array(
			"name" => "fourseasons_blog_cats",
			"std" => "",
			"title" => "Post Categories"
			)
		);

		function fourseasons_category_selector() {
			global $post;
			
			$fourseasons_blog_cats = get_post_meta($post->ID, 'fourseasons_blog_cats', true);		
			$tax_terms = get_terms('category');
			
			
			echo'<p>'.__('Here you can select which post categories you\'d like to display on this page.','four-seasons').'</p>';
			wp_nonce_field('fourseasons_update_blog_cats','fourseasons_update_blog_cats_nonce');
			echo '
				<select name="fourseasons_blog_cats[]" id="fourseasons_blog_cats" multiple="multiple" style="height: 120px; width: 100%; float: left;">';
				if($fourseasons_blog_cats == '' || empty($fourseasons_blog_cats) || $fourseasons_blog_cats[0] == ''){
					echo '<option value="" selected="selected">'.__('All categories','four-seasons').'</option>';
					
					if($tax_terms != ''){						
						foreach ($tax_terms as $tax_term) {
							if($tax_term->parent == '0'){
								echo '
								<option value="'. $tax_term->slug .'">' . $tax_term->name . '</option>
								';
							}
						}	
					}			
					
				}else{
					echo '<option value="">'.__('All categories','four-seasons').'</option>';
					
					
					if($tax_terms != ''){				
						foreach ($tax_terms as $tax_term) {
							$selected = '';
							foreach($fourseasons_blog_cats as $pf_cat){
								if($pf_cat == $tax_term->slug){
									$selected = ' selected="selected"';
								}
							}
							
							if($tax_term->parent == '0'){
								echo '
								<option value="'. $tax_term->slug .'"'.$selected.'>' . $tax_term->name . '</option>
								';
							}
						}	
					}
				}
					
				
			echo '		
				</select>
				<p>&nbsp;</p>
			';	
		}

		function fourseasons_create_meta_box_blogcats() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				add_meta_box( 'fourseasons-category-selector', 'Post Categories', 'fourseasons_category_selector', 'page', 'side' );		
			}
		}
		add_action('admin_menu', 'fourseasons_create_meta_box_blogcats');
		
		//save meta box values 
			function fourseasons_save_postdata_blogcats(){		
				global $post, $fourseasons_blog_cats;
							
				//save fields
				if(!empty($post->ID) && current_user_can('edit_page',$post->ID) && isset($_POST['fourseasons_update_blog_cats_nonce']) && wp_verify_nonce($_POST['fourseasons_update_blog_cats_nonce'],'fourseasons_update_blog_cats')){
					if(!empty($_POST['fourseasons_blog_cats']) && is_array($_POST['fourseasons_blog_cats'])){
						$_POST['fourseasons_blog_cats'] = array_map( 'esc_sql', $_POST['fourseasons_blog_cats'] );
						update_post_meta($post->ID,'fourseasons_blog_cats',$_POST['fourseasons_blog_cats']);
					}
				}
			}
			add_action('save_post', 'fourseasons_save_postdata_blogcats');
		
	}		
	
	

// user can decide which widget area should appear on a page template	
	if(is_admin()){				
		
		
		$fourseasons_new_meta_boxes_widget_areas  = array(
			"sc_gen" => array(
			"name" => "fourseasons_widget_areas",
			"std" => "",
			"title" => "Widget Areas"
			)
		);

		
		function fourseasons_widget_areas() {
			global $post;
		
			$fourseasons_widget_areas_sidebar = get_post_meta($post->ID, 'fourseasons-widget-areas-sidebar', true);	
			$fourseasons_widget_areas_first_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-first-footer', true);	
			$fourseasons_widget_areas_second_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-second-footer', true);	
			$fourseasons_widget_areas_third_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-third-footer', true);	
			$fourseasons_widget_areas_fourth_footer = get_post_meta($post->ID, 'fourseasons-widget-areas-fourth-footer', true);	
		
		
			echo'<p>'.__('Here you can select widget areas that should appear on this page.','four-seasons').'<br /><br /></p>';			
			
			wp_nonce_field('fourseasons_widget_areas','fourseasons_widget_areas_nonce');
			
			//list widget areas
			echo '<p><b>'.__('Sidebar','four-seasons').'</b></p>';
			echo '<p><select name="fourseasons-widget-areas-sidebar"><option value="">-</option>';			
				global $wp_registered_sidebars;
				foreach($wp_registered_sidebars as $k => $v){
					echo '<option value="'.$k.'"';
					if($fourseasons_widget_areas_sidebar == $k){ echo ' selected="selected"'; }
					echo '>'.$v['name'].'</option>';
				}
			echo '</select></p>';
			
			echo '<p>&nbsp;</p>';			
			echo '<p><b>'.__('Footer','four-seasons').'</b></p>';
			echo '<p><select name="fourseasons-widget-areas-first-footer"><option value="">-</option>';
				foreach($wp_registered_sidebars as $k => $v){
					echo '<option value="'.$k.'"';
					if($fourseasons_widget_areas_first_footer == $k){ echo ' selected="selected"'; }
					echo '>'.$v['name'].'</option>';
				}
			echo '</select></p>';
			echo '<p><select name="fourseasons-widget-areas-second-footer"><option value="">-</option>';
				foreach($wp_registered_sidebars as $k => $v){
					echo '<option value="'.$k.'"';
					if($fourseasons_widget_areas_second_footer == $k){ echo ' selected="selected"'; }
					echo '>'.$v['name'].'</option>';
				}
			echo '</select></p>';
			echo '<p><select name="fourseasons-widget-areas-third-footer"><option value="">-</option>';
				foreach($wp_registered_sidebars as $k => $v){
					echo '<option value="'.$k.'"';
					if($fourseasons_widget_areas_third_footer == $k){ echo ' selected="selected"'; }
					echo '>'.$v['name'].'</option>';
				}
			echo '</select></p>';
			echo '<p><select name="fourseasons-widget-areas-fourth-footer"><option value="">-</option>';
				foreach($wp_registered_sidebars as $k => $v){
					echo '<option value="'.$k.'"';
					if($fourseasons_widget_areas_fourth_footer == $k){ echo ' selected="selected"'; }
					echo '>'.$v['name'].'</option>';
				}
			echo '</select></p>';
			echo '<p>&nbsp;</p>';
			
		}
		
		
		function fourseasons_create_meta_box_widget_areas() {
			global $theme_name;
			if ( function_exists('add_meta_box') ) {
				
				add_meta_box( 'fourseasons-widget-areas', 'Widget Areas', 'fourseasons_widget_areas', 'page', 'side' );		
				add_meta_box( 'fourseasons-widget-areas', 'Widget Areas', 'fourseasons_widget_areas', 'post', 'side' );		
			}
		}
		
		add_action('admin_menu', 'fourseasons_create_meta_box_widget_areas');
		
		
		//save meta box values 
			function fourseasons_save_postdata_widget_areas(){		
				global $post, $fourseasons_widget_areas;
							
				//save fields				
				if(!empty($post->ID) && current_user_can('edit_page', $post->ID) && current_user_can('edit_post') && isset($_POST['fourseasons_widget_areas_nonce']) && wp_verify_nonce($_POST['fourseasons_widget_areas_nonce'],'fourseasons_widget_areas')){
				
					if(!empty($_POST['fourseasons-widget-areas-sidebar'])){
						$_POST['fourseasons-widget-areas-sidebar'] = sanitize_text_field($_POST['fourseasons-widget-areas-sidebar']);
						update_post_meta($post->ID,'fourseasons-widget-areas-sidebar',$_POST['fourseasons-widget-areas-sidebar']);					
					}elseif(!empty($post->ID)){
						delete_post_meta($post->ID,'fourseasons-widget-areas-sidebar');
					}
					
					if(!empty($_POST['fourseasons-widget-areas-first-footer'])){
						$_POST['fourseasons-widget-areas-first-footer'] = sanitize_text_field($_POST['fourseasons-widget-areas-first-footer']);
						update_post_meta($post->ID,'fourseasons-widget-areas-first-footer',$_POST['fourseasons-widget-areas-first-footer']);					
					}elseif(!empty($post->ID)){
						delete_post_meta($post->ID,'fourseasons-widget-areas-first-footer');
					}
					
					if(!empty($_POST['fourseasons-widget-areas-second-footer'])){
						$_POST['fourseasons-widget-areas-second-footer'] = sanitize_text_field($_POST['fourseasons-widget-areas-second-footer']);
						update_post_meta($post->ID,'fourseasons-widget-areas-second-footer',$_POST['fourseasons-widget-areas-second-footer']);					
					}elseif(!empty($post->ID)){
						delete_post_meta($post->ID,'fourseasons-widget-areas-second-footer');
					}
					
					if(!empty($_POST['fourseasons-widget-areas-third-footer'])){					
						$_POST['fourseasons-widget-areas-third-footer'] = sanitize_text_field($_POST['fourseasons-widget-areas-third-footer']);
						update_post_meta($post->ID,'fourseasons-widget-areas-third-footer',$_POST['fourseasons-widget-areas-third-footer']);					
					}elseif(!empty($post->ID)){
						delete_post_meta($post->ID,'fourseasons-widget-areas-third-footer');
					}
					
					if(!empty($_POST['fourseasons-widget-areas-fourth-footer'])){					
						$_POST['fourseasons-widget-areas-fourth-footer'] = sanitize_text_field($_POST['fourseasons-widget-areas-fourth-footer']);
						update_post_meta($post->ID,'fourseasons-widget-areas-fourth-footer',$_POST['fourseasons-widget-areas-fourth-footer']);					
					}elseif(!empty($post->ID)){
						delete_post_meta($post->ID,'fourseasons-widget-areas-fourth-footer');
					}
					
				}
			}
			add_action('save_post', 'fourseasons_save_postdata_widget_areas');
	}

	
	

