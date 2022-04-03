$(document).ready(function () {
  //group add limit
  var maxGroup = 10;

  //add more fields group
  $(".addMore").click(function () {
    if ($('body').find('.fieldGroup').length < maxGroup) {
      var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
      $('body').find('.fieldGroup:last').after(fieldHTML);
    } else {
      alert('Maximum ' + maxGroup + ' groups are allowed.');
    }
  });

  //remove fields group
  $("body").on("click", ".remove", function () {
    $(this).parents(".fieldGroup").remove();
  });

  function setBillingAddress() {
    if ($("#match_billed").is(":checked")) {
      $('#ship_title').val($('#billed_title').val());
      $('#ship_title').attr('readonly', true);

      $('#ship_contact').val($('#billed_contact').val());
      $('#ship_contact').attr('readonly', true);

      $('#ship_address').val($('#billed_address').val());
      $('#ship_address').attr('readonly', true);

      $('#ship_gst').val($('#billed_gst').val());
      $('#ship_gst').attr('readonly', true);

      $('#ship_state').val($('#billed_state').val());
      $('#ship_state').attr('readonly', true);

      $('#ship_state_code').val($('#billed_state_code').val());
      $('#ship_state_code').attr('readonly', true);

    } else {
      $('#ship_title').removeAttr('readonly');
      $('#ship_contact').removeAttr('readonly');
      $('#ship_address').removeAttr('readonly');
      $('#ship_gst').removeAttr('readonly');
      $('#ship_state').removeAttr('readonly');
      $('#ship_state_code').removeAttr('readonly');
    }
  }

  $('#match_billed').click(function () {
    setBillingAddress();
  })

  $('#partner_id').change(function (e) {
    e.preventDefault();

    var partner_name = $('#partner_id :selected').text();
    var short_partner = partner_name.substr(0, 2);

    $.ajax({
      type: "POST",
      url: "ajaxphp/ajaxinvoice.php",
      data: { "invoice_pre": short_partner, },
      success: function (response) {
        $('#invoice_pre').val(short_partner);
        $('#invoice_suf').val(response);

      }
    });

  });

  $('#billed_title').change(function (e) {

    var customer_title = $(this).val();

    $.ajax({
      type: "POST",
      url: "ajaxphp/ajaxinvoice.php",
      data: { "customer_title": customer_title, },
      success: function (response) {
        customer = JSON.parse(response);
        console.log(customer);
        $('#billed_contact').val(customer.customer_contact);
        $('#billed_address').val(customer.customer_address);
        $('#billed_state').val(customer.customer_state);
        $('#billed_state_code').val(customer.customer_state_code);
        $('#billed_gst').val(customer.customer_gst);
      }
    });

  });

  function blink(selector) {
    $(selector).fadeOut('fast', function () {
      $(this).fadeIn('fast', function () {
        blink(this);
      });
    });
  }

  blink('.blink');
});