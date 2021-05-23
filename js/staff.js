$(document).ready(function () {
    //Ajax to insert the staff data in the database
    $('#staff_registration').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "./ajax/ajax_staff.php",
            data: {staff_insert: 'staff_insert',
                   data : $(this).serialize()},
            success: function (response) {
                $('.result_alerts').html(response).fadeIn(100);
                    setTimeout(function() {
                        $('.result_alerts').fadeOut('slow',function(){
                        $('.result_alerts').remove(); 
                        }); 
                    }, 3000);
                    $("#staff_registration").trigger("reset");
            }
        });
    });

    //check the dublicate email
    $('#staff_email').change(function (e) { 
        e.preventDefault();
        var staff_email = $(this).val();

        $.ajax({
            type: "post",
            url: "./ajax/ajax_staff.php",
            data: {staff_email:staff_email},
            success: function (response) {
                if(response==2){
                    $('#emailHelp').removeClass('d-none');
                    $('#staff_email').val('');
                }else{
                    $('#emailHelp').addClass('d-none');
                }
            }
        });
    });

    //Ajax to edit the staff data in the database
    $('#staff_modification').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "./ajax/ajax_staff.php",
            data: {staff_edit: 'staff_edit',
                   data : $(this).serialize()},
            success: function (response) {
                $('.result_alerts').html(response).fadeIn(100);
                    setTimeout(function() {
                        $('.result_alerts').fadeOut('slow',function(){
                        $('.result_alerts').remove(); 
                        }); 
                    }, 3000);
            }
        });
    });

});