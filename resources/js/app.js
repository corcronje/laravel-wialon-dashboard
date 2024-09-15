import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import { Chart, registerables } from "chart.js";

Chart.register(...registerables);

const tanks = document.querySelectorAll('.tank-level-chart');

console.log(tanks);

// get the data for each tank from the data-tank-id data-percentage attribute
tanks.forEach(tank => {
    const percentage = tank.getAttribute('data-percentage');

    console.log(percentage);

    const dataChart = {
        labels: ['Tank Level'],
        datasets: [{
            label: 'Tank Level',
            data: percentage,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: dataChart,
        options: {
            scales: {
  yAxes: [
    {
      ticks: {
        min: 0,
        max: 100,// Your absolute max value
        callback: function (value) {
          return (value / 100 * 100).toFixed(0) + '%'; // convert it to percentage
        },
      },
      scaleLabel: {
        display: true,
        labelString: 'Percentage',
      },
    },
  ],
}
        }
    };

    console.log(config);

    new Chart(tank, config);
});
