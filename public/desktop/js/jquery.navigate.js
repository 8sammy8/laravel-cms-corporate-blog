jQuery(document).ready(function ($) {
    var currentLi;
    $('#top-navigation > li').on('mouseover', function (e) {
        currentLi = $(this);
        currentLi.find('ul.sub-menu').show();
    });
    $('#top-navigation > li').on('mouseout', function (e) {
        currentLi.find('ul.sub-menu').hide();
    });
});
