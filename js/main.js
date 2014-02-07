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
	
	function stickyHeader(){
		return;
		var clear = $('.top-logo');
		var clear = clear.offset().top + clear.height() + 50;
		if ($(window).scrollTop() >= clear){
			$('#header').addClass('small')
		}
		else {
			$('#header').removeClass('small')
		}
	}
	$('#header').addClass('small')//temp;
	
	$(document).on('scroll', $.throttle( 250, stickyHeader ) );
  	window.skroll = skrollr.init({forceHeight:false});
  	
  	
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
	skroll.refresh();
	if ($('#wpadminbar').length){
		$('#wpadminbar').css({
			'opacity' : 0,
			'top' : 'inherit',
			'bottom' : 0
		})
	}
})
