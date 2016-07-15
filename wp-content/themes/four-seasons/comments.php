<?php
/*
	Template for displaying Comments.
*/

// if the current post is protected by a password and the visitor has not yet entered the password we will return early without loading the comments. */
	if ( post_password_required() ){
		return;
	}

	
if ( have_comments() ){

	print '
	<section class="comments">
		<h6 class="comments-title">'.__('COMMENTS','four-seasons').' <span>('.get_comments_number().')</span></h6>';

		print '
		<ul class="commentlist">
		'; 
		
		//list comments
			wp_list_comments( array( 'callback' => 'fourseasons_comments' ) ); 
				
		print '
		</ul>	
		';
		
		//comment nav
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			print '<nav id="comment-nav-below" class="navigation" role="navigation">			
				<div class="nav-previous">'; previous_comments_link( __( 'PREVIOUS', 'four-seasons' ) ); print '</div>
				<div class="nav-next">'; next_comments_link( __( 'NEXT', 'four-seasons' ) ); print '</div>
			</nav>';
		}	
	
	print '</section>';
}

	
	//for translation
	print '<p class="hidden" id="comment-thanks">'.__('Thank you for submitting your comment!','four-seasons').'</p>';
	
	
	
if(comments_open()){	
	
	
	comment_form( array( 
		'title_reply' => __('LEAVE A REPLY ','four-seasons'),
		'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea></p>',
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		'label_submit' => __('SUBMIT','four-seasons'),
		'fields' => array(
			'author' => '<p class="comment-form-author"><label>' . __('NAME:', 'four-seasons') . '</label><input id="author" name="author" type="text" size="30" /></p>',
			'email' => '<p class="comment-form-email"><label>' . __('EMAIL:', 'four-seasons') . '</label><input id="email" name="email" type="text" size="30" /></p>'			
			)
	) );
}
	

