$(function () {
    $('#modal_cambiar_contrasena').on('hidden.bs.modal', () => {
        $('#current-password').val(null);
        $('#new-password').val(null);
        $('#new-password-confirm').val(null);
    });
    $('#btn-change-password').on('click', onChangePassword);
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
    });
}
