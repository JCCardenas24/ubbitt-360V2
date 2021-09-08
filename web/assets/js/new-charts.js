// cambiar de tab

$('.href_bd_freemium').click(function (e) {
    e.preventDefault();
    $('a[href="#freemium_option"]').tab('show');
    $('a[href="#freemium-inbound"]').tab('show');
    $('a[href="#freemium-inbound-call-center"]').tab('show');
    $('a[href="#freemium-call-center-bd"]').tab('show');
});
