$(document).ready(function () {

    $('#add_partner').click(function (e) { 
        e.preventDefault();

        var add_partner = $(this).attr("id");
        var partner_title = $("#partner_title").val();
        var partner_contact = $("#partner_contact").val();
        var partner_email = $("#partner_email").val();
        var partner_address = $("#partner_address").val();
        var bank_name = $("#bank_name").val();
        var ac_number = $("#ac_number").val();
        var branch_name = $("#branch_name").val();
        var ifsc_code = $("#ifsc_code").val();
        var ac_holder = $("#ac_holder").val();
        var partner_state = $("#partner_state").val();
        var partner_state_code = $("#partner_state_code").val();
        var partner_gst = $("#partner_gst").val();

        $.ajax({
            type: "POST",
            url: "ajaxphp/ajaxinvoice.php",
            data: {"add_partner": add_partner,
            "partner_title": partner_title,
            "partner_contact": partner_contact,
            "partner_email": partner_email,
            "partner_address": partner_address,
            "bank_name": bank_name,
            "ac_number": ac_number,
            "branch_name": branch_name,
            "ifsc_code": ifsc_code,
            "ac_holder": ac_holder,
            "partner_state": partner_state,
            "partner_state_code": partner_state_code,
            "partner_gst": partner_gst},
            success: function (response) {
                $('#partner_alerts').html(response);
                $("#insert_partner")[0].reset();
                $("#partner_alerts").fadeTo(3000, 500).slideUp(500, function(){
                    $("#partner_alerts").slideUp(500);
                });
            }
        });
        
    }); 

    $('#add_customer').click(function (e) { 
        e.preventDefault();

        var add_customer = $(this).attr("id");
        var customer_title = $("#customer_title").val();
        var customer_contact = $("#customer_contact").val();
        var customer_email = $("#customer_email").val();
        var customer_address = $("#customer_address").val();
        var customer_state = $("#customer_state").val();
        var customer_state_code = $("#customer_state_code").val();
        var customer_gst = $("#customer_gst").val();

        $.ajax({
            type: "POST",
            url: "ajaxphp/ajaxinvoice.php",
            data: {"add_customer": add_customer,
            "customer_title": customer_title,
            "customer_contact": customer_contact,
            "customer_email": customer_email,
            "customer_address": customer_address,
            "customer_state": customer_state,
            "customer_state_code": customer_state_code,
            "customer_gst": customer_gst},
            success: function (response) {
                $('#customer_alerts').html(response);
                $("#insert_customer")[0].reset();
                $("#customer_alerts").fadeTo(3000, 500).slideUp(500, function(){
                    $("#customer_alerts").slideUp(500);
                });
            }
        });
        
    }); 
}); 
