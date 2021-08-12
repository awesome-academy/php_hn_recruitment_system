$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    var urlData = $('#userData').val();
    var table = $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 4,
        ajax: {
            url: urlData,
        },
        columns: [
            {
                data: 'user_id',
                name: 'user_id'
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'avatar',
                name: 'avatar',
                orderable: false
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'phone_number',
                name: 'phone_number',
                orderable: false
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'view',
                name: 'view',
                orderable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ]
    });

    $('.filter-select').change(function () {
        table.columns($(this).data('column'))
            .search($(this).val())
            .draw();
    })

    $user_id = null;
    $(document).on('click', '.block-btn', function () {
        user_id = $(this).attr('id');
    });
    $(document).on('click', '.btn-block-confirm', function () {
        var routeUrl = $('#changeStatus').val();
        $.ajax({
            url: routeUrl,
            method: "post",
            data: {
                user_id: user_id,
            },
            success: function (data) {
                $('#user_table').DataTable().ajax.reload();
            }
        })
    });
});
