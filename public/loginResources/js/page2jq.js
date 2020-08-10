var id = 0;
var id = $('#last_id').val();
console.log(id);

$('#save').click(function () {

    id++;
    $('#last_id').val(id);
    var name = $('#Tname').val();
    var family = $('#Tfamily').val();
    var relative = $('#Trel').val();
    $('#Tname').val('');
    $('#Tfamily').val('');
    $('#Trel').val('');

    //add information as label to form just for watch
    $('#takafolShow').prepend(" <div  class=\""+ id +" mb-2 mt-2 col-12  \">\n" +
                                        "<label>" + name + "</label><label> - </label>\n" +
                                        "<label>" + family + "</label> <label> - </label>\n" +
                                        "<label>" + relative + "</label>\n" +
                                        "<button type=\"button\" onclick=\"t1(this)\" class=\"btn btn-danger delete \">حذف</button>\n" +
                                        "</div>");

    //add invisable forms of the tahte takafol values
    $('#takafolShow').append("<input type=\'text\' class=' "+ id +" takafols d-none' name='takafol" + id + "[]  '  value=\" "+ name +"  \"  >");
    $('#takafolShow').append("<input type=\'text\' class=' "+ id +" takafols d-none' name='takafol" + id + "[]  '  value=\" "+ family +"  \"  >");
    $('#takafolShow').append("<input type=\'text\' class=' "+ id +" takafols d-none' name='takafol" + id + "[]  '  value=\" "+ relative +"  \"  >");
    $('#takafolShow').append("<input type=\'text\' class=' "+ id +" takafols d-none' name='takafol" + id + "[]  '  value=\" "+ id +"  \"  >");


});

function t1(el) {
    // id--;
    var x = $(el).parent().attr('class').split(' ')[0];
    console.log(x);
    $('.' + x).remove();
    // $(el).remove();
}


