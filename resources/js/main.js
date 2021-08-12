document.querySelector(".logout-btn").addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
});

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
    $('.filter-types').val(type);
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
