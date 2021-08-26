window.onload = function () {
    let header = document.getElementById('encabezado');
    let menu = document.querySelector('.sidebar-menu');
    menu.children[2].classList.add('active');
    menu.children[2].children[1].children[1].classList.add('c-yellow');
    header.textContent = 'Panel INBound';
};

$(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const initialDate = urlParams.get('initial_date');
    const finalDate = urlParams.get('final_date');

    var start =
        initialDate == null
            ? moment().subtract(4, 'days')
            : moment(initialDate);
    var end = finalDate == null ? moment() : moment(finalDate);

    function cb(start, end, refresh = true) {
        $('#reportrange_panel_in span').html(
            start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
        );
        if (refresh) {
            location.replace(
                location.protocol +
                    '//' +
                    location.host +
                    location.pathname +
                    '?initial_date=' +
                    start.format('YYYY-MM-DD') +
                    '&final_date=' +
                    end.format('YYYY-MM-DD')
            );
        }
    }
    $('#reportrange_panel_in').daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Hoy: [moment(), moment()],
            },
        },
        cb
    );
    cb(start, end, false);
});
