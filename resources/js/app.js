require('./bootstrap');
require('alpinejs');
const axios = require('axios');

import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);


var ctx = document.getElementById('chart');
if(ctx) {
    axios.get('ranking/chart').then(function(response) {
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: response.data.style,
                datasets: [{
                    label: 'Estilos',
                    data: response.data.count,
                    backgroundColor: 'rgba(0,0,0, 0.7)',
                    borderColor: 'rgba(0,0,0, 1)',
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 1,
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                }
            }
        });
    });
}
