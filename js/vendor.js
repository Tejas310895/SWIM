$(document).ready(function () {

    $('#add_vendor').click(function (e) { 
        e.preventDefault();

        var add_vendor = $(this).attr("id");
        var vendor_title = $("#vendor_title").val();
        var shop_title = $("#shop_title").val();
        var item_desc = $("#item_desc").val();
        var vendor_gstn = $("#vendor_gstn").val();
        var vendor_email = $("#vendor_email").val();
        var vendor_contact = $("#vendor_contact").val();
        var vendor_status = $("#vendor_status").val();

        $.ajax({
            type: "POST",
            url: "ajaxphp/ajaxvendor.php",
            data: {"add_vendor": add_vendor,
            "vendor_title": vendor_title,
            "shop_title": shop_title,
            "item_desc": item_desc,
            "vendor_gstn": vendor_gstn,
            "vendor_email": vendor_email,
            "vendor_contact": vendor_contact,
            "vendor_status": vendor_status},
            success: function (response) {
                $('#vendor_alerts').html(response);
                $("#insert_vendor")[0].reset();
                $("#vendor_alerts").fadeTo(3000, 500).slideUp(500, function(){
                    $("#vendor_alerts").slideUp(500);
                });
            }
        });
        
    }); 
    
    $('#add_raw').click(function (e) { 
        e.preventDefault();

        var add_raw = $(this).attr("id");
        var item_type = $("#item_type").val();
        var item_name = $("#item_name").val();
        var item_unit = $("#item_unit").val();
        var unit_cost = $("#unit_cost").val();
        var gst_rate = $("#gst_rate").val();

        $.ajax({
            type: "POST",
            url: "ajaxphp/ajaxvendor.php",
            data: {"add_raw": add_raw,
            "item_type": item_type,
            "item_name": item_name,
            "item_unit": item_unit,
            "unit_cost": unit_cost,
            "gst_rate": gst_rate},
            success: function (response) {
                $('#raw_alerts').html(response);
                $("#insert_raw")[0].reset();
                $("#raw_alerts").fadeTo(3000, 500).slideUp(500, function(){
                    $("#raw_alerts").slideUp(500);
                });
            }
        });
        
    });

    $('#item_id').change(function (e) { 

        var item_id = $("#item_id").val();
        
        $.ajax({
            type: "post",
            url: "ajaxphp/ajaxhelper.php",
            data: {"item_id": item_id},
            success: function (response) {
                $('#label_qty').html(response);
            }
        });
        
        });
        
        // $('#vendor_id').change(function (e) { 
        
        // var vendor_id = $("#vendor_id").val();
        
        // $.ajax({
        //     type: "post",
        //     url: "ajaxphp/ajaxhelper.php",
        //     data: {"vendor_id": vendor_id},
        //     success: function (response) {
        //         $('#item_id').html(response);
        //     }
        // });
        
        // });

    $('#raw_entry').click(function (e) { 
        e.preventDefault();

        var raw_entry = $(this).attr("id");
        var vendor_id = $("#vendor_id").val();
        var item_id = $("#item_id").val();
        var item_qty = $("#item_qty").val();
        var item_unit_cost = $("#item_unit_cost").val();
        var item_total_cost = $("#item_total_cost").val();
        var item_invoice = $("#item_invoice").val();
        var item_extra = $("#item_extra").val();


        $.ajax({
            type: "POST",
            url: "ajaxphp/ajaxvendor.php",
            data: {"raw_entry": raw_entry,
            "vendor_id": vendor_id,
            "item_id": item_id,
            "item_qty": item_qty,
            "item_unit_cost": item_unit_cost,
            "item_total_cost": item_total_cost,
            "item_invoice": item_invoice,
            "item_extra": item_extra},
            success: function (response) {
                $('#entry_alerts').html(response);
                // $('#insert_entry input[type="text"]').re('');
                $('#insert_entry select, input[type=text]').val('');
                $("#item_id")[0].selectedIndex = 0;
                $("#entry_alerts").fadeTo(3000, 500).slideUp(500, function(){
                    $("#entry_alerts").slideUp(500);
                });
            }
        });
        
    });

});