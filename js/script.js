 $(document).ready(function () {
//group add limit
var maxGroup = 20;
    
//add more fields group
$(".addMore").click(function(){
    if($('body').find('.fieldGroup').length < maxGroup){
        var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
        $('body').find('.fieldGroup:last').after(fieldHTML);
    }else{
        alert('Maximum '+maxGroup+' groups are allowed.');
    }
});

$(".addMore1").click(function(){
    if($('body').find('.fieldGroup1').length < maxGroup){
        var fieldHTML = '<div class="form-group fieldGroup1">'+$(".fieldGroupCopy1").html()+'</div>';
        $('body').find('.fieldGroup1:last').after(fieldHTML);
    }else{
        alert('Maximum '+maxGroup+' groups are allowed.');
    }
});

$(".addMore2").click(function(){
    if($('body').find('.fieldGroup2').length < maxGroup){
        var fieldHTML = '<div class="form-group fieldGroup2">'+$(".fieldGroupCopy2").html()+'</div>';
        $('body').find('.fieldGroup2:last').after(fieldHTML);
    }else{
        alert('Maximum '+maxGroup+' groups are allowed.');
    }
});

//remove fields group
$("body").on("click",".remove",function(){ 
    $(this).parents(".fieldGroup").remove();
});

//remove fields group
$("body").on("click",".remove1",function(){ 
    $(this).parents(".fieldGroup1").remove();
});

//remove fields group
$("body").on("click",".remove2",function(){ 
    $(this).parents(".fieldGroup2").remove();
});

function setBillingAddress(){
    if ($("#match_billed").is(":checked")) {
      $('#shipped_title').val($('#billed_title').val());
      $('#shipped_title').attr('readonly', true);
      
      $('#shipped_contact').val($('#billed_contact').val());
      $('#shipped_contact').attr('readonly', true);

      $('#shipped_address').val($('#billed_address').val());
      $('#shipped_address').attr('readonly', true);
      
      $('#shipped_gstn').val($('#billed_gstn').val());
      $('#shipped_gstn').attr('readonly', true);
      
      $('#shipped_state').val($('#billed_state').val());
      $('#shipped_state').attr('readonly', true);

      $('#shipped_state_code').val($('#billed_state_code').val());
      $('#shipped_state_code').attr('readonly', true);

    } else {
      $('#shipped_title').removeAttr('readonly');
      $('#shipped_title').val('');
      $('#shipped_contact').removeAttr('readonly');
      $('#shipped_contact').val('');
      $('#shipped_address').removeAttr('readonly');
      $('#shipped_address').val('');
      $('#shipped_gstn').removeAttr('readonly');
      $('#shipped_gstn').val('');
      $('#shipped_state').removeAttr('readonly');
      $('#shipped_state').val('');
      $('#shipped_state_code').removeAttr('readonly');
      $('#shipped_state_code').val('');
    }
  }
  
  $('#match_billed').click(function(){
    setBillingAddress();
  });

  function blink(selector){
    $(selector).fadeOut('fast', function(){
        $(this).fadeIn('fast', function(){
            blink(this);
        });
    });
    }
    
    blink('.blink');

    $("#purchase_check_all").click(function(){
        $('input[type="checkbox"][name^="purchase_inc"]').not(this).prop('checked', this.checked);
    });

    $("#sale_check_all").click(function(){
        $('input[type="checkbox"][name^="sale_inc"]').not(this).prop('checked', this.checked);
    });
    
 });
