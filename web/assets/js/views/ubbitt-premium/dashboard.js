let startDate = null;
let endDate = null;
let summaryGraphData = [];
const urlSearchParams = new URLSearchParams(window.location.search);
$(() => {
    startDate = moment().subtract(1, 'months').startOf('month');
    endDate = moment().subtract(1, 'months').endOf('month');

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
    summaryCallback(startDate, endDate);
    if ($('[id^=premium-marketing-campaign][id$=tab]').is(':visible')) {
        marketingGeneralCallback(startDate, endDate);
    }
    if ($('div[id^="brief-campaign"]').is(':visible')) {
        findBriefData();
    }
    $('#pemp_yes').on('change', () => {
        updateSummaryGraphChart(summaryGraphData);
    });
    $('#pemp_no').on('change', () => {
        updateSummaryGraphChart(summaryGraphData);
    });
});

$('[id^=brief-campaign][id$=tab]').on('shown.bs.tab', function (event) {
    findBriefData();
});

$('[id^=resumen-campaign][id$=tab]').on('shown.bs.tab', function (event) {
    resetDatePickers();
    summaryCallback(startDate, endDate);
});

$('[id^=marketing-campaign][id$=tab]').on('shown.bs.tab', function (event) {
    resetDatePickers();
    marketingGeneralCallback(startDate, endDate);
});

$('[id^=premium-marketing-campaign][id$=segmento-tab]').on(
    'shown.bs.tab',
    function (event) {
        resetDatePickers();
        marketingSegmentCallback(startDate, endDate);
    }
);

$('[id^=call-center-campaign][id$=tab]').on('shown.bs.tab', function (event) {
    resetDatePickers();
    callCenterKpisCallback(startDate, endDate);
});

$('[id^=premium-call-center-bd-llamadas-campaign][id$=content-tab]').on(
    'shown.bs.tab',
    function (event) {
        resetDatePickers();
        callDatabaseCallback(startDate, endDate);
    }
);

$('[id^=premium-call-center-bd-sales-campaign-1-content][id$=content-tab]').on(
    'shown.bs.tab',
    function (event) {
        resetDatePickers();
        callDatabaseSalesCallback(startDate, endDate);
    }
);

$('[id^=premium-marketing-campaign][id$=vista-general-tab]').on(
    'shown.bs.tab',
    function (event) {
        resetDatePickers();
        marketingGeneralCallback(startDate, endDate);
    }
);

$('[id^=premium-call-center-kpis-campaign][id$=content-tab]').on(
    'shown.bs.tab',
    function (event) {
        resetDatePickers();
        callCenterKpisCallback(startDate, endDate);
    }
);

function resetDatePickers() {
    dateRangePickerConfig.startDate = startDate;
    dateRangePickerConfig.endDate = endDate;
    $('.range-pick#premium-summary-date-range').daterangepicker(
        dateRangePickerConfig,
        summaryCallback
    );
    $('.range-pick#premium-marketing-general-date-range').daterangepicker(
        dateRangePickerConfig,
        marketingGeneralCallback
    );
    $('.range-pick#premium-marketing-segment-date-range').daterangepicker(
        dateRangePickerConfig,
        marketingSegmentCallback
    );
    $('.range-pick#premium-call-center-kpis-date-range').daterangepicker(
        dateRangePickerConfig,
        callCenterKpisCallback
    );
    $('.range-pick#premium-calls-database-date-range').daterangepicker(
        dateRangePickerConfig,
        callDatabaseCallback
    );
    $('.range-pick#premium-sales-database-date-range').daterangepicker(
        dateRangePickerConfig,
        callDatabaseCallback
    );
}

function findHeaderData(start, end) {
    $.ajax({
        url: '/ubbitt-premium/find-header-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            var moneyFormatter = new Intl.NumberFormat('es-MX', {
                style: 'currency',
                currency: 'MXN',
                maximumFractionDigits: 0,
            });
            $('#header-forecast-investment').text(
                moneyFormatter.format(data.investment).replace('.00', '')
            );
            $('#header-spent-budget').text(
                moneyFormatter.format(data.spentBudget).replace('.00', '')
            );
            $('#header-actual-sales').text(
                moneyFormatter.format(data.sales).replace('.00', '')
            );
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del header'
            );
        },
        // complete: () => {
        //     hidePreloader();
        // },
    });
}

function summaryCallback(start, end) {
    startDate = start;
    endDate = end;
    $('.range-pick#premium-summary-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    var moneyFormatter = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
        maximumFractionDigits: 0,
    });
    findHeaderData(start, end);
    findForecastData(start, end, moneyFormatter);
    findSummaryGraphData(start, end, moneyFormatter);
    findLeadsCallsGraphData(start, end);
    findSummaryInputs(start, end, moneyFormatter);
}

function findForecastData(start, end, moneyFormatter) {
    $.ajax({
        url: '/ubbitt-premium/find-forecast-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            $('#forecast-investment').text(
                moneyFormatter.format(data.ubbitt_investment).replace('.00', '')
            );
            $('#ubbitt-investment').text(
                moneyFormatter.format(data.ubbitt_investment).replace('.00', '')
            );
            $('#spent-investment').text(
                moneyFormatter.format(data.ubbitt_investment).replace('.00', '')
            );
            $('#forecast-sales').text(
                moneyFormatter
                    .format(parseInt(data.sales_forecast))
                    .replace('.00', '')
            );
            $('#forecast-collected').text(
                moneyFormatter
                    .format(parseInt(data.collected_forecast))
                    .replace('.00', '')
            );
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del Forecast'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function findSummaryGraphData(start, end, moneyFormatter) {
    $.ajax({
        url: '/ubbitt-premium/find-summary-graph-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (response) => {
            summaryGraphData = response;
            updateSummaryGraphChart(response);
            $('#actual-sales').text(
                moneyFormatter.format(
                    Math.round(
                        response.reduce((total, record) => {
                            if (record.type == 'actual') {
                                total = total + parseFloat(record.sales);
                            }
                            return total;
                        }, 0)
                    )
                )
            );
            $('#actual-collected').text(
                moneyFormatter.format(
                    Math.round(
                        response.reduce((total, record) => {
                            if (record.type == 'actual') {
                                total = total + parseFloat(record.collected);
                            }
                            return total;
                        }, 0)
                    )
                )
            );
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del gráfico de resumen'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function updateSummaryGraphChart(data) {
    let actual = $('#pemp_yes').prop('checked');
    let forecast = $('#pemp_no').prop('checked');
    let legends = [];
    let series = [];
    let dates = [];
    if (actual && forecast) {
        let actualData = data.filter((data) => data.type == 'actual');
        dates = actualData.map((record) => record.date);
        let forecastData = data.filter((data) => data.type == 'forecast');
        legends = [
            'Cobrado - Actual',
            'Inversión - Actual',
            'Ventas - Actual',
            'Cobrado - Forecast',
            'Inversión - Forecast',
            'Ventas - Forecast',
        ];
        series = [
            {
                name: 'Cobrado - Actual',
                type: 'line',
                data: actualData.map((record) => record.collected),
            },
            {
                name: 'Inversión - Actual',
                type: 'line',
                data: actualData.map((record) => record.investment),
            },
            {
                name: 'Ventas - Actual',
                type: 'line',
                data: actualData.map((record) => record.sales),
            },
            {
                name: 'Cobrado - Forecast',
                type: 'line',
                symbol: 'triangle',
                symbolSize: 8,
                lineStyle: {
                    type: 'dotted',
                },
                data: forecastData.map((record) => record.collected),
            },
            {
                name: 'Inversión - Forecast',
                type: 'line',
                symbol: 'triangle',
                symbolSize: 8,
                lineStyle: {
                    type: 'dotted',
                },
                data: forecastData.map((record) => record.investment),
            },
            {
                name: 'Ventas - Forecast',
                type: 'line',
                symbol: 'triangle',
                symbolSize: 8,
                lineStyle: {
                    type: 'dotted',
                },
                data: forecastData.map((record) => record.sales),
            },
        ];
    } else {
        let filter = actual ? 'actual' : forecast ? 'forecast' : '';
        let graphData = data.filter((data) => data.type == filter);
        dates = graphData.map((record) => record.date);
        legends = ['Cobrado', 'Inversión', 'Ventas'];
        series = [
            {
                name: 'Cobrado',
                type: 'line',
                data: graphData.map((record) => record.collected),
            },
            {
                name: 'Inversión',
                type: 'line',
                data: graphData.map((record) => record.investment),
            },
            {
                name: 'Ventas',
                type: 'line',
                data: graphData.map((record) => record.sales),
            },
        ];
    }
    let stackedChart = echarts.init(document.getElementById('summary-graph'));
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
            data: legends,
        },

        // Add custom colors
        color: [
            '#ff6f61',
            '#16A085',
            '#2980B9',
            '#F39C12',
            '#1ABC9C',
            '#3498DB',
        ],

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [
            {
                type: 'category',
                boundaryGap: false,
                data: dates,
            },
        ],

        // Vertical axis
        yAxis: [
            {
                type: 'value',
            },
        ],

        // Add series
        series: series,
        lineStyle: {
            width: 10,
        },
        // Add series
    };

    stackedChart.setOption(option, true);

    $('[id^=resumen-campaign][id$=tab]').on('shown.bs.tab', function (event) {
        stackedChart.resize();
    });
}

function findLeadsCallsGraphData(start, end) {
    $.ajax({
        url: '/ubbitt-premium/find-leads-calls-graph-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            updateLeadsCallsGraph(data);
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del gráfico de leads y llamadas'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function updateLeadsCallsGraph(data) {
    //Stacked line chart (Venta emitida)
    let stackedChart = echarts.init(
        document.getElementById('behavior-campaign-stacked-line')
    );
    let option = {
        // Add title
        title: {
            text: 'Comportamiento de campaña',
            orient: 'vertical',
            x: 'left',
            top: '0',
            left: 0,
        },
        grid: {
            left: '1%',
            right: '3%',
            bottom: '1%',
            containLabel: true,
        },
        tooltip: {
            trigger: 'axis',
        },
        // Add legend
        legend: {
            data: ['Leads', 'Llamadas'],
            x: 'right',
            top: '7%',
            right: '0%',
        },

        // Add custom colors
        color: ['#ff6f61', '#4d4d4d'],

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [
            {
                type: 'category',
                boundaryGap: false,
                data: data.map((record) => record.date),
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
                data: data.map((record) => record.leads),
            },
            {
                name: 'Llamadas',
                type: 'line',
                data: data.map((record) => record.calls),
            },
        ],
        lineStyle: {
            width: 10,
        },
    };

    stackedChart.setOption(option, true);
    $('[id^=resumen-campaign][id$=tab]').on('shown.bs.tab', function (event) {
        stackedChart.resize();
    });
}

function findSummaryInputs(start, end, moneyFormatter) {
    $.ajax({
        url: '/ubbitt-premium/find-summary-inputs-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            $('#spent-budget').text(
                moneyFormatter.format(data.spent_budget).replace('.00', '')
            );
            $('#actual-investment').text(
                moneyFormatter.format(data.spent_budget).replace('.00', '')
            );
            // $('#roi').text(moneyFormatter.format(data.roi).replace('.00', ''));
            $('#roi-percentage').text(
                data.roi_percentage.replace('.00', '') + '%'
            );
            $('#cpl').text(moneyFormatter.format(data.cpl).replace('.00', ''));
            // $('#cpa').text(moneyFormatter.format(data.cpa).replace('.00', ''));
            // $('#cpa-percentage').text(
            //     data.cpa_percentage.replace('.00', '') + '%'
            // );
            $('#leads').text(data.leads);
            $('#calls-total').text(data.calls_total);
            $('#sales-total').text(data.sales_total);
            $('#conversion-percentage').text(
                data.conversion_percentage.replace('.00', '') + '%'
            );
            $('#collected-total').text(data.collected_total);
            $('#collected-percentage').text(
                data.collection_percentage.replace('.00', '') + '%'
            );
            updateFunnelChart(data, moneyFormatter);
            $('#sales-total-amount').text(
                moneyFormatter
                    .format(data.sales_total_amount)
                    .replace('.00', '')
            );
            // $('#sales-percentage').text(
            //     data.sales_percentage.replace('.00', '') + '%'
            // );
            $('#sales-percentage').text(
                data.roi_percentage.replace('.00', '') + '%'
            );
            $('#collected-total-amount').text(
                moneyFormatter
                    .format(data.collected_total_amount)
                    .replace('.00', '')
            );
            $('#collection-percentage').text(
                data.collection_percentage.replace('.00', '') + '%'
            );
            updateSalesConcentrate(data);
            $('#total-emitted-sales').text(
                moneyFormatter
                    .format(data.total_emitted_sales)
                    .replace('.00', '')
            );
            $('#total-paid-sales').text(
                moneyFormatter.format(data.total_paid_sales).replace('.00', '')
            );
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información de los datos del resumen'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function updateFunnelChart(data, moneyFormatter) {
    // funnel chart
    let funnel_ventas_inversiones_chart = echarts.init(
        document.getElementById('funel_inversiones_ventas_chart')
    );
    let options_funnel_data = {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/> {b} : {c}%',
        },
        toolbox: {},

        // Add custom colors
        color: ['#FFBE2C', '#F68A52', '#FF6F61'],
        series: [
            {
                name: moneyFormatter
                    .format(data.spent_investment)
                    .replace('.00', ''),
                type: 'funnel',
                top: '0',
                left: '0%',
                width: '100%',
                maxSize: '100%',
                label: {
                    position: 'inside',
                    formatter: '{c}%',
                    color: '#000',
                    labelFontWeight: 'bold',
                    fontWeight: 'bold',
                },
                itemStyle: {
                    opacity: 1,
                    borderWidth: 2,
                },
                emphasis: {
                    label: {
                        position: 'inside',
                        formatter: '{b}: {c}%',
                    },
                },
                sort: 'none',
                data: [
                    { value: 100, name: 'Inversion total' },
                    { value: data.roi_percentage, name: 'Total ventas' },
                    { value: data.collected_percentage, name: 'Total cobros' },
                ],
                // Ensure outer shape will not be over inner shape when hover.
                z: 100,
            },
        ],
    };

    funnel_ventas_inversiones_chart.setOption(options_funnel_data);
    $('[id^=resumen-campaign][id$=tab]').on('shown.bs.tab', function (event) {
        funnel_ventas_inversiones_chart.resize();
    });
}

function updateSalesConcentrate(data) {
    // Doughnut chart concentrado de ventas
    let basicdoughnut_concentrado_ventas = echarts.init(
        document.getElementById('premium_resumen_concentrado_ventas_chart')
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
            right: '15%',
        },

        // Add custom colors
        color: ['#f36f63', '#555'],

        // Display toolbox
        toolbox: {
            show: true,
            orient: 'vertical',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline',
                    },
                },
                dataView: {
                    show: false,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update'],
                },
                magicType: {
                    show: true,
                    title: {
                        pie: 'Switch to pies',
                        funnel: 'Switch to funnel',
                    },
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            y: '20%',
                            width: '50%',
                            height: '70%',
                            funnelAlign: 'left',
                            max: 1548,
                        },
                    },
                },
                restore: {
                    show: false,
                    title: 'Restore',
                },
                saveAsImage: {
                    show: false,
                    title: 'Save as image',
                    lang: ['Save'],
                },
            },
        },

        // Enable drag recalculate
        calculable: true,

        // Add series
        series: [
            {
                name: 'Pólizas',
                type: 'pie',
                center: ['30%', '50%'],
                radius: ['35%', '70%'],
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
                        value: data.sales_total,
                        name: 'Emitidas',
                    },
                    {
                        value: data.collected_total,
                        name: 'Cobradas',
                    },
                ],
            },
        ],
    };

    basicdoughnut_concentrado_ventas.setOption(options);
    $('[id^=resumen-campaign][id$=tab]').on('shown.bs.tab', function (event) {
        basicdoughnut_concentrado_ventas.resize();
    });
}

function marketingGeneralCallback(start, end) {
    startDate = start;
    endDate = end;
    $('.range-pick#premium-marketing-general-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    var moneyFormatter = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
        maximumFractionDigits: 0,
    });
    findHeaderData(start, end);
    findMarketingGeneralData(start, end, moneyFormatter);
    // findMarketingMediaData(start, end);
    findMarketingDailyPerformanceData(start, end);
}

function findMarketingGeneralData(start, end, moneyFormatter) {
    $.ajax({
        url: '/ubbitt-premium/find-marketing-general-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            $('#marketing-budget').text(
                moneyFormatter.format(data.budget).replace('.00', '')
            );
            $('#marketing-spent-budget').text(
                moneyFormatter.format(data.spent_budget).replace('.00', '')
            );
            $('#marketing-spent-budget-percentage').text(
                data.spent_budget_percentage.replace('.00', '') + '%'
            );
            $('#marketing-available-budget').text(
                moneyFormatter.format(data.available_budget).replace('.00', '')
            );
            $('#marketing-available-budget-percentage').text(
                data.available_budget_percentage.replace('.00', '') + '%'
            );
            $('#marketing-impressions').text(data.impressions);
            $('#marketing-ctr').text(data.ctr.replace('.00', '') + '%');
            $('#marketing-clicks').text(data.clicks);
            $('#marketing-rebound').text(data.rebound.replace('.00', '') + '%');
            $('#marketing-visits').text(data.visits);
            $('#marketing-visits-conversion').text(
                data.visits_conversion.replace('.00', '') + '%'
            );
            $('#marketing-leads').text(data.leads);
            $('#marketing-leads-conversion').text(
                data.leads_conversion.replace('.00', '') + '%'
            );
            $('#marketing-contacting').text(data.contacting);
            $('#marketing-contacting-conversion').text(
                data.contacting_conversion.replace('.00', '') + '%'
            );
            $('#marketing-sales').text(data.sales);
            $('#marketing-cpm').text(
                moneyFormatter.format(data.cpm).replace('.00', '')
            );
            $('#marketing-cpc').text(
                moneyFormatter.format(data.cpc).replace('.00', '')
            );
            $('#marketing-cp-visit').text(
                moneyFormatter.format(data.cp_visit).replace('.00', '')
            );
            $('#marketing-cpl').text(
                moneyFormatter.format(data.cpl).replace('.00', '')
            );
            $('#marketing-cpl-contacted').text(
                moneyFormatter.format(data.cpl_contacted).replace('.00', '')
            );
            // $('#marketing-sale-cost').text(
            //     moneyFormatter.format(data.sale_cost).replace('.00', '')
            // );
            $('#marketing-roa').text(data.roa.replace('.00', '') + '%');
            $('#marketing-sales-amount').text(
                moneyFormatter.format(data.sales_amount).replace('.00', '')
            );
            updateProgressBar(
                'marketing-sales-bar',
                (
                    (parseFloat(data.sales_amount) * 100) /
                    (parseFloat(data.sales_amount) +
                        parseFloat(data.expenses) +
                        parseFloat(data.investment))
                )
                    .toFixed(2)
                    .toString()
            );
            $('#marketing-expenses').text(
                moneyFormatter.format(data.expenses).replace('.00', '')
            );
            updateProgressBar(
                'marketing-expenses-bar',
                (
                    (parseFloat(data.expenses) * 100) /
                    (parseFloat(data.sales_amount) +
                        parseFloat(data.expenses) +
                        parseFloat(data.investment))
                )
                    .toFixed(2)
                    .toString()
            );
            $('#marketing-investment').text(
                moneyFormatter.format(data.investment).replace('.00', '')
            );
            updateProgressBar(
                'marketing-investment-bar',
                (
                    (parseFloat(data.investment) * 100) /
                    (parseFloat(data.sales_amount) +
                        parseFloat(data.expenses) +
                        parseFloat(data.investment))
                )
                    .toFixed(2)
                    .toString()
            );
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información general de Marketing'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function updateProgressBar(id, value) {
    $('#' + id).prop('style', 'width: ' + value.replace('.00', '') + '%');
    $('#' + id).prop('aria-valuenow', value.replace('.00', ''));
}

function findMarketingMediaData(start, end) {
    $.ajax({
        url: '/ubbitt-premium/find-marketing-media-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            $('#media-data').html(null);
            $.each(data, (index, row) => {
                $('#media-data').append(createMediaDataRow(row));
            });
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información de la tabla de medios de Marketing'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function createMediaDataRow(data) {
    return (
        `<tr>
        <th scope="row"> <span class="` +
        getClassName(data.media) +
        `">` +
        data.media +
        `</span> </th>
        <td>` +
        data.impressions +
        `</td>
        <td>` +
        data.clicks +
        `</td>
        <td>` +
        data.visits +
        `</td>
        <td>` +
        data.leads +
        `</td>
        <td>` +
        data.contacted +
        `</td>
        <td>` +
        data.sales +
        `</td>
    </tr>`
    );
}

function getClassName(mediaName) {
    let className = '';
    switch (mediaName.toLowerCase()) {
        case 'facebook':
            className = 'fb';
            break;
        case 'google':
            className = 'google';
            break;
        case 'programmatic':
            className = 'progra';
            break;
        default:
            className = 'bold';
            break;
    }
    return className;
}

function findMarketingDailyPerformanceData(start, end) {
    $.ajax({
        url: '/ubbitt-premium/find-marketing-daily-performance-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            updateDailyPerformanceDataGraph(data);
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del rendimiento diario de Marketing'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function updateDailyPerformanceDataGraph(data) {
    // Rendimiento chart
    let rendimiento_mixed_chart = echarts.init(
        document.getElementById('redimiento_diario_chart_wrapper')
    );
    let options_redimiento_data = {
        title: {
            text: 'Rendimiento diario',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                crossStyle: {
                    color: '#999',
                },
            },
        },
        toolbox: {},
        legend: {
            data: ['Leads', 'Inversión campaña', 'Ventas'],
            x: 'right',
            top: '0%',
            right: '0%',
        },
        // Add custom colors
        color: ['#ff6f61', '#ffd800', '#32d926'],
        xAxis: [
            {
                type: 'category',
                data: data.map((row) => row.date),
                axisPointer: {
                    type: 'shadow',
                },
            },
        ],
        yAxis: [
            {
                type: 'value',
                name: 'Leads',
                min: 0,
                // max: 100,
                // interval: 5,
            },
            {
                type: 'value',
                name: 'Rendimiento / Ventas',
                min: 0,
                // max:
                //     Math.max.apply(
                //         Math,
                //         data.map(function (row) {
                //             return row.sales;
                //         })
                //     ) + 50,
                // interval: 100,
            },
        ],
        series: [
            {
                name: 'Leads',
                type: 'line',
                yAxisIndex: 0,
                data: data.map((row) => row.leads),
            },
            {
                name: 'Inversión campaña',
                type: 'bar',
                yAxisIndex: 1,
                data: data.map((row) => row.investment),
            },
            {
                name: 'Ventas',
                type: 'bar',
                yAxisIndex: 1,
                data: data.map((row) => row.sales),
            },
        ],
    };

    rendimiento_mixed_chart.setOption(options_redimiento_data, true);
    $('[id^=resumen-campaign][id$=tab]').on('shown.bs.tab', function (event) {
        rendimiento_mixed_chart.resize();
    });
    window.addEventListener('resize', function () {
        rendimiento_mixed_chart.resize();
    });
}

function marketingSegmentCallback(start, end) {
    startDate = start;
    endDate = end;
    $('.range-pick#premium-marketing-segment-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    findMarketingSegmentData(start, end);
}

function findMarketingSegmentData(start, end) {
    $.ajax({
        url: '/ubbitt-premium/find-marketing-segment-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (response) => {
            updateAgeDataGraph(response.ageData);
            updateRegionDataGraph(response.regionData);
            updateScheduleDataGraph(response.scheduleData);
            updateTopModelsDataGraph(response.topModelsData);
            updateTopYearsDataGraph(response.topYearsData);
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información de segmento'
            );
        },
        complete: () => {
            hidePreloader();
        },
    });
}

function updateAgeDataGraph(ageData) {
    // ********Charts marketing - segmento view***********
    let horizontal_double_bar = echarts.init(
        document.getElementById('edad_segmento_chart')
    );
    let options_edad = {
        title: {
            text: 'Edad',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow',
            },
        },
        legend: {
            data: ['Hombres', 'Mujeres'],
        },
        // Add custom colors
        color: ['#FFBE45', '#FD8377'],

        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true,
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01],
        },
        yAxis: {
            type: 'category',
            data: ['25 a 34', '35 a 44', '45 a 54', '55 a 64', '65+'],
        },
        series: [
            {
                name: 'Hombres',
                type: 'bar',
                data: [
                    ageData.men_segment_25_34,
                    ageData.men_segment_35_44,
                    ageData.men_segment_45_54,
                    ageData.men_segment_55_64,
                    ageData.men_segment_65_plus,
                ],
            },
            {
                name: 'Mujeres',
                type: 'bar',
                data: [
                    ageData.women_segment_25_34,
                    ageData.women_segment_35_44,
                    ageData.women_segment_45_54,
                    ageData.women_segment_55_64,
                    ageData.women_segment_65_plus,
                ],
            },
        ],
    };

    horizontal_double_bar.setOption(options_edad);
}

function updateRegionDataGraph(regionData) {
    let horizontal_region_bar = echarts.init(
        document.getElementById('region_segmento_chart')
    );
    let options_region = {
        title: {
            text: 'Región',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow',
            },
        },
        // legend: {
        //     data: ['Hombres', 'Mujeres']
        // },
        // Add custom colors
        color: ['#FFBE2C'],

        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true,
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01],
        },
        yAxis: {
            type: 'category',
            data: regionData.map((row) => row.place).reverse(),
            axisLabel: {
                fontSize: 8,
                interval: 0,
            },
            min: 'Zacatecas',
            max: 'Aguascalientes',
        },
        series: [
            {
                type: 'bar',
                data: regionData.map((row) => row.amount).reverse(),
            },
        ],
    };

    horizontal_region_bar.setOption(options_region);
}

function updateScheduleDataGraph(scheduleData) {
    // Horarios chart
    let horarios_double_bar = echarts.init(
        document.getElementById('horarios_chart')
    );
    let options_horarios = {
        title: {
            text: 'Horarios',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow',
            },
        },
        legend: {
            data: ['Impresiones', 'Clics'],
            x: 'right',
            top: '7%',
            right: '0%',
        },
        // Add custom colors
        color: ['#4d4d4d', '#feba5e'],

        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true,
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01],
        },
        yAxis: {
            type: 'category',
            data: [
                '6:00-1:00',
                '11:00-13:00',
                '14:00-16:00',
                '17:00-20:00',
                '21:00-23:00',
                '00:00-02:00',
            ],
        },
        series: [
            {
                name: 'Impresiones',
                type: 'bar',
                data: [
                    scheduleData.schedule_06_10_impressions,
                    scheduleData.schedule_11_13_impressions,
                    scheduleData.schedule_14_16_impressions,
                    scheduleData.schedule_17_20_impressions,
                    scheduleData.schedule_21_23_impressions,
                    scheduleData.schedule_00_02_impressions,
                ],
            },
            {
                name: 'Clics',
                type: 'bar',
                data: [
                    scheduleData.schedule_06_10_clicks,
                    scheduleData.schedule_11_13_clicks,
                    scheduleData.schedule_14_16_clicks,
                    scheduleData.schedule_17_20_clicks,
                    scheduleData.schedule_21_23_clicks,
                    scheduleData.schedule_00_02_clicks,
                ],
            },
        ],
    };

    horarios_double_bar.setOption(options_horarios);
}

function updateTopModelsDataGraph(topModelsData) {
    // charts leads 1

    let horizontal_top_7_leads = echarts.init(
        document.getElementById('leads_totales_top_7')
    );
    let options_top_7_leads = {
        title: {
            text: 'Leads totales (Modelo top 7)',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow',
            },
        },
        // legend: {
        //     data: ['Hombres', 'Mujeres']
        // },
        // Add custom colors
        color: ['#FF6F61'],

        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true,
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01],
        },
        yAxis: {
            type: 'category',
            data: topModelsData.map((row) => row.model).reverse(),
        },
        series: [
            {
                type: 'bar',
                data: topModelsData.map((row) => row.amount).reverse(),
            },
        ],
    };

    horizontal_top_7_leads.setOption(options_top_7_leads);
}

function updateTopYearsDataGraph(topYearsData) {
    // charts leads 2
    let horizontal_top_5_leads = echarts.init(
        document.getElementById('leads_totales_top_5')
    );
    let options_top_5_leads = {
        title: {
            text: 'Leads totales (Modelo top 5)',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow',
            },
        },
        // legend: {
        //     data: ['Hombres', 'Mujeres']
        // },
        // Add custom colors
        color: ['#4D4D4D'],

        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true,
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01],
        },
        yAxis: {
            type: 'category',
            data: topYearsData.map((row) => row.year).reverse(),
        },
        series: [
            {
                type: 'bar',
                data: topYearsData.map((row) => row.amount).reverse(),
            },
        ],
    };

    horizontal_top_5_leads.setOption(options_top_5_leads);
}

function callCenterKpisCallback(start, end) {
    startDate = start;
    endDate = end;
    $('.range-pick#premium-call-center-kpis-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    findHeaderData(start, end);
    findCenterKpisData(start, end);
}

function findCenterKpisData(start, end) {
    $.ajax({
        url: '/ubbitt-premium/find-marketing-kpis-data',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
            'SearchByDateCampaignForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateCampaignForm[endDate]': end.format('YYYY-MM-DD'),
        },
        success: (data) => {
            $('#kpi-inbound-calls').text(data.inbound_calls);
            $('#kpi-answered-calls').text(data.answered_calls);
            $('#kpi-outbound-calls').text(data.outbound_calls);
            $('#kpi-lost-calls').text(data.lost_calls);
            // $('#kpi-calls-answered-within-25-seconds').text(
            //     data.calls_answered_within_25_seconds
            // );
            // $('#kpi-nsl-percentage').text(
            //     data.nsl_percentage.replace('.00', '') + '%'
            // );
            // $('#kpi-abandoned-before-5-seconds').text(
            //     data.abandoned_before_5_seconds
            // );
            // $('#kpi-abandonment').text(
            //     data.abandonment.replace('.00', '') + '%'
            // );
            // $('#kpi-ath').text(data.ath.replace('.00', '') + ' min');
            // $('#kpi-average-time-in-answering-call').text(
            //     data.average_time_in_answering_call + ' seg'
            // );
            // $('#kpi-speaking-time').text(data.speaking_time + ' hrs');
        },
        error: () => {
            showAlert('error', "Ocurrió un problema al consultar los KPI's");
        },
        complete: function () {
            hidePreloader();
        },
    });
}

function callDatabaseCallback(start, end, label, page = 1) {
    startDate = start;
    endDate = end;
    $('.range-pick#premium-calls-database-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    findHeaderData(start, end);
    $.ajax({
        url: '/ubbitt-premium/find-calls',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateForm[page]': page,
        },
        success: (response) => {
            $('#premium-calls-table tbody').html(null);
            $.each(response.callsRecords, (index, callRecord) => {
                $('#premium-calls-table tbody').append(
                    createCallRecordRow(callRecord)
                );
            });
            updatePaginator(
                '#premium-calls-paginator',
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
        callRecord.answered_by +
        `</td>
            <td>` +
        callRecord.callpicker_number +
        `</td>
            <td>GS</td>
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

function callDatabaseSalesCallback(start, end, label, page = 1) {
    startDate = start;
    endDate = end;
    $('.range-pick#premium-sales-database-date-range > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
    showPreloader();
    $.ajax({
        url: '/ubbitt-premium/find-sales',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateForm[startDate]': start.format('YYYY-MM-DD'),
            'SearchByDateForm[endDate]': end.format('YYYY-MM-DD'),
            'SearchByDateForm[page]': page,
        },
        success: (response) => {
            $('#premium-sales-table tbody').html(null);
            $.each(response.salesRecords, (index, callRecord) => {
                $('#premium-sales-table tbody').append(
                    createSalesRecordRow(callRecord)
                );
            });
            updatePaginator(
                '#premium-sales-paginator',
                page,
                parseInt(response.totalPages),
                (page) => {
                    callDatabaseSalesCallback(start, end, '', page);
                }
            );
        },
        error: () => {
            alert('Ocurrió un problema al consultar el registro de llamadas');
        },
        complete: function () {
            hidePreloader();
        },
    });
}

function createSalesRecordRow(salesRecord) {
    return `
        <tr>
            <th scope="row" colspan="10"></td>
        </tr>
    `;
}

function onEnableBriefEdition() {
    $('#premium-brief-campaign').find('input').prop('disabled', false);
    $('#btn-edit-brief').hide();
    $('#btn-cancel-edit-brief').show();
    $('#btn-save-brief').show();
}

function onCancelBriefEdition() {
    $('#premium-brief-campaign').find('input').prop('disabled', true);
    $('#btn-edit-brief').show();
    $('#btn-cancel-edit-brief').hide();
    $('#btn-save-brief').hide();
}

function findBriefData() {
    showPreloader();
    $.ajax({
        url: '/ubbitt-premium/find-brief',
        type: 'POST',
        dataType: 'json',
        data: {
            'SearchByDateCampaignForm[campaignId]': urlSearchParams.get('id'),
        },
        success: (data) => {
            if (data != null) {
                $(
                    'input[name="brief-industry-type"][value="' +
                        data.industryType +
                        '"]'
                ).prop('checked', true);
                $('#campaign-name').val(data.name);
                $('#product-description').val(data.productDescription);
                $('#product-insights').val(data.productInsights);
                $('#product-added-value').val(data.productAddedValue);
                $('#product-average-price').val(data.productAveragePrice);
                $('#product-first-payment-average-price').val(
                    data.productFirstPaymentAveragePrice
                );
                $('#payment-frequency-yearly').prop(
                    'checked',
                    data.paymentFrequencyYearly
                );
                $('#payment-frequency-biannual').prop(
                    'checked',
                    data.paymentFrequencyBiannual
                );
                $('#payment-frequency-quarterly').prop(
                    'checked',
                    data.paymentFrequencyQuarterly
                );
                $('#payment-frequency-monthly').prop(
                    'checked',
                    data.paymentFrequencyMonthly
                );
                $('#payment-type-cash').prop('checked', data.paymentTypeCash);
                $('#payment-type-card-months-without-interest').prop(
                    'checked',
                    data.paymentTypeCardMonthsWithoutInterest
                );
                $('#payment-type-card-single-payment').prop(
                    'checked',
                    data.paymentTypeCardSinglePayment
                );
                $('#payment-method-card').prop(
                    'checked',
                    data.paymentMethodCard
                );
                $('#payment-method-cash-pickup').prop(
                    'checked',
                    data.paymentMethodCashPickup
                );
                $('#payment-method-wire-transfer').prop(
                    'checked',
                    data.paymentMethodWireTransfer
                );
                $('#investment').val(data.investment);
                $('#start-date').val(data.startDate);
                $('#end-date').val(data.endDate);
                $('#expected-bidding-per-lead').val(
                    data.expectedBiddingPerLead
                );
                $('#expected-total-sales').val(data.expectedTotalSales);
            }
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al recuperar la información del Brief'
            );
        },
        complete: function () {
            hidePreloader();
        },
    });
}

function onSaveBrief() {
    showPreloader();
    $.ajax({
        url: '/ubbitt-premium/save-brief',
        type: 'POST',
        dataType: 'json',
        data: {
            'PremiumBriefForm[campaignId]': urlSearchParams.get('id'),
            'PremiumBriefForm[industryType]': $(
                'input[name="brief-industry-type"]:checked'
            ).val(),
            'PremiumBriefForm[name]': $('#campaign-name').val(),
            'PremiumBriefForm[productDescription]': $(
                '#product-description'
            ).val(),
            'PremiumBriefForm[productInsights]': $('#product-insights').val(),
            'PremiumBriefForm[productAddedValue]': $(
                '#product-added-value'
            ).val(),
            'PremiumBriefForm[productAveragePrice]': $(
                '#product-average-price'
            ).val(),
            'PremiumBriefForm[productFirstPaymentAveragePrice]': $(
                '#product-first-payment-average-price'
            ).val(),
            'PremiumBriefForm[paymentFrequencyYearly]': $(
                '#payment-frequency-yearly'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[paymentFrequencyBiannual]': $(
                '#payment-frequency-biannual'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[paymentFrequencyQuarterly]': $(
                '#payment-frequency-quarterly'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[paymentFrequencyMonthly]': $(
                '#payment-frequency-monthly'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[paymentTypeCash]': $('#payment-type-cash').is(
                ':checked'
            )
                ? 1
                : 0,
            'PremiumBriefForm[paymentTypeCardMonthsWithoutInterest]': $(
                '#payment-type-card-months-without-interest'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[paymentTypeCardSinglePayment]': $(
                '#payment-type-card-single-payment'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[paymentMethodCard]': $('#payment-method-card').is(
                ':checked'
            )
                ? 1
                : 0,
            'PremiumBriefForm[paymentMethodCashPickup]': $(
                '#payment-method-cash-pickup'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[paymentMethodWireTransfer]': $(
                '#payment-method-wire-transfer'
            ).is(':checked')
                ? 1
                : 0,
            'PremiumBriefForm[investment]': $('#investment').val(),
            'PremiumBriefForm[startDate]': $('#start-date').val(),
            'PremiumBriefForm[endDate]': $('#end-date').val(),
            'PremiumBriefForm[expectedBiddingPerLead]': $(
                '#expected-bidding-per-lead'
            ).val(),
            'PremiumBriefForm[expectedTotalSales]': $(
                '#expected-total-sales'
            ).val(),
        },
        success: (response) => {
            showAlert('success', 'El Brief se actualizó correctamente');
            $('#premium-brief-campaign').find('input').prop('disabled', true);
            $('#btn-edit-brief').show();
            $('#btn-cancel-edit-brief').hide();
            $('#btn-save-brief').hide();
        },
        error: () => {
            showAlert(
                'error',
                'Ocurrió un problema al guardar la información del Brief'
            );
        },
        complete: function () {
            hidePreloader();
        },
    });
}
