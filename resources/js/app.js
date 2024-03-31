import './bootstrap';

import { Chart, registerables } from "chart.js";
Chart.register(...registerables);

const axiosInstance = axios.create();

var year = document.getElementById("chart-year");

if (year) {
    var userId = year.dataset.userid ?? "";
    axiosInstance.get("year/chart/" + userId).then(function (response) {
        var chart = new Chart(year, {
            type: "line",
            data: {
                labels: response.data.date,
                datasets: [
                    {
                        label: "Date",
                        data: response.data.total,
                        backgroundColor: "rgba(255,255,255, 0.7)",
                        borderColor: "rgba(255,255,255, 1)",
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                elements: {
                    bar: {
                        borderWidth: 1,
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: "mês/ano",
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: "total",
                        },
                        ticks: {
                            stepSize: 1,
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
    });
}
