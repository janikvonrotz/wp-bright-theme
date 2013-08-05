/**
 * JavaScript Media Queries
 */

/* Desktop */
enquire.register("(min-width: 980px)", {
    match : function() {jQuery('html').removeClass('desktop tablet phone no-desktop').addClass('desktop no-tablet no-phone');},                                
    unmatch : function() {},    
    setup : function() {},                              
    deferSetup : true,
    destroy : function() {} 
});
/* Tablets */
enquire.register("(min-width: 768px) and (max-width: 979px)", {
    match : function() {jQuery('html').removeClass('desktop phone no-tablet').addClass('tablet no-desktop no-phone');},                                
    unmatch : function() {},    
    setup : function() {},                              
    deferSetup : true,
    destroy : function() {} 
});
/* Phones */
enquire.register("(max-width: 767px)", {
    match : function() {jQuery('html').removeClass('desktop tablet no-phone').addClass('phone no-desktop no-tablet');},                                
    unmatch : function() {},    
    setup : function() {},                              
    deferSetup : true,
    destroy : function() {} 
});


/**
 * touch supported navigation
 */

/* open dropdown navigation on touch devices */
jQuery('.touch nav').on('click','ul.nav>li:not(.active)',function(event){
	if(jQuery(this).find('ul').length > 0){
		event.preventDefault();
		jQuery('.overlay').show();
		jQuery(this).siblings().removeClass('active');
		jQuery(this).addClass('active');	
	}else{
		jQuery(this).siblings().removeClass('active');
		jQuery('.overlay').hide();
	}
});

/* open dropdown navigation on non touch devices */
jQuery('.no-touch nav').on('mouseenter','ul.nav>li:not(.active)',function(event){
	if(jQuery(this).find('ul').length > 0){
		event.preventDefault();
		jQuery('.overlay').show();
		jQuery(this).siblings().removeClass('active');
		jQuery(this).addClass('active');	
	}else{
		jQuery(this).siblings().removeClass('active');
		jQuery('.overlay').hide();
	}
});

/* close dropdown menu on click outside navigation */
jQuery('.overlay').on('click',function(event){
	jQuery('nav ul li').removeClass('active');
	jQuery('.overlay').hide();
});

/* button to show or hide menu on phone view */
jQuery('nav p.toggle-menu').on('click', function(event){
	jQuery('.phone nav>div>ul').toggleClass('hidden-phone');
});

/**
 * Video responsive resizing
 */

jQuery("article").fitVids();