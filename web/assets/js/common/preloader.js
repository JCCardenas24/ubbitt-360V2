function showPreloader() {
    $('#loading_content').modal('show');
}

function hidePreloader() {
    setTimeout(() => {
        $('#loading_content').modal('hide');
    }, 500);
}
