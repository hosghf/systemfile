var id = 0;
var id = $('#countFacility').val();
console.log(id);

$('#add').click(function () {
    id++;
    var title = $("#emkanatinput").val();
    $('#emkanatinput').val('');

    //add information as label to form just for watch
    $('#emkanat').append("<div class=\" facility" + id + " row text-bold mt-2 mb-0\">\n" +
        "  <div class=\"form-group ml-4 mb-0\">\n" +
        "  <p>"+ id +"</p>\n" +
        "   </div>\n" +
        "   <div class=\"form-group col-5 mb-0\">\n" +
        "   <p>"+ title +"</p>\n" +
        "   </div>\n" +
        "   <div class=\"form-group mb-0\">\n" +
        "   <button type=\"button\" onclick=\"t1(this)\" class=\"facility"+ id +" btn btn-hazf btn-outline-danger\"> حذف </button>\n" +
        "   </div>\n" +
        "   </div>");

    //add invisable forms of the tahte takafol values
    $('#emkanat').append("<input type=\'text\' class=' facility"+ id +" d-none' name='facility[]  '  value=\" "+ title +"  \"  >");

});

function t1(el) {
    var x = $(el).attr('class').split(' ')[0];
    $('.' + x).remove();
}


