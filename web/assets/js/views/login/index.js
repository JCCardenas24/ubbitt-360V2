$('#btn_go_to_recover').click(function () {
    $('#login_container').toggle();
    $('#recovery_psw_container').toggle();
});
$('.send_request_email, .cancel_request_email').click(function () {
    $('#recovery_psw_container').toggle();
    $('#login_container').toggle();
});
