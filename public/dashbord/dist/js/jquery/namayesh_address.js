$(document).ready(function(){
    $('#address').keyup(function() {
        var y = $('#address').val();
        y = y.substring(0,14) ;
        $('#addressToShow').text(y);
    });
    var first = $('#address').val();
    first = first.substring(0,14) ;
    $('#addressToShow').text(first);
});