$(() => {
    $('#submit-reset-password-form').on('click', (e) => {
        e.preventDefault();
        onResetPassword();
    });
});

function onResetPassword() {
    let password = $('#password').val();
    let password_confirm = $('#password_confirm').val();
    if (password.length > 0) {
        if (password_confirm.length > 0) {
            resetPassword(password);
        } else {
            showAlert(
                'error',
                'Ingresa la confirmación del password para continuar.'
            );
        }
    } else {
        showAlert('error', 'Ingresa el password para continuar.');
    }
}

function resetPassword(password) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    $.ajax({
        url: '/password-reset/update-password',
        type: 'POST',
        dataType: 'json',
        data: {
            'GeneratePasswordForm[password]': password,
            'GeneratePasswordForm[token]': urlParams.get('token'),
        },
        success: (response) => {
            showAlert(
                'success',
                '¡Tu contraseña se ha cambiado con éxito! Enseguida serás redireccionado automáticamente al login'
            );
            setInterval(() => {
                window.location.replace('/login/index');
            }, 3000);
        },
        error: (jqXHR, textStatus, errorThrown) => {
            if (jqXHR.status == 400) {
                showAlert('error', jqXHR.responseJSON.message);
            } else {
                showAlert(
                    'error',
                    'Ocurrió un problema al cambiar tu contraseña.'
                );
            }
        },
    });
}
