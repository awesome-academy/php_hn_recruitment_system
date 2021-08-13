$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    var urlData = $('#userData').val();
    var userTable = $('#user_table').DataTable({
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
        userTable.columns($(this).data('column'))
            .search($(this).val())
            .draw();
    });

    var path = $('#companyData').val();
    var companyTable = $('#company_table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 4,
        ajax: {
            url: path,
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
                data: 'logo',
                name: 'logo',
                orderable: false
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'website',
                name: 'website',
            },
            {
                data: 'industry',
                name: 'industry',
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

    $('.filter-selector').change(function () {
        companyTable.columns($(this).data('column'))
            .search($(this).val())
            .draw();
    });

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
                $('#company_table').DataTable().ajax.reload();
            }
        })
    });

    initJobsTable();
});

function initJobsTable() {
    const getJobsUrl = $('#get-jobs-url').val();
    $('#jobs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: getJobsUrl,
        },
        columns: [
            {
                data: 'title',
            },
            {
                data: 'employer_profile.name',
            },
            {
                data: 'close_at',
            },
            {
                data: 'status',
            },
            {
                data: 'actions',
                orderable: false,
            },
        ],
    });

    let deleteJobUrl = '';
    $(document).on('click', 'button#delete', () => {
        deleteJobUrl = $('button#delete').val();
    });

    $(document).on('click', '.btn-delete-confirm', function () {
        $.ajax({
            url: deleteJobUrl,
            method: 'post',
            data: {
                _method: 'delete',
            },
            success: () => {
                $('#jobs-table').DataTable().ajax.reload();
            },
        });
    });
}
