$(function () {
    $('.navbar-collapse .navbar-nav .nav-item .nav-link').filter(function () {
        return this.href == location.href
    }).parent().addClass('active').siblings().removeClass('active')
});

// slider

$('.owl-carousel').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    dots: false,
    lazyload: false,
    items: 1,
    navText: ["<i style='line-height: 32px !important; color: #7E8387 !important; font-size: 18px;' class='fa fa-angle-left text-dark'></i>", "<i style='line-height: 32px !important; font-size: 18px; color: #7E8387 !important;' class='fa fa-angle-right text-dark'></i>"]
})

console.log($('.owl-carousel').owlCarousel());

$(function () {

    $('.item-button').on('click', function () {
        $('.item-button').removeClass('active-button');
        $(this).addClass('active-button');

        let target = $(this).attr('id');
        $('.content').hide();
        $('.content-' + target).show();
    });
});
