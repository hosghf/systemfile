$( document ).ready(function() {

    $('.img-btn-delete').click(function () {
        var id = $(this).val();
        $.post("/deleteimage",
            {
                id: id
            },
            function(data, status){
                // alert("data: " + data + "\nstatus: " + status);
                console.log("data: " + data + "\nstatus: " + status);
        });

        $(this).parent().remove();
    });

});

