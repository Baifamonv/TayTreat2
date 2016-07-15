jQuery(document).ready(function($) {		
	"use strict";		
	

	
	
	//RESPONSIVE MENU
		var responsiveMenu = 'closed';		
		$(document).on('click','#responsive-menu',function(){
			if(responsiveMenu == 'closed'){
				$('i',this).removeClass('fa-bars').addClass('fa-times');
				$('#page .content, footer').css('opacity','0.2');
				$('#respo-menu-holder').slideToggle();
				
				responsiveMenu = 'opened';			
			}else{
				$('i',this).removeClass('fa-times').addClass('fa-bars');
				$('#page .content, footer').css('opacity','1');
				$('#respo-menu-holder').slideToggle();
				
				responsiveMenu = 'closed';
			}
		});
	
	
	
	
	//PARALLAX DECORATION
		var scrolltop = $(document).scrollTop();
		
		
		//DEFAULT POSITIONS		
		$('.deco-spring .branch').css('top',(110 + scrolltop/8)+'px');
		$('.deco-summer .palm').css('top',(60 - scrolltop/6)+'px');
		$('.deco-fall #leaf1').css('top',(100 - scrolltop/4)+'px');
		$('.deco-fall #leaf2').css('top',(309 - scrolltop/3)+'px');
		$('.deco-fall #leaf3').css('top',(569 - scrolltop/6)+'px');
		$('.deco-fall #leaf4').css('top',(857 - scrolltop/4)+'px');
		$('.deco-fall #leaf5').css('top',(1229 - scrolltop/2)+'px');
		$('.deco-winter .pine').css('top',(182 - scrolltop/4)+'px');					
		$('.deco-winter .snow').css('top',(0 + scrolltop/4)+'px');
		
		
		//CHANGE ON SCROLL
		$(document).scroll(function(e){
			scrolltop = $(document).scrollTop();			
			
			//WINTER
			if($('body').hasClass('season-winter')){
				$('.deco-winter .pine').css('top',(182 - scrolltop/4)+'px');
				
				$('.deco-winter .snow').css('top',(0 + scrolltop/3)+'px');
			}									
			
			if(scrolltop >= 1 && scrolltop <= 900){							
				//SPRING
				if($('body').hasClass('season-spring')){					
					$('.deco-spring .branch').css('top',(110 + scrolltop/8)+'px');
				}
			
				//SUMMER								
				if($('body').hasClass('season-summer')){
					$('.deco-summer .palm').css('top',(60 - scrolltop/6)+'px');
				}
			
				//FALL
				if(!$('body').hasClass('season-spring') && !$('body').hasClass('season-summer') && !$('body').hasClass('season-winter')){		
					$('.deco-fall #leaf1').css('top',(100 - scrolltop/4)+'px');
					$('.deco-fall #leaf2').css('top',(309 - scrolltop/3)+'px');
					$('.deco-fall #leaf3').css('top',(569 - scrolltop/6)+'px');
					$('.deco-fall #leaf4').css('top',(857 - scrolltop/4)+'px');
					$('.deco-fall #leaf5').css('top',(1229 - scrolltop/2)+'px');
				}				
			}
		});
		
	
	
});

