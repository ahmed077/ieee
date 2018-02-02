document.body.onload = function () {
    var EventForm = $('#event-form');
    EventForm.on('submit', function (e) {
        formValidation(e, e.target);

    });
// Validates that the input string is a valid date formatted as "mm/dd/yyyy"
function formValidation (e, F) {
    var errorInputs = validateInputs(F.id),
        errorDate = isValidDate(F.id),
        errorSelect = checkSelect(F.id);
        errorImages = checkImages(F.id);
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
function checkImages(Form) {
    var error = false;
    if(document.getElementById(Form)['event_image'].files.length === 0) {
        error = true;
        console.log('image Error');
    } else {
        console.log('image no error');
    }
    return error;
}
function isValidDate(Form) {
    var dateString = $('#' + Form + ' input[name="date"]').val();
    // First check for the pattern
    if(!(/^\d{1,2}\/\d{1,2}\/\d{4}$/).test(dateString)) {
        return false;
    }

    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[1], 10);
    var month = parseInt(parts[0], 10);
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12) {
        return false;
    }

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
};
function validateInputs(Form) {
    var error = false;
    $('input[type="text"]:not([name="date"]), textarea', $('#' + Form)).each(function () {
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
    return error;
}
function checkSelect(Form) {
    var selectBox = $('#' + Form + '  select');
    if (selectBox.val() === '') {
        selectBox.addClass('error');
        return true;
    } else {
        selectBox.removeClass('error');
        return false;
    }
}

//Add New fields for speakers and their images
    var addSpeaker = $('#addSpeaker');
    addSpeaker.on('click', function () {
        var speakers = $('.speakers');
        var inputs = speakers.eq(0).children('input');
        var type = ['name', 'image'];
        if (speakers.eq(0).children('input').length < 5) {
            for (var i = 0; i < speakers.length; i++) {
                var child = speakers.eq(i).children('input');
                speakers.eq(i).append(child.eq(0).clone().val("").attr('name', 'speaker_' + type[i] + '_' + (child.length + 1)));
            }
        }
    });

};


// file extension check
var validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
function ValidateSingleInput(fileInput) {
    if (fileInput.type == "file") {
        var sFileName = fileInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < validFileExtensions.length; j++) {
                var sCurExtension = validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + validFileExtensions.join(", "));
                fileInput.value = "";
                return false;
            }
        }
    }
    return true;
}