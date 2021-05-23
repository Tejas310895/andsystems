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
});