//@prepros-prepend noconsole.js
//@prepros-prepend debounce.js
//@prepros-prepend skrollr.js
//@prepros-prepend wait-for-images.js
//@prepros-prepend modernizr.js

$(document).ready(function(){
	$('.dropdown.active .dropdown-hide').slideToggle();//default enable dropdowns with active class;
	$('.dropdown .strapline').on('click', function(){
		var dropdown =  $(this).parent('.dropdown')
		dropdown.find('> .dropdown-hide').slideToggle(); dropdown.toggleClass('active')	
	})
	

	if ($(window).width() > 700){
	  	window.skroll = skrollr.init({
	  		forceHeight:false,
	  		mobileCheck:function() {return false}
		});
  	}
  	
  	var siteFade = $('.site-fade');
  	siteFade.data().state = 0;
  	$('.menu-trigger').on('click', function(){
  		$('.mobile-nav-sidebar').toggleClass('active');
  		
  		if (siteFade.data().state === 0){//fade is inactive
  			siteFade.addClass('show');
  			setTimeout(function(){
  				siteFade.addClass('active');
  			},100)
  			siteFade.data().state = 1;
  		} else {
  			siteFade.removeClass('active')
  			setTimeout(function(){
  				siteFade.removeClass('show');
  			},1000)  
  			siteFade.data().state = 0;			
  		}
  	})
  	
  	var init = $.Deferred();
  	init.done(
	  	function init(){
	  		$('#image-cache').remove();
	 		$('.header-container').addClass('loaded');
			setTimeout(function(){
				$('.wrapper').addClass('loaded');
			}, 200)
		}  		
  	)
  	$('#image-cache').waitForImages(init.resolve())
  	window.setTimeout(function(){
  		init.resolve()
  	},1000) //just in case the image cache failes.
	
	
	$('.tickets-link').mouseover(function(){
		$('#rainbow').addClass('active');
	})
	$('.tickets-link').mouseout(function(){
		$('#rainbow').removeClass('active');
	})
		
	
})



$(window).on('load', function(){
	if ($(window).width() > 700){
		skroll.refresh();
	}
	if ($('#wpadminbar').length){
		$('#wpadminbar').css({
			'opacity' : 0,
			'top' : 'inherit',
			'bottom' : 0
		})
	}
})
