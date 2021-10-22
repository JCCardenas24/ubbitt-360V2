// from tab menu to side menu
$('.level-three .nav-link').on('shown.bs.tab', function (event) {
    let current_href = $(this).attr('href');
    let create_id = current_href.substring(1) + '_side_menu';
    $('.side-menu-link-redirect').removeClass('font-weight-bold');
    $('#' + create_id).addClass('font-weight-bold');
    updateUrlHash(current_href + '-tab');
});

//href nav tabs
// Javascript to enable link to tab

$(() => {
    setTimeout(() => {
        let tabId = location.hash.replace(/^#/, ''); // ^ means starting, meaning only match the first hash

        if (tabId) {
            $('#' + tabId).tab('show');
        }
    }, 500);
});

$('.side-menu-link-redirect').click(function (e) {
    let tabId = $(this).attr('href').split('#')[1];
    updateUrlHash(tabId);
    $('#' + tabId).tab('show');
});

function updateUrlHash(hash) {
    var x = window.pageXOffset,
        y = window.pageYOffset;
    window.location.hash = hash;
    $(window).one('scroll', function () {
        window.scrollTo(x, y);
    });
}
