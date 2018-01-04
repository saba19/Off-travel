$(document).ready(function () {
    var button=$('button');
    console.log(button);
    button.on('click', function () {
        var phone=$('<span>Call 9999999 to book this tour</span>');
        $('.tour').append(phone);
        $(this).remove();
    })
console.log("ok");




});