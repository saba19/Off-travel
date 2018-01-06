$(document).ready(function () {
    var button=$('button');                                                                                                                                                             $('.button');
    console.log(button);
    button.on('click', function () {
        console.log("ok button");
        var phone=$('<span>Call 9999999 to book this tour</span>');
        $(this).closest('.tour').append(phone);
        $(this).remove();
    });

    $('.more').hide("fast");
    $('.showMore').on('click', function (e) {
        e.preventDefault();

        var more=$('.more');

        if (more.is(":hidden")){
            more.stop().slideDown();
            $(this).text("Pokaż mniej");
        } else {

            more.stop().slideUp();
            $(this).text("Pokaż więcej");
        }

    });




});