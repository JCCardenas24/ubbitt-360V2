let dateRangePickerConfig = null;
let startDate = null;
let endDate = null;

$(function () {
    $('#resumen-cobranza_side_menu').addClass('font-weight-bold');
    const urlParams = new URLSearchParams(window.location.search);
    const initialDate = urlParams.get('initial_date');
    const finalDate = urlParams.get('final_date');

    startDate =
        initialDate == null
            ? moment().subtract(6, 'days')
            : moment(initialDate);
    endDate = finalDate == null ? moment() : moment(finalDate);

    dateRangePickerConfig = {
        showDropdowns: true,
        startDate,
        endDate,
        ranges: {
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        },
        locale: {
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            customRangeLabel: 'Personalizado',
        },
    };

    $('.range-pick#beyond-collection-summary-date-range').daterangepicker(
        dateRangePickerConfig,
        summaryCallback
    );
    summaryCallback(startDate, endDate);

    $('#management-selector').on('change', updateKpisByManagement);

    let initialChartKpis = {
        on_track_registries_total: 0,
        collected_total: 0,
    };
    updateConcentrateOnTrackGraph(initialChartKpis);
});

/** TAB CHANGE EVENTS  **/
$('#resumen-cobranza-tab').on('shown.bs.tab', function (event) {});
$('#beyond-cobranza-callcenter-tab').on('shown.bs.tab', function (event) {
    // Initialize the date picker on the call center kpi's tab
    $('.range-pick#beyond-kpis-date-range').daterangepicker(
        dateRangePickerConfig,
        loadKpis
    );
    loadKpis(startDate, endDate);
});
$('#beyond-cobranza-callcenter-bd-tab').on('shown.bs.tab', function (event) {
    // Initialize the date picker on the call center calls database tab
    $('.range-pick#beyond-calls-database-date-range').daterangepicker(
        dateRangePickerConfig,
        callDatabaseCallback
    );
    callDatabaseCallback(startDate, endDate, null, 1);
});
$('#beyond-cobranza-reportes-tab, .nav-link-beyond-collection-reports').on(
    'shown.bs.tab',
    function (event) {
        var tab_report_type = $(
            '.nav-link-beyond-collection-reports.active'
        ).data('tab-type');
        $('#type-file').val(tab_report_type);
        // Initialize the date picker on the call center kpi's tab
        $('.range-pick#beyond-collection-report-date-range').daterangepicker(
            dateRangePickerConfig,
            reportsListCallback
        );
        reportsListCallback(startDate, endDate, null, 1);
        showHideAddButton(tab_report_type);
    }
);

function showHideAddButton(reportType) {
    if (userHasPermission(reportType + '-add')) {
        $('#upload_report_btn').show();
    } else {
        $('#upload_report_btn').hide();
    }
}

function userHasPermission(checkedPermission) {
    let requiredPermission = permissionsMap[checkedPermission];
    return userPermissions.indexOf(requiredPermission) > -1;
}

$('#beyond-cobranza-carga-base-datos-tab').on(
    'shown.bs.tab',
    function (event) {}
);

// Show upload report form
$('#upload_report_btn').click(function () {
    $('#reports_info_contents').toggle();
    $('#view_upload_report_form').toggle();
});
// Cancel upload report form
$('#cancel_upload_report').click(function () {
    $('#view_upload_report_form').toggle();
    $('#reports_info_contents').toggle();
});

function summaryCallback(start, end) {
    $('.range-pick#beyond-collection-summary-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    $('#loading_content').modal('show');
    findSummaryGraphData(start, end);
    findSummaryDetailData(start, end);
}

function findSummaryGraphData(start, end) {
    $.ajax({
        url: '/ubbitt-beyond/find-collection-summary-graph-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (response) => {
            updateTransactionChart(response);
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del gráfico de transacciones'
            );
        },
    });
}

function updateTransactionChart(data) {
    let stackedChart = echarts.init(document.getElementById('stacked-line'));
    let option = {
        grid: {
            left: '1%',
            right: '2%',
            bottom: '3%',
            containLabel: true,
        },
        tooltip: {
            trigger: 'axis',
        },
        // Add legend
        legend: {
            data: ['Registros', 'Llamadas', 'Cobrados'],
        },

        // Add custom colors
        color: ['#47d182', '#211a19', '#ff6f61', '#ffd800'],

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [
            {
                type: 'category',
                boundaryGap: false,
                data: data.map((row) => row.date),
            },
        ],

        // Vertical axis
        yAxis: [
            {
                type: 'value',
            },
        ],

        // Add series
        series: [
            {
                name: 'Registros',
                type: 'line',
                stack: 'Total',
                data: data.map((row) => row.registries),
            },
            {
                name: 'Llamadas',
                type: 'line',
                stack: 'Total',
                data: data.map((row) => row.calls),
            },
            {
                name: 'Cobrados',
                type: 'line',
                stack: 'Total',
                data: data.map((row) => row.collected),
            },
        ],
        lineStyle: {
            width: 10,
        },
    };
    stackedChart.setOption(option);
}

var savedKpis = [];
function findSummaryDetailData(start, end) {
    $.ajax({
        url: '/ubbitt-beyond/find-collection-summary-detail-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (kpis) => {
            var moneyFormatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
            });
            updateManagementSummaryKpis(kpis, moneyFormatter);
            updateTotalKpis(kpis, moneyFormatter);
            savedKpis = addAllManagement(kpis);
            updateKpisByManagement();
            updateConcentrateKpis(kpis, moneyFormatter);
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del resumen'
            );
        },
        complete: function () {
            $('#loading_content').modal('hide');
        },
    });
}

function addAllManagement(kpis) {
    kpis['all_man_det_effective_registries'] =
        parseInt(kpis.fir_man_det_effective_registries) +
        parseInt(kpis.sec_man_det_effective_registries) +
        parseInt(kpis.thir_man_det_effective_registries) +
        parseInt(kpis.four_man_det_effective_registries);
    kpis['all_man_det_effective_registries_percentage'] = (
        (parseFloat(kpis.fir_man_det_effective_registries_percentage) +
            parseFloat(kpis.sec_man_det_effective_registries_percentage) +
            parseFloat(kpis.thir_man_det_effective_registries_percentage) +
            parseFloat(kpis.four_man_det_effective_registries_percentage)) /
        4
    ).toFixed(2);
    kpis['all_man_det_effective_registries_payment_promise_scheduled'] =
        parseInt(
            kpis.fir_man_det_effective_registries_payment_promise_scheduled
        ) +
        parseInt(
            kpis.sec_man_det_effective_registries_payment_promise_scheduled
        ) +
        parseInt(
            kpis.thir_man_det_effective_registries_payment_promise_scheduled
        ) +
        parseInt(
            kpis.four_man_det_effective_registries_payment_promise_scheduled
        );
    kpis['all_man_det_effective_registries_online_payment'] =
        parseInt(kpis.fir_man_det_effective_registries_online_payment) +
        parseInt(kpis.sec_man_det_effective_registries_online_payment) +
        parseInt(kpis.thir_man_det_effective_registries_online_payment) +
        parseInt(kpis.four_man_det_effective_registries_online_payment);
    kpis['all_man_det_effective_registries_new_policy_accepted'] =
        parseInt(kpis.fir_man_det_effective_registries_new_policy_accepted) +
        parseInt(kpis.sec_man_det_effective_registries_new_policy_accepted) +
        parseInt(kpis.thir_man_det_effective_registries_new_policy_accepted) +
        parseInt(kpis.four_man_det_effective_registries_new_policy_accepted);
    kpis['all_man_det_effective_registries_accepted_direct_debit_payment'] =
        parseInt(
            kpis.fir_man_det_effective_registries_accepted_direct_debit_payment
        ) +
        parseInt(
            kpis.sec_man_det_effective_registries_accepted_direct_debit_payment
        ) +
        parseInt(
            kpis.thir_man_det_effective_registries_accepted_direct_debit_payment
        ) +
        parseInt(
            kpis.four_man_det_effective_registries_accepted_direct_debit_payment
        );
    kpis['all_man_det_effective_registries_deposit_slip_sent'] =
        parseInt(kpis.fir_man_det_effective_registries_deposit_slip_sent) +
        parseInt(kpis.sec_man_det_effective_registries_deposit_slip_sent) +
        parseInt(kpis.thir_man_det_effective_registries_deposit_slip_sent) +
        parseInt(kpis.four_man_det_effective_registries_deposit_slip_sent);
    kpis['all_man_det_on_track_registries'] =
        parseInt(kpis.fir_man_det_on_track_registries) +
        parseInt(kpis.sec_man_det_on_track_registries) +
        parseInt(kpis.thir_man_det_on_track_registries) +
        parseInt(kpis.four_man_det_on_track_registries);
    kpis['all_man_det_on_track_registries_percentage'] = (
        (parseFloat(kpis.fir_man_det_on_track_registries_percentage) +
            parseFloat(kpis.sec_man_det_on_track_registries_percentage) +
            parseFloat(kpis.thir_man_det_on_track_registries_percentage) +
            parseFloat(kpis.four_man_det_on_track_registries_percentage)) /
        4
    ).toFixed(2);
    kpis['all_man_det_on_track_registries_call_scheduled'] =
        parseInt(kpis.fir_man_det_on_track_registries_call_scheduled) +
        parseInt(kpis.sec_man_det_on_track_registries_call_scheduled) +
        parseInt(kpis.thir_man_det_on_track_registries_call_scheduled) +
        parseInt(kpis.four_man_det_on_track_registries_call_scheduled);
    kpis['all_man_det_on_track_registries_does_not_answer'] =
        parseInt(kpis.fir_man_det_on_track_registries_does_not_answer) +
        parseInt(kpis.sec_man_det_on_track_registries_does_not_answer) +
        parseInt(kpis.thir_man_det_on_track_registries_does_not_answer) +
        parseInt(kpis.four_man_det_on_track_registries_does_not_answer);
    kpis['all_man_det_on_track_registries_voice_mail'] =
        parseInt(kpis.fir_man_det_on_track_registries_voice_mail) +
        parseInt(kpis.sec_man_det_on_track_registries_voice_mail) +
        parseInt(kpis.thir_man_det_on_track_registries_voice_mail) +
        parseInt(kpis.four_man_det_on_track_registries_voice_mail);
    kpis['all_man_det_out_of_management_registries'] =
        parseInt(kpis.fir_man_det_out_of_management_registries) +
        parseInt(kpis.sec_man_det_out_of_management_registries) +
        parseInt(kpis.thir_man_det_out_of_management_registries) +
        parseInt(kpis.four_man_det_out_of_management_registries);
    kpis['all_man_det_out_of_management_registries_percentage'] = (
        (parseFloat(kpis.fir_man_det_out_of_management_registries_percentage) +
            parseFloat(
                kpis.sec_man_det_out_of_management_registries_percentage
            ) +
            parseFloat(
                kpis.thir_man_det_out_of_management_registries_percentage
            ) +
            parseFloat(
                kpis.four_man_det_out_of_management_registries_percentage
            )) /
        4
    ).toFixed(2);
    kpis['all_man_det_out_of_management_registries_wrong_number'] =
        parseInt(kpis.fir_man_det_out_of_management_registries_wrong_number) +
        parseInt(kpis.sec_man_det_out_of_management_registries_wrong_number) +
        parseInt(kpis.thir_man_det_out_of_management_registries_wrong_number) +
        parseInt(kpis.four_man_det_out_of_management_registries_wrong_number);
    kpis['all_man_det_out_of_management_registries_policy_cancelled'] =
        parseInt(
            kpis.fir_man_det_out_of_management_registries_policy_cancelled
        ) +
        parseInt(
            kpis.sec_man_det_out_of_management_registries_policy_cancelled
        ) +
        parseInt(
            kpis.thir_man_det_out_of_management_registries_policy_cancelled
        ) +
        parseInt(
            kpis.four_man_det_out_of_management_registries_policy_cancelled
        );
    kpis['all_man_det_out_of_management_registries_does_not_answer'] =
        parseInt(
            kpis.fir_man_det_out_of_management_registries_does_not_answer
        ) +
        parseInt(
            kpis.sec_man_det_out_of_management_registries_does_not_answer
        ) +
        parseInt(
            kpis.thir_man_det_out_of_management_registries_does_not_answer
        ) +
        parseInt(
            kpis.four_man_det_out_of_management_registries_does_not_answer
        );
    kpis['all_man_det_out_of_management_registries_complaint'] =
        parseInt(kpis.fir_man_det_out_of_management_registries_complaint) +
        parseInt(kpis.sec_man_det_out_of_management_registries_complaint) +
        parseInt(kpis.thir_man_det_out_of_management_registries_complaint) +
        parseInt(kpis.four_man_det_out_of_management_registries_complaint);
    kpis['all_man_det_out_of_management_registries_not_manageable'] =
        parseInt(kpis.fir_man_det_out_of_management_registries_not_manageable) +
        parseInt(kpis.sec_man_det_out_of_management_registries_not_manageable) +
        parseInt(
            kpis.thir_man_det_out_of_management_registries_not_manageable
        ) +
        parseInt(kpis.four_man_det_out_of_management_registries_not_manageable);
    kpis['all_man_det_out_of_management_registries_lost_registry'] =
        parseInt(kpis.fir_man_det_out_of_management_registries_lost_registry) +
        parseInt(kpis.sec_man_det_out_of_management_registries_lost_registry) +
        parseInt(kpis.thir_man_det_out_of_management_registries_lost_registry) +
        parseInt(kpis.four_man_det_out_of_management_registries_lost_registry);
    return kpis;
}

function updateManagementSummaryKpis(kpis, moneyFormatter) {
    $('#delivered-base').text(kpis.delivered_base);
    $('#delivered-base-accepted').html(
        kpis.delivered_base_accepted +
            ' / <span>' +
            kpis.delivered_base_accepted_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#delivered-base-rejected').html(
        kpis.delivered_base_rejected +
            ' / <span>' +
            kpis.delivered_base_rejected_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#first-management').html(
        kpis.first_management +
            ' / <span>' +
            kpis.first_management_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#first-management-effective-registries').html(
        kpis.first_management_effective_registries +
            ' / <span>' +
            kpis.first_management_percentage.replace('.00', '') +
            '%</span><span class="mini_price"> (' +
            moneyFormatter
                .format(kpis.first_management_effective_registries_amount)
                .replace('.00', '') +
            ')</span>'
    );
    $('#first-management-on-track-registries').html(
        kpis.first_management_on_track_registries +
            ' / <span>' +
            kpis.first_management_on_track_registries_percentage.replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#first-management-out-of-management-registries').html(
        kpis.first_management_out_of_management_registries +
            ' / <span>' +
            kpis.first_management_out_of_management_registries_percentage.replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#second-management').html(
        kpis.second_management +
            ' / <span>' +
            kpis.second_management_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#second-management-effective-registries').html(
        kpis.second_management_effective_registries +
            ' / <span>' +
            kpis.second_management_effective_registries_percentage.replace(
                '.00',
                ''
            ) +
            '%</span><span class="mini_price"> (' +
            moneyFormatter
                .format(kpis.second_management_effective_registries_amount)
                .replace('.00', '') +
            ')</span>'
    );
    $('#second-management-on-track-registries').html(
        kpis.second_management_on_track_registries +
            ' / <span>' +
            kpis.second_management_on_track_registries_percentage.replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#second-management-out-of-management-registries').html(
        kpis.second_management_out_of_management_registries +
            ' / <span>' +
            kpis.second_management_out_of_management_registries_percentage.replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#third-management').html(
        kpis.third_management +
            ' / <span>' +
            kpis.third_management_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#third-management-effective-registries').html(
        kpis.third_management_effective_registries +
            ' / <span>' +
            kpis.third_management_percentage.replace('.00', '') +
            '%</span><span class="mini_price"> (' +
            moneyFormatter
                .format(kpis.third_management_effective_registries_amount)
                .replace('.00', '') +
            ')</span>'
    );
    $('#third-management-on-track-registries').html(
        kpis.third_management_on_track_registries +
            ' / <span>' +
            kpis.third_management_on_track_registries_percentage.replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#third-management-out-of-management-registries').html(
        kpis.third_management_out_of_management_registries +
            ' / <span>' +
            kpis.third_management_out_of_management_registries_percentage.replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
}

function updateTotalKpis(kpis, moneyFormatter) {
    $('#total-collected').text(kpis.total_collected);
    $('#conversion-percentage').text(
        kpis.conversion_percentage.replace('.00', '') + '%'
    );
    $('#collected-amount').text(
        moneyFormatter.format(kpis.collected_amount).replace('.00', '')
    );
    $('#on-track-registries').text(kpis.on_track_registries);
    $('#pending-amount').text(
        moneyFormatter.format(kpis.pending_amount).replace('.00', '')
    );
}

function updateKpisByManagement() {
    let kpisPrefix = $('#management-selector').val();
    $('#by-management-effective-registries').html(
        savedKpis[kpisPrefix + 'effective_registries'] +
            ' / <span>' +
            savedKpis[kpisPrefix + 'effective_registries_percentage'].replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#by-management-effective-registries-payment-promise-scheduled').text(
        savedKpis[kpisPrefix + 'effective_registries_payment_promise_scheduled']
    );
    updateProgressBar(
        'by-management-effective-registries-payment-promise-scheduled-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'effective_registries'],
            savedKpis[
                kpisPrefix + 'effective_registries_payment_promise_scheduled'
            ]
        )
    );
    $('#by-management-effective-registries-online-payment').text(
        savedKpis[kpisPrefix + 'effective_registries_online_payment']
    );
    updateProgressBar(
        'by-management-effective-registries-online-payment-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'effective_registries'],
            savedKpis[kpisPrefix + 'effective_registries_online_payment']
        )
    );
    $('#by-management-effective-registries-new-policy-accepted').text(
        savedKpis[kpisPrefix + 'effective_registries_new_policy_accepted']
    );
    updateProgressBar(
        'by-management-effective-registries-new-policy-accepted-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'effective_registries'],
            savedKpis[kpisPrefix + 'effective_registries_new_policy_accepted']
        )
    );
    $('#by-management-effective-registries-accepted-direct-debit-payment').text(
        savedKpis[
            kpisPrefix + 'effective_registries_accepted_direct_debit_payment'
        ]
    );
    updateProgressBar(
        'by-management-effective-registries-accepted-direct-debit-payment-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'effective_registries'],
            savedKpis[
                kpisPrefix +
                    'effective_registries_accepted_direct_debit_payment'
            ]
        )
    );
    $('#by-management-effective-registries-deposit-slip-sent').text(
        savedKpis[kpisPrefix + 'effective_registries_deposit_slip_sent']
    );
    updateProgressBar(
        'by-management-effective-registries-deposit-slip-sent-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'effective_registries'],
            savedKpis[kpisPrefix + 'effective_registries_deposit_slip_sent']
        )
    );
    /** ON TRACK **/
    $('#by-management-on-track-registries').html(
        savedKpis[kpisPrefix + 'on_track_registries'] +
            ' / <span>' +
            savedKpis[kpisPrefix + 'on_track_registries_percentage'].replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#by-management-on-track-registries-call-scheduled').text(
        savedKpis[kpisPrefix + 'on_track_registries_call_scheduled']
    );
    updateProgressBar(
        'by-management-on-track-registries-call-scheduled-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'on_track_registries'],
            savedKpis[kpisPrefix + 'on_track_registries_call_scheduled']
        )
    );
    $('#by-management-on-track-registries-does-not_answer').text(
        savedKpis[kpisPrefix + 'on_track_registries_does_not_answer']
    );
    updateProgressBar(
        'by-management-on-track-registries-does-not-answer-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'on_track_registries'],
            savedKpis[kpisPrefix + 'on_track_registries_does_not_answer']
        )
    );
    $('#by-management-on-track-registries-voice-mail').text(
        savedKpis[kpisPrefix + 'on_track_registries_voice_mail']
    );
    updateProgressBar(
        'by-management-on-track-registries-voice-mail-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'on_track_registries'],
            savedKpis[kpisPrefix + 'on_track_registries_voice_mail']
        )
    );
    /** OUT OF MANAGEMENT **/
    $('#by-management-out-of-management-registries').html(
        savedKpis[kpisPrefix + 'out_of_management_registries'] +
            ' / <span>' +
            savedKpis[
                kpisPrefix + 'out_of_management_registries_percentage'
            ].replace('.00', '') +
            '%</span>'
    );
    $('#by-management-out-of-management-registries-wrong-number').text(
        savedKpis[kpisPrefix + 'out_of_management_registries_wrong_number']
    );
    updateProgressBar(
        'by-management-out-of-management-registries-wrong-number-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'out_of_management_registries'],
            savedKpis[kpisPrefix + 'out_of_management_registries_wrong_number']
        )
    );
    $('#by-management-out-of-management-registries-policy-cancelled').text(
        savedKpis[kpisPrefix + 'out_of_management_registries_policy_cancelled']
    );
    updateProgressBar(
        'by-management-out-of-management-registries-policy-cancelled-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'out_of_management_registries'],
            savedKpis[
                kpisPrefix + 'out_of_management_registries_policy_cancelled'
            ]
        )
    );
    $('#by-management-out-of-management-registries-does-not-answer').text(
        savedKpis[kpisPrefix + 'out_of_management_registries_does_not_answer']
    );
    updateProgressBar(
        'by-management-out-of-management-registries-does-not-answer-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'out_of_management_registries'],
            savedKpis[
                kpisPrefix + 'out_of_management_registries_does_not_answer'
            ]
        )
    );
    $('#by-management-out-of-management-registries-complaint').text(
        savedKpis[kpisPrefix + 'out_of_management_registries_complaint']
    );
    updateProgressBar(
        'by-management-out-of-management-registries-complaint-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'out_of_management_registries'],
            savedKpis[kpisPrefix + 'out_of_management_registries_complaint']
        )
    );
    $('#by-management-out-of-management-registries-not-manageable').text(
        savedKpis[kpisPrefix + 'out_of_management_registries_not_manageable']
    );
    updateProgressBar(
        'by-management-out-of-management-registries-not-manageable-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'out_of_management_registries'],
            savedKpis[
                kpisPrefix + 'out_of_management_registries_not_manageable'
            ]
        )
    );
    $('#by-management-out-of-management-registries-lost-registry').text(
        savedKpis[kpisPrefix + 'out_of_management_registries_lost_registry']
    );
    updateProgressBar(
        'by-management-out-of-management-registries-lost-registry-percentage',
        getPercentage(
            savedKpis[kpisPrefix + 'out_of_management_registries'],
            savedKpis[kpisPrefix + 'out_of_management_registries_lost_registry']
        )
    );
}

function getPercentage(total, value) {
    let percentage = (parseFloat(value) * 100) / parseFloat(total);
    return percentage.toFixed(2).replace('.00', '');
}

function updateProgressBar(id, value) {
    $('#' + id).prop('style', 'width: ' + value.replace('.00', '') + '%');
    $('#' + id).prop('aria-valuenow', value.replace('.00', ''));
}

function updateConcentrateKpis(kpis, moneyFormatter) {
    $('#total-pending-sale-amount').text(
        moneyFormatter.format(kpis.total_pending_sale_amount).replace('.00', '')
    );
    $('#total-collected-sale-amount').text(
        moneyFormatter
            .format(kpis.total_collected_sale_amount)
            .replace('.00', '')
    );
    updateConcentrateOnTrackGraph(kpis);
}

function updateConcentrateOnTrackGraph(kpis) {
    let concentrateOnTrackGraph = echarts.init(
        document.getElementById('concentrate-on-track-graph')
    );
    let option = {
        // Add title
        title: {
            text: 'Concentrado de registros en seguimiento',
            subtext: '',
            x: '',
        },

        // Add legend
        legend: {
            orient: 'vertical',
            x: 'right',
            top: '40%',
            data: ['Registros en seguimiento', 'Cobrados'],
            right: 0,
        },

        // Add custom colors
        color: ['#f36f63', '#555'],

        // Enable drag recalculate
        calculable: true,

        // Add series
        series: [
            {
                name: 'Pólizas',
                type: 'pie',
                center: ['30%', '50%'],
                radius: ['35%', '70%'],
                itemStyle: {
                    normal: {
                        label: {
                            show: true,
                            position: 'inner',
                            formatter: function (params) {
                                return params.value + '\n';
                            },
                        },
                        labelLine: {
                            show: false,
                        },
                    },
                    emphasis: {
                        label: {
                            show: true,
                            formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                            position: 'center',
                            textStyle: {
                                fontSize: '17',
                                fontWeight: '500',
                            },
                        },
                    },
                },

                data: [
                    {
                        value: kpis.on_track_registries_total,
                        name: 'Registros en seguimiento',
                    },
                    {
                        value: kpis.collected_total,
                        name: 'Cobrados',
                    },
                ],
            },
        ],
    };
    concentrateOnTrackGraph.setOption(option);
}

function loadKpis(start, end) {
    $('.range-pick#beyond-kpis-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    $('#loading_content').modal('show');
    $.ajax({
        url: '/ubbitt-beyond/find-collection-call-center-kpis',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (kpis) => {
            $('#kpi-inbound-calls').text(kpis.inbound_calls);
            $('#kpi-answered-calls').text(kpis.answered_calls);
            $('#kpi-outbound-calls').text(kpis.outbound_calls);
            $('#kpi-lost-calls').text(kpis.lost_calls);
            $('#kpi-calls-answered-within-25-seconds').text(
                kpis.calls_answered_within_25_seconds
            );
            $('#kpi-nsl-percentage').text(
                kpis.nsl_percentage.replace('.00', '') + '%'
            );
            $('#kpi-abandoned-before-5-seconds').text(
                kpis.abandoned_before_5_seconds
            );
            $('#kpi-abandonment').text(
                kpis.abandonment.replace('.00', '') + '%'
            );
            $('#kpi-ath').text(kpis.ath.replace('.00', '') + ' min');
            $('#kpi-average-time-in-answering-call').text(
                kpis.average_time_in_answering_call + ' seg'
            );
            $('#kpi-speaking-time').text(kpis.speaking_time + ' seg');
        },
        error: () => {
            alert("Ocurrió un problema al consultar los KPI's de telefonía");
        },
        complete: function () {
            $('#loading_content').modal('hide');
        },
    });
}

function callDatabaseCallback(start, end, label, page = 1) {
    $('.range-pick#beyond-calls-database-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    $('#loading_content').modal('show');
    $.ajax({
        url: '/ubbitt-beyond/find-collection-calls',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateForm[page]': page,
        },
        success: (response) => {
            $('#ubbitt-beyond-collection-calls-table tbody').html(null);
            $.each(response.callsRecords, (index, callRecord) => {
                $('#ubbitt-beyond-collection-calls-table tbody').append(
                    createCallRecordRow(callRecord)
                );
            });
            updatePaginator(
                '#ubbitt-beyond-collection-calls-paginator',
                page,
                parseInt(response.totalPages),
                (page) => {
                    callDatabaseCallback(start, end, '', page);
                }
            );
        },
        error: () => {
            alert('Ocurrió un problema al consultar el registro de llamadas');
        },
        complete: function () {
            $('#loading_content').modal('hide');
        },
    });
}

function createCallRecordRow(callRecord) {
    return (
        `
        <tr>
            <th scope="row">` +
        callRecord.call_id +
        `</th>
            <td>` +
        callRecord.answered_by +
        `</td>
            <td>` +
        callRecord.callpicker_number +
        `</td>
            <td>Mapfre</td>
            <td>` +
        callRecord.date +
        `</td>
            <td>
            ` +
        callRecord.records.map(
            (record) =>
                `
            <audio controls>
                <source src="/assets/audio/` +
                record +
                `.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            `
        ) +
        `
            </td>
        </tr>
    `
    );
}

function reportsListCallback(start, end, label, page = 1) {
    $('.range-pick#beyond-collection-report-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    var report_type = $('.nav-link-beyond-collection-reports.active').data(
        'tab-type'
    );
    $('#loading_content').modal('show');
    $.ajax({
        url: '/report-file/find-reports',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateForm[page]': page,
            'SearchByDateForm[module_origin]': 'beyond',
            'SearchByDateForm[submodule_origin]': 'collection',
            'SearchByDateForm[type]': report_type,
        },
        success: (response) => {
            $('#beyond-collection-reports-table tbody').html(null);
            $.each(response.reportsRecords, (index, reportRecord) => {
                $('#beyond-collection-reports-table tbody').append(
                    createReportRecordRow(reportRecord)
                );
            });
            updatePaginator(
                '#beyond-collection-reports-paginator',
                page,
                parseInt(response.totalPages),
                (page) => {
                    reportsListCallback(start, end, '', page);
                }
            );
        },
        error: () => {
            alert('Ocurrió un problema al consultar el registro de reportes');
        },
        complete: function () {
            $('#loading_content').modal('hide');
        },
    });
}

function createReportRecordRow(record) {
    return (
        `
        <tr>
            <td scope="row">
                ${record.id}
            </td>
            <td>
                ${record.file_path}
            </td>
            <td>
                ${record.user_id}
            </td>
            <td>
                ${record.created_at}
            </td>
            <td>
                <a href="${record.file_path}" download>
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>` +
        (userHasPermission(
            $('.nav-link-beyond-collection-reports.active').data('tab-type') +
                '-delete'
        )
            ? `<a href="#" class="btn-delete-report" data-report-id="${record.id}">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>`
            : '') +
        `
            </td>
        </tr>
    `
    );
}

$('#beyond-collection-reports-table tbody').on(
    'click',
    '.btn-delete-report',
    function (evt) {
        evt.preventDefault();
        var report_id = $(this).data('report-id');
        $('#btn-confirm-delete-report').attr(
            'href',
            `/report-file/delete?id=${report_id}`
        );
        $('#modal-delete-report').modal('show');
    }
);
