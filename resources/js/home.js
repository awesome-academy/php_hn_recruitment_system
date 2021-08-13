$(document).ready(function () {
    function loadMoreJob(page) {
        $.ajax({
            url: '?page=' + page,
            type: 'get',
            beforeSend: function () {
                $('.ajax-load').show();
            },
        }).done(function (data) {
            setTimeout(() => {
                if (data.html == "") {
                    $(".ajax-load p").html("No more record");
                    return;
                }
                $('.ajax-load').hide();
                $('.job-data').append(data.html);
            }, 500);
        })
    }

    function getDocHeight() {
        var D = document;

        return Math.max(
            D.body.scrollHeight, D.documentElement.scrollHeight,
            D.body.offsetHeight, D.documentElement.offsetHeight,
            D.body.clientHeight, D.documentElement.clientHeight
        );
    }

    var page = 1;
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() == getDocHeight()) {
            page++;
            loadMoreJob(page);
        }
    });
});
