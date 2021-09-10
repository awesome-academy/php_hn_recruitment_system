$('#application-action form').on('submit', async (event) => {
    event.preventDefault();

    const isConfirmed = await confirm();
    if (isConfirmed) {
        event.target.submit();
    }
});

function confirm() {
    //Trigger the modal
    $('#modal-confirm').modal({
        backdrop: 'static',
        keyboard: false,
    });

    return new Promise((resolve) => {
        $('#btn-confirm').on('click', () => {
            $('#modal-confirm').modal('hide');
            resolve(true);
        });

        $('#btn-cancel').on('click', () => {
            $('#modal-confirm').modal('hide');
            resolve(false);
        });
    });
}

//Remove all event listeners once the modal is closed.
$('#modal-confirm').on('hidden.bs.modal', () => {
    $('#btn-confirm').off();
    $('#btn-cancel').off();
});

+function($, window){

    var chartJs = {};

    chartJs.init = function(data) {
        //Donut Chart
        var donutChart = document.getElementById("donut-chart");
        var donutCtx = donutChart.getContext('2d');
        donutChart.height = 292;
        var donutData = {
            labels: data.appliedStatus,
            datasets: [
                {
                    fill: true,
                    backgroundColor: [app.colors.success, app.colors.info, app.colors.primary],
                    data: data.appliedCnt,
                }
            ]
        };

        var donutConfig = new Chart(donutCtx, {
            type: 'doughnut',
            data: donutData,
            options: {
                maintainAspectRatio: false,
                hover: {mode: null},
                cutoutPercentage: 45,
            }
        });
    };

    window.chartJs = chartJs;

}(jQuery, window);

// initialize app
+function($) {
    let jobId = $('#jobId').val();
    $.ajax({
        url: '/jobs/applied-data/' + jobId,
        method: 'get',
        success: (data) => {
            chartJs.init(data);
        },
    });
}(jQuery);
