let ncoCanva = document.getElementById("nco");
let nchCanva = document.getElementById("nch");
let obcCanva = document.getElementById("obc");
let avanceCanva = document.getElementById('avance-gestion');
let converCanva = document.getElementById('conversion-venta');

let ncoData = {
    labels: [
        "número de llamadas ofrecidas",
    ],
    datasets: [
        {
            data: [84, 16],
            backgroundColor: [
                "#EEAA3B",
            ]
        }]
};
let ncoChart = new Chart(ncoCanva, {
    type: 'doughnut',
    data: ncoData,
    options: {
        legend: {
          display: false,
      },
      plugins: {
        datalabels: {
            formatter: function(value) {
                return null;
            },
        }
    },
    }
});

let nchData = {
    labels: [
        "número de llamadas ofrecidas",
    ],
    datasets: [
        {
            data: [65, 35],
            backgroundColor: [
                "#53B0A3",
            ]
        }]
};
let nchChart = new Chart(nchCanva, {
    type: 'doughnut',
    data: nchData,
    options: {
        legend: {
          display: false,
      },
      plugins: {
        datalabels: {
            formatter: function(value) {
                return null;
            },
        }
    },
    }
});

let obcData = {
    labels: [
        "número de llamadas ofrecidas",
    ],
    datasets: [
        {
            data: [23, 77],
            backgroundColor: [
                "#538EEF",
            ]
        }]
};
let obcChart = new Chart(obcCanva, {
    type: 'doughnut',
    data: obcData,
    options: {
        legend: {
          display: false,
        },
        plugins: {
            datalabels: {
                formatter: function(value) {
                    return null;
                },
            }
        },
    }
});

let avanceData = {
    labels: [
        "Registros asignados",
        "Trabajados",
        "Retención"
    ],
    datasets: [
        {
            data: [70, 21, 32],
            backgroundColor: [
                "#5375D9",
                "#62B472",
                "#613FB0"
            ]
        }]
};
let avanceChart = new Chart(avanceCanva, {
    type: 'doughnut',
    data: avanceData,
    options: {
        legend: {
          display: false,
        },
        plugins: {
            datalabels: {
                formatter: function(value) {
                    return value;
                },
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 13,
                }
            }
        },
    }
});

let converData = {
    labels: [
        "Conversión",
        "CCC",
    ],
    datasets: [
        {
            data: [119, 90],
            backgroundColor: [
                "#56B1D9",
                "#5ABF58",
            ]
        }]
};
let converChart = new Chart(converCanva, {
    type: 'doughnut',
    data: converData,
    options: {
        legend: {
          display: false,
        },
        rotation: 1 * Math.PI,/** This is where you need to work out where 89% is */
        circumference: 1 * Math.PI,/** put in a much smaller amount  so it does not take up an entire semi circle */
        series: {
            showLabel: true,
            showLegend: true
        },
        plugins: {
            datalabels: {
                formatter: function(value) {
                    return value;
                },
                color: '#fff',
                font: {
                    weight: 'bold',
                    size: 13,
                },
            }
        },
    }
});