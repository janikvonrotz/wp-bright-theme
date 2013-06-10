
// $(document).ready(function() {
	// $(".no-phone .fancybox").fancybox({
	
		// padding: 'none',

		// closeBtn: false,
		
		// helpers		: {
			// title	: { type : 'inside' },
			// buttons	: {}
		// },
		
		// openEffect: 'none',
		// closeEffect: 'none',
		// nextEffect: 'none',
		// prevEffect: 'none',
		
		// beforeLoad: function() {
            // this.title = $(this.element).find('img').attr('alt');
        // }
	// });

// });

/* no links for pictures in mobile view */
jQuery('.phone a.fancybox img').on('click','', function(event){
	event.preventDefault();
});


