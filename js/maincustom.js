$('.deleteCheck, .editCheck').on('click', function (e) {
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