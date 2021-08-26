$(function() {
    const urlParams = new URLSearchParams(window.location.search);
    const initialDate = urlParams.get('initial_date');
    const finalDate = urlParams.get('final_date');

    var start =
        initialDate == null ?
        moment().subtract(4, 'days') :
        moment(initialDate);
    var end = finalDate == null ? moment() : moment(finalDate);

    function cb(start, end, refresh = true) {
        $('.range-pick span').html(
            start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
        );
        // if (refresh) {
        //     location.replace(
        //         location.protocol +
        //             '//' +
        //             location.host +
        //             location.pathname +
        //             '?initial_date=' +
        //             start.format('YYYY-MM-DD') +
        //             '&final_date=' +
        //             end.format('YYYY-MM-DD')
        //     );
        // }
    }
    $('.range-pick').daterangepicker({
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