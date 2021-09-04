$(function () {
    $('#toast-alert').on('hide.bs.toast', () => {
        let toast = $('#toast-alert');
        toast.removeClass('success');
        toast.removeClass('warning');
        toast.find('.toast-body > p').text(null);
    });
});

function showAlert(type, message) {
    let toast = $('#toast-alert');
    toast.addClass(getTostClass(type));
    toast.find('.toast-body > p').text(message);
    toast.toast('show');
}

function getTostClass(type) {
    let toastClass = '';
    switch (type) {
        case 'success':
            toastClass = 'success';
            break;
        case 'error':
            toastClass = 'warning';
            break;
        default:
            toastClass = '';
            break;
    }
    return toastClass;
}
