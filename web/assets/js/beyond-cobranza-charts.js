// Gráfica para Beyond Conbranza
let basicdoughnutChartBeyondCobranza = echarts.init(
    document.getElementById('basic-doughnut-beyond-cobranza')
);
let options3 = {
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
                title: 'Same as image',
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
                    value: 435,
                    name: 'Registros en seguimiento',
                },
                {
                    value: 310,
                    name: 'Cobrados',
                },
            ],
        },
    ],
};

basicdoughnutChartBeyondCobranza.setOption(options3);

window.addEventListener('resize', function () {
    basicdoughnutChartBeyondCobranza.resize();
    stackedChart.resize();
});

$('.href_bd_cobra').click(function (e) {
    e.preventDefault();
    // a[href="#profile"]
    $('a[href="#beyond_option"]').tab('show');
    $('a[href="#cobranza-home"]').tab('show');
    $('a[href="#beyond-cobranza-callcenter"]').tab('show');
    $('a[href="#beyond-cobranza-callcenter-bd"]').tab('show');
    console.log('clicky');
});
