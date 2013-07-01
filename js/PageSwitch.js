
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