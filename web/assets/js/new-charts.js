let stackedChart = echarts.init(document.getElementById('stacked-line'));
let option = {

    grid: {
        left: '1%',
        right: '2%',
        bottom: '3%',
        containLabel: true
    },
    tooltip: {
        trigger: 'axis'
    },
    // Add legend
    legend: {
        data: ['Leads', 'Llamadas', 'Ventas', 'Cobrado']
    },

    // Add custom colors
    color: ['#47d182', '#211a19', '#ff6f61', '#ffd800'],

    // Enable drag recalculate
    calculable: true,

    // Hirozontal axis
    xAxis: [{
        type: 'category',
        boundaryGap: false,
        data: [
            'Día 1', 'Día 2', 'Día 3', 'Día 4', 'Día 5', 'Día 6', 'Día 7'
        ]
    }],

    // Vertical axis
    yAxis: [{
        type: 'value'
    }],

    // Add series
    series: [{
            name: 'Leads',
            type: 'line',
            stack: 'Total',
            data: [125, 254, 125, 105, 75, 235, 215]
        },
        {
            name: 'Llamadas',
            type: 'line',
            stack: 'Total',
            data: [245, 495, 201, 245, 215, 345, 301]
        },
        {
            name: 'Ventas',
            type: 'line',
            stack: 'Total',
            data: [125, 545, 320, 158, 215, 325, 412]
        },
        {
            name: 'Cobrado',
            type: 'line',
            stack: 'Total',
            data: [325, 258, 302, 359, 345, 359, 369]
        }
    ],
    lineStyle: {
        width: 10
    }
    // Add series

};
stackedChart.setOption(option);

let basicdoughnutChart = echarts.init(document.getElementById('basic-doughnut'));
let options = {
    // Add title
    title: {
        text: 'Concentrado de ventas',
        subtext: 'Emisiones / Cobro',
        x: ''
    },

    // Add legend
    legend: {
        orient: 'vertical',
        x: 'right',
        top: '40%',
        data: ['Emitidas', 'Cobradas'],
        right: 0
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
                    markClear: 'Clear markline'
                }
            },
            dataView: {
                show: false,
                readOnly: false,
                title: 'View data',
                lang: ['View chart data', 'Close', 'Update']
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
                        max: 1548
                    }
                }
            },
            restore: {
                show: false,
                title: 'Restore'
            },
            saveAsImage: {
                show: false,
                title: 'Same as image',
                lang: ['Save']
            }
        }
    },

    // Enable drag recalculate
    calculable: true,

    // Add series
    series: [{
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
                    formatter: function(params) {
                        return params.value + '\n'
                    },
                },
                labelLine: {
                    show: false
                }
            },
            emphasis: {
                label: {
                    show: true,
                    formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                    position: 'center',
                    textStyle: {
                        fontSize: '17',
                        fontWeight: '500'
                    }
                }
            }
        },

        data: [{
                value: 435,
                name: 'Emitidas'
            },
            {
                value: 310,
                name: 'Cobradas'
            }
        ]
    }]
};

basicdoughnutChart.setOption(options);



let basicdoughnut2Chart = echarts.init(document.getElementById('basic-doughnut2'));
let option2 = {
    // Add title
    title: {
        text: 'Tipificación general total',
        subtext: '(Total de llamadas)',
        x: ''
    },

    // Add legend
    legend: {
        orient: 'vertical',
        top: '40%',
        x: 'right',
        data: ['Motivo de venta', 'Asistencia Ubbitt', 'Otros productos', 'Atención clientes', 'Dudas de cobranza']
    },

    // Add custom colors
    color: ['#ec4497', '#4bb6cc', '#2c72f0', '#f06c39', '#FF5757'],

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
                    markClear: 'Clear markline'
                }
            },
            dataView: {
                show: false,
                readOnly: false,
                title: 'View data',
                lang: ['View chart data', 'Close', 'Update']
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
                        max: 1548
                    }
                }
            },
            restore: {
                show: false,
                title: 'Restore'
            },
            saveAsImage: {
                show: false,
                title: 'Same as image',
                lang: ['Save']
            }
        }
    },

    // Enable drag recalculate
    calculable: true,

    // Add series
    series: [{
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
                    formatter: function(params) {
                        return params.value + '\n'
                    },
                },
                labelLine: {
                    show: false
                }
            },
            emphasis: {
                label: {
                    show: true,
                    formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                    position: 'center',
                    textStyle: {
                        fontSize: '17',
                        fontWeight: '500'
                    }
                }
            }
        },

        data: [{
                value: 335,
                name: 'Motivo de venta'
            },
            {
                value: 310,
                name: 'Asistencia Ubbitt'
            },
            {
                value: 234,
                name: 'Otros productos'
            },
            {
                value: 135,
                name: 'Atención clientes'
            },
            {
                value: 1548,
                name: 'Dudas de cobranza'
            }
        ]
    }]
};

basicdoughnut2Chart.setOption(option2);


window.addEventListener('resize', function() {
    basicdoughnutChart.resize();
    stackedChart.resize();
    basicdoughnut2Chart.resize();
})



// cambiar de tab

$('.href_bd_freemium').click(function(e) {
    e.preventDefault();
    $('a[href="#freemium_option"]').tab('show');
    $('a[href="#freemium-inbound"]').tab('show');
    $('a[href="#freemium-inbound-call-center"]').tab('show');
    $('a[href="#freemium-call-center-bd"]').tab('show');
})