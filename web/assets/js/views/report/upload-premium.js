$(function () {
    $('#file-input').on('change', () => {
        fileValidation(
            /(\.xls|\.xlsx)$/i,
            document.getElementById('file-input'),
            document.getElementById('file-input-label'),
            () => {
                $('#btn-upload-file').prop('disabled', false);
            },
            () => {
                $('#btn-upload-file').prop('disabled', true);
            }
        );
    });
    $('#btn-upload-file').prop('disabled', true);
    $('#btn-upload-file').on('click', uploadReport);
});

function uploadReport(e) {
    e.preventDefault();
    if ($('#campaign-id').val() == undefined) {
        showAlert('error', 'Seleccione la campaña primero');
    } else if (document.getElementById('file-input').files.length > 0) {
        var data = new FormData();
        data.append('file', document.getElementById('file-input').files[0]);
        data.append('CampaignForm[campaignId]', $('#campaign-id').val());
        showPreloader();
        $.ajax({
            url: '/report/upload-premium-file',
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: (response) => {
                clearFileInput(
                    document.getElementById('file-input'),
                    document.getElementById('file-input-label')
                );
                showAlert('success', '¡Tu reporte se ha cargado con éxito!');
            },
            error: (jqXHR, textStatus, errorThrown) => {
                if (jqXHR.status == 400) {
                    showAlert('error', jqXHR.responseJSON.message);
                } else {
                    showAlert(
                        'error',
                        'Ocurrió un problema al cargar el archivo de reportes.'
                    );
                }
                clearFileInput(
                    document.getElementById('file-input'),
                    document.getElementById('file-input-label')
                );
            },
            complete: function () {
                hidePreloader();
            },
        });
    } else {
        showAlert('error', 'Selecciona un archivo para cargar.');
    }
}
