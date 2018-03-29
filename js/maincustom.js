$('.deleteCheck').on('click', function (e) {
    var btn = $(this);
    e.preventDefault();
    $('.alert-box').removeClass('hidden');
    $('.alert-box .cancelDelete').on('click', function () {
        $('.alert-box').addClass('hidden');
    });
    $('.alert-box .confirmDelete').on('click', function () {
        window.location.href = btn[0].href;
    });
});
$('#edit-event-form, #edit-news-form').on('submit', function () {
    var x = confirm("Are you sure you want to edit the event?");
    return x;
});