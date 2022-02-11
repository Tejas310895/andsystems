$(document).ready(function () {
    //Ajax to insert the customer data in the database
    $('#customer_registration').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "./ajax/ajax_sales.php",
            data: {
                customer_insert: 'customer_insert',
                data: $(this).serialize()
            },
            success: function (response) {
                $('.result_alerts').html(response).fadeIn(100);
                setTimeout(function () {
                    $('.result_alerts').fadeOut('slow', function () {
                        $('.result_alerts').remove();
                    });
                }, 3000);
                $("#customer_registration").trigger("reset");
            }
        });
    });

    $('#billed_title').change(function (e) {

        var customer_title = $(this).val();

        $.ajax({
            type: "POST",
            url: "./ajax/ajax_sales.php",
            data: { "customer_title": customer_title, },
            success: function (response) {
                customer = JSON.parse(response);
                console.log(customer);
                $('#billed_contact').val(customer.customer_contact);
                $('#billed_address').val(customer.customer_address);
                $('#billed_state').val(customer.customer_state);
                $('#billed_state_code').val(customer.customer_state_code);
                $('#billed_gstn').val(customer.customer_gstn);
            }
        });

    });

    $('#product_type').change(function (e) {
        e.preventDefault();
        var product_type = $(this).val();

        if (product_type == 'raw') {
            $('#raw_select').removeClass('d-none');
            $('#custom_select').addClass('d-none');

            $('#raw_product_id').attr("required", true);
            $('#raw_product_qty').attr("required", true);
            $('#raw_product_hsn_code').attr("required", true);
            $('#raw_product_unit_rate').attr("required", true);
            $('#raw_product_discount').attr("required", true);
            $('#raw_product_gst_type').attr("required", true);
            $('#raw_product_gst_rate').attr("required", true);

            $('#custom_product_id').attr("required", false);
            $('#custom_product_qty').attr("required", false);
            $('#custom_product_hsn_code').attr("required", false);
            $('#custom_product_unit_rate').attr("required", false);
            $('#custom_product_discount').attr("required", false);
            $('#custom_product_gst_type').attr("required", false);
            $('#custom_product_gst_rate').attr("required", false);

            $('#custom_product_id').val("");
            $('#custom_product_qty').val("");
            $('#custom_product_hsn_code').val("");
            $('#custom_product_unit_rate').val("");
            $('#custom_product_discount').val("");
            $('#custom_product_gst_type').val("");
            $('#custom_product_gst_rate').val("");

            $(".remove1").parents(".fieldGroup1").remove();

        } if (product_type == 'custom') {
            $('#custom_select').removeClass('d-none');
            $('#raw_select').addClass('d-none');

            $('#custom_product_id').attr("required", true);
            $('#custom_product_qty').attr("required", true);
            $('#custom_product_hsn_code').attr("required", true);
            $('#custom_product_unit_rate').attr("required", true);
            $('#custom_product_discount').attr("required", true);
            $('#custom_product_gst_type').attr("required", true);
            $('#custom_product_gst_rate').attr("required", true);

            $('#raw_product_id').attr("required", false);
            $('#raw_product_qty').attr("required", false);
            $('#raw_product_hsn_code').attr("required", false);
            $('#raw_product_unit_rate').attr("required", false);
            $('#raw_product_discount').attr("required", false);
            $('#raw_product_gst_type').attr("required", false);
            $('#raw_product_gst_rate').attr("required", false);

            $('#raw_product_id').val("");
            $('#raw_product_qty').val("");
            $('#raw_product_hsn_code').val("");
            $('#raw_product_unit_rate').val("");
            $('#raw_product_discount').val("");
            $('#raw_product_gst_type').val("");
            $('#raw_product_gst_rate').val("");

            $(".remove").parents(".fieldGroup").remove();

        } if (product_type == 'both') {
            $('#raw_select').removeClass('d-none');
            $('#custom_select').removeClass('d-none');

            $('#raw_product_id').attr("required", true);
            $('#raw_product_qty').attr("required", true);
            $('#raw_product_hsn_code').attr("required", true);
            $('#raw_product_unit_rate').attr("required", true);
            $('#raw_product_discount').attr("required", true);
            $('#raw_product_gst_type').attr("required", true);
            $('#raw_product_gst_rate').attr("required", true);

            $('#custom_product_id').attr("required", true);
            $('#custom_product_qty').attr("required", true);
            $('#custom_product_hsn_code').attr("required", true);
            $('#custom_product_unit_rate').attr("required", true);
            $('#custom_product_discount').attr("required", true);
            $('#custom_product_gst_type').attr("required", true);
            $('#custom_product_gst_rate').attr("required", true);
        }
    });

    $('#Inc_num_id').change(function (e) {
        e.preventDefault();
        var Inc_num_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "./ajax/ajax_sales.php",
            data: { "Inc_num_id": Inc_num_id, },
            success: function (response) {
                if (response == 2) {
                    $('#Inc_num_id').val("");
                    $('#Inc_alert_lable').removeClass('d-none');
                } else {
                    $('#Inc_alert_lable').addClass('d-none');
                }
            }
        });

    });

});