require('./bootstrap');
require('alpinejs');
const axios = require('axios');

import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

var year = document.getElementById('chart-year');
if(year) {
    axios.get('year/chart').then(function(response) {
        new Chart(year, {
            type: 'line',
            data: {
                labels: response.data.date,
                datasets: [{
                    label: 'Date',
                    data: response.data.total,
                    backgroundColor: 'rgba(0,0,0, 0.7)',
                    borderColor: 'rgba(0,0,0, 1)',
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                elements: {
                    bar: {
                        borderWidth: 1,
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'mês/ano'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'total'
                        },
                        ticks: {
                            stepSize: 1
                        }
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

var ranking = document.getElementById('chart');
if(ranking) {
    axios.get('ranking/chart').then(function(response) {
        new Chart(ranking, {
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
