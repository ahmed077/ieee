$('#o-committees > li > span').on('click', function () {
    $(this).parent().children('ul').hasClass('acc-open') ? null : $('.acc-open', $(this).parent().parent()).slideUp().removeClass('acc-open');
    $(this).parent().children('ul').addClass('acc-open').slideToggle();
})


$('#o-committees > li > i').on('click', function () {
    $(this).parent().children('ul').hasClass('acc-open') ? null : $('.acc-open', $(this).parent().parent()).slideUp().removeClass('acc-open');
    $(this).parent().children('ul').addClass('acc-open').slideToggle();
})