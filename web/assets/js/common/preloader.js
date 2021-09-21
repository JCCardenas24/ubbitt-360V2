function showPreloader() {
    $('#loading_content').modal('show');
}

function hidePreloader() {
    setInterval(() => {
        $('#loading_content').modal('hide');
    }, 500);
}
