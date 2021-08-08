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

// Upload image
const wrapper = document.querySelector(".wrapper");
const fileName = document.querySelector(".file-name");
const defaultBtn = document.querySelector("#default-btn");
const customBtn = document.querySelector("#custom-btn");
const cancelBtn = document.querySelector("#cancel-btn i");
const img = document.querySelector(".avt-upload-image");
let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;

customBtn.addEventListener("click", function () {
    defaultBtn.click();
})

defaultBtn.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            const result = reader.result;
            img.src = result;
            wrapper.classList.add("active");
        }
        cancelBtn.addEventListener("click", function () {
            img.src = "";
            wrapper.classList.remove("active");
        })
        reader.readAsDataURL(file);
    }
    if (this.value) {
        let valueStore = this.value.match(regExp);
        fileName.textContent = valueStore;
    }
});

document.querySelector(".logout-btn").addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
});
