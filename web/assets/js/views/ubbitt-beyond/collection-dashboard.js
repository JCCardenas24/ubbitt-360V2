let dateRangePickerConfig = null;
let startDate = null;
let endDate = null;

$(function () {
    $('#li-beyond-collection-summary').addClass('font-weight-bold');
    const urlParams = new URLSearchParams(window.location.search);
    const initialDate = urlParams.get('initial_date');
    const finalDate = urlParams.get('final_date');

    startDate =
        initialDate == null
            ? moment().subtract(6, 'days')
            : moment(initialDate);
    endDate =
        finalDate == null ? moment().subtract(1, 'days') : moment(finalDate);

    dateRangePickerConfig = {
        showDropdowns: true,
        startDate,
        endDate,
        ranges: {
            'Últimos 7 días': [
                moment().subtract(6, 'days'),
                moment().subtract(1, 'days'),
            ],
            'Últimos 30 días': [
                moment().subtract(29, 'days'),
                moment().subtract(1, 'days'),
            ],
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
});

/** TAB CHANGE EVENTS  **/
$('#resumen-cobranza-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.menu-sidebar li span').removeClass('font-weight-bold');
    $('#li-beyond-collection-summary').addClass('font-weight-bold');
});
$('#beyond-cobranza-callcenter-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.menu-sidebar li span').removeClass('font-weight-bold');
    $('#li-beyond-collection-call-center').addClass('font-weight-bold');
    // Initialize the date picker on the call center kpi's tab
    $('.range-pick#beyond-kpis-date-range').daterangepicker(
        dateRangePickerConfig,
        loadKpis
    );
    loadKpis(startDate, endDate);
});
$('#beyond-cobranza-reportes-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.menu-sidebar li span').removeClass('font-weight-bold');
    $('#li-beyond-collection-reports').addClass('font-weight-bold');
});
$('#beyond-cobranza-carga-base-datos-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.menu-sidebar li span').removeClass('font-weight-bold');
    $('#li-beyond-collection-database-upload').addClass('font-weight-bold');
});

function summaryCallback(start, end) {
    $('.range-pick#beyond-collection-summary-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    findSummaryGraphData(start, end);
    //findSummaryDetailData(start, end);
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

function loadKpis(start, end) {
    $('.range-pick#beyond-kpis-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    $.ajax({
        url: '/ubbitt-beyond/find-call-center-kpis',
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
    });
}
