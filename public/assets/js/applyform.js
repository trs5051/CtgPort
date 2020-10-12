$.ajaxSetup({
 headers:{
   'X_CSRF_TOKEN':$('meta[name="_token"]').attr('content')
 }
});
$(document).ready(function() {
 var selected_sticker_category='';
 $('#sticker_category').change(function(){
  selected_sticker_category = $(this).val(); 
});
 $('#term_checkbox').change(function (){
   if (this.checked && (selected_sticker_category != '')){
    $(this).parent().parent().find('#next_btn').attr('disabled', false);
  }
  else{
   $(this).parent().parent().find('#next_btn').attr('disabled', true);
 }
});
 $('#next_btn').on('click',function(){
  if((selected_sticker_category == 'A') || (selected_sticker_category == 'B') || (selected_sticker_category == 'C') ||(selected_sticker_category =='D')){
   $('#content_term_condition').remove();
   $('#content_form_E').remove();
   $('#content_form_B').removeAttr('hidden');
   $('.sticker_category_name').text('(' +selected_sticker_category +')');
 }
 else if((selected_sticker_category == 'E') || (selected_sticker_category == 'F')|| (selected_sticker_category == 'S') || (selected_sticker_category == 'M')|| (selected_sticker_category == 'T')){
   $('#content_term_condition').remove();
   $('#content_form_B').remove();

   $('#content_form_E').removeAttr('hidden');
   $('.sticker_category_name').text('(' +selected_sticker_category +')');
 }
 $('#sticker_category').val(selected_sticker_category);  
 if(selected_sticker_category != 'F'){
  $('#driver_prev_btn').after('<div class="col-md-1"><button id="submit-btn" type="submit" class="btn btn-success submit-btn custm-btn">Save & Finish</button></div>');
  $('.helper-info').remove();
}else{
  $('#driver_prev_btn').after('<div class="col-md-1"><button id="submit-btn" type="submit" class="btn btn-primary submit-btn custm-btn">Save & Continue</button></div>');
}
});
 function readURL(input) {
   imgId = '#prev_'+ $(input).attr('id');
   if (input.files && (input.files[0].size / 1024 / 1024) < 0.25) {
    var reader = new FileReader();
    reader.onload = function (e) {

      $(imgId).attr('src', e.target.result);
      $(imgId).attr('hidden',false);
      $(imgId).css({'display':'inline-block','height':'auto','padding':'10px 0px','max-width':'70%','width': 'auto','max-height': '200px'});
    }
    reader.readAsDataURL(input.files[0]);
    $(input).siblings('div.err_msg').attr('hidden',true);
  }
  else{
    $(input).val('');  
    $(imgId).attr('hidden',true);
    $(input).siblings('div.err_msg').find('span').text('File size exceeds 250 KB.Please reduce file size less than 250kb');
    $(input).siblings('div.err_msg').attr('hidden',false);
  }
}

$("form#Application_Form_B input[type='file']").change(function(){            
  readURL(this);
  $(this).on('click',function(){
   imgId = '#prev_'+ $(this).attr('id');
   $(imgId).attr('hidden',true);
 })
}); $("form#Application_Form_B_Edit input[type='file']").change(function(){            
  readURL(this);
  $(this).on('click',function(){
   imgId = '#prev_'+ $(this).attr('id');
   $(imgId).attr('hidden',true);
 })
});
$(document).on('change',"form.Applycationform input[type='file']",function(){
  readURL(this);
  $(this).on('click',function(){
   imgId = '#prev_'+ $(this).attr('id');
   $(imgId).attr('hidden',true);
 })
});  $("form#Application_Form_E_Edit input[type='file']").change(function(){
  readURL(this);
  $(this).on('click',function(){
   imgId = '#prev_'+ $(this).attr('id');
   $(imgId).attr('hidden',true);
 })
});

function windowScrollTop(){
 $('html, body').animate({
  scrollTop: $("#adm-header-bar").offset().top
}, 0);
}

$('.owner_is_company').change(function (){
 if (this.checked){
  $(".company_info_field").attr('hidden', false);
  $(".company_info_field input[type='text']").attr('required', true);
}
else{
 $('.company_info_field').attr('hidden', true);
 $(".company_info_field input[type='text']").attr('required', false);
}
}); 


$('.self_driven').change(function (){
 if (this.checked){
  $(".not_self_driven").attr('hidden', true);
  $(".not_self_driven input").attr('required', false);
  // $(".not_self_driven input").val('');
}
else{
 $('.not_self_driven').attr('hidden', false);
 $(".Applycationform .not_self_driven input").attr('required', true);
 $(".not_self_driven input[type='checkbox']").attr('required', false);
 $(".driver_perm input").attr('required', false);
}
});
if($('#self_driven_checked').is(':checked')){
  $(".not_self_driven").attr('hidden', true);
  // $(".driver-is-not-owner").attr('hidden', true);
  $(".not_self_driven input").attr('required', false);
}
else{
 $('.not_self_driven').attr('hidden', false);
 // $('.driver-is-not-owner').attr('hidden', false);
 $(".Applycationform .not_self_driven input").attr('required', true);
 $(".not_self_driven input[type='checkbox']").attr('required', false);
 $(".driver_perm input").attr('required', false); 
} 
$('.owner_address_permanent').change(function (){
 if (this.checked){
  $('.o_per_house').val($('.o_house').val());
  $('.o_per_road').val($('.o_road').val());
  $('.o_per_block').val($('.o_block').val());
  $('.o_per_area').val($('.o_area').val());
}
else{
  $('.o_per_house').val('');
  $('.o_per_road').val('');
  $('.o_per_block').val('');
  $('.o_per_area').val('');  
}
});
$(document).on('change','.driver_address_same_as_present', function (){
 if (this.checked){
  $(this).parent().siblings().find('.driver_per_house').val($(this).parent().siblings().find('.driver_pre_house').val());
  $(this).parent().siblings().find('.driver_per_road').val($(this).parent().siblings().find('.driver_pre_road').val());
  $(this).parent().siblings().find('.driver_per_block').val($(this).parent().siblings().find('.driver_pre_block').val());
  $(this).parent().siblings().find('.driver_per_area').val($(this).parent().siblings().find('.driver_pre_area').val());
}
else{
  $(this).parent().siblings().find('.driver_per_house').val('');
  $(this).parent().siblings().find('.driver_per_road').val('');
  $(this).parent().siblings().find('.driver_per_block').val('');
  $(this).parent().siblings().find('.driver_per_area').val('');  
}
});
$(document).on('change','.helper_address_same_as_present', function (){
 if (this.checked){
  $(this).parent().siblings().find('.helper_per_house').val($(this).parent().siblings().find('.helper_pre_house').val());
  $(this).parent().siblings().find('.helper_per_road').val($(this).parent().siblings().find('.helper_pre_road').val());
  $(this).parent().siblings().find('.helper_per_block').val($(this).parent().siblings().find('.helper_pre_block').val());
  $(this).parent().siblings().find('.helper_per_area').val($(this).parent().siblings().find('.helper_pre_area').val());
}
else{
  $(this).parent().siblings().find('.helper_per_house').val('');
  $(this).parent().siblings().find('.helper_per_road').val('');
  $(this).parent().siblings().find('.helper_per_block').val('');
  $(this).parent().siblings().find('.helper_per_area').val('');  
}
});
$('#app_address_same_as_office').change(function (){
 if (this.checked){
  $('#app_pre_house').val($('#applicant_o_house').val());
  $('#app_pre_road').val($('#applicant_o_road').val());
  $('#app_pre_block').val($('#applicant_o_block').val());
  $('#app_pre_area').val($('#applicant_o_area').val());
}
else{
  $('#app_pre_house').val('');
  $('#app_pre_road').val('');
  $('#app_pre_block').val('');
  $('#app_pre_area').val('');    
}
});
$('#app_address_same_as_present').change(function (){
 if (this.checked){
  $('#app_per_house').val($('#app_pre_house').val());
  $('#app_per_road').val($('#app_pre_road').val());
  $('#app_per_block').val($('#app_pre_block').val());
  $('#app_per_area').val($('#app_pre_area').val());
}
else{
  $('#app_per_house').val('');
  $('#app_per_road').val('');
  $('#app_per_block').val('');
  $('#app_per_area').val(''); 
}
});
$('div#o_c_address_same_pre_per_ofc input[type="checkbox"]').on('change', 
  function() {
   $(this).siblings('input[type="checkbox"]').prop('checked', false);
   if ($('.o_c_address_same_pre:checked').val() == '0'){ 
    $('#o_c_house').val($('#app_pre_house').val());
    $('#o_c_road').val($('#app_pre_road').val());
    $('#o_c_block').val($('#app_pre_block').val());
    $('#o_c_area').val($('#app_pre_area').val());
  }
  else if ($('.o_c_address_same_per:checked').val()== '1'){
    $('#o_c_house').val($('#app_per_house').val());
    $('#o_c_road').val($('#app_per_road').val());
    $('#o_c_block').val($('#app_per_block').val());
    $('#o_c_area').val($('#app_per_area').val());
  }
  else if ($('.o_c_address_same_ofc:checked').val()== '2'){
    $('#o_c_house').val($('#applicant_o_house').val());
    $('#o_c_road').val($('#applicant_o_road').val());
    $('#o_c_block').val($('#applicant_o_block').val());
    $('#o_c_area').val($('#applicant_o_area').val());
  }
  else{
    $('#o_c_house').val('');
    $('#o_c_road').val('');
    $('#o_c_block').val('');
    $('#o_c_area').val('');
  }
});
///// date 
$("input[type='date']").on('change',function(){
  var date=new Date($(this).val());
  if (date <= new Date()){
    $(this).val('');
    $(this).parent().append("<div class='validity-check err_msg'><i  class='fas fa-exclamation-triangle'></i><span> This Validity Expired </span></div>");
  }else{
    $(this).siblings('.validity-check').remove();
  }
}); 
/// Form Validatiom function
function applicantInfoValidate(){
 if($("input#applicant_name").val()==''){
  $('#err_applicantName').text("Applicant's Name field is required");
  $('#err_msg_applicantName').attr('hidden',false);
  $("input#applicant_name").addClass('red-border');
}
else if($("input#applicant_name").val()!=null){
  $('#err_msg_applicantName').attr('hidden',true); 
  $("input#applicant_name").removeClass('red-border');
}
$("input#applicant_name").on("keyup bind cut change copy paste", function () {
  if($(this).val()!=null){
   $('#err_msg_applicantName').attr('hidden',true); 
   $("input#applicant_name").removeClass('red-border');
 }
 else{
  $('#err_msg_applicantName').attr('hidden',false); 
  $("input#applicant_name").addClass('red-border');   
}
});
            /////  
            if($("input#applicant_phone").val()==''){
              $('#err_applicantPhone').text("Applicant's Phone field is required");
              $('#err_msg_applicantPhone').attr('hidden',false);
              $("input#applicant_phone").addClass('red-border');
            }
            else if($("input#applicant_phone").val()!=null){
              $('#err_msg_applicantPhone').attr('hidden',true); 
              $("input#applicant_phone").removeClass('red-border');
            }
            $("input#applicant_phone").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantPhone').attr('hidden',true); 
               $("input#applicant_phone").removeClass('red-border');

             }
             else{
              $('#err_msg_applicantPhone').attr('hidden',false);
              $("input#applicant_phone").addClass('red-border');

            }
          });
            /////    
            if($("input#f_h_name").val()==''){
              $('#err_applicantFather').text("Applicant's Father/Husband name field is required");
              $('#err_msg_applicantFather').attr('hidden',false);
              $("input#f_h_name").addClass('red-border');
            }
            else if($("input#f_h_name").val()!=null){
              $('#err_msg_applicantFather').attr('hidden',true); 
              $("input#f_h_name").removeClass('red-border');
            }
            $("input#f_h_name").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantFather').attr('hidden',true);
               $("input#f_h_name").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantFather').attr('hidden',false); 
              $("input#f_h_name").addClass('red-border');   
            }
          });
            /////

            if($("input#applicant_nid").val()==''){
              $('#err_applicantNid').text('Applicant NID Number is required');
              $('#err_msg_applicantNid').attr('hidden',false);
              $("input#applicant_nid").addClass('red-border');
            }
            else if($("input#applicant_nid").val()!=null){
              $('#err_msg_applicantNid').attr('hidden',true); 
              $("input#applicant_nid").removeClass('red-border');

            }
            $("input#applicant_nid").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantNid').attr('hidden',true);
               $("input#applicant_nid").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantNid').attr('hidden',false);  
              $("input#applicant_nid").addClass('red-border');  
            }
          });
            /////        /////

            if($("input#app_pre_area").val()==''){
              $('#err_applicantArea').text('Present Area field is required');
              $('#err_msg_applicantArea').attr('hidden',false);
              $("input#app_pre_area").addClass('red-border');
            }
            else if($("input#app_pre_area").val()!=null){
              $('#err_msg_applicantArea').attr('hidden',true); 
              $("input#app_pre_area").removeClass('red-border');

            }
            $("input#app_pre_area").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantArea').attr('hidden',true);
               $("input#app_pre_area").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantArea').attr('hidden',false); 
              $("input#app_pre_area").addClass('red-border');   
            }
          });
            /////        /////

            if($("input#app_pre_road").val()==''){
              $('#err_applicantRoad').text('Present Road field is required');
              $('#err_msg_applicantRoad').attr('hidden',false);
              $("input#app_pre_road").addClass('red-border');
            }
            else if($("input#app_pre_road").val()!=null){
              $('#err_msg_applicantRoad').attr('hidden',true);
              $("input#app_pre_road").removeClass('red-border'); 

            }
            $("input#app_pre_road").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantRoad').attr('hidden',true);
               $("input#app_pre_road").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantRoad').attr('hidden',false); 
              $("input#app_pre_road").addClass('red-border');   
            }
          });
            /////        /////

            if($("input#app_pre_block").val()==''){
              $('#err_applicantBlock').text('Present Block field is required');
              $('#err_msg_applicantBlock').attr('hidden',false);
              $("input#app_pre_block").addClass('red-border');
            }
            else if($("input#app_pre_block").val()!=null){
              $('#err_msg_applicantBlock').attr('hidden',true);
              $("input#app_pre_block").removeClass('red-border'); 

            }
            $("input#app_pre_block").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantBlock').attr('hidden',true);
               $("input#app_pre_block").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantBlock').attr('hidden',false);  
              $("input#app_pre_block").addClass('red-border');  
            }
          });
            /////        /////

            if($("input#app_pre_house").val()==''){
              $('#err_applicantHouse').text('Present House field is required');
              $('#err_msg_applicantHouse').attr('hidden',false);
              $("input#app_pre_house").addClass('red-border');
            }
            else if($("input#app_pre_house").val()!=null){
              $('#err_msg_applicantHouse').attr('hidden',true);
              $("input#app_pre_house").removeClass('red-border'); 

            }
            $("input#app_pre_house").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantHouse').attr('hidden',true);
               $("input#app_pre_house").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantHouse').attr('hidden',false);
              $("input#app_pre_house").addClass('red-border');    
            }
          }); 
                 /////    permanent add    /////

                 if($("input#app_per_area").val()==''){
                  $('#err_applicantPArea').text('Permanent Area field is required');
                  $('#err_msg_applicantPArea').attr('hidden',false);
                  $("input#app_per_area").addClass('red-border');

                }
                else if($("input#app_per_area").val()!=null){
                  $('#err_msg_applicantPArea').attr('hidden',true); 
                  $("input#app_per_area").removeClass('red-border');
                }
                $("input#app_per_area").on("keyup bind cut change copy paste", function () {
                  if($(this).val()!=null){
                   $('#err_msg_applicantPArea').attr('hidden',true); 
                   $("input#app_per_area").removeClass('red-border');
                 }
                 else{
                  $('#err_msg_applicantPArea').attr('hidden',false); 
                  $("input#app_per_area").addClass('red-border');
                }
              });
            /////        /////

            if($("input#app_per_road").val()==''){
              $('#err_applicantPRoad').text('Permanent Road field is required');
              $('#err_msg_applicantPRoad').attr('hidden',false);
              $("input#app_per_road").addClass('red-border');
            }
            else if($("input#app_per_road").val()!=null){
              $('#err_msg_applicantPRoad').attr('hidden',true); 
              $("input#app_per_road").removeClass('red-border');
            }
            $("input#app_per_road").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantPRoad').attr('hidden',true);
               $("input#app_per_road").removeClass('red-border');
             }
             else{
              $('#err_msg_applicantPRoad').attr('hidden',false);
              $("input#app_per_road").addClass('red-border');    
            }
          });
            /////        /////

            if($("input#app_per_block").val()==''){
              $('#err_applicantPBlock').text('Permanent Block field is required');
              $('#err_msg_applicantPBlock').attr('hidden',false);
              $("input#app_per_block").addClass('red-border');
            }
            else if($("input#app_per_block").val()!=null){
              $('#err_msg_applicantPBlock').attr('hidden',true);
              $("input#app_per_block").removeClass('red-border'); 

            }
            $("input#app_per_block").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantPBlock').attr('hidden',true);
               $("input#app_per_block").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantPBlock').attr('hidden',false); 
              $("input#app_per_block").addClass('red-border');   
            }
          });
            /////        /////

            if($("input#app_per_house").val()==''){
              $('#err_applicantPHouse').text('Permanent House field is required');
              $('#err_msg_applicantPHouse').attr('hidden',false);
              $("input#app_per_house").addClass('red-border');
            }
            else if($("input#app_per_house").val()!=null){
              $('#err_msg_applicantPHouse').attr('hidden',true);
              $("input#app_per_house").removeClass('red-border'); 

            }
            $("input#app_per_house").on("keyup bind cut change copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_applicantPHouse').attr('hidden',true);
               $("input#app_per_house").removeClass('red-border'); 
             }
             else{
              $('#err_msg_applicantPHouse').attr('hidden',false);
              $("input#app_per_house").addClass('red-border');    
            }
          });
            /////
         /////
         if($('#image1_e').val()===''){
          $('#err_applicantPhoto').text('Applicant Photo is required');
          $('#err_msg_applicantPhoto').attr('hidden',false);
          $("input#image1_e").addClass('red-border');              
        }
        else if($('#image1_e').val()!=''){
          $('#err_msg_applicantPhoto').attr('hidden',true);
          $("input#image1_e").removeClass('red-border'); 
        }

        $('#image1_e').on('change',function(){
          if($('#image1_e').val()!=''){
           $('#err_msg_applicantPhoto').attr('hidden',true);
           $("input#image1_e").removeClass('red-border');  
         }
         else{
          $('#err_msg_applicantPhoto').attr('hidden',false);
          $("input#image1_e").addClass('red-border');     
        }
      });
               /////   
               if($('#image2_e').val()===''){
                $('#err_appNidCopy').text('Applicant NID Copy is required');
                $('#err_msg_appNidCopy').attr('hidden',false);
                $("input#image2_e").addClass('red-border');              
              }
              else if($('#image2_e').val()!=''){
                $('#err_msg_appNidCopy').attr('hidden',true);
                $("input#image2_e").removeClass('red-border');
              }

              $('#image2_e').on('change',function(){
                if($('#image2_e').val()!=''){
                 $('#err_msg_appNidCopy').attr('hidden',true); 
                 $("input#image2_e").removeClass('red-border');
               }
               else{
                $('#err_msg_appNidCopy').attr('hidden',false); 
                $("input#image2_e").addClass('red-border');   
              }
            });
               /////    
               if($('#image3_e').val()===''){
                $('#err_appcopy').text('Application Copy is required');
                $('#err_msg_appcopy').attr('hidden',false);
                $("input#image3_e").addClass('red-border');              
              }
              else if($('#image3_e').val()!=''){
                $('#err_msg_appcopy').attr('hidden',true);
                $("input#image3_e").removeClass('red-border');
              }

              $('#image3_e').on('change',function(){
                if($('#image3_e').val()!=''){
                 $('#err_msg_appcopy').attr('hidden',true);
                 $("input#image3_e").removeClass('red-border'); 
               }
               else{
                $('#err_msg_appcopy').attr('hidden',false);
                $("input#image3_e").addClass('red-border');    
              }
            });
               /////

             }

             function vehicleInfoValidate(){
              if($("select#vehicle_type").val()==null){
                $('#err_vehicletype').text('Vehicle type field is required');
                $('#err_msg_vehicletype').attr('hidden',false);
                $("select#vehicle_type").addClass('red-border');              
              }
              else if($("select#vehicle_type").val()!=null){
                $('#err_msg_vehicletype').attr('hidden',true);
                $("select#vehicle_type").removeClass('red-border');  

              }
              $('select#vehicle_type').on('change',function(){
                if($("select#vehicle_type").val()!=null){
                 $('#err_msg_vehicletype').attr('hidden',true);
                 $("select#vehicle_type").removeClass('red-border');  
               }
               else{
                $('#err_msg_vehicletype').attr('hidden',false);
                $("select#vehicle_type").addClass('red-border');     
              }
            })

              if($("input#vehicle_reg_no").val()==''){
                $('#err_vehiclereg').text('Vehicle Registration Number field is required');
                $('#err_msg_vehiclereg').attr('hidden',false);
                $("input#vehicle_reg_no").addClass('red-border'); 
              }
              else if($("input#vehicle_reg_no").val()!=null){
                $('#err_msg_vehiclereg').attr('hidden',true); 
                $("input#vehicle_reg_no").removeClass('red-border');

              }
              $("input#vehicle_reg_no").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_vehiclereg').attr('hidden',true); 
                 $("input#vehicle_reg_no").removeClass('red-border');
               }
               else{
                $('#err_msg_vehiclereg').attr('hidden',false); 
                $("input#vehicle_reg_no").addClass('red-border');   
              }
            });   


              if($("input#vehicle_chassis_no").val()==''){
                $('#err_vehicleChassis').text('Vehicle Chassis Number field is required');
                $('#err_msg_vehicleChassis').attr('hidden',false);
                $("input#vehicle_chassis_no").addClass('red-border'); 
              }
              else if($("input#vehicle_chassis_no").val()!=null){
                $('#err_msg_vehicleChassis').attr('hidden',true); 
                $("input#vehicle_chassis_no").removeClass('red-border');

              }
              $("input#vehicle_chassis_no").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_vehicleChassis').attr('hidden',true); 
                 $("input#vehicle_chassis_no").removeClass('red-border');
               }
               else{
                $('#err_msg_vehicleChassis').attr('hidden',false); 
                $("input#vehicle_chassis_no").addClass('red-border');   
              }
            });  

              if($("input#owner_name").val()==''){
                $('#err_ownername').text('Owner name field is required');
                $('#err_msg_ownername').attr('hidden',false);
                $("input#owner_name").addClass('red-border');
              }
              else if($("input#owner_name").val()!=null){
                $('#err_msg_ownername').attr('hidden',true);
                $("input#owner_name").removeClass('red-border'); 

              }
              $("input#owner_name").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_ownername').attr('hidden',true);
                 $("input#owner_name").removeClass('red-border'); 
               }
               else{
                $('#err_msg_ownername').attr('hidden',false);
                $("input#owner_name").addClass('red-border');    
              }
            });

              if($('#image2_b').val()===''){
                $('#err_vehicleregphoto').text('Registration certificate copy is required');
                $('#err_msg_vehicleregphoto').attr('hidden',false);
                $("#image2_b").addClass('red-border');
              }
              else if($('#image2_b').val()!=''){
                $('#err_msg_vehicleregphoto').attr('hidden',true);
                $("#image2_b").removeClass('red-border');
              }

              $('#image2_b').on('change',function(){
                if($('#image2_b').val()!=''){
                 $('#err_msg_vehicleregphoto').attr('hidden',true);
                 $("#image2_b").removeClass('red-border');
               }
               else{
                $('#err_msg_vehicleregphoto').attr('hidden',false);
                $("#image2_b").addClass('red-border');
              }
            });

              if($("input#o_area").val()==''){
                $('#err_ownerarea').text('Area field is required');
                $('#err_msg_ownerarea').attr('hidden',false);
                $("input#o_area").addClass('red-border');
              }
              else if($("input#o_area").val()!=null){
                $('#err_msg_ownerarea').attr('hidden',true);
                $("input#o_area").removeClass('red-border'); 

              }
              $("input#o_area").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_ownerarea').attr('hidden',true); 
                 $("input#o_area").removeClass('red-border');
               }
               else{
                $('#err_msg_ownerarea').attr('hidden',false);
                $("input#o_area").addClass('red-border');    
              }
            });

              if($("input#o_house").val()==''){
                $('#err_ownerhouse').text('House field is required');
                $('#err_msg_ownerhouse').attr('hidden',false);
                $("input#o_house").addClass('red-border');
              }
              else if($("input#o_house").val()!=null){
                $('#err_msg_ownerhouse').attr('hidden',true);
                $("input#o_house").removeClass('red-border'); 

              }
              $("input#o_house").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_ownerhouse').attr('hidden',true);
                 $("input#o_house").removeClass('red-border'); 
               }
               else{
                $('#err_msg_ownerhouse').attr('hidden',false); 
                $("input#o_house").addClass('red-border');   
              }
            });


              if($("input#o_road").val()==''){
                $('#err_ownerroad').text('Road field is required');
                $('#err_msg_ownerroad').attr('hidden',false);
                $("input#o_road").addClass('red-border');
              }
              else if($("input#o_road").val()!=null){
                $('#err_msg_ownerroad').attr('hidden',true);
                $("input#o_road").removeClass('red-border'); 

              }
              $("input#o_road").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_ownerroad').attr('hidden',true);
                 $("input#o_road").removeClass('red-border'); 
               }
               else{
                $('#err_msg_ownerroad').attr('hidden',false);
                $("input#o_road").addClass('red-border');    
              }
            });
              
              if($("input#o_block").val()==''){
                $('#err_ownerblock').text('Block field is required');
                $('#err_msg_ownerblock').attr('hidden',false);
                $("input#o_block").addClass('red-border');
              }
              else if($("input#o_block").val()!=null){
                $('#err_msg_ownerblock').attr('hidden',true); 
                $("input#o_block").removeClass('red-border');

              }
              $("input#o_block").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_ownerblock').attr('hidden',true); 
                 $("input#o_block").removeClass('red-border');
               }
               else{
                $('#err_msg_ownerblock').attr('hidden',false);  
                $("input#o_block").addClass('red-border');  
              }
            });
            /////
            if($("input#owner_nid").val()==''){
              $('#err_ownerNid').text('Owner NID field is required');
              $('#err_msg_ownerNid').attr('hidden',false);
              $("input#owner_nid").addClass('red-border');
            }
            else if($("input#owner_nid").val()!=null){
              $('#err_msg_ownerNid').attr('hidden',true); 
              $("input#owner_nid").removeClass('red-border');

            }
            $("input#owner_nid").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_ownerNid').attr('hidden',true);
               $("input#owner_nid").removeClass('red-border'); 
             }
             else{
              $('#err_msg_ownerNid').attr('hidden',false);  
              $("input#owner_nid").addClass('red-border');  
            }
          });
            /////
            if($('#image3_b').val()===''){
              $('#err_ownerNidCopy').text('Owner NID copy is required');
              $('#err_msg_ownerNidCopy').attr('hidden',false);
              $("#image3_b").addClass('red-border');
            }
            else if($('#image3_b').val()!=''){
              $('#err_msg_ownerNidCopy').attr('hidden',true);
              $("#image3_b").removeClass('red-border');
            }

            $('#image3_b').on('change',function(){
              if($('#image3_b').val()!=''){
               $('#err_msg_ownerNidCopy').attr('hidden',true); 
               $("#image3_b").removeClass('red-border');
             }
             else{
              $('#err_msg_ownerNidCopy').attr('hidden',false); 
              $("#image3_b").addClass('red-border');
            }
          });
               ///
               if($('#image4_b').val()===''){
                $('#err_taxCopy').text('Tax Token copy is required');
                $('#err_msg_taxCopy').attr('hidden',false);
                $("#image4_b").addClass('red-border');
              }
              else if($('#image4_b').val()!=''){
                $('#err_msg_taxCopy').attr('hidden',true);
                $("#image4_b").removeClass('red-border');
              }

              $('#image4_b').on('change',function(){
                if($('#image4_b').val()!=''){
                 $('#err_msg_taxCopy').attr('hidden',true);
                 $("#image4_b").removeClass('red-border');
               }
               else{
                $('#err_msg_taxCopy').attr('hidden',false); 
                $("#image4_b").addClass('red-border');
              }
            });
               ///
               if($('#image5_b').val()===''){
                $('#err_fitnessCopy').text('Fitness certificate copy is required');
                $('#err_msg_fitnessCopy').attr('hidden',false); 
                $("#image5_b").addClass('red-border');
              }
              else if($('#image5_b').val()!=''){
                $('#err_msg_fitnessCopy').attr('hidden',true);
                $("#image5_b").removeClass('red-border');
              }

              $('#image5_b').on('change',function(){
                if($('#image5_b').val()!=''){
                 $('#err_msg_fitnessCopy').attr('hidden',true); 
                 $("#image5_b").removeClass('red-border');
               }
               else{
                $('#err_msg_fitnessCopy').attr('hidden',false); 
                $("#image5_b").addClass('red-border');
              }
            });
               ///
              //       if($('#image6_b').val()===''){
              //   $('#err_insuranceCopy').text('Insurance certificate copy is required');
              //   $('#err_msg_insuranceCopy').attr('hidden',false);
              //   $("#image6_b").addClass('red-border');
              // }
              // else if($('#image6_b').val()!=''){
              //   $('#err_msg_insuranceCopy').attr('hidden',true);
              //   $("#image6_b").removeClass('red-border');
              // }

              //  $('#image6_b').on('change',function(){
              //     if($('#image6_b').val()!=''){
              //        $('#err_msg_insuranceCopy').attr('hidden',true);
              //        $("#image6_b").removeClass('red-border');
              //      }
              //      else{
              //       $('#err_msg_insuranceCopy').attr('hidden',false);
              //       $("#image6_b").addClass('red-border');
              //      }
              //   });
               /////
               if($("input#tax_paid_upto").val()==''){
                $('#err_taxVal').text('Tax token validity date field is required');
                $('#err_msg_taxVal').attr('hidden',false);
                $("input#tax_paid_upto").addClass('red-border');
              }
              else if($("input#tax_paid_upto").val()!=null){
                $('#err_msg_taxVal').attr('hidden',true); 
                $("input#tax_paid_upto").removeClass('red-border');

              }
              $("input#tax_paid_upto").on("change", function () {
                if($(this).val()!=null){
                 $('#err_msg_taxVal').attr('hidden',true); 
                 $("input#tax_paid_upto").removeClass('red-border');
               }
               else{
                $('#err_msg_taxVal').attr('hidden',false); 
                $("input#tax_paid_upto").addClass('red-border');   
              }
            });
            /////
            if($("input#fitnness_validity").val()==''){
              $('#err_fitnessVal').text('Fitnness validity date field is required');
              $('#err_msg_fitnessVal').attr('hidden',false);
              $("input#fitnness_validity").addClass('red-border');
            }
            else if($("input#fitnness_validity").val()!=null){
              $('#err_msg_fitnessVal').attr('hidden',true);
              $("input#fitnness_validity").removeClass('red-border'); 

            }
            $("input#fitnness_validity").on("change", function () {
              if($(this).val()!=null){
               $('#err_msg_fitnessVal').attr('hidden',true);
               $("input#fitnness_validity").removeClass('red-border'); 
             }
             else{
              $('#err_msg_fitnessVal').attr('hidden',false);
              $("input#fitnness_validity").addClass('red-border');    
            }
          });
            /////
             //    if($("input#insurance_validity").val()==''){
             //    $('#err_insuranceValidity').text('Insurance validity field is required');
             //    $('#err_msg_insuranceValidity').attr('hidden',false);
             //    $("input#insurance_validity").addClass('red-border');
             //  }
             //   else if($("input#insurance_validity").val()!=null){
             //    $('#err_msg_insuranceValidity').attr('hidden',true);
             //    $("input#insurance_validity").removeClass('red-border'); 

             //  }
             //  $("input#insurance_validity").on("change", function () {
             //      if($(this).val()!=null){
             //         $('#err_msg_insuranceValidity').attr('hidden',true);
             //         $("input#insurance_validity").removeClass('red-border'); 
             //       }
             //       else{
             //        $('#err_msg_insuranceValidity').attr('hidden',false);
             //        $("input#insurance_validity").addClass('red-border');    
             //       }
             // });

             if(selected_sticker_category == 'T'){ 
               if($("textarea#necessity_to_use").val()==''){
                $('#err_necessity').text("Necessity to use field is required");
                $('#err_msg_necessity').attr('hidden',false);
                $("textarea#necessity_to_use").addClass('red-border');
              }
              else if($("textarea#necessity_to_use").val()!=null){
                $('#err_msg_necessity').attr('hidden',true); 
                $("textarea#necessity_to_use").removeClass('red-border');

              }
              $("textarea#necessity_to_use").on("keyup bind cut change copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_necessity').attr('hidden',true);
                 $("textarea#necessity_to_use").removeClass('red-border'); 
               }
               else{
                $('#err_msg_necessity').attr('hidden',false); 
                $("textarea#necessity_to_use").addClass('red-border');   
              }
            });       
            }     
          }
          function notSelfDriven(){
            if($("input#driver_name").val()==''){
              $('#err_drivername').text('Driver Name field is required');
              $('#err_msg_drivername').attr('hidden',false);
              $("input#driver_name").addClass('red-border');
            }
            else if($("input#driver_name").val()!=null){
              $('#err_msg_drivername').attr('hidden',true);
              $("input#driver_name").removeClass('red-border'); 

            }
            $("input#driver_name").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_drivername').attr('hidden',true); 
               $("input#driver_name").removeClass('red-border');
             }
             else{
              $('#err_msg_drivername').attr('hidden',false);
              $("input#driver_name").addClass('red-border');    
            }
          });
            /////
            if($('#image10_b').val()===''){
              $('#err_driverphoto').text('Driver Photo is required');
              $('#err_msg_driverphoto').attr('hidden',false); 
              $("#image10_b").addClass('red-border');             
            }
            else if($('#image10_b').val()!=''){
              $('#err_msg_driverphoto').attr('hidden',true);
              $("#image10_b").removeClass('red-border');
            }

            $('#image10_b').on('change',function(){
              if($('#image10_b').val()!=''){
               $('#err_msg_driverphoto').attr('hidden',true);
               $("#image10_b").removeClass('red-border'); 
             }
             else{
              $('#err_msg_driverphoto').attr('hidden',false);
              $("#image10_b").addClass('red-border');    
            }
          });
               /////
               if($("input#dri_pre_house").val()==''){
                $('#err_driverhouse').text('House field is required');
                $('#err_msg_driverhouse').attr('hidden',false);
                $("input#dri_pre_house").addClass('red-border');
              }
              else if($("input#dri_pre_house").val()!=null){
                $('#err_msg_driverhouse').attr('hidden',true);
                $("input#dri_pre_house").removeClass('red-border'); 

              }
              $("input#dri_pre_house").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_driverhouse').attr('hidden',true);
                 $("input#dri_pre_house").removeClass('red-border'); 
               }
               else{
                $('#err_msg_driverhouse').attr('hidden',false);
                $("input#dri_pre_house").addClass('red-border');    
              }
            });
            /////
            if($("input#dri_pre_road").val()==''){
              $('#err_driverroad').text('Road field is required');
              $('#err_msg_driverroad').attr('hidden',false);
              $("input#dri_pre_road").addClass('red-border');
            }
            else if($("input#dri_pre_road").val()!=null){
              $('#err_msg_driverroad').attr('hidden',true);
              $("input#dri_pre_road").removeClass('red-border'); 

            }
            $("input#dri_pre_road").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_driverroad').attr('hidden',true);
               $("input#dri_pre_road").removeClass('red-border'); 
             }
             else{
              $('#err_msg_driverroad').attr('hidden',false);
              $("input#dri_pre_road").addClass('red-border');    
            }
          });
            /////
            if($("input#dri_pre_block").val()==''){
              $('#err_driverblock').text('Block field is required');
              $('#err_msg_driverblock').attr('hidden',false);
              $("input#dri_pre_block").addClass('red-border');
            }
            else if($("input#dri_pre_block").val()!=null){
              $('#err_msg_driverblock').attr('hidden',true);
              $("input#dri_pre_block").removeClass('red-border'); 

            }
            $("input#dri_pre_block").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_driverblock').attr('hidden',true); 
               $("input#dri_pre_block").removeClass('red-border');
             }
             else{
              $('#err_msg_driverblock').attr('hidden',false);
              $("input#dri_pre_block").addClass('red-border');    
            }
          });
            /////
            if($("input#dri_pre_area").val()==''){
              $('#err_driverarea').text('Area field is required');
              $('#err_msg_driverarea').attr('hidden',false);
              $("input#dri_pre_area").addClass('red-border');
            }
            else if($("input#dri_pre_area").val()!=null){
              $('#err_msg_driverarea').attr('hidden',true);
              $("input#dri_pre_area").removeClass('red-border'); 

            }
            $("input#dri_pre_area").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_driverarea').attr('hidden',true);
               $("input#dri_pre_area").removeClass('red-border'); 
             }
             else{
              $('#err_msg_driverarea').attr('hidden',false);
              $("input#dri_pre_area").addClass('red-border');    
            }
          });
            /////
            if($("input#drivernid_number").val()==''){
              $('#err_driverNid').text('Driver NID Number field is required');
              $('#err_msg_driverNid').attr('hidden',false);
              $("input#drivernid_number").addClass('red-border');
            }
            else if($("input#drivernid_number").val()!=null){
              $('#err_msg_driverNid').attr('hidden',true);
              $("input#drivernid_number").removeClass('red-border'); 
            }
            $("input#drivernid_number").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_driverNid').attr('hidden',true);
               $("input#drivernid_number").removeClass('red-border'); 
             }
             else{
              $('#err_msg_driverNid').attr('hidden',false);
              $("input#drivernid_number").addClass('red-border');    
            }
          });
            /////
            if($('#image11_b').val()===''){
              $('#err_driverNidcopy').text('Driver NID Copy is required');
              $('#err_msg_driverNidcopy').attr('hidden',false);
              $("#image11_b").addClass('red-border');              
            }
            else if($('#image11_b').val()!=''){
              $('#err_msg_driverNidcopy').attr('hidden',true);
              $("#image11_b").removeClass('red-border');
            }

            $('#image11_b').on('change',function(){
              if($('#image11_b').val()!=''){
               $('#err_msg_driverNidcopy').attr('hidden',true);
               $("#image11_b").removeClass('red-border'); 
             }
             else{
              $('#err_msg_driverNidcopy').attr('hidden',false);
              $("#image11_b").addClass('red-border');    
            }
          });   
                 /////
                 if($('#image12_b').val()===''){
                  $('#err_driverlicence').text('Driver Licence Copy is required');
                  $('#err_msg_driverlicence').attr('hidden',false); 
                  $("#image12_b").addClass('red-border');             
                }
                else if($('#image12_b').val()!=''){
                  $('#err_msg_driverlicence').attr('hidden',true);
                  $("#image12_b").removeClass('red-border');
                }

                $('#image12_b').on('change',function(){
                  if($('#image12_b').val()!=''){
                   $('#err_msg_driverlicence').attr('hidden',true);
                   $("#image12_b").removeClass('red-border'); 
                 }
                 else{
                  $('#err_msg_driverlicence').attr('hidden',false);
                  $("#image12_b").addClass('red-border');    
                }
              });
                  /////
                  if($("input#licence_validity").val()==''){
                    $('#err_drivingValidity').text('Driving License validity date field is required');
                    $('#err_msg_drivingValidity').attr('hidden',false);
                    $("#licence_validity").addClass('red-border');             

                  }
                  else if($("input#licence_validity").val()!=null){
                    $('#err_msg_drivingValidity').attr('hidden',true); 
                    $("#licence_validity").removeClass('red-border'); 

                  }
                  $("input#licence_validity").on("change", function () {
                    if($(this).val()!=null){
                     $('#err_msg_drivingValidity').attr('hidden',true);
                     $("#licence_validity").removeClass('red-border');  
                   }
                   else{
                    $('#err_msg_drivingValidity').attr('hidden',false); 
                    $("#licence_validity").addClass('red-border');    
                  }
                });
            /////
          }
          function HelperInfoValidate(){
            if($("input#helper_name").val()==''){
              $('#err_helpername').text('Helper Name field is required');
              $('#err_msg_helpername').attr('hidden',false);
              $("input#helper_name").addClass('red-border');
            }
            else if($("input#helper_name").val()!=null){
              $('#err_msg_helpername').attr('hidden',true);
              $("input#helper_name").removeClass('red-border'); 

            }
            $("input#helper_name").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_helpername').attr('hidden',true); 
               $("input#helper_name").removeClass('red-border');
             }
             else{
              $('#err_msg_helpername').attr('hidden',false);
              $("input#helper_name").addClass('red-border');    
            }
          });
            /////
            if($('#image10_bhelper_photo').val()===''){
              $('#err_helperphoto').text('Helper Photo is required');
              $('#err_msg_helperphoto').attr('hidden',false); 
              $("#image10_bhelper_photo").addClass('red-border');             
            }
            else if($('#image10_bhelper_photo').val()!=''){
              $('#err_msg_helperphoto').attr('hidden',true);
              $("#image10_bhelper_photo").removeClass('red-border');
            }

            $('#image10_bhelper_photo').on('change',function(){
              if($('#image10_bhelper_photo').val()!=''){
               $('#err_msg_helperphoto').attr('hidden',true);
               $("#image10_bhelper_photo").removeClass('red-border'); 
             }
             else{
              $('#err_msg_helperphoto').attr('hidden',false);
              $("#image10_bhelper_photo").addClass('red-border');    
            }
          });
               /////
               if($("input#helper_pre_house").val()==''){
                $('#err_helperhouse').text('House field is required');
                $('#err_msg_helperhouse').attr('hidden',false);
                $("input#helper_pre_house").addClass('red-border');
              }
              else if($("input#helper_pre_house").val()!=null){
                $('#err_msg_helperhouse').attr('hidden',true);
                $("input#helper_pre_house").removeClass('red-border'); 

              }
              $("input#helper_pre_house").on("keyup bind cut copy paste", function () {
                if($(this).val()!=null){
                 $('#err_msg_helperhouse').attr('hidden',true);
                 $("input#helper_pre_house").removeClass('red-border'); 
               }
               else{
                $('#err_msg_helperhouse').attr('hidden',false);
                $("input#helper_pre_house").addClass('red-border');    
              }
            });
            /////
            if($("input#helper_pre_road").val()==''){
              $('#err_helperroad').text('Road field is required');
              $('#err_msg_helperroad').attr('hidden',false);
              $("input#helper_pre_road").addClass('red-border');
            }
            else if($("input#helper_pre_road").val()!=null){
              $('#err_msg_helperroad').attr('hidden',true);
              $("input#helper_pre_road").removeClass('red-border'); 

            }
            $("input#helper_pre_road").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_helperroad').attr('hidden',true);
               $("input#helper_pre_road").removeClass('red-border'); 
             }
             else{
              $('#err_msg_helperroad').attr('hidden',false);
              $("input#helper_pre_road").addClass('red-border');    
            }
          });
            /////
            if($("input#helper_pre_block").val()==''){
              $('#err_helperblock').text('Block field is required');
              $('#err_msg_helperblock').attr('hidden',false);
              $("input#helper_pre_block").addClass('red-border');
            }
            else if($("input#helper_pre_block").val()!=null){
              $('#err_msg_helperblock').attr('hidden',true);
              $("input#helper_pre_block").removeClass('red-border'); 

            }
            $("input#helper_pre_block").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_helperblock').attr('hidden',true); 
               $("input#helper_pre_block").removeClass('red-border');
             }
             else{
              $('#err_msg_helperblock').attr('hidden',false);
              $("input#helper_pre_block").addClass('red-border');    
            }
          });
            /////
            if($("input#helper_pre_area").val()==''){
              $('#err_helperarea').text('Area field is required');
              $('#err_msg_helperarea').attr('hidden',false);
              $("input#helper_pre_area").addClass('red-border');
            }
            else if($("input#helper_pre_area").val()!=null){
              $('#err_msg_helperarea').attr('hidden',true);
              $("input#helper_pre_area").removeClass('red-border'); 

            }
            $("input#helper_pre_area").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_helperarea').attr('hidden',true);
               $("input#helper_pre_area").removeClass('red-border'); 
             }
             else{
              $('#err_msg_helperarea').attr('hidden',false);
              $("input#helper_pre_area").addClass('red-border');    
            }
          });
            /////
            if($("input#helpernid_number").val()==''){
              $('#err_helperNid').text('Helper NID Number field is required');
              $('#err_msg_helperNid').attr('hidden',false);
              $("input#helpernid_number").addClass('red-border');
            }
            else if($("input#helpernid_number").val()!=null){
              $('#err_msg_helperNid').attr('hidden',true);
              $("input#helpernid_number").removeClass('red-border'); 
            }
            $("input#helpernid_number").on("keyup bind cut copy paste", function () {
              if($(this).val()!=null){
               $('#err_msg_helperNid').attr('hidden',true);
               $("input#helpernid_number").removeClass('red-border'); 
             }
             else{
              $('#err_msg_helperNid').attr('hidden',false);
              $("input#helpernid_number").addClass('red-border');    
            }
          });
            /////
            if($('#image11_bhhh').val()===''){
              $('#err_helperNidcopy').text('Helper NID Copy is required');
              $('#err_msg_helperNidcopy').attr('hidden',false);
              $("#image11_bhhh").addClass('red-border');              
            }
            else if($('#image11_bhhh').val()!=''){
              $('#err_msg_helperNidcopy').attr('hidden',true);
              $("#image11_bhhh").removeClass('red-border');
            }

            $('#image11_bhhh').on('change',function(){
              if($('#image11_bhhh').val()!=''){
               $('#err_msg_helperNidcopy').attr('hidden',true);
               $("#image11_bhhh").removeClass('red-border'); 
             }
             else{
              $('#err_msg_helperNidcopy').attr('hidden',false);
              $("#image11_bhhh").addClass('red-border');    
            }
          });    
          }

         //    if($('#self_driven_checkbox').is(':checked')){
         //    $(".not_self_driven").attr('hidden', true);
         //    $(".not_self_driven input").attr('required', false);

         //  }
         //  else{
         //   $('.not_self_driven').attr('hidden', false);
         //   $(".Applycationform .not_self_driven input").attr('required', true);
         //   $(".not_self_driven input[type='checkbox']").attr('required', false);
         //   $(".helper_perm input").attr('required', false);
         // }
         function driverInfoValidate(){

          if($('#image12_b').val()===''){
            $('#err_driverlicence').text('Driver Licence Copy is required');
            $('#err_msg_driverlicence').attr('hidden',false); 
            $("#image12_b").addClass('red-border');             
          }
          else if($('#image12_b').val()!=''){
            $('#err_msg_driverlicence').attr('hidden',true);
            $("#image12_b").removeClass('red-border');
          }

          $('#image12_b').on('change',function(){
            if($('#image12_b').val()!=''){
             $('#err_msg_driverlicence').attr('hidden',true);
             $("#image12_b").removeClass('red-border'); 
           }
           else{
            $('#err_msg_driverlicence').attr('hidden',false);
            $("#image12_b").addClass('red-border');    
          }
        });
                  /////
                  if($("input#licence_validity").val()==''){
                    $('#err_drivingValidity').text('Driving License validity date field is required');
                    $('#err_msg_drivingValidity').attr('hidden',false);
                    $("#licence_validity").addClass('red-border');             

                  }
                  else if($("input#licence_validity").val()!=null){
                    $('#err_msg_drivingValidity').attr('hidden',true); 
                    $("#licence_validity").removeClass('red-border'); 

                  }
                  $("input#licence_validity").on("change", function () {
                    if($(this).val()!=null){
                     $('#err_msg_drivingValidity').attr('hidden',true);
                     $("#licence_validity").removeClass('red-border');  
                   }
                   else{
                    $('#err_msg_drivingValidity').attr('hidden',false); 
                    $("#licence_validity").addClass('red-border');    
                  }
                });
            /////

            if($('#self_driven_checked').is(':checked')){
              $(".not_self_driven").attr('hidden', true);
              // $(".driver-is-not-owner").attr('hidden', false);
              $(".not_self_driven input").attr('required', false);
            }
            else{
             $('.not_self_driven').attr('hidden', false);
             // $('.driver-is-not-owner').attr('hidden', true);
             $(".Applycationform .not_self_driven input").attr('required', true);
             $(".not_self_driven input[type='checkbox']").attr('required', false);
             $(".driver_perm input").attr('required', false);
             notSelfDriven();
           }          
         }
        //

        $('.change-btn').on('click',function(){
          $(this).siblings('input').attr('disabled',false);
          $(this).siblings('.cancel-btn').attr('hidden',false);
          $(this).attr('hidden',true);
        }); 
        $('.cancel-btn').on('click',function(){
          $(this).siblings('input').attr('disabled',true);
          $(this).siblings('input').val('');
          $(this).siblings('.change-btn').attr('hidden',false);
          $(this).attr('hidden',true);
          $(this).siblings('.change-btn').data('photo');
          $(this).siblings('div').find('img').attr('src',$(this).siblings('.change-btn').data('photo'));
        });
        // end Of Form validation Function

        $("#B-p-btn1").click(function () {

          $('#B-myTab li:nth-child(1) a').tab('show');
        });
        $("#B-p-btn2").click(function () {
          $('#B-myTab li:nth-child(2) a').tab('show');
        });

        $("#E-p-btn1").click(function () {
          $('#E-myTab li:nth-child(1) a').tab('show');
        });
        $("#E-p-btn2").click(function () {
          $('#E-myTab li:nth-child(2) a').tab('show');
        });


        $('#Application_Form_B').on('submit',function(e){
          e.preventDefault();
          var form=$('#Application_Form_B');
          var formData=form.serialize();
          var url='/applicationForm/store';
          var type='post';
          $('#ajax-loader').attr('hidden',false);
          $.ajax({
            type:type,
            url:url,
            data:new FormData($("#Application_Form_B")[0]),
            processData:false,
            contentType:false,
            success:function(response){
             $('#ajax-loader').attr('hidden',true);
             if(response[1]=="success"){
              swal(
               'Congratulation!',response[0],'success').then(function() {
                 $.ajax({
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  type:"post",
                  url:"/send-submission-sms/success/"+response[2],
                  data:'',
                  dataType:'json',
                  success:function(res){
                  }


                });
                 location.reload();   
               });
             }  
             if(response[1]=="fail renew"){
              swal(
               'Sorry!', response[0], 'warning').then(function() { 
               });
             }   if(response[1]=="DB_Transaction_error"){
              swal(
               'Sorry!', response[0], 'warning').then(function() { 
                 // location.reload();    
               });
             }
           },
           error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');

          }


        });
        });
        $('#Application_Form_B_Edit').on('submit',function(e){
          e.preventDefault();
          var app_id = $(this).data('id');
          var form=$('#Application_Form_B_Edit');
          var formData=form.serialize();
          var url='/applicationForm/update/'+app_id;
          var type='post';
          $('#ajax-loader').attr('hidden',false);
          $.ajax({
            type:type,
            url:url,
            data:new FormData($("#Application_Form_B_Edit")[0]),
            processData:false,
            contentType:false,
            success:function(response){
             $('#ajax-loader').attr('hidden',true);
             if(response[1]=="success"){ 
               if(response[2]=="Customer"){
                 swal(
                  'Congratulation!',response[0],'success').then(function() {
                    location.reload();
                  });
                }else if(response[2]==""){
                  swal(
                   'Congratulation!',response[0],'success').then(function() {
                     var splitUrl = document.location.href.split('/');
                     var win = window.open('/application-review/'+splitUrl[5],'_parent');
                     win.focus();
                   });
                 }
               }  

               if(response[1]=="DB_Transaction_error"){
                swal(
                 'Sorry!', response[0], 'warning').then(function() { 
                 });
               }


          //         toastr.success("Great!!! Application Submitted Successfully." );
          // setTimeout(function() {

              // location.reload();         
          //        }, 1500);
        },
        error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');

          }


        });
        });
        $('#Application_Form_E').on('submit',function(e){
          e.preventDefault();
          var form=$('#Application_Form_E');
          var formData=form.serialize();
          var url='/applicationForm/store';
          var type='post';
          $('#ajax-loader').attr('hidden',false);
          $.ajax({
            type:type,
            url:url,
            data:new FormData($("#Application_Form_E")[0]),
            processData:false,
            contentType:false,
            success:function(response){
              $('#ajax-loader').attr('hidden',true);
              if(response[1]=="success"){
                swal(
                 'Congratulation!',response[0],'success').then(function() {
                  $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:"post",
                    url:"/send-submission-sms/success/"+response[2],
                    data:'',
                    dataType:'json',
                    success:function(res){
                    }

                  });
                  location.reload(); 
                });
               }  
               if(response[1]=="fail renew"){
                swal(
                 'Sorry!', response[0], 'warning').then(function() { 
                 });
               }   if(response[1]=="DB_Transaction_error"){
                swal(
                 'Sorry!', response[0], 'warning').then(function() {  
                 });
               }
             },
             error:function(response){
              swal('Oops...', 'Something went wrong!' , 'error');

            }


          });
        });
        $('#Application_Form_E_Edit').on('submit',function(e){
          e.preventDefault();
          var app_id = $(this).data('id');
          var form=$('#Application_Form_E_Edit');
          var formData=form.serialize();
          var url='/applicationForm/update/'+app_id;
          var type='post';
          $('#ajax-loader').attr('hidden',false);
          $.ajax({
            type:type,
            url:url,
            data:new FormData($("#Application_Form_E_Edit")[0]),
            processData:false,
            contentType:false,
            success:function(response){
             $('#ajax-loader').attr('hidden',true);
             if(response[1]=="success"){

              if(response[2]=="Customer"){
               swal(
                'Congratulation!',response[0],'success').then(function() {
                 location.reload();
               });
              }else if(response[2]==""){
                swal(
                 'Congratulation!',response[0],'success').then(function() {
                   var splitUrl = document.location.href.split('/');
                   var win = window.open('/application-review/'+splitUrl[5],'_parent');
                   win.focus();
                 });
               }


             }  

             if(response[1]=="DB_Transaction_error"){
              swal(
               'Sorry!', response[0], 'warning').then(function() { 
               });
             }


          //         toastr.success("Great!!! Application Submitted Successfully." );
          // setTimeout(function() {

              // location.reload();         
          //        }, 1500);
        },
        error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');

          }


        });
        });

///

$('#Application_Detail_Form_B').on('submit',function(e){
  e.preventDefault();
  if($('#image1_b').val()!=''){
    $('#ajax-loader').attr('hidden',false);
    var form=$('#Application_Detail_Form_B');
    var formData=form.serialize();
    var url='/applicant-details/store';
    var type='post';
    $.ajax({
      type:type,
      url:url,
      data:new FormData($("#Application_Detail_Form_B")[0]),
      processData:false,
      contentType:false,
      success:function(response){
        $('#ajax-loader').attr('hidden',true);
        $('#B-myTab li:nth-child(2) a').tab('show');
        $('#B-myTab li:nth-child(2) a').removeClass('not-active');
        $("#image1_b").removeClass('red-border'); 
        windowScrollTop();
      },
      error:function(response){
        swal('Oops...', 'Something went wrong!' , 'error');
      }
    });
  }else{
    $('#err_appcopy').text('Application Photocopy is required');
    $('#err_msg_appcopy').attr('hidden',false); 
    $("#image1_b").addClass('red-border');    
    $('#B-myTab li:nth-child(2) a').addClass('not-active'); 
    swal('Oops!', 'Please fill required form fields', 'warning');            
  }
});
///

$('#applicant_detail_form_E_app').on('submit',function(e){
  e.preventDefault();
  if(selected_sticker_category == 'T'){
    $('#Necessity-div').find('span').html('*');
  }
  if($("input#applicant_name").val()!='' && $("input#applicant_phone").val()!='' && $("input#f_h_name").val()!='' && $('#app_pre_house').val()!='' &&$('#app_pre_road').val()!=''
   && $('#image2_e').val()!='' && $('#image3_e').val()!='' && $('#image1_e').val()!='' && $("input#app_pre_block").val()!='' && $("input#app_pre_area").val()!='' && $("input#app_per_house").val()!=''
   && $("input#app_per_road").val()!='' && $("input#app_per_block").val()!='' && $("input#app_per_area").val()!='' && $("input#applicant_nid").val()!=null)
  {  
    $('#ajax-loader').attr('hidden',false);
    var form=$('#applicant_detail_form_E_app');
    var formData=form.serialize();
    var url='/applicant-details/store';
    var type='post';
    $.ajax({
      type:type,
      url:url,
      data:new FormData($("#applicant_detail_form_E_app")[0]),
      processData:false,
      contentType:false,
      success:function(response){
        $('#ajax-loader').attr('hidden',true);
        $('#E-myTab li:nth-child(2) a').removeClass('not-active');
        $('#E-myTab li:nth-child(2) a').tab('show');
        windowScrollTop();
      },
      error:function(response){
        swal('Oops...', 'Something went wrong!' , 'error');
      }
    });
  }
  else{
    $('#E-myTab li:nth-child(2) a').addClass('not-active');
    applicantInfoValidate();
    swal('Oops!', 'Please fill required form fields', 'warning');
  }
});
///

$('#vehicle_detail_form_B_app').on('submit', function(e){
  e.preventDefault();
  if($("input#company_name").val()!='' && $("input#c_road").val()!='' && $("input#c_block").val()!='' && $("input#c_house").val()!='' && $("input#c_area").val()!='' && $("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
   && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
   && $("input#o_road").val()!='' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!='' && $("input#vehicle_chassis_no").val()!=''
   && $(".owner_is_company").is(':checked') && selected_sticker_category !='T' ){
   vehicleDetailFormBAjaxSubmit();
}
else if($("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
 && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
 && $("input#o_road").val()!='' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!=''
 && $("input#vehicle_chassis_no").val()!='' && $(".owner_is_company").not(':checked') && selected_sticker_category !='T')
{
  vehicleDetailFormBAjaxSubmit();
}

else if($("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
 && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
 && $("input#o_road").val()!='' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!=''
 && $(".owner_is_company").not(':checked') && selected_sticker_category == 'T' && $("input#vehicle_chassis_no").val()!=''  && $("textarea#necessity_to_use").val()=='' )
{
  vehicleDetailFormBAjaxSubmit();
}
else if($("input#company_name").val()!='' && $("input#c_road").val()!='' && $("input#c_block").val()!='' && $("input#c_house").val()!='' && $("input#c_area").val()!='' && $("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
 && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
 && $("input#o_road").val()!='' && $(".owner_is_company").is(':checked') && selected_sticker_category == 'T' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!='' && $("input#vehicle_chassis_no").val()!='' && $("textarea#necessity_to_use").val()=='')
{
  vehicleDetailFormBAjaxSubmit();

}else{
  $('#B-myTab li:nth-child(3) a').addClass('not-active');
  $('#E-myTab li:nth-child(3) a').addClass('not-active');
  vehicleInfoValidate();
  swal('Oops!', 'Please fill required form fields', 'warning');
}

});
$('#vehicle_detail_form_E_app').on('submit', function(e){
  e.preventDefault();
  if($("input#company_name").val()!='' && $("input#c_road").val()!='' && $("input#c_block").val()!='' && $("input#c_house").val()!='' && $("input#c_area").val()!='' && $("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
   && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
   && $("input#o_road").val()!='' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!='' && $("input#vehicle_chassis_no").val()!=''
   && $(".owner_is_company").is(':checked') && selected_sticker_category !='T' ){
   vehicleDetailFormEAjaxSubmit();
}
else if($("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
 && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
 && $("input#o_road").val()!='' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!=''
 && $("input#vehicle_chassis_no").val()!='' && $(".owner_is_company").not(':checked') && selected_sticker_category !='T')
{
  vehicleDetailFormEAjaxSubmit();
}

else if($("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
 && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
 && $("input#o_road").val()!='' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!=''
 && $(".owner_is_company").not(':checked') && selected_sticker_category == 'T' && $("input#vehicle_chassis_no").val()!=''  && $("textarea#necessity_to_use").val()!='' )
{
  vehicleDetailFormEAjaxSubmit();
}
else if($("input#company_name").val()!='' && $("input#c_road").val()!='' && $("input#c_block").val()!='' && $("input#c_house").val()!='' && $("input#c_area").val()!='' && $("input#fitnness_validity").val()!='' && $("input#tax_paid_upto").val()!='' && $('#image5_b').val()!=''
 && $('#image4_b').val()!='' && $('#image3_b').val()!='' && $('#image2_b').val()!='' && $("input#owner_nid").val()!='' && $("input#o_block").val()!='' && $("input#o_house").val()!=''
 && $("input#o_road").val()!='' && $(".owner_is_company").is(':checked') && selected_sticker_category == 'T' && $("input#o_area").val()!='' && $("input#owner_name").val()!='' && $("select#vehicle_type").val()!=null && $("input#vehicle_reg_no").val()!='' && $("input#vehicle_chassis_no").val()!='' && $("textarea#necessity_to_use").val()!='')
{
  vehicleDetailFormEAjaxSubmit();

}else{
  $('#B-myTab li:nth-child(3) a').addClass('not-active');
  $('#E-myTab li:nth-child(3) a').addClass('not-active');
  vehicleInfoValidate();
  swal('Oops!', 'Please fill required form fields', 'warning');
}

});
function vehicleDetailFormBAjaxSubmit(){
 $('#ajax-loader').attr('hidden',false);
 var form=$('#vehicle_detail_form_B_app');
 var formData=form.serialize();
 var url='/vehicle-detail/store';
 var type='post';
 $.ajax({
  type:type,
  url:url,
  data:new FormData($("#vehicle_detail_form_B_app")[0]),
  processData:false,
  contentType:false,
  success:function(response){
   $('#ajax-loader').attr('hidden',true);
   if(response[1]=="already-applied"){
    swal('sorry', response[0] , 'warning');
  }else{
    $('#B-myTab li:nth-child(3) a').removeClass('not-active');
    $('#B-myTab li:nth-child(3) a').tab('show'); 
    $('#E-myTab li:nth-child(3) a').removeClass('not-active');
    $('#E-myTab li:nth-child(3) a').tab('show');
    windowScrollTop();
  }
},
error:function(response){
  swal('Oops...', 'Something went wrong!' , 'error');

}
});
}
function vehicleDetailFormEAjaxSubmit(){
 $('#ajax-loader').attr('hidden',false);
 var form=$('#vehicle_detail_form_E_app');
 var formData=form.serialize();
 var url='/vehicle-detail/store';
 var type='post';
 $.ajax({
  type:type,
  url:url,
  data:new FormData($("#vehicle_detail_form_E_app")[0]),
  processData:false,
  contentType:false,
  success:function(response){
   $('#ajax-loader').attr('hidden',true);
   if(response[1]=="already-applied"){
    swal('sorry', response[0] , 'warning');
  }else{
    $('#B-myTab li:nth-child(3) a').removeClass('not-active');
    $('#B-myTab li:nth-child(3) a').tab('show'); 
    $('#E-myTab li:nth-child(3) a').removeClass('not-active');
    $('#E-myTab li:nth-child(3) a').tab('show');
    windowScrollTop();
  }
},
error:function(response){
  swal('Oops...', 'Something went wrong!' , 'error');

}
});
}
////// Driver Info Submission
$('form#driver_detail_form_B_app').on('submit',function(e){
  e.preventDefault();
  if($('#self_driven_checked').is(':checked') && $('#image12_b').val()!='' && $("input#licence_validity").val()!=''){
    driverFormBAjaxReq();
  }
  else if($('#self_driven_checked').not(':checked') && $('#image12_b').val()!='' && $('#image11_b').val()!=''
   && $("input#drivernid_number").val()!=null && $("input#dri_pre_house").val()!='' && $("input#dri_pre_road").val()!=''
   && $("input#dri_pre_block").val()!='' && $("input#dri_pre_area").val()!='' && $('#image10_b').val()!=''
   && $("input#driver_name").val()!='' && $("input#licence_validity").val()!=''){
    driverFormBAjaxReq();
}
else{
  driverInfoValidate();
  swal('Oops!', 'Please fill required form fields', 'warning');
}
});
////// Driver Info Submission
$('form#driver_detail_form_E_app').on('submit',function(e){
  e.preventDefault();
  if($('#self_driven_checked').is(':checked') && $('#image12_b').val()!='' && $("input#licence_validity").val()!=''){
    driverFormEAjaxReq();
  }
  else if($('#self_driven_checked').not(':checked') && $('#image12_b').val()!='' && $('#image11_b').val()!=''
   && $("input#drivernid_number").val()!=null && $("input#dri_pre_house").val()!='' && $("input#dri_pre_road").val()!=''
   && $("input#dri_pre_block").val()!='' && $("input#dri_pre_area").val()!='' && $('#image10_b').val()!=''
   && $("input#driver_name").val()!='' && $("input#licence_validity").val()!=''){
    driverFormEAjaxReq();
}
else{
  driverInfoValidate();
  swal('Oops!', 'Please fill required form fields', 'warning');
}
});
////// Helper Info Submission
$('form#helper_detail_form').on('submit',function(e){
  e.preventDefault();
  if($('#image11_bhhh').val()!='' && $('#image10_bhelper_photo').val()!=''
   && $("input#helpernid_number").val()!=null && $("input#helper_pre_house").val()!=''
   && $("input#helper_pre_road").val()!='' && $("input#helper_pre_block").val()!='' 
   && $("input#helper_pre_area").val()!=''&& $("input#helper_name").val()!=''){
   $('#ajax-loader').attr('hidden',false);
 var form=$('form#helper_detail_form');
 var formData=form.serialize();
 var url='/helper-detail/store';
 var type='post';
 $.ajax({
  type:type,
  url:url,
  data:new FormData($("form#helper_detail_form")[0]),
  processData:false,
  contentType:false,
  success:function(response){
    $('#ajax-loader').attr('hidden',true);
    if(response[1]=="success renew"){
      swal(
       'Congratulation!',response[0],'success').then(function() {
         $('#ajax-loader').attr('hidden',false);
         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/send-submission-sms/success/"+response[2],
          data:'',
          dataType:'json',
          success:function(res){
            $('#ajax-loader').attr('hidden',true);
          }
        });
         window.location.href = '/applied-applications';
       });
     }else if(response[1]=="success for renew"){
      swal(
       'Congratulation!',response[0],'success').then(function() {
         $('#ajax-loader').attr('hidden',false);
         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/send-submission-renew-sms/success/"+response[2],
          data:'',
          dataType:'json',
          success:function(res){
            $('#ajax-loader').attr('hidden',true); 
          }
        });
         window.location.href = '/applied-applications';
       });
     }  
   },
   error:function(response){
    swal('Oops...', 'Something went wrong!' , 'error');
  }
});
}
else{
  HelperInfoValidate();
  swal('Oops!', 'Please fill required form fields', 'warning');
}
});
function driverFormBAjaxReq(){
 $('#ajax-loader').attr('hidden',false);
 var form=$('form#driver_detail_form_B_app');
 var formData=form.serialize();
 var url='/driver-details/store';
 var type='post';
 $.ajax({
  type:type,
  url:url,
  data:new FormData($("form#driver_detail_form_B_app")[0]),
  processData:false,
  contentType:false,
  success:function(response){
    $('#ajax-loader').attr('hidden',true);
    if(selected_sticker_category=='F'){
     $('#B-myTab li:nth-child(4) a').removeClass('not-active');
     $('#B-myTab li:nth-child(4) a').tab('show'); 
     $('#E-myTab li:nth-child(4) a').removeClass('not-active');
     $('#E-myTab li:nth-child(4) a').tab('show');
     windowScrollTop();
   }else{
    console.log(response);
    if(response[1]=="success renew"){
      swal(
       'Congratulation!',response[0],'success').then(function() {
         $('#ajax-loader').attr('hidden',false);
         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/send-submission-sms/success/"+response[2],
          data:'',
          dataType:'json',
          success:function(res){
            $('#ajax-loader').attr('hidden',true);
          }
        });
         window.location.href = '/applied-applications';
       });
     }else if(response[1]=="success for renew"){
      swal(
       'Congratulation!',response[0],'success').then(function() {
         $('#ajax-loader').attr('hidden',false);
         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/send-submission-renew-sms/success/"+response[2],
          data:'',
          dataType:'json',
          success:function(res){
            $('#ajax-loader').attr('hidden',true); 
          }
        });
         window.location.href = '/applied-applications';
       });
     }  
   }
 },
 error:function(response){
  swal('Oops...', 'Something went wrong!' , 'error');
}
});
}
function driverFormEAjaxReq(){
 $('#ajax-loader').attr('hidden',false);
 var form=$('form#driver_detail_form_E_app');
 var formData=form.serialize();
 var url='/driver-details/store';
 var type='post';
 $.ajax({
  type:type,
  url:url,
  data:new FormData($("form#driver_detail_form_E_app")[0]),
  processData:false,
  contentType:false,
  success:function(response){
    $('#ajax-loader').attr('hidden',true);
    if(selected_sticker_category=='F'){
     $('#B-myTab li:nth-child(4) a').removeClass('not-active');
     $('#B-myTab li:nth-child(4) a').tab('show'); 
     $('#E-myTab li:nth-child(4) a').removeClass('not-active');
     $('#E-myTab li:nth-child(4) a').tab('show');
     windowScrollTop();
   }else{
    console.log(response);
    if(response[1]=="success renew"){
      swal(
       'Congratulation!',response[0],'success').then(function() {
         $('#ajax-loader').attr('hidden',false);
         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/send-submission-sms/success/"+response[2],
          data:'',
          dataType:'json',
          success:function(res){
            $('#ajax-loader').attr('hidden',true);
          }
        });
         window.location.href = '/applied-applications';
       });
     }else if(response[1]=="success for renew"){
      swal(
       'Congratulation!',response[0],'success').then(function() {
         $('#ajax-loader').attr('hidden',false);
         $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type:"post",
          url:"/send-submission-renew-sms/success/"+response[2],
          data:'',
          dataType:'json',
          success:function(res){
            $('#ajax-loader').attr('hidden',true); 
          }
        });
         window.location.href = '/applied-applications';
       });
     }  
   }
 },
 error:function(response){
  swal('Oops...', 'Something went wrong!' , 'error');
}
});
}
///
$('#application_edit_form').on('submit',function(e){
  e.preventDefault();
  $('#ajax-loader').attr('hidden',false);
  var app_id = $(this).data('id');
  var form=$('#application_edit_form');
  var formData=form.serialize();
  var url='/application-detail/update/'+app_id;
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#application_edit_form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
     $('#ajax-loader').attr('hidden',true);
     if(response[1]=="success"){
      swal('Great!', response[0] , 'success').then(function(){
       windowScrollTop(); 
       location.reload();
     });

    }
  },
  error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');
          }
        });
});

$('#applicant_detail_edit_form').on('submit',function(e){
  e.preventDefault();
  $('#ajax-loader').attr('hidden',false);
  var app_id = $(this).data('id');
  var form=$('#applicant_detail_edit_form');
  var formData=form.serialize();
  var url='/applicant-detail/update/'+app_id;
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#applicant_detail_edit_form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
     $('#ajax-loader').attr('hidden',true);
     if(response[1]=="success"){
      swal('Great!', response[0] , 'success').then(function(){
       windowScrollTop(); 
       location.reload();
     });

    }
  },
  error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');
          }
        });
});

$('#vehicle_detail_edit_form').on('submit',function(e){
  e.preventDefault();
  $('#ajax-loader').attr('hidden',false);
  var app_id = $(this).data('id');
  var form=$('#vehicle_detail_edit_form');
  var formData=form.serialize();
  var url='/vehicle-detail/update/'+app_id;
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#vehicle_detail_edit_form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      $('#ajax-loader').attr('hidden',true);
      if(response[1]=="success"){
        swal('Great!', response[0] , 'success').then(function(){
         windowScrollTop(); 
         location.reload();
       });
      }
    },
    error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');
          }
        });
});

$('#driver_detail_edit_form').on('submit',function(e){
  e.preventDefault();
  $('#ajax-loader').attr('hidden',false);
  var app_id = $(this).data('id');
  var form=$('#driver_detail_edit_form');
  var formData=form.serialize();
  var url='/driver-detail/update/'+app_id;
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#driver_detail_edit_form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      $('#ajax-loader').attr('hidden',true);
      if(response[1]=="success"){
        swal('Great!', response[0] , 'success').then(function(){
         windowScrollTop(); 
         // location.reload();
       });
      }
    },
    error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');
          }
        });
});

$('#helper_detail_edit_form').on('submit',function(e){
  e.preventDefault();
  $('#ajax-loader').attr('hidden',false);
  var app_id = $(this).data('id');
  var form=$('#helper_detail_edit_form');
  var formData=form.serialize();
  var url='/helper-detail/update/'+app_id;
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#helper_detail_edit_form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      $('#ajax-loader').attr('hidden',true);
      if(response[1]=="success"){
        swal('Great!', response[0] , 'success').then(function(){
         windowScrollTop(); 
         // location.reload();
       });
      }
    },
    error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');

          }


        });
});
var numOfDriver=1;
var addedDriver=1;
var totalexistDriver=0;
//       Remove Driver Form
$(document).on('click','button#remove_driver',function(){
  totalexistDriver= parseInt($('div.driver:first-child').data('total'));
  if(numOfDriver>1){
    $('#ajax-loader').attr('hidden',false);
    $('div#driver-'+numOfDriver).remove();
    $.each($('div.driverform_fields'), function( key, value ) {
      $(this).find('.driver_serial_no').text(++key)
      $(this).attr('data-total',(totalexistDriver-1));
    });
    numOfDriver -=1;
    swal('Removed!', 'Last Driver Form Removed Successfully' , 'success')
  }else{
   swal('Not Now..', 'No More Created Driver Form To Remove!' , 'warning');
 }
 setTimeout(function(){ $('#ajax-loader').attr('hidden',true); }, 250);

 // alert(numOfDriver)

});
//       Add Driver Form
$(document).on('click','button#add_driver',function(){
  $('#ajax-loader').attr('hidden',false);
  totalexistDriver= parseInt($('div.driver:first-child').data('total'));
  var drivernum = totalexistDriver+numOfDriver;
  numOfDriver +=1;
  var DriverForm= $("div.driver:first-child").clone().removeClass('driver-1').addClass('newdriver driver-'+numOfDriver).attr('id','driver-'+numOfDriver);
  DriverForm.find('div.isvehicleselfdriven').remove();
  DriverForm.find("*[id]").each(function () {
    $(this).attr("id", $(this).attr("id") + 'new'+numOfDriver);
  });
  DriverForm.find('.not_self_driven').attr('hidden',false);
  DriverForm.find('.not_self_driven').removeClass('not_self_driven');
  DriverForm.find('input[type="file"]').attr('disabled',false);
  DriverForm.find('button.change-btn').remove();
  DriverForm.find('button.cancel-btn').remove();
  DriverForm.find('button.removeDriver').remove();
  DriverForm.find('img').attr('hidden','true');
  DriverForm.find('input[type="checkbox"]').prop('checked', false);
  DriverForm.find('input').val('');
  DriverForm.find(".driver_serial_no").attr("id","driver-num-new"+numOfDriver);
  $('input',DriverForm).val('');
  $('#driver_prev_btn').before(DriverForm);
  if(totalexistDriver>0){
    $('.driver-'+numOfDriver).each(function(index) {
      var prefix = "newdrivers[" + ( numOfDriver - 1 ) + "]";
      $(this).find("input").each(function() {
       this.name = this.name.replace(/drivers\[\d+\]/, prefix);   
     });
    });
  }else{
    $('.driver-'+numOfDriver).each(function(index) {
      var prefix = "drivers[" + ( numOfDriver - 1 ) + "]";
      $(this).find("input").each(function() {
        this.name = this.name.replace(/drivers\[\d+\]/, prefix);   
      });
    });
  }
  // alert(totalexistDriver)
  // alert(numOfDriver)
  // $('#driver-num-new'+numOfDriver).text(drivernum);
  $.each($('div.driverform_fields'), function( key, value ) {
    $(this).find('.driver_serial_no').text(++key)
    $(this).attr('data-total',(totalexistDriver+1));
  });
  setTimeout(function(){ $('#ajax-loader').attr('hidden',true); }, 250);
  swal('Created!', 'New Driver Form Created Successfully' , 'success').then(function(){
   $('html, body').stop().animate({
    scrollTop: $('#driver-'+numOfDriver).offset().top - 75
  }, 1000); 
 })
})
var numOfHelper=1;
var addedHelper=1;
var HelpernumExist=0;
//     Remove Helper Form
$(document).on('click','button#remove_helper',function(){
  HelpernumExist= parseInt($('div.helper:first-child').data('total'));
  if(numOfHelper>1){
    $('#ajax-loader').attr('hidden',false);
    $('div.helper-'+numOfHelper).remove();
    $.each($('div.helperform_fields'), function( key, value ) {
      $(this).find('.helper_serial_no').text(++key)
      $(this).attr('data-total',(HelpernumExist-1));
    });
    numOfHelper -=1;
    swal('Removed!', 'Last Helper Form Removed Successfully' , 'success')
  }else{
   swal('Not Now..', 'No More Created Helper Form To Remove!' , 'warning');
 }
 setTimeout(function(){ $('#ajax-loader').attr('hidden',true); }, 250);

});
//     Add Helper Form

$(document).on('click','button#add_helper',function(){
  $('#ajax-loader').attr('hidden',false);
  HelpernumExist= parseInt($('div.helper:first-child').data('total'));
  var helpernum = HelpernumExist+numOfHelper;
  numOfHelper +=1;
  var HelperForm= $("div.helper:first-child").clone().removeClass('helper-1').addClass('newhelper helper-'+numOfHelper).attr('id','helper-'+numOfHelper);
  HelperForm.find('input.helper_address_same_as_present').prop('checked',false);
  HelperForm.find('input[type="file"]').attr('disabled',false);
  HelperForm.find('button.change-btn').remove();
  HelperForm.find('button.removeHelper').remove();
  HelperForm.find('img').attr('hidden','true');
  $('input',HelperForm).val('');
  HelperForm.find("*[id]").each(function () {
    $(this).attr("id", $(this).attr("id") + 'new'+numOfHelper);
  });
  HelperForm.find(".helper_serial_no").attr("id","helper-num-new"+numOfHelper);
  $('#helper_prev_btn').before(HelperForm);
  if(HelpernumExist>0){
      // alert(HelpernumExist)
      $('.helper-'+numOfHelper).each(function(index) {
        var prefix = "newhelpers[" + index + "]";
        $(this).find("input").each(function() {
         this.name = this.name.replace(/helpers\[\d+\]/, prefix);   
       });
      });
    }else{
     $('.helper-'+numOfHelper).each(function(index) {
      var prefix = "helpers[" + ( numOfHelper - 1 ) + "]";
      $(this).find("input").each(function() {
       this.name = this.name.replace(/helpers\[\d+\]/, prefix);   
     });
    });
   }
   // alert(numOfHelper)
   // alert(helpernum)
   $.each($('div.helperform_fields'), function( key, value ) {
    $(this).find('.helper_serial_no').text(++key)
    $(this).attr('data-total',(HelpernumExist+1));
  });
   // $('#helper-num-new'+numOfHelper).text(helpernum);
   setTimeout(function(){ $('#ajax-loader').attr('hidden',true); }, 250);
   swal('Created!', 'New Helper Form Created Successfully' , 'success').then(function(){
    $('html, body').stop().animate({
      scrollTop: $('#helper-'+numOfHelper).offset().top - 75
    }, 1000); 
  }); 
 });
//     Remove Driver From DB

$(document).on('click', 'button.removeDriver', function(e){
  e.preventDefault();
  var totalDrivernumber= $(this).parent('div.driver').data('total');
  var driverId=$(this).data('id');
  swal({
   title: 'Are you sure?',
   text: "Delete this driver!",
   type: 'question',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, Delete!',
   showLoaderOnConfirm: true,
   preConfirm: function() {
     return new Promise(function() {
      $('#ajax-loader').attr('hidden',false);
      $.ajax({
        type:'get',
        url:'/remove/driver/'+driverId,
        success:function(response){
          $('#ajax-loader').attr('hidden',true);
          if(response[1]=="success"){
            swal('Done!', response[0] , 'success').then(function(){
              $('#driverID_'+response[2]).remove();
              $.each($('div.driverform_fields'), function( key, value ) {
                $(this).find('.driver_serial_no').text(++key)
                $(this).attr('data-total',(totalDrivernumber-1));
              });
            });
          }
          else if(response[1]=="not-success"){
            swal('Sorry!', response[0] , 'warning').then(function(){
            });
          }
        },
        error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');
          }
        });
    })
   }
 })
});
//     Remove Helper From DB

$(document).on('click', 'button.removeHelper', function(e){
  e.preventDefault();
  var totalHelpernumber= $(this).parent('div.helper').data('total');
  var helperId=$(this).data('id');
  swal({
   title: 'Are you sure?',
   text: "Delete this helper!",
   type: 'question',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, Delete!',
   showLoaderOnConfirm: true,
   preConfirm: function() {
     return new Promise(function() {
      $('#ajax-loader').attr('hidden',false);
      $.ajax({
        type:'get',
        url:'/remove/helper/'+helperId,
        success:function(response){
          console.log(response)
          $('#ajax-loader').attr('hidden',true);
          if(response[1]=="success"){
            swal('Done!', response[0] , 'success').then(function(){
              $('#helperID_'+response[2]).remove();
              $.each($('div.helperform_fields'), function( key, value ) {
                $(this).find('.helper_serial_no').text(++key)
                $(this).attr('data-total',(totalHelpernumber-1));
              });
            });
          }
          else if(response[1]=="not-success"){
            swal('Sorry!', response[0] , 'warning').then(function(){
            });
          }
        },
        error:function(response){
            // toastr.error(" Opps!! Something Went Wrong");
            swal('Oops...', 'Something went wrong!' , 'error');
          }
        });

    })
   }
 })
  
});

}); // End document.ready
