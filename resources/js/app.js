require("./bootstrap");
require("alpinejs");
const axios = require("axios");

import { Chart, registerables } from "chart.js";
import { identity } from "lodash";
Chart.register(...registerables);

const axiosInstance = axios.create({
    baseURL:
        window.location.hostname == "127.0.0.1"
            ? "http://127.0.0.1:8000/"
            : "https://www.brassagemforte.com.br/bjcp-score",
});

var year = document.getElementById("chart-year");

if (year) {
    var userId = year.dataset.userid ?? '';
    axiosInstance.get("year/chart/" + userId).then(function (response) {
        var chart = new Chart(year, {
            type: "line",
            data: {
                labels: response.data.date,
                datasets: [
                    {
                        label: "Date",
                        data: response.data.total,
                        backgroundColor: "rgba(0,0,0, 0.7)",
                        borderColor: "rgba(0,0,0, 1)",
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

var ctx = document.getElementById("chart");
if (ctx) {
    axiosInstance.get("ranking/chart").then(function (response) {
        var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: response.data.style,
                datasets: [
                    {
                        label: "Estilos",
                        data: response.data.count,
                        backgroundColor: "rgba(0,0,0, 0.7)",
                        borderColor: "rgba(0,0,0, 1)",
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                indexAxis: "y",
                elements: {
                    bar: {
                        borderWidth: 1,
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
