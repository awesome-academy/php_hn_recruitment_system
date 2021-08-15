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

    function searchUser(query = '') {
        var searchUrl = $('#search-member-url').val();

        $.ajax({
            url: searchUrl,
            method: 'GET',
            data: { query: query },
            success: function (data) {
                var html = '';
                data.forEach(user => {
                    if (user.logo != null) {
                        image = user.logo.replace('public/','');
                        imageUrl = `/storage/${image}`;
                        profileUrl = `/employer/profiles/${user.id}`
                    } else {
                        imageUrl = `/images/${user.avatar}`;
                        profileUrl = `/employee-profiles/${user.id}`;
                    }
                    html += renderUsers(user);
                });
                $('#list-user').html(html);
            }
        })
    }

    function renderUsers(user) {
        html = `
            <li class="list-item">
                <a href="${profileUrl}" class="conversation-toggler media-hover p-h-20">
                    <div class="media-img">
                        <img src="${imageUrl}">
                    </div>
                    <div class="info">
                        <span class="title p-t-10">${user.name}</span>
                    </div>
                </a>
            </li>`;

        return html
    }

    $("#search-member").keyup(function () {
        var query = $(this).val();
        searchUser(query);
    });
});
