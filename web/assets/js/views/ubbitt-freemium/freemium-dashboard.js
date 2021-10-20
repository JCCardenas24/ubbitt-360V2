let dateRangePickerConfig = null;
let startDate = null;
let endDate = null;

$(function () {
    $('#freemium-inbound-resumen_side_menu').addClass('font-weight-bold');
    const urlParams = new URLSearchParams(window.location.search);
    const initialDate = urlParams.get('initial_date');
    const finalDate = urlParams.get('final_date');

    startDate =
        initialDate == null ? moment().startOf('month') : moment(initialDate);
    endDate = finalDate == null ? moment() : moment(finalDate);

    dateRangePickerConfig = {
        showDropdowns: true,
        startDate,
        endDate,
        ranges: {
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment()],
            'Mes anterior': [
                moment().subtract(1, 'months').startOf('month'),
                moment().subtract(1, 'months').endOf('month'),
            ],
        },
        locale: {
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            customRangeLabel: 'Personalizado',
        },
    };

    resetDatePickers();
    summaryCallback(startDate, endDate);
    $('.nav-link-freemium-reports').first().addClass('active');
    $('#freemium-inbound-options .nav-link').first().tab('show');
});

$('#freemium-inbound-resumen-tab').on('shown.bs.tab', function (event) {
    summaryCallback(startDate, endDate);
});
$('#freemium-inbound-call-center-tab').on('shown.bs.tab', function (event) {
    resetDatePickers();
    loadKpis(startDate, endDate);
});
$('#freemium-call-center-bd-calls-tab').on('shown.bs.tab', function (event) {
    resetDatePickers();
    callDatabaseCallback(startDate, endDate, null, 1);
});

$('#freemium-call-center-bd-sales-tab').on('shown.bs.tab', function (event) {
    resetDatePickers();
    callDatabaseSalesCallback(startDate, endDate, null, 1);
});

$('#freemium-inbound-reportes-tab, .nav-link-freemium-reports').on(
    'shown.bs.tab',
    function (event) {
        var tab_report_type = $('.nav-link-freemium-reports.active').data(
            'tab-type'
        );
        $('#type-file').val(tab_report_type);
        resetDatePickers();
        reportsListCallback(startDate, endDate, null, 1);
        showHideAddButton(tab_report_type);
    }
);

function resetDatePickers() {
    dateRangePickerConfig.startDate = startDate;
    dateRangePickerConfig.endDate = endDate;
    $('.range-pick#freemium-summary-date-range').daterangepicker(
        dateRangePickerConfig,
        summaryCallback
    );
    $('.range-pick#freemium-kpis-date-range').daterangepicker(
        dateRangePickerConfig,
        loadKpis
    );
    $('.range-pick#freemium-calls-database-date-range').daterangepicker(
        dateRangePickerConfig,
        callDatabaseCallback
    );
    $('.range-pick#freemium-sales-database-date-range').daterangepicker(
        dateRangePickerConfig,
        callDatabaseSalesCallback
    );
    $('.range-pick#freemium-report-date-range').daterangepicker(
        dateRangePickerConfig,
        reportsListCallback
    );
}

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
    startDate = start;
    endDate = end;
    $('.range-pick#freemium-summary-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
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
                data: data.map((row) => row.leads),
            },
            {
                name: 'Llamadas',
                type: 'line',
                data: data.map((row) => row.calls),
            },
            {
                name: 'Ventas',
                type: 'line',
                data: data.map((row) => row.sales),
            },
            {
                name: 'Cobrado',
                type: 'line',
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
            updateDashboardTree(kpis);
            updateSummaryKpis(kpis, formatter);
            updateSalesSummary(kpis, formatter);
            updateTotalTypification(kpis);
            updateCustomerServiceCallsKpis(kpis);
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del resumen'
            );
        },
        complete: function () {
            hidePreloader();
        },
    });
}

function updateSummaryKpis(kpis, formatter) {
    $('#nco-total-calls-1').text(kpis.nco_total_calls);
    $('#sale-reason-det').text(kpis.sale_reason);
    $('#cust-serv-calls-det').text(kpis.cust_serv_calls);
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

function updateCustomerServiceCallsKpis(kpis) {
    updateUbbittAssistanceCharts(kpis);
    updateOtherProductsChart(kpis);
    updateCustomerServiceChart(kpis);
    updateCollectionQuestionsChart(kpis);
}

function updateDashboardTree(kpis) {
    $('#tree-container').html(null);
    let treeData = {
        ttl_categoria: 'NCO (Total llamadas)',
        type: 'type8',
        total_llamadas: kpis.nco_total_calls,
        efectivos: '',
        label: '',
        link: {
            ttl_categoria: 'NODE NAME 1',
            direction: 'ASYN',
        },
        children: [
            {
                ttl_categoria: 'Motivo de venta',
                name: 'NODE NAME 2.1',
                type: 'type2',
                total_llamadas: kpis.sale_reason + ' / ',
                label: 'Node name 2.1',
                efectivos: kpis.sale_reason_percentage.replace('.00', '') + '%',
                link: {
                    name: 'Link node 1 to 2.1',
                    ttl_categoria: 'NODE NAME 2.1',
                    direction: 'SYNC',
                },
                children: [
                    {
                        ttl_categoria: 'Acepta venta',
                        name: 'NODE NAME 3.1',
                        type: 'type2',
                        total_llamadas: kpis.sale_accepted + ' / ',
                        label: 'Node name 3.1',
                        efectivos:
                            kpis.sale_accepted_percentage.replace('.00', '') +
                            '%',
                        link: {
                            name: 'Link node 2.1 to 3.1',
                            ttl_categoria: 'NODE NAME 3.1',
                            direction: 'SYNC',
                        },
                        children: [
                            {
                                ttl_categoria: 'Ventas',
                                name: 'NODE NAME 3.1',
                                type: 'type2',
                                total_llamadas:
                                    kpis.sale_accepted_sales + ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.sale_accepted_sales_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                                children: [
                                    {
                                        ttl_categoria: 'Cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type2',
                                        total_llamadas:
                                            kpis.sale_accepted_charged + ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.sale_accepted_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                    {
                                        ttl_categoria: 'No cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type4',
                                        total_llamadas:
                                            kpis.sale_accepted_not_charged +
                                            ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.sale_accepted_not_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                ],
                            },
                            {
                                ttl_categoria: 'En seguimiento',
                                name: 'NODE NAME 3.1',
                                type: 'type7',
                                total_llamadas:
                                    kpis.sale_accepted_on_track + ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.sale_accepted_on_track_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                            },
                        ],
                    },
                    {
                        ttl_categoria: 'Agenda llamada',
                        name: 'NODE NAME 3.1',
                        type: 'type2',
                        total_llamadas: kpis.call_scheduled + ' / ',
                        label: 'Node name 3.1',
                        efectivos:
                            kpis.call_scheduled_percentage.replace('.00', '') +
                            '%',
                        link: {
                            name: 'Link node 2.1 to 3.1',
                            ttl_categoria: 'NODE NAME 3.1',
                            direction: 'SYNC',
                        },
                        children: [
                            {
                                ttl_categoria: 'Ventas',
                                name: 'NODE NAME 3.1',
                                type: 'type2',
                                total_llamadas:
                                    kpis.call_scheduled_sales + ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.call_scheduled_sales_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                                children: [
                                    {
                                        ttl_categoria: 'Cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type2',
                                        total_llamadas:
                                            kpis.call_scheduled_charged + ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.call_scheduled_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                    {
                                        ttl_categoria: 'No cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type4',
                                        total_llamadas:
                                            kpis.call_scheduled_not_charged +
                                            ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.call_scheduled_not_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                ],
                            },
                            {
                                ttl_categoria: 'En seguimiento',
                                name: 'NODE NAME 3.1',
                                type: 'type7',
                                total_llamadas:
                                    kpis.call_scheduled_on_track + ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.call_scheduled_on_track_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                            },
                        ],
                    },
                    {
                        ttl_categoria: 'Agenda de promesa pago',
                        name: 'NODE NAME 3.1',
                        type: 'type2',
                        total_llamadas: kpis.payment_promise_scheduled + ' / ',
                        label: 'Node name 3.1',
                        efectivos:
                            kpis.payment_promise_scheduled_percentage.replace(
                                '.00',
                                ''
                            ) + '%',
                        link: {
                            name: 'Link node 2.1 to 3.1',
                            ttl_categoria: 'NODE NAME 3.1',
                            direction: 'SYNC',
                        },
                        children: [
                            {
                                ttl_categoria: 'Ventas',
                                name: 'NODE NAME 3.1',
                                type: 'type2',
                                total_llamadas:
                                    kpis.payment_promise_scheduled_sales +
                                    ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.payment_promise_scheduled_sales_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                                children: [
                                    {
                                        ttl_categoria: 'Cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type2',
                                        total_llamadas:
                                            kpis.payment_promise_scheduled_charged +
                                            ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.payment_promise_scheduled_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                    {
                                        ttl_categoria: 'No cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type4',
                                        total_llamadas:
                                            kpis.payment_promise_scheduled_not_charged +
                                            ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.payment_promise_scheduled_not_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                ],
                            },
                            {
                                ttl_categoria: 'En seguimiento',
                                name: 'NODE NAME 3.1',
                                type: 'type7',
                                total_llamadas:
                                    kpis.payment_promise_scheduled_on_track +
                                    ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.payment_promise_scheduled_on_track_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                            },
                        ],
                    },
                    {
                        ttl_categoria: 'Envía ficha de depósito',
                        name: 'NODE NAME 3.1',
                        type: 'type2',
                        total_llamadas: kpis.deposit_slip_sent + ' / ',
                        label: 'Node name 3.1',
                        efectivos:
                            kpis.deposit_slip_sent_percentage.replace(
                                '.00',
                                ''
                            ) + '%',
                        link: {
                            name: 'Link node 2.1 to 3.1',
                            ttl_categoria: 'NODE NAME 3.1',
                            direction: 'SYNC',
                        },
                        children: [
                            {
                                ttl_categoria: 'Ventas',
                                name: 'NODE NAME 3.1',
                                type: 'type2',
                                total_llamadas:
                                    kpis.deposit_slip_sent_sales + ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.deposit_slip_sent_sales_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                                children: [
                                    {
                                        ttl_categoria: 'Cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type2',
                                        total_llamadas:
                                            kpis.deposit_slip_sent_charged +
                                            ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.deposit_slip_sent_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                    {
                                        ttl_categoria: 'No cobrado',
                                        name: 'NODE NAME 3.1',
                                        type: 'type4',
                                        total_llamadas:
                                            kpis.deposit_slip_sent_not_charged +
                                            ' / ',
                                        label: 'Node name 3.1',
                                        efectivos:
                                            kpis.deposit_slip_sent_not_charged_percentage.replace(
                                                '.00',
                                                ''
                                            ) + '%',
                                        link: {
                                            name: 'Link node 2.1 to 3.1',
                                            ttl_categoria: 'NODE NAME 3.1',
                                            direction: 'SYNC',
                                        },
                                    },
                                ],
                            },
                            {
                                ttl_categoria: 'En seguimiento',
                                name: 'NODE NAME 3.1',
                                type: 'type7',
                                total_llamadas:
                                    kpis.deposit_slip_sent_on_track + ' / ',
                                label: 'Node name 3.1',
                                efectivos:
                                    kpis.deposit_slip_sent_on_track_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 2.1 to 3.1',
                                    ttl_categoria: 'NODE NAME 3.1',
                                    direction: 'SYNC',
                                },
                            },
                        ],
                    },
                ],
            },
            {
                ttl_categoria: 'Atención a clientes',
                type: 'type7',
                total_llamadas: kpis.cust_serv_calls + ' / ',
                efectivos:
                    kpis.cust_serv_calls_percentage.replace('.00', '') + '%',
                label: 'Node name 2.3',
                link: {
                    ttl_categoria: 'NODE NAME 2.3',
                    direction: 'ASYN',
                },
                children: [
                    {
                        ttl_categoria: 'Asistencia Ubbitt',
                        name: 'NODE NAME 3.3',
                        type: 'type5',
                        total_llamadas:
                            kpis.cust_serv_calls_ubbitt_assistance + ' / ',
                        label: 'Node name 3.3',
                        efectivos:
                            kpis.cust_serv_calls_ubbitt_assistance_percentage.replace(
                                '.00',
                                ''
                            ) + '%',
                        link: {
                            name: 'Link node 2.3 to 3.3',
                            ttl_categoria: 'NODE NAME 3.3',
                            direction: 'ASYN',
                        },
                        children: [
                            {
                                ttl_categoria: 'Dudas de producto',
                                name: 'NODE NAME 4.1',
                                type: 'type5',
                                total_llamadas:
                                    kpis.cust_serv_calls_product_questions +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_calls_product_questions_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.1',
                                link: {
                                    name: 'Link node 3.3 to 4.1',
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'SYNC',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Asesorías de producto',
                                name: 'NODE NAME 4.1',
                                type: 'type5',
                                total_llamadas:
                                    kpis.cust_serv_calls_product_advisory +
                                    ' / ',
                                label: 'Node name 4.1',
                                efectivos:
                                    kpis.cust_serv_calls_product_advisory_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 3.3 to 4.1',
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'SYNC',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Enlace de producto',
                                name: 'NODE NAME 4.1',
                                type: 'type5',
                                total_llamadas:
                                    kpis.cust_serv_calls_product_linkage +
                                    ' / ',
                                label: 'Node name 4.1',
                                efectivos:
                                    kpis.cust_serv_calls_product_linkage_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 3.3 to 4.1',
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'SYNC',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Enlace de coberturas',
                                name: 'NODE NAME 4.1',
                                type: 'type5',
                                total_llamadas:
                                    kpis.cust_serv_calls_coverage_linkage +
                                    ' / ',
                                label: 'Node name 4.1',
                                efectivos:
                                    kpis.cust_serv_calls_coverage_linkage_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                link: {
                                    name: 'Link node 3.3 to 4.1',
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'SYNC',
                                },
                                children: [],
                            },
                        ],
                    },
                    {
                        ttl_categoria: 'Otros productos',
                        type: 'type1',
                        total_llamadas:
                            kpis.cust_serv_calls_other_products + ' / ',
                        label: 'Node name 3.4',
                        efectivos:
                            kpis.cust_serv_calls_other_products_percentage.replace(
                                '.00',
                                ''
                            ) + '%',
                        link: {
                            ttl_categoria: 'NODE NAME 3.4',
                            direction: 'ASYN',
                        },
                        children: [
                            {
                                ttl_categoria: 'Gastos médicos',
                                type: 'type1',
                                total_llamadas:
                                    kpis.cust_serv_calls_other_products_medical_expenses +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_calls_other_products_medical_expenses_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Vida',
                                type: 'type1',
                                total_llamadas:
                                    kpis.cust_serv_calls_other_products_life +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_calls_other_products_life_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Legalizados',
                                type: 'type1',
                                total_llamadas:
                                    kpis.cust_serv_calls_other_products_legalized +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_calls_other_products_legalized_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Plataformas',
                                type: 'type1',
                                total_llamadas:
                                    kpis.cust_serv_calls_other_products_platforms +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_calls_other_products_platforms_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Residenciales',
                                type: 'type1',
                                total_llamadas:
                                    kpis.cust_serv_calls_other_products_residential +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_calls_other_products_residential_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                        ],
                    },
                    {
                        ttl_categoria: 'Atención a clientes',
                        type: 'type6',
                        total_llamadas: kpis.cust_serv_cust_serv + ' / ',
                        efectivos:
                            kpis.cust_serv_cust_serv_percentage.replace(
                                '.00',
                                ''
                            ) + '%',
                        label: 'Node name 3.4',
                        link: {
                            ttl_categoria: 'NODE NAME 3.4',
                            direction: 'ASYN',
                        },
                        children: [
                            {
                                ttl_categoria: 'Reportar atención de asesor',
                                type: 'type6',
                                total_llamadas:
                                    kpis.cust_serv_cust_serv_report_advisor_care +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_cust_serv_report_advisor_care_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Revisión renovación póliza',
                                type: 'type6',
                                total_llamadas:
                                    kpis.cust_serv_cust_serv_policy_renewal_review +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_cust_serv_policy_renewal_review_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Cancelación de producto',
                                type: 'type6',
                                total_llamadas:
                                    kpis.cust_serv_cust_serv_product_cancellation +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_cust_serv_product_cancellation_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Checar fechas de vigencia',
                                type: 'type6',
                                total_llamadas:
                                    kpis.cust_serv_cust_serv_check_expiration_dates +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_cust_serv_check_expiration_dates_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                        ],
                    },
                    {
                        ttl_categoria: 'Dudas de cobranza',
                        type: 'type3',
                        total_llamadas:
                            kpis.cust_serv_collection_questions + ' / ',
                        efectivos:
                            kpis.cust_serv_collection_questions_percentage.replace(
                                '.00',
                                ''
                            ) + '%',
                        label: 'Node name 3.4',
                        link: {
                            ttl_categoria: 'NODE NAME 3.4',
                            direction: 'ASYN',
                        },
                        children: [
                            {
                                ttl_categoria: 'Seguimiento pago',
                                type: 'type3',
                                total_llamadas:
                                    kpis.cust_serv_collection_questions_payment_track +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_collection_questions_payment_track_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Reembolsos',
                                type: 'type3',
                                total_llamadas:
                                    kpis.cust_serv_collection_questions_refund +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_collection_questions_refund_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Aclaración pagos',
                                type: 'type3',
                                total_llamadas:
                                    kpis.cust_serv_collection_questions_payment_clarification +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_collection_questions_payment_clarification_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                            {
                                ttl_categoria: 'Reaiizar pago',
                                type: 'type3',
                                total_llamadas:
                                    kpis.cust_serv_collection_questions_make_payment +
                                    ' / ',
                                efectivos:
                                    kpis.cust_serv_collection_questions_make_payment_percentage.replace(
                                        '.00',
                                        ''
                                    ) + '%',
                                label: 'Node name 4.2',
                                link: {
                                    ttl_categoria: 'NODE NAME 4.1',
                                    direction: 'ASYN',
                                },
                                children: [],
                            },
                        ],
                    },
                ],
            },
        ],
    };
    treeBoxes('', treeData);
}

function updateUbbittAssistanceCharts(kpis) {
    $('#cust-serv-calls-ubbitt-assistance').html(
        kpis.cust_serv_calls_ubbitt_assistance +
            ' / <span>' +
            kpis.cust_serv_calls_ubbitt_assistance_percentage.replace(
                '.00',
                ''
            ) +
            '%</span>'
    );
    $('#cust-serv-calls-product-questions').text(
        kpis.cust_serv_calls_product_questions
    );
    updateProgressBar(
        'cust-serv-calls-product-questions-percentage',
        kpis.cust_serv_calls_product_questions_percentage
    );
    $('#cust-serv-calls-product-advisory').text(
        kpis.cust_serv_calls_product_advisory
    );
    updateProgressBar(
        'cust-serv-calls-product-advisory-percentage',
        kpis.cust_serv_calls_product_advisory_percentage
    );
    $('#cust-serv-calls-product-linkage').text(
        kpis.cust_serv_calls_product_linkage
    );
    updateProgressBar(
        'cust-serv-calls-product-linkage-percentage',
        kpis.cust_serv_calls_product_linkage_percentage
    );
    $('#cust-serv-calls-coverage-linkage').text(
        kpis.cust_serv_calls_coverage_linkage
    );
    updateProgressBar(
        'cust-serv-calls-coverage-linkage-percentage',
        kpis.cust_serv_calls_coverage_linkage_percentage
    );
}

function updateOtherProductsChart(kpis) {
    $('#cust-serv-calls-other-products').html(
        kpis.cust_serv_calls_other_products +
            ' / <span>' +
            kpis.cust_serv_calls_other_products_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#cust-serv-calls-other-products-medical-expenses').text(
        kpis.cust_serv_calls_other_products_medical_expenses
    );
    updateProgressBar(
        'cust-serv-calls-other-products-medical-expenses-percentage',
        kpis.cust_serv_calls_other_products_medical_expenses_percentage
    );
    $('#cust-serv-calls-other-products-life').text(
        kpis.cust_serv_calls_other_products_life
    );
    updateProgressBar(
        'cust-serv-calls-other-products-life-percentage',
        kpis.cust_serv_calls_other_products_life_percentage
    );
    $('#cust-serv-calls-other-products-legalized').text(
        kpis.cust_serv_calls_other_products_legalized
    );
    updateProgressBar(
        'cust-serv-calls-other-products-legalized-percentage',
        kpis.cust_serv_calls_other_products_legalized_percentage
    );
    $('#cust-serv-calls-other-products-platforms').text(
        kpis.cust_serv_calls_other_products_platforms
    );
    updateProgressBar(
        'cust-serv-calls-other-products-platforms-percentage',
        kpis.cust_serv_calls_other_products_platforms_percentage
    );
    $('#cust-serv-calls-other-products-residential').text(
        kpis.cust_serv_calls_other_products_residential
    );
    updateProgressBar(
        'cust-serv-calls-other-products-residential-percentage',
        kpis.cust_serv_calls_other_products_residential_percentage
    );
}

function updateCustomerServiceChart(kpis) {
    $('#cust-serv-cust-serv').html(
        kpis.cust_serv_cust_serv +
            ' / <span>' +
            kpis.cust_serv_cust_serv_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#cust-serv-cust-serv-report-advisor-care').text(
        kpis.cust_serv_cust_serv_report_advisor_care
    );
    updateProgressBar(
        'cust-serv-cust-serv-report-advisor-care-percentage',
        kpis.cust_serv_cust_serv_report_advisor_care_percentage
    );
    $('#cust-serv-cust-serv-policy-renewal-review').text(
        kpis.cust_serv_cust_serv_policy_renewal_review
    );
    updateProgressBar(
        'cust-serv-cust-serv-policy-renewal-review-percentage',
        kpis.cust_serv_cust_serv_policy_renewal_review_percentage
    );
    $('#cust-serv-cust-serv-product-cancellation').text(
        kpis.cust_serv_cust_serv_product_cancellation
    );
    updateProgressBar(
        'cust-serv-cust-serv-product-cancellation-percentage',
        kpis.cust_serv_cust_serv_product_cancellation_percentage
    );
    $('#cust-serv-cust-serv-check-expiration-dates').text(
        kpis.cust_serv_cust_serv_check_expiration_dates
    );
    updateProgressBar(
        'cust-serv-cust-serv-check-expiration-dates-percentage',
        kpis.cust_serv_cust_serv_check_expiration_dates_percentage
    );
}

function updateCollectionQuestionsChart(kpis) {
    $('#cust-serv-collection-questions').html(
        kpis.cust_serv_collection_questions +
            ' / <span>' +
            kpis.cust_serv_collection_questions_percentage.replace('.00', '') +
            '%</span>'
    );
    $('#cust-serv-collection-questions-payment-track').text(
        kpis.cust_serv_collection_questions_payment_track
    );
    updateProgressBar(
        'cust-serv-collection-questions-payment-track-percentage',
        kpis.cust_serv_collection_questions_payment_track_percentage
    );
    $('#cust-serv-collection-questions-refund').text(
        kpis.cust_serv_collection_questions_refund
    );
    updateProgressBar(
        'cust-serv-collection-questions-refund-percentage',
        kpis.cust_serv_collection_questions_refund_percentage
    );
    $('#cust-serv-collection-questions-payment-clarification').text(
        kpis.cust_serv_collection_questions_payment_clarification
    );
    updateProgressBar(
        'cust-serv-collection-questions-payment-clarification-percentage',
        kpis.cust_serv_collection_questions_payment_clarification_percentage
    );
    $('#cust-serv-collection-questions-make-payment').text(
        kpis.cust_serv_collection_questions_make_payment
    );
    updateProgressBar(
        'cust-serv-collection-questions-make-payment-percentage',
        kpis.cust_serv_collection_questions_make_payment_percentage
    );
}

function onFilterCallsDatabase() {
    callDatabaseCallback(startDate, endDate, null, 1);
}

function callDatabaseCallback(start, end, label, page = 1) {
    startDate = start;
    endDate = end;
    $('.range-pick#freemium-calls-database-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    $.ajax({
        url: '/ubbitt-freemium/find-calls',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateAndTermsForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateAndTermsForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateAndTermsForm[term]': $('#search-term').val(),
            'SearchByDateAndTermsForm[page]': page,
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
            showAlert(
                'error',
                'Ocurrió un problema al consultar el registro de llamadas'
            );
        },
        complete: function () {
            hidePreloader();
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
        callRecord.type +
        `</td>
            <td>` +
        (callRecord.type == 'inbound'
            ? callRecord.answered_by
            : callRecord.dialed_by) +
        `</td>
            <td>` +
        (callRecord.type == 'inbound'
            ? callRecord.caller_id
            : callRecord.dialed_number) +
        `</td>` +
        // <td>Mapfre</td>
        `<td>` +
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

function onDownloadCalls(event) {
    event.preventDefault();
    showPreloader();
    let headers = new Headers();
    let fileName = '';
    fetch(
        '/ubbitt-freemium/download-calls-audios?SearchByDateAndTermsForm[startDate]=' +
            startDate.format('YYYY-MM-DD') +
            '&SearchByDateAndTermsForm[endDate]=' +
            endDate.format('YYYY-MM-DD') +
            '&SearchByDateAndTermsForm[term]=' +
            encodeURIComponent($('#search-term').val()),
        {
            headers,
        }
    )
        .then((resp) => {
            if (resp.status == 200) {
                const header = resp.headers.get('Content-Disposition');
                const parts = header.split(';');
                fileName = parts[1].split('=')[1].replaceAll('"', '');
                return resp.blob();
            } else {
                throw 'Hubo un problema al descargar los audios de las llamadas.';
            }
        })
        .then((blob) => {
            // IE doesn't allow using a blob object directly as link href
            // instead it is necessary to use msSaveOrOpenBlob
            if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                window.navigator.msSaveOrOpenBlob(blob);
                return;
            }

            // For other browsers:
            // Create a link pointing to the ObjectURL containing the blob.
            const url = window.URL.createObjectURL(blob);
            var link = document.createElement('a');
            link.href = url;
            link.download = fileName;
            link.click();
            setTimeout(function () {
                // For Firefox it is necessary to delay revoking the ObjectURL
                window.URL.revokeObjectURL(url);
            }, 100);
        })
        .catch((error) => showAlert('error', error))
        .finally(() => {
            hidePreloader();
        });
}

function onFilterSalesDatabase() {
    callDatabaseSalesCallback(startDate, endDate, null, 1);
}

function callDatabaseSalesCallback(start, end, label, page = 1) {
    startDate = start;
    endDate = end;
    $('.range-pick#freemium-sales-database-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    $.ajax({
        url: '/ubbitt-freemium/find-sales',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateAndTermsForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateAndTermsForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateAndTermsForm[term]': $('#search-term').val(),
            'SearchByDateAndTermsForm[page]': page,
        },
        success: (response) => {
            $('#freemium-sales-table tbody').html(null);
            var moneyFormatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                maximumFractionDigits: 0,
            });
            $.each(response.salesRecords, (index, callRecord) => {
                $('#freemium-sales-table tbody').append(
                    createSalesRecordRow(callRecord, moneyFormatter)
                );
            });
            updatePaginator(
                '#freemium-sales-paginator',
                page,
                parseInt(response.totalPages),
                (page) => {
                    callDatabaseSalesCallback(start, end, '', page);
                }
            );
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al consultar el registro de llamadas'
            );
        },
        complete: function () {
            hidePreloader();
        },
    });
}

function createSalesRecordRow(salesRecord, moneyFormatter) {
    return (
        `
        <tr>
            <th scope="row">` +
        salesRecord.id +
        `</th>
            <td>` +
        salesRecord.nombre_contacto +
        `</td>
            <td>` +
        salesRecord.telefono_contacto +
        `</td>
            <td>` +
        salesRecord.correo_contacto +
        `</td>
            <td>` +
        salesRecord.producto +
        `</td>
            <td>` +
        salesRecord.estatus_cobro +
        `</td>
            <td>` +
        salesRecord.num_poliza +
        `</td>
            <td>` +
        moneyFormatter.format(salesRecord.prima_total) +
        `</td>
            <td>` +
        moneyFormatter.format(salesRecord.monto_pagado) +
        `</td>
            <td>` +
        salesRecord.asignado +
        `</td>
            <td>` +
        moment(salesRecord.fecha_venta, 'YYYY-MM-DDTHH:mm:ss.SSS').format(
            'DD/MM/YYYY h:mm A'
        ) +
        `</td>
            <td>` +
        moment(salesRecord.fecha_cobro, 'YYYY-MM-DDTHH:mm:ss.SSS').format(
            'DD/MM/YYYY h:mm A'
        ) +
        `</td>
            <td><a href="` +
        salesRecord.documento +
        `" download target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a></td>
        </tr>
    `
    );
}

function onDownloadPolicies(event) {
    event.preventDefault();
    showPreloader();
    let headers = new Headers();
    let fileName = '';
    fetch(
        '/ubbitt-freemium/download-policies?SearchByDateAndTermsForm[startDate]=' +
            startDate.format('YYYY-MM-DD') +
            '&SearchByDateAndTermsForm[endDate]=' +
            endDate.format('YYYY-MM-DD') +
            '&SearchByDateAndTermsForm[term]=' +
            encodeURIComponent($('#search-term').val()),
        {
            headers,
        }
    )
        .then((resp) => {
            if (resp.status == 200) {
                const header = resp.headers.get('Content-Disposition');
                const parts = header.split(';');
                fileName = parts[1].split('=')[1].replaceAll('"', '');
                return resp
                    .blob()
                    .then((blob) => {
                        // IE doesn't allow using a blob object directly as link href
                        // instead it is necessary to use msSaveOrOpenBlob
                        if (
                            window.navigator &&
                            window.navigator.msSaveOrOpenBlob
                        ) {
                            window.navigator.msSaveOrOpenBlob(blob);
                            return;
                        }

                        // For other browsers:
                        // Create a link pointing to the ObjectURL containing the blob.
                        const url = window.URL.createObjectURL(blob);
                        var link = document.createElement('a');
                        link.href = url;
                        link.download = fileName;
                        link.click();
                        setTimeout(function () {
                            // For Firefox it is necessary to delay revoking the ObjectURL
                            window.URL.revokeObjectURL(url);
                        }, 100);
                    })
                    .catch((error) => showAlert('error', error))
                    .finally(() => {
                        hidePreloader();
                    });
            } else if (resp.status == 400) {
                resp.json()
                    .then((jsonResp) => {
                        showAlert('error', jsonResp);
                    })
                    .finally(() => {
                        hidePreloader();
                    });
            } else {
                throw 'Hubo un problema al descargar las pólizas.';
            }
        })
        .catch((error) => {
            showAlert('error', error);
            hidePreloader();
        });
}

function loadKpis(start, end) {
    startDate = start;
    endDate = end;
    $('.range-pick#freemium-kpis-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
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
            $('#kpi-speaking-time').text(kpis.speaking_time + ' hr');
        },
        error: () => {
            showAlert(
                'error',
                "Ocurrió un problema al consultar los KPI's de telefonía"
            );
        },
        complete: function () {
            hidePreloader();
        },
    });
}

function reportsListCallback(start, end, label, page = 1) {
    startDate = start;
    endDate = end;
    $('.range-pick#freemium-report-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    var report_type = $('.nav-link-freemium-reports.active').data('tab-type');
    showPreloader();
    $.ajax({
        url: '/report-file/find-reports',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateForm[page]': page,
            'SearchByDateForm[module_origin]': 'freemium',
            'SearchByDateForm[submodule_origin]': 'inbound',
            'SearchByDateForm[type]': report_type,
        },
        success: (response) => {
            $('#freemium-reports-table tbody').html(null);
            $.each(response.reportsRecords, (index, reportRecord) => {
                $('#freemium-reports-table tbody').append(
                    createReportRecordRow(reportRecord)
                );
            });
            updatePaginator(
                '#freemium-reports-paginator',
                page,
                parseInt(response.totalPages),
                (page) => {
                    reportsListCallback(start, end, '', page);
                }
            );
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al consultar el registro de reportes'
            );
        },
        complete: function () {
            hidePreloader();
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
                <a href="/${record.file_path}" download>
                    <i class="fa fa-download" aria-hidden="true"></i>
                </a>` +
        (userHasPermission(
            $('.nav-link-freemium-reports.active').data('tab-type') + '-delete'
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

$('#freemium-reports-table tbody').on(
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
