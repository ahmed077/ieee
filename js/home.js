(function () {
    var flagscroll=true;
    $(window).scroll(function(){
        var windowHeight = window.innerHeight;
        var windowScrollY = window.scrollY;
        var windowScroll = windowScrollY + windowHeight;
        var y = $('.home-count').offset().top;
        var dur = 4000;
        if(  windowScroll > y && flagscroll==true ) {
            flagscroll=false;
            $('.home-count').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: dur,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        }
        if (windowScrollY + windowHeight < y) {
            flagscroll = true;
        }
    });
})();