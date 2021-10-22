$(function () {
    $('#modal_cambiar_contrasena').on('hidden.bs.modal', () => {
        $('#current-password').val(null);
        $('#new-password').val(null);
        $('#new-password-confirm').val(null);
    });
    $('#btn-change-password').on('click', onChangePassword);
    $('#modal_cambiar_email').on('hidden.bs.modal', () => {
        $('#new-email').val($('#new-email').val());
    });
    $('#btn-change-email').on('click', onChangeEmail);
});

function onChangePassword() {
    let currentPassword = $('#current-password').val();
    let newPassword = $('#new-password').val();
    let newPasswordConfirm = $('#new-password-confirm').val();
    if (newPassword == newPasswordConfirm) {
        changePassword(currentPassword, newPassword);
    } else {
        showAlert(
            'error',
            'La contraseña nueva no coincide con la confirmación.'
        );
    }
}

function changePassword(currentPassword, newPassword) {
    showPreloader();
    $.ajax({
        url: '/account/update-password',
        type: 'POST',
        dataType: 'json',
        data: {
            'ChangePassword[currentPassword]': currentPassword,
            'ChangePassword[newPassword]': newPassword,
        },
        success: (response) => {
            $('#modal_cambiar_contrasena').modal('hide');
            showAlert('success', '¡Tu contraseña se ha cambiado con éxito!');
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
        complete: function () {
            hidePreloader();
        },
    });
}

function onChangeEmail() {
    let newEmail = $('#new-email').val();
    if (newEmail != undefined && newEmail != '') {
        showPreloader();
        $.ajax({
            url: '/account/update-email',
            type: 'POST',
            dataType: 'json',
            data: {
                'ChangeEmail[newEmail]': newEmail,
            },
            success: (response) => {
                $('#modal_cambiar_email').modal('hide');
                $('#email').val(newEmail);
                showAlert('success', '¡Tu email se ha actualizado con éxito!');
            },
            error: (jqXHR, textStatus, errorThrown) => {
                if (jqXHR.status == 400) {
                    showAlert('error', jqXHR.responseJSON.message);
                } else {
                    showAlert(
                        'error',
                        'Ocurrió un problema al actualizar tu email.'
                    );
                }
            },
            complete: function () {
                hidePreloader();
            },
        });
    } else {
        showAlert('error', 'El email no puede estar vacío.');
    }
}
