$(document).ready(function () {
    var button=$('button');                                                                                                                                                             $('.button');
    console.log(button);
    button.on('click', function () {
        console.log("ok button");
        var phone=$('<span>Call 9999999 to book this tour</span>');
        $(this).closest('.tour').append(phone);
        $(this).remove();
    })
//console.log("ok");


});