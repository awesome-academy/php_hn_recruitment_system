+function ($, window) {

    var chartJs = {};

    chartJs.init = function (jobData, typeData) {
        //Bar Chart
        var barChart = document.getElementById("bar-chart");
        var barCtx = barChart.getContext('2d');
        barChart.height = 120;
        var barConfig = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: typeData.types,
                datasets: [{
                    label: 'Active',
                    backgroundColor: app.colors.primary,
                    borderColor: app.colors.primary,
                    pointBackgroundColor: app.colors.primary,
                    borderWidth: 2,
                    data: typeData.activeCount
                },
                    {
                        label: 'Inactive',
                        backgroundColor: app.colors.success,
                        borderColor: app.colors.success,
                        pointBackgroundColor: app.colors.success,
                        borderWidth: 2,
                        data: typeData.inactiveCount
                    }]
            },

            options: {
                legend: {
                    display: false
                }
            }
        });

        //Gradient Chart
        var gradientCtx = document.getElementById('gradient-chart').getContext('2d');
        gradientCtx.height = 100;
        var gradientChartGradient = gradientCtx.createLinearGradient(0, 0, 0, 300);
        gradientChartGradient.addColorStop(0, app.colors.success);
        gradientChartGradient.addColorStop(1, app.colors.transparent);

        var bar_chart = new Chart(gradientCtx, {
            type: 'line',
            data: {
                labels: jobData.months,
                datasets: [{
                    data: jobData.jobCount,
                    backgroundColor: gradientChartGradient,
                    borderColor: app.colors.success,
                    pointBackgroundColor: app.colors.warning
                }]
            },
            options: {
                legend: {
                    display: false
                },
                maintainAspectRatio: false
            },
            scales: {
                yAxes: [{
                    stacked: true,
                    ticks: {
                        min: 0,
                        stepSize: 1,
                    }
                }]
            }
        });
    };

    window.chartJs = chartJs;

}(jQuery, window);

// initialize app
+function ($) {
    $.ajax({
        url: 'job-data',
        method: 'get',
        success: (jobData) => {
            $.ajax({
                url: 'job-type-data',
                method: 'get',
                success: (typeData) => {
                    chartJs.init(jobData, typeData);
                },
            });
        },
    });
}(jQuery);
