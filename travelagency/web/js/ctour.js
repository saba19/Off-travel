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

    var img = $(".col-sm-7 text-left").find(".large img");
    console.log(img);


        $("img").on("click", function() {

        //var img = $(".col-sm-7 text-left").find(".large img"),
            var zoomed=$(this).data("zoomed");
            //$(this).slideToggle();


        if(!zoomed) {

            $(this).stop().animate({
                width: "700",
                height:"300"
            }, 1000, function () {
                $(this).data("zoomed",true);

            });

        } else {

           $(this).stop().animate({
                width: "350",
                height:"150"
            }, 1000, function () {
                $(this).removeData("zoomed");
            });

        }

    });




});