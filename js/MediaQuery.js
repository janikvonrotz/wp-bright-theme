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