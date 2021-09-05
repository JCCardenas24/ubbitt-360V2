let dateRangePickerConfig = null;
let startDate = null;
let endDate = null;

$(function () {
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

    $('.range-pick#freemium-summary-date-range').daterangepicker(
        dateRangePickerConfig,
        summaryCallback
    );
    summaryCallback(startDate, endDate);
});

$('#freemium-inbound-resumen-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.options_inbound_freemium').removeClass('font-weight-bold');
    $('#li_resumen_inbound_freemium').addClass('font-weight-bold');
    summaryCallback(startDate, endDate);
});
$('#freemium-inbound-call-center-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.options_inbound_freemium').removeClass('font-weight-bold');
    $('#li_call_center_inbound_freemium').addClass('font-weight-bold');
    // Initialize the date picker on the call center kpi's tab
    $('.range-pick#freemium-kpis-date-range').daterangepicker(
        dateRangePickerConfig,
        loadKpis
    );
    loadKpis(startDate, endDate);
});
$('#freemium-call-center-bd-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.options_inbound_freemium').removeClass('font-weight-bold');
    $('#li_call_center_inbound_freemium').addClass('font-weight-bold');
    // Initialize the date picker on the call center calls database tab
    $('.range-pick#freemium-calls-database-date-range').daterangepicker(
        dateRangePickerConfig,
        callDatabaseCallback
    );
    callDatabaseCallback(startDate, endDate, null, 1);
});
$('#freemium-inbound-reportes-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.options_inbound_freemium').removeClass('font-weight-bold');
    $('#li_reportes_inbound_freemium').addClass('font-weight-bold');
});

function summaryCallback(start, end) {
    $('.range-pick#freemium-summary-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    findSummaryGraphData(start, end);
    findSummaryDetailData(start, end);
}

function findSummaryGraphData(start, end) {
    $.ajax({
        url: '/ubbitt-freemium/find-summary-graph-data',
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
            alert(
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
            data: ['Leads', 'Llamadas', 'Ventas', 'Cobrado'],
        },

        // Add custom colors
        color: ['#47d182', '#211a19', '#ff6f61', '#ffd800'],

        // Enable drag recalculate
        calculable: true,

        // Hirozontal axis
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
                name: 'Leads',
                type: 'line',
                stack: 'Total',
                data: data.map((row) => row.leads),
            },
            {
                name: 'Llamadas',
                type: 'line',
                stack: 'Total',
                data: data.map((row) => row.calls),
            },
            {
                name: 'Ventas',
                type: 'line',
                stack: 'Total',
                data: data.map((row) => row.sales),
            },
            {
                name: 'Cobrado',
                type: 'line',
                stack: 'Total',
                data: data.map((row) => row.collected),
            },
        ],
        lineStyle: {
            width: 10,
        },
        // Add series
    };
    stackedChart.setOption(option);
}

function findSummaryDetailData(start, end) {
    $.ajax({
        url: '/ubbitt-freemium/find-summary-detail-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (kpis) => {
            var formatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
            });
            updateSummaryKpis(kpis, formatter);
            updateSalesSummary(kpis, formatter);
            updateTotalTypification(kpis);
        },
        error: () => {
            alert(
                'Ocurrió un problema al recuperar la información del resumen'
            );
        },
    });
}

function updateSummaryKpis(kpis, formatter) {
    $('#nco-total-calls-1').text(kpis.nco_total_calls);
    $('#nco-total-calls-2').text(kpis.nco_total_calls);
    $('#nco-total-calls-3').text(kpis.nco_total_calls);
    $('#total-sales').text(kpis.total_sales);
    $('#sales-total-amount').text(
        formatter.format(kpis.sales_total_amount).replace('.00', '')
    );
    $('#conversion-percentage').text(
        kpis.conversion_percentage.replace('.00', '') + '%'
    );
    $('#emissions-total').text(kpis.emissions_total);
    $('#collection-percentage').text(
        kpis.collection_percentage.replace('.00', '') + '%'
    );
    $('#total-collections').text(kpis.total_collections);
}

function updateSalesSummary(kpis, formatter) {
    $('#total-sale-issued').text(
        formatter.format(kpis.total_sale_issued).replace('.00', '')
    );
    $('#total-sale-paid').text(
        formatter.format(kpis.total_sale_paid).replace('.00', '')
    );
    updateSalesConcentrateGraph(kpis);
}

function updateSalesConcentrateGraph(kpis) {
    let salesConcentrateGraph = echarts.init(
        document.getElementById('sales-concentrate-graph')
    );
    let options = {
        // Add title
        title: {
            text: 'Concentrado de ventas',
            subtext: 'Emisiones / Cobro',
            x: '',
        },

        // Add legend
        legend: {
            orient: 'vertical',
            x: 'right',
            top: '40%',
            data: ['Emitidas', 'Cobradas'],
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
                        value: kpis.emissions_total,
                        name: 'Emitidas',
                    },
                    {
                        value: kpis.total_collections,
                        name: 'Cobradas',
                    },
                ],
            },
        ],
    };

    salesConcentrateGraph.setOption(options);
}

function updateTotalTypification(kpis) {
    updateTotalTypificationGraph(kpis);
    $('#sale-reason').html(
        kpis.sale_reason +
            ' / <span>' +
            kpis.sale_reason_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#call-scheduled').text(kpis.call_scheduled);
    updateProgressBar(
        'call-scheduled-percentage',
        kpis.call_scheduled_percentage
    );
    $('#sale-accepted').text(kpis.sale_accepted);
    updateProgressBar(
        'sale-accepted-percentage',
        kpis.sale_accepted_percentage
    );
    $('#payment-promise-scheduled').text(kpis.payment_promise_scheduled);
    updateProgressBar(
        'payment-promise-scheduled-percentage',
        kpis.payment_promise_scheduled_percentage
    );
    $('#deposit-slip-sent').text(kpis.deposit_slip_sent);
    updateProgressBar(
        'deposit-slip-sent-percentage',
        kpis.deposit_slip_sent_percentage
    );
}

function updateProgressBar(id, value) {
    $('#' + id).prop('style', 'width: ' + value.replace('.00', '') + '%');
    $('#' + id).prop('aria-valuenow', value.replace('.00', ''));
}

function updateTotalTypificationGraph(kpis) {
    let totalTypificationGraph = echarts.init(
        document.getElementById('total-typification-graph')
    );
    let option = {
        // Add title
        title: {
            text: 'Tipificación general total',
            subtext: '(Total de llamadas)',
            x: '',
        },

        // Add legend
        legend: {
            orient: 'vertical',
            top: '40%',
            x: 'right',
            data: [
                'Motivo de venta',
                'Asistencia Ubbitt',
                'Otros productos',
                'Atención clientes',
                'Dudas de cobranza',
            ],
        },

        // Add custom colors
        color: ['#ec4497', '#4bb6cc', '#2c72f0', '#f06c39', '#FF5757'],

        // Enable drag recalculate
        calculable: true,

        // Add series
        series: [
            {
                name: 'Llamadas',
                type: 'pie',
                radius: ['35%', '70%'],
                center: ['30%', '50%'],
                // center: ['50%', '57.5%'],
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
                        value: kpis.sale_reason,
                        name: 'Motivo de venta',
                    },
                    {
                        value: kpis.cust_serv_calls_ubbitt_assistance,
                        name: 'Asistencia Ubbitt',
                    },
                    {
                        value: kpis.cust_serv_calls_other_products,
                        name: 'Otros productos',
                    },
                    {
                        value: kpis.cust_serv_cust_serv,
                        name: 'Atención clientes',
                    },
                    {
                        value: kpis.cust_serv_collection_questions,
                        name: 'Dudas de cobranza',
                    },
                ],
            },
        ],
    };

    totalTypificationGraph.setOption(option);

    window.addEventListener('resize', function () {
        totalTypificationGraph.resize();
        stackedChart.resize();
        totalTypificationGraph.resize();
    });
}

function callDatabaseCallback(start, end, label, page = 1) {
    $('.range-pick#freemium-calls-database-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    $.ajax({
        url: '/ubbitt-freemium/find-calls',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateForm[page]': page,
        },
        success: (response) => {
            $('#freemium-calls-table tbody').html(null);
            $.each(response.callsRecords, (index, callRecord) => {
                $('#freemium-calls-table tbody').append(
                    createCallRecordRow(callRecord)
                );
            });
            updatePaginator(
                '#freemium-calls-paginator',
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
            <td>55125486</td>
            <td>Mapre</td>
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

function loadKpis(start, end) {
    $('.range-pick#freemium-kpis-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    $.ajax({
        url: '/ubbitt-freemium/find-call-center-kpis',
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
