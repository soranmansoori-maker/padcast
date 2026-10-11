'use strict';
function dataGrowChart(user_grow, orderGrow_array, completedGrow_array) {
    var options = {
        colors: ['#575b7a', '#5f87cb', '#7dd28e'],
        chart: {
            height: 350,
            type: 'bar',
            fontFamily: "iran",
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded',
                columnWidth: '55%',
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'کاربر جدید',
            data: [user_grow[6],user_grow[5],user_grow[4],user_grow[3],user_grow[2],user_grow[1]]
        }, {
            name: 'درخواست ثبت شده',
            data: [orderGrow_array[6],orderGrow_array[5],orderGrow_array[4],orderGrow_array[3],orderGrow_array[2],orderGrow_array[1]]
        }, {
            name: 'درخواست تکمیل شده',
            data: [completedGrow_array[6],completedGrow_array[5],completedGrow_array[4],completedGrow_array[3],completedGrow_array[2],completedGrow_array[1]]
        }],
        xaxis: {
            categories: ['5 ماه گذشته', '4 ماه گذشته', '3 ماه گذشته', '2 ماه گذشته', '1 ماه گذشته', 'ماه جاری'],
            labels: {
                style: {
                    colors: '#9aa0ac',
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    color: '#9aa0ac',
                }
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " مورد"
                }
            }
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#growChart"),
        options
    );

    chart.render();


}

function dataGrowChart2(orderGrow_array, completedGrow_array) {

    //line chart
    var ctx = document.getElementById("lineChartFill");
    if (ctx) {
        ctx.height = 143;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['5 ماه گذشته', '4 ماه گذشته', '3 ماه گذشته', '2 ماه گذشته', '1 ماه گذشته', 'ماه جاری'],
                defaultFontFamily: "iran",
                datasets: [
                    {
                        label: "درخواست ثبت شده",
                        borderColor: "rgba(0,0,0,.09)",
                        borderWidth: "1",
                        backgroundColor: "rgba(0,0,0,.07)",
                        data: [orderGrow_array[6],orderGrow_array[5],orderGrow_array[4],orderGrow_array[3],orderGrow_array[2],orderGrow_array[1]]
                    },
                    {
                        label: "درخواست تکمیل شده",
                        borderColor: "rgba(0, 123, 255, 0.9)",
                        borderWidth: "1",
                        backgroundColor: "rgba(0, 123, 255, 0.5)",
                        pointHighlightStroke: "rgba(26,179,148,1)",
                        data: [completedGrow_array[6],completedGrow_array[5],completedGrow_array[4],completedGrow_array[3],completedGrow_array[2],completedGrow_array[1]]
                    }
                ]
            },
            options: {
                legend: {
                    position: 'top',
                    labels: {
                        fontFamily: 'iran'
                    }

                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                    textDirection: 'rtl',
                    rtl: true,
                    titleAlign: 'right',
                    bodyAlign: 'right',
                    footerAlign: 'right'
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontFamily: "iran",
                            fontColor: "#9aa0ac", // Font Color

                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontFamily: "iran",
                            fontColor: "#9aa0ac", // Font Color
                        }
                    }]
                }

            }
        });
    }
}
