
Hammer('body').on("swiperight", function() {
    window.location.href = $('.pager li.previous a').attr('href');
});

Hammer('body').on("swipeleft", function() {
    window.location.href = $('.pager li.next a').attr('href');
});