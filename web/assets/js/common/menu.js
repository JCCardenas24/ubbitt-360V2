// from tab menu to side menu
$('.level-three .nav-link').on('shown.bs.tab', function (event) {
    let current_href = $(this).attr('href');
    let create_id = current_href.substring(1) + '_side_menu';
    $('.side-menu-link-redirect').removeClass('font-weight-bold');
    $('#' + create_id).addClass('font-weight-bold');
});

//href nav tabs
// Javascript to enable link to tab
$(function () {
    let tabId = location.hash.replace(/^#/, ''); // ^ means starting, meaning only match the first hash

    if (tabId) {
        $('#' + tabId).tab('show');
    }
});

$('.side-menu-link-redirect').click(function (e) {
    let tabId = $(this).attr('href').split('#')[1];
    var x = window.pageXOffset,
        y = window.pageYOffset;
    window.location.hash = tabId;
    $(window).one('scroll', function () {
        window.scrollTo(x, y);
    });
    $('#' + tabId).tab('show');
});
