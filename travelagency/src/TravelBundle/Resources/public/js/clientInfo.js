$(document).ready(function() {

    var titles = $(".accordion__title"),
        texts = $(".accordion__text");

    texts.hide();
    titles.on("click", function () {
        var that = $(this);
        var text=that.next(".accordion__text");
        that.toggleClass("accordion__title--active", text.is(":hidden"));


        if (text.is(":hidden")) {
            text.stop().slideDown();
        } else {
            text.stop().slideUp();
        }

    });

});
