$(document).ready(function () {
    var links = $('.navbar-collapse ul li .nav-link');
    $.each(links, function (key, va) {
        if (va.href == document.URL) {
            $(this).addClass('active-link');
        }
    });
});
