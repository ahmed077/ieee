/*global $*/
$("#membershipS").on("click", function () {
    "use strict";
    var x = $("#membershipS").val();
    if (x === "Member") {
        $(".membershipid").removeClass("hide");
    } else {
        $(".membershipid").addClass("hide");
    }
});