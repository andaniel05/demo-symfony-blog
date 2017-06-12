
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
        currentPage: 1,
        currentCategory: null,
    },
    methods: {
        loadMore: function() {
            app.fetchArticles(app.paginationData.next);
        }
    }
});

app.fetchCategories = function() {
    $.getJSON('/api/categories', function(categories) {
        app.categories = categories;
    });
};

app.fetchArticles = function(page = 1) {

    var reqData = {
        page: page,
        category: app.currentCategory,
    };

    $.getJSON('/api/articles', reqData, function(resp) {

        app.articles = app.articles.concat(resp.articles);
        app.paginationData = resp.paginationData;

        if (app.paginationData.current < app.paginationData.endPage) {
            app.incomplete = true;
        } else {
            app.incomplete = false;
        }
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

});

$(document).ready(function() {
    app.fetchCategories();
    app.fetchArticles();
});