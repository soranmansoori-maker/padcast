'use strict';

function PieChart(completedOrders, pendingOrders) {
    //pie chart
    var ctx = document.getElementById("pie-chart");
    if (ctx) {
        ctx.height = 210;
        var incomeChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [completedOrders, pendingOrders],
                    backgroundColor: [
                        "#29c4b2",
                        "#67bde2"
                    ],
                    hoverBackgroundColor: [
                        "#1b8a7d",
                        "#46839d"
                    ],

                }],
                labels: [
                    "تکمیل شده",
                    "در حال پردازش",
                ]
            },
            options: {
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                            return new Intl.NumberFormat('fa-IR').format(data['datasets'][0]['data'][tooltipItem['index']]);
                        },
                    },
                    backgroundColor: '#FFF',
                    titleFontSize: 16,
                    titleFontColor: '#0066ff',
                    titleFontFamily: "Shabnam, sans-serif",
                    bodyFontColor: '#000',
                    bodyAlign: 'center',
                    bodyFontSize: 14,
                    bodyFontFamily: "Shabnam, sans-serif",
                    displayColors: false
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        fontFamily: "Shabnam, sans-serif",
                    },
                },
                responsive: true,
            }
        });
    }

}
