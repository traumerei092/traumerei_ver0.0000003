document.addEventListener('DOMContentLoaded', function() {
    function renderChart(id, data, label, titleColor) {
        var ctx = document.getElementById(id).getContext('2d');
        var labels = Object.keys(data);
        var counts = Object.values(data);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        labels: false
                    },
                    title: {
                        display: true,
                        text: label,
                        color: titleColor,
                        font: {
                            size: 18
                        }
                    }
                }
            }
        });
    }

    renderChart('movieChart', movieData, 'MOVIE', 'rgba(255, 99, 132, 1)');
    renderChart('sportChart', sportData, 'SPORTS', 'rgba(54, 162, 235, 1)');
    renderChart('hobbyChart', hobbyData, 'HOBBY', 'rgba(75, 192, 192, 1)');
});

