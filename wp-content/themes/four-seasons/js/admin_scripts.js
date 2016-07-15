jQuery(document).ready(function() {
		
	//POST CATEGORY SELECTOR
		var pagetmpl = jQuery('#page_template option:selected').val();
		if(pagetmpl == 'template-portfolio.php' || pagetmpl == 'template-blog-full.php' || pagetmpl == 'template-blog-thumbs.php'){
			jQuery('#fourseasons-category-selector').css('display','block');			
		}else{
			jQuery('#fourseasons-category-selector').css('display','none');
		}
		
		jQuery('#page_template').change(function(){
			var pagetemps = jQuery('option:selected',this).val();
			if(pagetemps == 'template-portfolio.php' || pagetemps == 'template-blog-full.php' || pagetemps == 'template-blog-thumbs.php'){
				jQuery('#fourseasons-category-selector').css('display','block');				
			}else{
				jQuery('#fourseasons-category-selector').css('display','none');				
			}
		});
	
});