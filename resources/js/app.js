import './bootstrap';

import { Chart, registerables } from "chart.js";
Chart.register(...registerables);

const axiosInstance = axios.create({
    baseURL:
        window.location.hostname == "localhost"
            ? "http://localhost/"
            : "https://bjcpscore.brassagemforte.com.br/",
});

Livewire.on("theme-updated", ({ theme }) => {
    document.body.classList.remove("dark", "light");
    document.body.classList.add(theme);
});

document.addEventListener('livewire:navigated', () => {
    var year = document.getElementById("chart-year");

    if (year) {
        var userId = year.dataset.userid ?? "";
        var color = document.children[0].classList.contains("dark") ? '255, 255, 255' : '100, 100, 100';
        axiosInstance.get("year/chart/" + userId).then(function (response) {
            var chart = new Chart(year, {
                type: "line",
                data: {
                    labels: response.data.date,
                    datasets: [
                        {
                            label: "Date",
                            data: response.data.total,
                            backgroundColor: "rgba(" + color + ", 0.7)",
                            borderColor: "rgba(" + color + ", 1)",
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
});
