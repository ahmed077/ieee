$('#addImage').on('click', function () {
    var newInput = $('#mainInput').clone();
    newInput.attr('id','').children('input').val("").attr('name', 'image_' + ($('input[type=file]').length + 1));
    $("#mainInput").after(newInput);
});
$('#gallery-form').on('submit', function (e) {
    var x = true;
    $('input[type=file]').each(function (i, elem) {
        if(!$(elem).val()) {
            if ($(elem).parent()[0].id !== 'mainInput') {
                $(elem).parent().remove();
            }
        }
    }).each(function(i,elem) {
        if($(elem)[0].files.length === 0) {
            x = false;
            alert("You Must Upload Atleast 1 Image.");
        }
    });
    return x;
});