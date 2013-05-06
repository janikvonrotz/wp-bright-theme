/* open dropdown navigation on touch devices */
$('.touch nav').on('click','ul.nav>li:not(.active)',function(event){
	if($(this).find('ul').length > 0){
		event.preventDefault();
		$('.overlay').show();
		$(this).siblings().removeClass('active');
		$(this).addClass('active');	
	}else{
		$(this).siblings().removeClass('active');
		$('.overlay').hide();
	}
});

/* open dropdown navigation on non touch devices */
$('.no-touch nav').on('mouseenter','ul.nav>li:not(.active)',function(event){
	if($(this).find('ul').length > 0){
		event.preventDefault();
		$('.overlay').show();
		$(this).siblings().removeClass('active');
		$(this).addClass('active');	
	}else{
		$(this).siblings().removeClass('active');
		$('.overlay').hide();
	}
});

/* close dropdown menu on click outside navigation */
$('.overlay').on('click',function(event){
	$('nav ul li').removeClass('active');
	$('.overlay').hide();
});

/* button to show or hide menu on phone view */
$('nav .menu').on('click', function(event){
	$('.phone nav>ul').toggleClass('hidden-phone');
});

