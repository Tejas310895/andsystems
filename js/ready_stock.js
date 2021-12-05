$(document).ready(function () {
    $('#ready_stock_product_qty').change(function (e) { 
        e.preventDefault();
        var product_qty = $(this).val();
        var product_id = $('#custom_product_id').val();

        $.ajax({
            type: "post",
            url: "./ajax/ajax_ready_stock.php",
            data: {product_qty:product_qty,
                       product_id:product_id},
            success: function (response) {
                if(response==2){
                    $('#stock_alert').removeClass('d-none');
                    $('#ready_stock_product_qty').val("");
                }else{
                    $('#stock_alert').addClass('d-none');
                }
            }
        });
    });

    $('#custom_product_id').change(function (e) { 
        e.preventDefault();
        $('#ready_stock_product_qty').val("");
    });

    $('#work_product_type').change(function (e) { 
        e.preventDefault();
        var work_product_type = $(this).val();

        if(work_product_type=='product_manufac'){
            $('#manufac_select').removeClass('d-none');
            $('#raw_select').addClass('d-none');
            $('#custom_select').addClass('d-none');

            $('#manufac_product_id').attr("required", true);
            $('#manufac_product_qty').attr("required", true);


            $('#raw_product_id').attr("required", false);
            $('#raw_product_qty').attr("required", false);
            $('#custom_product_id').attr("required", false);
            $('#custom_product_qty').attr("required", false);


            $('#raw_product_id').val("");
            $('#raw_product_qty').val("");
            $('#custom_product_id').val("");
            $('#custom_product_qty').val("");

            $(".remove1").parents(".fieldGroup1").remove();
            $(".remove2").parents(".fieldGroup2").remove();

        }if(work_product_type=='product_sale_raw'){
            $('#raw_select').removeClass('d-none');
            $('#manufac_select').addClass('d-none');
            $('#custom_select').addClass('d-none');

            $('#raw_product_id').attr("required", true);
            $('#raw_product_qty').attr("required", true);


            $('#manufac_product_id').attr("required", false);
            $('#manufac_product_qty').attr("required", false);
            $('#custom_product_id').attr("required", false);
            $('#custom_product_qty').attr("required", false);


            $('#manufac_product_id').val("");
            $('#manufac_product_qty').val("");
            $('#custom_product_id').val("");
            $('#custom_product_qty').val("");

            $(".remove").parents(".fieldGroup").remove();
            $(".remove2").parents(".fieldGroup2").remove();

        }if(work_product_type=='product_sale_custom'){
            $('#custom_select').removeClass('d-none');
            $('#raw_select').addClass('d-none');
            $('#manufac_select').addClass('d-none');

            $('#custom_product_id').attr("required", true);
            $('#custom_product_qty').attr("required", true);


            $('#raw_product_id').attr("required", false);
            $('#raw_product_qty').attr("required", false);
            $('#manufac_product_id').attr("required", false);
            $('#manufac_product_qty').attr("required", false);


            $('#raw_product_id').val("");
            $('#raw_product_qty').val("");
            $('#manufac_product_id').val("");
            $('#manufac_product_qty').val("");

            $(".remove").parents(".fieldGroup").remove();
            $(".remove1").parents(".fieldGroup1").remove();

        }if(work_product_type=='product_sale_both'){
            $('#custom_select').removeClass('d-none');
            $('#raw_select').removeClass('d-none');
            $('#manufac_select').addClass('d-none');

            $('#custom_product_id').attr("required", true);
            $('#custom_product_qty').attr("required", true);
            $('#raw_product_id').attr("required", true);
            $('#raw_product_qty').attr("required", true);


            $('#manufac_product_id').attr("required", false);
            $('#manufac_product_qty').attr("required", false);


            $('#manufac_product_id').val("");
            $('#manufac_product_qty').val("");

            $(".remove").parents(".fieldGroup").remove();

        }if(work_product_type=='product_manufac_sale_raw'){
            $('#raw_select').removeClass('d-none');
            $('#manufac_select').removeClass('d-none');
            $('#custom_select').addClass('d-none');

            $('#raw_product_id').attr("required", true);
            $('#raw_product_qty').attr("required", true);
            $('#manufac_product_id').attr("required", true);
            $('#manufac_product_qty').attr("required", true);

            $('#custom_product_id').attr("required", false);
            $('#custom_product_qty').attr("required", false);

            $('#custom_product_id').val("");
            $('#custom_product_qty').val("");

            $(".remove2").parents(".fieldGroup2").remove();

        }if(work_product_type=='product_manufac_sale_custom'){
            $('#manufac_select').removeClass('d-none');
            $('#custom_select').removeClass('d-none');
            $('#raw_select').addClass('d-none');

            $('#custom_product_id').attr("required", true);
            $('#custom_product_qty').attr("required", true);
            $('#manufac_product_id').attr("required", true);
            $('#manufac_product_qty').attr("required", true);


            $('#raw_product_id').attr("required", false);
            $('#raw_product_qty').attr("required", false);


            $('#raw_product_id').val("");
            $('#raw_product_qty').val("");

            $(".remove1").parents(".fieldGroup1").remove();
        }if(work_product_type=='product_manufac_sale_both'){
            $('#custom_select').removeClass('d-none');
            $('#raw_select').removeClass('d-none');
            $('#manufac_select').removeClass('d-none');

            $('#custom_product_id').attr("required", true);
            $('#custom_product_qty').attr("required", true);
            $('#raw_product_id').attr("required", true);
            $('#raw_product_qty').attr("required", true);
            $('#manufac_product_id').attr("required", true);
            $('#manufac_product_qty').attr("required", true);
        }
    });
});