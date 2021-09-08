let coberturaCanva = document.getElementById("cobertura");
let generoCanva = document.getElementById("genero");
let formaPagoCanva = document.getElementById("formaPago");
let tipoPagoCanva = document.getElementById("tipoPago");

coberturaCanva.height = 150;
generoCanva.height = 150;
formaPagoCanva.height = 150;
tipoPagoCanva.height = 150;

let coberturaData = {
    labels: [
        "Amplia",
        "Limitante",
        "Resp C.",
    ],
    datasets: [
        {
            data: [133.3, 86.2, 52.2],
            backgroundColor: [
                "#F09436",
                "#569D98",
                "#DB334A",
            ]
        }]
};

let generoData = {
    labels: [
        "Femenino",
        "Masculino",
    ],
    datasets: [
        {
            data: [130, 52.2],
            backgroundColor: [
                "#749D47",
                "#569D98",
            ]
        }]
};

let formaPagoData = {
    labels: [
        "Crédito",
        "Débito",
        "Trans",
        "Ventanilla"
    ],
    datasets: [
        {
            data: [130, 52.2, 60, 20],
            backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#654484",
                "#63CB84",
            ]
        }]
};

let tipoPagoData = {
    labels: [
        "Anual",
        "Semestral",
        "Bimestral",
        "Mensual"
    ],
    datasets: [
        {
            data: [130, 52.2, 60, 20],
            backgroundColor: [
                "#F09436",
                "#569D98",
                "#F09436",
                "#DB334A",
            ]
        }]
};

let doughnutChart = new Chart(coberturaCanva, {
  type: 'doughnut',
  data: coberturaData,
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
                size: 17,
            }
        }
    },
  }
});

let generoChart = new Chart(generoCanva, {
    type: 'doughnut',
    data: generoData,
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
                    size: 17,
                }
            }
        },
    }
});

let formaPagoChart = new Chart(formaPagoCanva, {
    type: 'doughnut',
    data: formaPagoData,
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
                    size: 17,
                }
            }
        },
    }
});

let tipoPagoChart = new Chart(tipoPagoCanva, {
    type: 'doughnut',
    data: tipoPagoData,
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
                    size: 17,
                }
            }
        },
    }
});

var ctx = document.getElementById("lineChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["0", "1", "2", "3", "4", "5"],
    datasets: [
        {
            label: "Tanjung Perak",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'round',
            borderWidth: 1,
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 5,
            pointHoverRadius: 6,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [65, 59, 80, 81, 56, 55, 40],
            spanGaps: false,
        },
        {
              label: "Gresik",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "#FFCA28",
              borderColor: "#FF6F00",
              borderCapStyle: 'round',
              borderWidth: 1,
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: "#FF6F00",
              pointBackgroundColor: "#fff",
              pointBorderWidth: 5,
              pointHoverRadius: 6,
              pointHoverBackgroundColor: "#FF6F00",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointHoverBorderWidth:2,
              pointRadius: 1,
              pointHitRadius: 10,
              data: [15, 20, 35, 25, 40, 45, 50],
              spanGaps: false,
          },
        {
              label: "Bima",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "#E91E63",
              borderColor: "#E91E63",
              borderCapStyle: 'round',
              borderWidth: 1,
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: "#AD1457",
              pointBackgroundColor: "#fff",
              pointBorderWidth: 5,
              pointHoverRadius: 6,
              pointHoverBackgroundColor: "#AD1457",
              pointHoverBorderColor: "rgba(220,220,220,1)",
              pointHoverBorderWidth:2,
              pointRadius: 1,
              pointHitRadius: 10,
              data: [40, 42, 43, 39, 30, 41, 20],
              spanGaps: false,
          }
    ]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                },
                gridLines: {
                    display:false
                }
            }],
            xAxes: [{
                gridLines: {
                    display:false
                }
            }]
        },
        plugins: {
            datalabels: {
                formatter: function(value) {
                    return value;
                },
                color: '#000',
                font: {
                    weight: 'bold',
                    size: 11,
                },
                anchor: 'end',
                align: 'top',
            }
        },
        scales: {
            yAxes : [{
              ticks : {
                max : 100,
                min : 0,
              }
            }]
        }
    }
});

var ctx = document.getElementById("barChart").getContext('2d');
ctx.height = 350;
var barChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Jan", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sept", "Oct", "Nov", "Dec"],
    datasets: [{
      label: '',
      data: [12, 19, 3, 17, 28, 24, 7, 15, 10, 5, 8, 9],
      backgroundColor: "#569D98"
    }, {
      label: '',
      data: [30, 29, 5, 5, 20, 3, 10, 15, 12, 10, 7, 5],
      backgroundColor: "#42649B"
    }]
  },
  options: {
        legend: {
            display: false,
        },
        plugins: {
            datalabels: {
                formatter: function(value) {
                    return value;
                },
                color: '#000',
                font: {
                    weight: 'bold',
                    size: 9,
                },
                anchor: 'end',
                align: 'top',
            }
        },
        scales: {
            yAxes : [{
              ticks : {
                max : 50,
                min : 0,
              }
            }]
        }
    }
});

var ctx2 = document.getElementById("barInfo").getContext('2d');
var barChart = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: ["Jan", "Feb", "Mar", "Abr"],
    datasets: [{
      label: '',
      data: [12, 19, 3, 17, 28, 24, 7, 15, 10, 5, 8, 9],
      backgroundColor: "#569D98"
    }]
  },
  options: {
        legend: {
            display: false,
        }
    }
});