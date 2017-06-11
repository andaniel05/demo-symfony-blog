
var app = new Vue({
    el: '#app',
    data: {
        articles: [],
        categories: [],
        incomplete: false,
    },
});

app.fetchCategories = function() {
    $.getJSON('/api/categories', function(categories) {
        app.categories = categories;
    });
};

$(document).ready(function() {

    $.LoadingOverlaySetup({
        color : "rgba(255, 255, 255, 1)"
    });

    $(document).ajaxStart(function() {
        $.LoadingOverlay("show");
    });
    $(document).ajaxStop(function() {
        $.LoadingOverlay("hide");
    });

    app.fetchCategories();
});