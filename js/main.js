(function ($) {
 "use strict";
  
	var $tabs = $('.nav-year li');
	var flagscroll=true;
	
    $(window).scroll(function(){
        var windowHeight = window.innerHeight;
        var windowScrollY = window.scrollY;
        var windowScroll = windowScrollY + windowHeight;
//        var windowScroll = $(window).scrollTop() + $(window).innerHeight();
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
//        setTimeout(function() {
//            flagscroll = true;
//        }, dur);
	});
    
    var previous = null;
    $('.board-17 img, .counselor img').on('mouseenter', function(e) {
        if(window.innerWidth > 991){
            if (!e.target.hasAttribute('data-target')) {
                var t = $(e.target.parentElement),
                    i;
                $('.board-17').each(function() {
                    if (this === t[0]) {
                        i = $(this).index();
                    }
                });
                changeImages('.sided', i);
            } else {
                changeImages('.top');
            }
        }
        
    });
    
    $('.board-17 img, .counselor img').on('mouseleave', resetImages);
//    Reset Images Back To Normal
    function resetImages() {
        var other = (previous == '.sided') ? '.top' : '.sided';
        $('.board-17 ' + previous).each(function () {
            $(this).addClass('hidden').siblings('img').not(previous).not(other).removeClass('hidden');
        });
        $('.board-17 .rightSide, .board-17 .leftSide').each(function() {
            ($(this).hasClass('rightSide')) ? $(this).removeClass('rightSide') : $(this).removeClass('leftSide');
        });
    }
    //Switch Images Function
    function changeImages(next, cur = null) {
        if (cur !== null) {
            var exclude = $('.board-17').filter($('.board-17').eq(cur))[0];
        }
        
        $('.board-17').not($(exclude)).children('img').not('.hidden').addClass('hidden').siblings(next).removeClass('hidden');
        previous = next;
        
        if (cur) {
            $('.board-17').each(function() {
                $(this).index() < cur ? 
                    $('img', $(this)).not('.hidden').addClass('rightSide') : 
                $('img', $(this)).not('.hidden').addClass('leftSide');
            });
        }
    }
    
	$('.about-count').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
			}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});

    //membership buttons
    function removeClass(elem, cls) {
    'use strict';
    var classes = elem.className,
        start = classes.search(cls),
        end = cls.length,
        a = classes.substring(0, start),
        b = classes.substring(a.length + end);
    elem.className = a.concat(b).trim();
    return elem;
}
    var graduated = document.getElementById("Graduated"),
        underGraduate = document.getElementById("Undergraduate"),
        graduatedBtn = document.getElementById("btn-right"),
        underGraduateBtn = document.getElementById("btn-left");
    
    underGraduateBtn.onclick = function(){
        'use strict';
        graduated.className += " hide";
        $(underGraduate).removeClass("hide");
        $(underGraduateBtn).removeClass("btnActive");
        underGraduateBtn.className += " btnActive";
        $(graduatedBtn).removeClass("btnActive");
    }
    
    graduatedBtn.onclick = function(){
        'use strict';
        if($(underGraduate).hasClass("hide")){
            $(underGraduate).removeClass("hide");
        }
        underGraduate.className +=" hide";
        $(graduated).removeClass("hide");
        $(graduatedBtn).removeClass("btnActive");
        graduatedBtn.className += " btnActive";
        $(underGraduateBtn).removeClass("btnActive");
        
       
        
    }
    
    
    
    
	
	$(".events-list .row > div").slice(0, 8).show();
	$(".excursions-list .row > div").slice(0, 8).show();
	$(".teachers-list .row > div").slice(0, 8).show();
	$(".gallery-list .container > .row").slice(0, 4).show();
	$(".academics-content .container > .row").slice(0, 6).show();


	$("div").on("mouseleave", function(){	
	
		if ($(this).hasClass("events-single-location")) { 
			$('.events-single-location iframe').css("pointer-events", "none"); 
		}
		
		if ($(this).hasClass("excursions-single-location")) { 
			$('.excursions-single-location iframe').css("pointer-events", "none"); 
		}
		
	  
	});
	
	$("a,section,div,span,li,input[type='text'],input[type='button'],tr,button").on("click", function(){
		
		if ($(this).hasClass("events-single-location")) { 
			$('.events-single-location iframe').css("pointer-events", "auto");
		}
		
		if ($(this).hasClass("excursions-single-location")) { 
			$('.excursions-single-location iframe').css("pointer-events", "auto");
		}
		
		if ($(this).hasClass("yr-prev")) { 
			$tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
			return false;
		}
		
		if ($(this).hasClass("yr-next")) { 
			$tabs.filter('.active').next('li').find('a[data-toggle="tab"]').tab('show');
			return false;
		}
		
		if ($(this).hasClass("events-load-more")) { 
			$(".events-list .row > div:hidden").slice(0, 4).slideDown();
			if ($(".events-list .row > div:hidden").length == 0) {
				$(".events-load-more").fadeOut('slow');
			}
			$('html,body').animate({
				scrollTop: $(this).offset().top-600
			}, 1500);
		}
		
		if ($(this).hasClass("excursions-load-more")) { 
			$(".excursions-list .row > div:hidden").slice(0, 4).slideDown();
			if ($(".excursions-list .row > div:hidden").length == 0) {
				$(".excursions-load-more").fadeOut('slow');
			}
			$('html,body').animate({
				scrollTop: $(this).offset().top-600
			}, 1500);
		}
		
		if ($(this).hasClass("teachers-load-more")) { 
			$(".teachers-list .row > div:hidden").slice(0, 4).slideDown();
			if ($(".teachers-list .row > div:hidden").length == 0) {
				$(".teachers-load-more").fadeOut('slow');
			}
			$('html,body').animate({
				scrollTop: $(this).offset().top-600
			}, 1500);
		}
		
		if ($(this).hasClass("gallery-load-more")) { 
			$(".gallery-list .container > .row:hidden").slice(0, 1).slideDown();
			if ($(".gallery-list .container > .row:hidden").length == 0) {
				$(".gallery-load-more").fadeOut('slow');
			}
			$('html,body').animate({
				scrollTop: $(this).offset().top-200
			}, 1500);
		}
		
		if ($(this).hasClass("academics-load-more")) { 
			$(".academics-content .container > .row:hidden").slice(0, 6).slideDown();
			if ($(".academics-content .container > .row:hidden").length == 0) {
				$(".academics-load-more").fadeOut('slow');
			}
			$('html,body').animate({
				scrollTop: $(this).offset().top-1100
			}, 1500);
		}
		
		if ($(this).hasClass("closecanvas")) { 
			$("body").removeClass("offcanvas-stop-scrolling");
		}
		
		
	});
	
	 $('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		todayHighlight: true,
		autoclose: true
	});

	$('.skillbar').each(function(){
		$(this).find('.skillbar-bar').animate({
			width:$(this).attr('data-percent')
		},2000);
	});
	  
})(jQuery);
