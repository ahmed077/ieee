/*global $*/
document.body.onload = function () {
    "use strict";
    var EventForm = $('#megaReg');
    EventForm.on('submit', function (e) {
        e.preventDefault();
        formValidation(e, e.target);

    });

// Validates that the input string is a valid date formatted as "mm/dd/yyyy"
    function formValidation(e, F) {
        var errorInputs = validateInputs(F.id),
            errorDate = isValidDate(F.id),
            errorSelect = checkSelect(F.id);
        if (!errorDate) {
            $('#' + F.id + ' input[name="date"]').addClass('error');
        } else {
            $('#' + F.id + ' input[name="date"]').removeClass('error');
        }
        console.log(errorInputs);
        if (errorInputs || !errorDate || errorSelect) {
            console.log('error');
            e.preventDefault();
        } else {
            // prompt('success');
        }
    }

    function isValidDate(Form) {
        var dateString = $('#' + Form + ' input[name="date"]').val();
        // First check for the pattern
        if (!(/^\d{1,2}\/\d{1,2}\/\d{4}$/).test(dateString)) {
            return false;
        }

        // Parse the date parts to integers
        var parts = dateString.split("/"),
            day = parseInt(parts[1], 10),
            month = parseInt(parts[0], 10),
            year = parseInt(parts[2], 10);

        // Check the ranges of month and year
        if (year < 1000 || year > 3000 || month == 0 || month > 12) {
            return false;
        }

        var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        // Adjust for leap years
        if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
            monthLength[1] = 29;

        // Check the range of the day
        return day > 0 && day <= monthLength[month - 1];
    };

    function validateInputs(Form) {
        var error = false;
        $('input[type="text"], input[type="email"], textarea', $('#' + Form)).each(function () {
            var input = $(this),
                regEx = input.data('check'),
                v = input.val();
            if (v === '' || v.match(regEx)) {
                console.log(input);
                console.log(v.match(regEx));
                input.addClass('error');
                error = true;
            } else {
                input.removeClass('error');
            }
        });
        // console.log($('input[type="text"], input[type="email"], textarea', $('#' + Form)));
        return error;
    }

    function checkSelect(Form) {
        var selectBox = $('#' + Form + '  select');
        var error = false;
        selectBox.each(function () {
            if ($(this).val() === null) {
                $(this).addClass('error');
                error = true;
                return true;
            } else {
                $(this).removeClass('error');
            }
        });
        return error;
            // if (selectBox.val() === '') {
            //     selectBox.addClass('error');
            //     return true;
            // } else {
            //     selectBox.removeClass('error');
            //     return false;
            // }
        }
    };
