$(document).ready(function () {
    //Ajax to insert the supplier data in the database
    $('#supplier_registration').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "./ajax/ajax_supplier.php",
            data: {supplier_insert: 'supplier_insert',
                    data : $(this).serialize()},
            success: function (response) {
                $('.result_alerts').html(response).fadeIn(100);
                    setTimeout(function() {
                        $('.result_alerts').fadeOut('slow',function(){
                        $('.result_alerts').remove(); 
                        }); 
                    }, 3000);
                    $("#supplier_registration").trigger("reset");
            }
        });
    });

    //Ajax to insert the raw product data in the database
    $('#new_raw_stock_entry').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "./ajax/ajax_supplier.php",
            data: {raw_product_insert: 'raw_product_insert',
                    data : $(this).serialize()},
            success: function (response) {
                $('.result_alerts').html(response).fadeIn(100);
                    setTimeout(function() {
                        $('.result_alerts').fadeOut('slow',function(){
                        $('.result_alerts').remove(); 
                        }); 
                    }, 3000);
                    $("#new_raw_stock_entry").trigger("reset");
            }
        });
    });
    //ajax to get the supplier email
    $('#enquiry_supplier_id').change(function (e) { 
        e.preventDefault();
        var enquiry_supplier_id = $(this).val();

        $.ajax({
            type: "post",
            url: "./ajax/ajax_supplier.php",
            data: {enquiry_supplier_id:enquiry_supplier_id},
            success: function (response) {
                $('#supplier_email').val(response);
            }
        });
    });

    $('#purchase_inc_no').change(function (e) { 
        e.preventDefault();
        var inc_no = $(this).val();
        $.ajax({
            type: "post",
            url: "./ajax/ajax_supplier.php",
            data: {purchase_inc_no:inc_no},
            success: function (response) {
                if(response==2){
                $('#dublicate_purchase_inc').removeClass('d-none');
                $('#purchase_inc_no').val("");
                }else{
                    $('#dublicate_purchase_inc').addClass('d-none');
                }
            }
        });
    });
});