$(document).ready(function() {
    $('.photos').hide();

    $(".image").on('click', 'button', function() {

        $('.photos').toggle(1000);
    });

    $('#nights').on('keyup', function() {
        var nights = +$(this).val();
        var dailyPrice = +$(this).closest(".tour").data("daily-price");
        $('#total').text(nights * dailyPrice);
        $('#nights-count').text($(this).val());
    });




});
