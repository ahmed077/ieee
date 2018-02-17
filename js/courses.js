/*global $ */
$(".certificate").mouseenter(function () {
    "use strict";
    $(":submit").css("background-color", "#004296");
});
$(".certificate").mouseleave(function () {
    "use strict";
    $(":submit").css("background-color", "#F58C04");
});

$("form").submit(function (e) {
    "use strict";
    var str = $("#serial").val(),
        patt = new RegExp(/[^A-Za-z0-9]+/g),
        res = patt.test(str);
    if (res || str === '') {
        e.preventDefault();
        $(".warning").removeClass('hide');
    } else {
        $(".warning").addClass('hide');
    }
});