/*global $*/
$("form").submit(function (e) {
    "use strict";
    var name = $("#name").val(),
        faculty = $("#Faculty").val(),
        semester = $("#Semester").val(),
        mail = $("#mail").val(),
        profile = $("#profile").val(),
        Mobile = $("#Mobile").val(),
        patt1 = new RegExp(/[^A-Za-z0-9]+/g),
        patt2 = new RegExp(/[^A-Za-z]+/g),
        patt3 = new RegExp(/[^0-9]+/g),
        patt4 = new RegExp(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/g),
        nameTest = patt2.test(name),
        facultyTest = patt2.test(faculty),
        semesterTest = patt3.test(semester),
        mailTest = patt4.test(mail),
        profileTest = patt1.test(profile),
        mobileTest = patt3.test(Mobile);
    // if (nameTest || name === '') {
    //     e.preventDefault();
    // }
    // if (facultyTest || faculty === '') {
    //     e.preventDefault();
    // }
    // if (semesterTest || semester === '') {
    //     e.preventDefault();
    // }
    // if (mailTest || mail === '') {
    //     e.preventDefault();
    // }
    // if (profileTest || profile === '') {
    //     e.preventDefault();
    // }
    // if (mobileTest || Mobile === '') {
    //     e.preventDefault();
    // }
});