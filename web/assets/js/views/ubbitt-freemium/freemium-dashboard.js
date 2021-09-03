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
        summaryGraphCallback
    );
    summaryGraphCallback(startDate, endDate);
});

$('#freemium-inbound-resumen-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.options_inbound_freemium').removeClass('font-weight-bold');
    $('#li_resumen_inbound_freemium').addClass('font-weight-bold');
    summaryGraphCallback(startDate, endDate);
});
$('#freemium-inbound-call-center-tab').on('shown.bs.tab', function (event) {
    event.target; // newly activated tab
    event.relatedTarget; // previous active tab
    $('.options_inbound_freemium').removeClass('font-weight-bold');
    $('#li_call_center_inbound_freemium').addClass('font-weight-bold');
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

function summaryGraphCallback(start, end, label) {
    $('.range-pick#freemium-summary-date-range  > .text-date').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
    );
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
                'Ocurrió un problema al la información del gráfico de transacciones'
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
