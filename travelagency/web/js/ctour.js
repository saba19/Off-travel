$(document).ready(function () {
    var button=$('button');                                                                                                                                                             $('.button');
    console.log(button);
    button.on('click', function () {
        console.log("ok button");
        var phone=$('<span>Call 9999999 to book this tour</span>');
        $(this).closest('.tour').append(phone);
        $(this).remove();
    })

    var hideSpan=$(".more").hide();

    $("a.showMore").on("click", function(e) {

        e.preventDefault();

        var that = $(this),
            content = that.prev(".more");

        if(content.is(":hidden")){
            content.show();
            $(this).text("Pokaż mniej");
        } else {
            content.hide();
            $(this).text("Pokaż więcej");
        }

    });


});