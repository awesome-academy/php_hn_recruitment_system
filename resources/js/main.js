var logoutBtn = document.querySelector(".logout-btn");
if (logoutBtn) {
    logoutBtn.addEventListener("click", function (event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
}

/* autocomplete search */
var path = document.querySelector('.autocompleteUrl').value;
$('input.typeahead').typeahead({
    source: function (terms, process) {
        return $.get(path, {
            terms: terms
        }, function (data) {
            return process(data);
        });
    }
});

/* filter job search */
var type = [];
function filter_data() {
    type = get_filter('job-type');
    var keyword = $('.keyword').val();
    type = type.toString();
    $.ajax({
        url: "/search-job",
        method: "GET",
        data: { types: type, keyword: keyword },
        success: function (data) {
            $('.job-data').html(data.html);
        }
    });
}
function get_filter(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function () {
        filter.push($(this).val());
    });
    return filter;
}
$('.filter-selector').click(function () {
    filter_data();
});
