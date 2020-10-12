$(document).ready(function () {

    $('#carton_entry').click(function (e) { 
        e.preventDefault();

        var carton_entry = $(this).attr("id");
        var carton_title = $("#carton_title").val();
        var product_id = $("#product_id").val();
        var carton_qty = $("#carton_qty").val();
        var carton_lable = $("#carton_lable").val();
        var carton_sub_lable = $("#carton_sub_lable").val();
        var carton_box_size = $("#carton_box_size").val();

        $.ajax({
            type: "POST",
            url: "ajaxphp/ajaxproduct.php",
            data: {"carton_entry": carton_entry,
            "carton_title": carton_title,
            "product_id": product_id,
            "carton_qty": carton_qty,
            "carton_lable": carton_lable,
            "carton_sub_lable": carton_sub_lable,
            "carton_box_size": carton_box_size},
            success: function (response) {
                $('#carton_alerts').html(response);
                $("#carton_form")[0].reset();
                $("#carton_alerts").fadeTo(3000, 500).slideUp(500, function(){
                    $("#carton_alerts").slideUp(500);
                });
            }
        });
        
    }); 

});