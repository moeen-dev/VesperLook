document.addEventListener("DOMContentLoaded", function () {
    const chartCanvas = document.getElementById("myChart");

    if (chartCanvas) {
        const labels = window.chartLabels || [];
        const data = window.chartData || [];

        const ctx = chartCanvas.getContext("2d");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Daily Sales (৳)",
                        data: data,
                        borderWidth: 5,
                        borderColor: "#6777ef",
                        backgroundColor: "rgba(103, 119, 239, 0.1)",
                        pointBackgroundColor: "#fff",
                        pointBorderColor: "#6777ef",
                        pointRadius: 4,
                        tension: 0.4,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return "৳ " + context.parsed.y.toLocaleString();
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return "৳ " + value;
                            },
                        },
                    },
                },
            },
        });
    }
});
