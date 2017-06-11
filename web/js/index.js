
$.LoadingOverlaySetup({
    color : "rgba(255, 255, 255, 1)"
});

$(document).ajaxStart(function() {
    $.LoadingOverlay("show");
});
$(document).ajaxStop(function() {
    $.LoadingOverlay("hide");
});

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

    var $tabs = $('#tabs');

    $tabs.activateTab = function($tab) {

        var $currentActive = $tabs.find('li.active');
        $currentActive.removeClass('active');

        $tab.addClass('active');
    };

    $tabs.on('click', 'li', function() {
        var $this = $(this);
        $tabs.activateTab($this);
    });

    app.fetchCategories();
});