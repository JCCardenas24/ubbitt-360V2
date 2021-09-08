var ctx = document.getElementById("barInfo").getContext('2d');
var barChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["R. Efectivos", "R. Fuera de Gestion", "R. Segumiento"],
    datasets: [{
      label: '',
      data: [633, 1172, 1249],
      backgroundColor: "#DE496F"
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
                    size: 13,
                },
                anchor: 'end',
                align: 'top',
            }
        },
    }
});

let generoCanva = document.getElementById("genero");
let generoData = {
    labels: [
        "Cobradas",
        "Pendientes",
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

let generoChart = new Chart(generoCanva, {
    plugins: [ChartDataLabels],
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
                    size: 20,
                }
            }
        },
    }
});