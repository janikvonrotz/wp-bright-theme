/**
 * WordPress keyboard navigation
 */

jQuery( document ).ready( function( $ ) {
	$( document ).keydown( function( e ) {
		var url = false;
		if ( e.which == 37 ) {  // Left arrow key code
			url = $( '.previous-image a' ).attr( 'href' );
		}
		else if ( e.which == 39 ) {  // Right arrow key code
			url = $( '.entry-attachment a' ).attr( 'href' );
		}
		if ( url && ( !$( 'textarea, input' ).is( ':focus' ) ) ) {
			window.location = url;
		}
	} );
} );


/**
 * Switch Content
 */
 
// previous post
Hammer('body').on("swiperight", function() {
    window.location.href = jQuery('.pager li.previous a').attr('href');
});

// next post
Hammer('body').on("swipeleft", function() {
    window.location.href = jQuery('.pager li.next a').attr('href');
});