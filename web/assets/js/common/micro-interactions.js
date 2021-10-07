// Upload file report
$('.upload_file_report').click(function () {
    $('.view_upload_report_form').toggle();
    $('.reports_info_contents').toggle();
    $('#toast_report_uploaded_successfully').toast('show');
});

// Show upload report form
$('.upload_report_btn').click(function () {
    $('.reports_info_contents').toggle();
    $('.view_upload_report_form').toggle();
});

// Cancel upload report form
$('.cancel_upload_report').click(function () {
    $('.form_upload_file')[0].reset();
    $('.upload-wrapper').removeClass('success');
    $('#file-upload-name').html('');
    $('.view_upload_report_form').toggle();
    $('.reports_info_contents').toggle();
});

//Open modal msg exito
$('.btn_send_file').click(function (event) {
    event.preventDefault();
    $('.carga_exito_modal').modal('show');
});

//Close msg and redirect
$('.btn_close_file_uploaded').click(function (event) {
    event.preventDefault();
    $('.form_upload_file')[0].reset();
    $('.upload-wrapper').removeClass('success');
    $('#file-upload-name').html('');
    $('.view_upload_report_form').toggle();
    $('.reports_info_contents').toggle();
});

// Check radio button to display selected chart
$("input[name='selected_chart']").on('click', function () {
    $('.chart_actual').toggle(this.value === 'false' && this.checked);
    $('.chart_forecast').toggle(this.value === 'true' && this.checked);
    stackedChartForecast.resize();
});

// from tab menu to side menu
$('.level-three .nav-link').on('shown.bs.tab', function (event) {
    let current_href = $(this).attr('href');
    let create_id = current_href.substring(1) + '_side_menu';

    $('.side-menu-link-redirect').removeClass('font-weight-bold');
    $('#' + create_id).addClass('font-weight-bold');
});

//href nav tabs
// Javascript to enable link to tab

let hash = location.hash.replace(/^#/, ''); // ^ means starting, meaning only match the first hash

if (hash) {
    $('a[href="#' + hash + '"]').tab('show');
}

// Href fron side-nav to tabs-menu
$('.side-menu-link-redirect').click(function () {
    let current_href = $(this).attr('href');
    $('a[href="' + current_href + '"]').tab('show');
});

$('#upload-file').change(function () {
    var filename = $(this).val().split('\\').pop();
    $('#file-upload-name').html(filename);
    console.log(filename);
    if (filename != '') {
        setTimeout(function () {
            $('.upload-wrapper').addClass('uploaded');
        }, 600);
        setTimeout(function () {
            $('.upload-wrapper').removeClass('uploaded');
            $('.upload-wrapper').addClass('success');
            $('.btn_send_file').attr('aria-disabled', 'false');
            $('.btn_send_file').removeClass('disabled');
        }, 1600);
    }
});

function inc(element) {
    let el = document.querySelector(`[name="${element}"]`);
    el.value = parseInt(el.value) + 1;
}

function dec(element) {
    let el = document.querySelector(`[name="${element}"]`);
    if (parseInt(el.value) > 0) {
        el.value = parseInt(el.value) - 1;
    }
}

// Mask money input
$('.currency').maskMoney({
    suffix: '$',
    thousands: ',',
    decimal: '.',
    allowZero: true,
});
