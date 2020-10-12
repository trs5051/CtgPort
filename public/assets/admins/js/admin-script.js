
$(document).ready(function() {
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $('.check_box_select').change(function (){
   if (this.checked){
    $(this).siblings('input').attr('readonly', false);
    $(this).siblings('select').attr('disabled', false);
  }
  else{
   $(this).siblings('input').attr('readonly', true);
   $(this).siblings('select').attr('disabled', true);
 }
});
  $('input.check_box_select').change(function (){
    var inputValue = $(this).data('input');
    var selectText = $(this).data('select');
    var vehicle = $(this).data('vehicle');
    if (this.checked){
      $(this).siblings('input').val(inputValue);
      $(this).siblings("select").children("option:selected").html(selectText);
      $(this).siblings("select").children("option:selected").val(vehicle);
    }
    else{
     $(this).siblings('input').val('');
     $(this).siblings("select").children("option:selected").html('Select One');
     $(this).siblings("select").children("option:selected").val('');
   }
 });

  $(window).scroll(function() {
    var scrollVal = $(this).scrollTop();
    if ( scrollVal > 110) {
      $('#action-bar').css({'position':'fixed','top' :'0px', 'width':'81.2%'});
    } else {
      $('#action-bar').css({'position':'static','top':'auto', 'width':'100%'});
    }
  });
  $('#temp-pass').on('click',function(){
    $('.temp-menu').toggleClass('hasborder');
  })

  $('#approve_App').on('click',function(){
   var app_num = $(this).data('number');
   var sticker_delivery_date = $('#sticker_delivery_date').val();
   if (sticker_delivery_date!=''){
     $('#err_msg_delDate').attr('hidden',true);
     swal({
       title: 'Are you sure?',
       text: "Approve this application!",
       type: 'question',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, Approve!',
       showLoaderOnConfirm: true,
       preConfirm: function() {
         return new Promise(function() {
           $.ajax({
             url: '/application/approve',
             type: 'get',
             data: {
               'app_num':app_num,
               'sticker_delivery_date':sticker_delivery_date,
             },
             dataType: 'json',
             contentType: "application/json; charset=utf-8",
           })
           .done(function(response){

            if(response[0]==11){
              swal('Approved!',response[1],'success').then(function(){
                $('#app_status').replaceWith("<span id='app_status' style='color: red'>"+response[2]+"</span>");
                $("[data-dismiss=modal]").trigger({ type: "click" });
              });
              if(response[3]!="SMS sent"){
               swal('Not Sent SMS!',response[3],'error').then(function(){
                $("[data-dismiss=modal]").trigger({ type: "click" });
              });
             }

           }
           else if(response[0]==10){
            swal('Not Approved!',response[1],'warning').then(function(){
              $("[data-dismiss=modal]").trigger({ type: "click" });
            });
            
          }
          else if(response[0]==12){
            swal('Not Approved!',response[1],'warning').then(function(){
              $("[data-dismiss=modal]").trigger({ type: "click" });
            });
            
          }

        })
           .fail(function(response){
             swal('Oops...', 'Something went wrong!' , 'error');
           });
         });
       },
       allowOutsideClick: false
     });
   }
   else{
     $('#err_delDate').text('Delivery Date field is required');
     $('#err_msg_delDate').attr('hidden',false);
     $("input#sticker_delivery_date").on("change", function () {
      if($(this).val()!=null){
       $('#err_msg_delDate').attr('hidden',true);
     }
     else{
      $('#err_msg_delDate').attr('hidden',false);
    }
  })
   }

 }); 


  var Applicant_Photo ='';  var Applicant_NID =''; var Driver_Photo =''; var Driver_NID =''; var App_Photo ='';
  var Driver_License_Copy =''; var Driver_Organizational_ID =''; var Owner_NID =''; var Vehicle_Reg_Copy =''; var Tax_Token_Copy ='';
  var Fitness_Certificate_Copy =''; var Insurance_Certificate_Copy =''; var Road_Permit_Copy =''; var Port_Entry_Pass_Copy =''; var Jetty_License_Copy ='';
  var missMatch=new Array(); 
  $('#App_Photo').change(function (){
    if (this.checked){
      App_Photo =$(this).val(); 
      missMatch.push(App_Photo);
    }else{
      missMatch.pop(App_Photo);
    }
  });
  $('#Applicant_Photo').change(function (){
    if (this.checked){
      Applicant_Photo =$(this).val(); 
      missMatch.push(Applicant_Photo);
    }else{
      missMatch.pop(Applicant_Photo);
    }
  }); 
  $('#Applicant_NID').change(function (){
    if (this.checked){
      Applicant_NID =$(this).val(); 
      missMatch.push(Applicant_NID);
    }else{
     missMatch.pop(Applicant_NID);
   }
 }); 
  $('#Driver_Photo').change(function (){
    if (this.checked){
      Driver_Photo =$(this).val(); 
      missMatch.push(Driver_Photo);
    }else{
      missMatch.pop(Driver_Photo);
    }
  }); 
  $('#Driver_NID').change(function (){
    if (this.checked){
      Driver_NID =$(this).val(); 
      missMatch.push(Driver_NID);
    }else{
      missMatch.pop(Driver_NID);
    }
  }); 
  $('#Driver_License_Copy').change(function (){
    if (this.checked){
      Driver_License_Copy =$(this).val();
      missMatch.push(Driver_License_Copy);
    }else{
      missMatch.pop(Driver_License_Copy);
    }
  });  
  $('#Driver_Organizational_ID').change(function (){
    if (this.checked){
      Driver_Organizational_ID =$(this).val(); 
      missMatch.push(Driver_Organizational_ID);

    }else{
      missMatch.pop(Driver_Organizational_ID);
    }
  });  
  $('#Owner_NID').change(function (){
    if (this.checked){
      Owner_NID =$(this).val(); 
      missMatch.push(Owner_NID);

    }else{
      missMatch.pop(Owner_NID);
    }
  }); 
  $('#Vehicle_Reg_Copy').change(function (){
    if (this.checked){
      Vehicle_Reg_Copy =$(this).val();
      missMatch.push(Vehicle_Reg_Copy);
      
    }else{
      missMatch.pop(Vehicle_Reg_Copy);
    }
  });     
  $('#Tax_Token_Copy').change(function (){
    if (this.checked){
      Tax_Token_Copy =$(this).val();
      missMatch.push(Tax_Token_Copy);
      
    }else{
      missMatch.pop(Tax_Token_Copy);
    }
  });     
  $('#Fitness_Certificate_Copy').change(function (){
    if (this.checked){
      Fitness_Certificate_Copy =$(this).val(); 
      missMatch.push(Fitness_Certificate_Copy);

    }else{
     missMatch.pop(Fitness_Certificate_Copy);
   }
 });  
  $('#Insurance_Certificate_Copy').change(function (){
    if (this.checked){
      Insurance_Certificate_Copy =$(this).val();
      missMatch.push(Insurance_Certificate_Copy);
      
    }else{
      missMatch.pop(Insurance_Certificate_Copy);
    }
  });      
  $('#Road_Permit_Copy').change(function (){
    if (this.checked){
      Road_Permit_Copy =$(this).val();
      missMatch.push(Road_Permit_Copy);
      
    }else{
      missMatch.pop(Road_Permit_Copy);
    }
  });      
  $('#Port_Entry_Pass_Copy').change(function (){
    if (this.checked){
      Port_Entry_Pass_Copy =$(this).val();
      missMatch.push(Port_Entry_Pass_Copy);
      
    }else{
     missMatch.pop(Port_Entry_Pass_Copy);

   }
 });     
  $('#Jetty_License_Copy').change(function (){
    if (this.checked){
      Jetty_License_Copy =$(this).val();
      missMatch.push(Jetty_License_Copy);
      
    }else{
     missMatch.pop(Jetty_License_Copy);
   }
 });
  

  $('#reject_App').on('click',function(){
   var app_num = $(this).data('number');
    // if(Applicant_Photo!='' || Applicant_NID!='' || App_Photo!='' || Driver_Photo!='' || Driver_NID!='' || Driver_License_Copy!='' 
    //   || Driver_Organizational_ID!='' || Owner_NID!='' || Vehicle_Reg_Copy!='' || Tax_Token_Copy!='' || Fitness_Certificate_Copy!='' || 
    //   Insurance_Certificate_Copy!='' || Road_Permit_Copy!='' || Port_Entry_Pass_Copy!='' || Jetty_License_Copy!=''){
      if(missMatch.length > 0){
       swal({
         title: 'Are you sure?',
         text: "You want to reject this application!",
         type: 'question',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, reject it!',
         showLoaderOnConfirm: true,
         preConfirm: function() {
           return new Promise(function(resolve) {
             $.ajax({
               url: '/application/reject',
               type: 'get',
               data: {
                'app_num':app_num,
                'missMatch':missMatch,
                
              },
              dataType: 'json'
            })
             .done(function(response){
               if(response[0]==11){
                swal('Rejected!',response[1],'success').then(function(){
                  $('#app_status').replaceWith("<span id='app_status' style='color: red'>"+response[2]+"</span>");
                  $("[data-dismiss=modal]").trigger({ type: "click" });
                });
                if(response[3]!="SMS sent"){
                 swal('Not Sent SMS!',response[3],'error').then(function(){
                  $("[data-dismiss=modal]").trigger({ type: "click" });
                });
               }

             }
             else if(response[0]==10){
              swal('Not Rejected!',response[1],'warning').then(function(){
                $("[data-dismiss=modal]").trigger({ type: "click" });
              });
            }
            else if(response[0]==12){
              swal('Not Rejected!',response[1],'warning').then(function(){
                $("[data-dismiss=modal]").trigger({ type: "click" });
              });
            }
          })
             .fail(function(response){
               swal('Oops...', 'Something went wrong!' , 'error');
             });
           });
         },

         allowOutsideClick: false     
       });
     }else{
      swal('Oops...', 'Please Tick any for which application will be rejected!' , 'error');
    }  

  });
  $('#delete_App').on('click',function(){
   var app_num = $(this).data('number');

   swal({
     title: 'Are you sure?',
     text: "You want to delete this application!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, delete it!',
     showLoaderOnConfirm: true,
     preConfirm: function() {
       return new Promise(function(resolve) {
         $.ajax({
           url: '/application/delete',
           type: 'get',
           data: {
            'app_num':app_num,
          },
          dataType: 'json'
        })
         .done(function(response){
          if(response[0]==13){
            swal('Deleted!',response[1],'success');
            window.location.href='/home';
          } 
          if(response[0]==11){
            swal('Deleted!',response[1],'success').then(function(){
              $('#app_status').replaceWith("<span id='app_status' style='color: red'>"+response[2]+"</span>");
              $("[data-dismiss=modal]").trigger({ type: "click" });
            });

          }
          else if(response[0]==10){
            swal('Not Deleted!',response[1],'warning').then(function(){
              $("[data-dismiss=modal]").trigger({ type: "click" });
            });
          }
          else if(response[0]==12){
            swal('Not Deleted!',response[1],'warning').then(function(){
              $("[data-dismiss=modal]").trigger({ type: "click" });
            });;
          }
          
        })


         .fail(function(response){
           swal('Oops...', 'Something went wrong!' , 'error');
         });
       });
     },
     allowOutsideClick: false
   });

 });
  $('#issueSticker_Form').on('submit',function(e){
    e.preventDefault();
    var form=$('#issueSticker_Form');
    var formData=form.serialize();
    var url='/sticker/issue';
    var type='post';
    $.ajax({
      type:type,
      url:url,
      data:new FormData($("#issueSticker_Form")[0]),
      processData:false,
      contentType:false,
      success:function(response){
        if(response[0]==11){
          swal('Issued!',response[1],'success').then(function() {
            var win = window.open('/invoice/'+response[2]['id'], '_blank');
            win.focus();
            $('#app_status').replaceWith("<span id='app_status' style='color: red'>"+response[3]+"</span>");
            $("[data-dismiss=modal]").trigger({ type: "click" });
          });
        }
        else if(response[0]==10){
          swal('Not Issued!',response[1],'warning').then(function(){
            $("[data-dismiss=modal]").trigger({ type: "click" });
          });
        }
        else if(response[0]==12){
          swal('Not Issued!',response[1],'warning').then(function(){
            $("[data-dismiss=modal]").trigger({ type: "click" });
          });
        }
      },
      error:function(response){
        swal('Oops...', 'Something went wrong!' , 'error');

      }
    });
  });
  
  $('#undo_app').on('click',function(){
   var app_id = $(this).data('id');

   swal({
     title: 'Are you sure?',
     text: "You want to undo this application!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, undo it!',
     showLoaderOnConfirm: true,
     preConfirm: function() {
       return new Promise(function(resolve) {
         $.ajax({
           url: '/application/undo',
           type: 'get',
           data: {
            'app_id':app_id,
          },
          dataType: 'json'
        })
         .done(function(response){
          if(response[1]=="success"){
            swal('Undo Done!',response[0],'success').then(function() {
             $('#app_status').replaceWith("<span id='app_status' style='color: red'>"+response[2]+"</span>");
             $("[data-dismiss=modal]").trigger({ type: "click" });
             location.reload();
           });
          }if(response[1]=="fail"){
            swal('Sorry!',response[0],'warning').then(function() {
             $("[data-dismiss=modal]").trigger({ type: "click" });
           });
          }
        })
         .fail(function(response){
           swal('Oops...', 'Something went wrong!' , 'error');
         });
       });
     },
     allowOutsideClick: false
   });
 });
  function amountCalc(currentDate,expDate){
    var days=null;
    days = Math.round((expDate - currentDate) / (1000 * 60 * 60 * 24));
    days +=1;
    $('.numberOfDays').val(days);
    var feePerDay=$('#feePerDay').val();
    var total=days*feePerDay;
    $('#totalAmount').val(total);
    $('#totalFee').val(total);
    var vatamount = total*0.15;
    $('#vatamount').val(vatamount);
    var grandTotal=total+vatamount;
    $('#grandTotal').val(grandTotal);
  }
  $('#sticker_exp_date').on('change',function(){
    var expDate=new Date($(this).val());
    // console.log(expDate)
    var currentDate = new Date();
    amountCalc(currentDate,expDate);
  });
  $('#temp_sticker_exp_date').on('change',function(){
   var expDate=new Date($(this).val());
   var currentDate = new Date();
   amountCalc(currentDate,expDate);
 });
 //  $('#temp_sticker_exp_date').on('change',function(){
 //    var expDate=new Date($(this).val());
 //    var currentDate = new Date($('#temp_sticker_start_date').val());
 //    if($('#temp_sticker_start_date').val()!='' && $(this).val()!='') {
 //     amountCalc(currentDate,expDate);
 //   }
 // });
 //  $('#temp_sticker_start_date').on('change',function(){
 //    var currentDate=new Date($(this).val());
 //    var expDate = new Date($('#temp_sticker_exp_date').val());
 //    if($('#temp_sticker_exp_date').val()!='' && $().val()!='') {
 //     amountCalc(currentDate,expDate);
 //   }
 // });
 $('select#sms_template').on('change',function(){
  var sms_id = $("#sms_template option:selected" ).val();
  var all_sms = $(this).data('sms');
  $.each( all_sms, function( key, value ) {
    if(sms_id==value['id']){
     $('#sms_subject').val(value['sms_subject']);
     $('#sms_text').val(value['sms_text']);
   }
 }); 
})
 $('#sendSms_Form').on('submit',function(e){
  e.preventDefault();
  var form=$('#sendSms_Form');
  var formData=form.serialize();
  var url='/send/sms';
  var type='post';
  swal({
   title: 'Are you sure?',
   text: "Mail sending",
   type: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, Send Mail!',
   showLoaderOnConfirm: true,
   preConfirm: function() {
     return new Promise(function(resolve) {
      $.ajax({
        type:type,
        url:url,
        data:new FormData($("#sendSms_Form")[0]),
        processData:false,
        contentType:false,
      })
      .done(function(response){

        if(response[1]=="failed"){
         swal('Not Sent!',response[0],'warning');
       }else if(response[1]=="success"){
        swal('Congratulation!',response[0],'success').then(function(){
          $("[data-dismiss=modal]").trigger({ type: "click" });
          location.reload();
        });
      }
    })
      .fail(function(response){
       swal('Oops...', 'Something went wrong!' , 'error');
     });
    });
   },
   allowOutsideClick: false,
 });
}); 

 $('#AddSms_Form').on('submit',function(e){
  e.preventDefault();
  var form=$('#AddSms_Form');
  var formData=form.serialize();
  var url='/add/sms';
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#AddSms_Form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      var table = $('#example').DataTable();
      var  idx= table.rows().count();
      idx++;
      var rowNode = table
      .row.add( ['<b class="serial">'+idx+'</b>', response[1]['sms_template_name'],response[1]['sms_subject'],response[1]['sms_text'],response[1]['creator'],response[1]['updater'], 
        '<button class="btn btn-info view-sms mr-1" data-template="'+response[1]['sms_template_name']+'" data-subject="'+response[1]['sms_subject']+'" data-message="'+response[1]['sms_text']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#view_template_modal"><i class="fas fa-eye"></i></button>'+
        '<button class="btn btn-info edit-sms mr-1" data-template="'+response[1]['sms_template_name']+'" data-subject="'+response[1]['sms_subject']+'" data-message="'+response[1]['sms_text']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#edit_template_modal"><i class="fas fa-edit"></i></button>'+
        '<button class="btn btn-danger delete-sms ml-0" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#delete_template_modal"><i class="fas fa-trash-alt"></i></button>'] )
      .order([0, 'dsc']).draw()
      .node().id = 'sms-'+idx;
      $( rowNode )
      .css( 'color', 'green' )
      .animate( { color: 'red' } );
      swal('Congratulation!',response[0],'success').then(function() {
       $('#AddSms_Form')[0].reset();
       $("[data-dismiss=modal]").trigger({ type: "click" });
     });
    },
    error:function(response){
      printSMSErrorMsg(response.responseJSON);
      swal('Oops...', 'Something went wrong!' , 'error');

    }
  });
});
 
 $(document).on('click', 'button.view-sms', function(){
   $('.sms-template').html($(this).data('template'));
   $('.sms-subject').html($(this).data('subject'));
   $('.sms-text').html($(this).data('message'));
 });  
 
 var id=null; var tr_id=null;  var sl=null;
 $(document).on('click', '.edit-sms', function(){
   $('input.sms_template_name').val($(this).data('template'));
   $('input.sms_subject').val($(this).data('subject'));
   $('textarea.sms_text').val($(this).data('message'));

   id = $(this).data('id');
   tr = $(this).parent().parent();
   tr_id=tr.attr('id');
   sl = $('#'+tr_id +" .serial").text();
 });
 
 $('#UpdateSms_Form').on('submit',function(e){
  e.preventDefault();
  var form=$('#UpdateSms_Form');
  var formData=form.serialize();
  var table = $('#example').DataTable();
  var url='/update/sms/'+id;
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#UpdateSms_Form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      if(response[1]['id'] == id){
        var rData = [
        '<b class="serial">'+sl+'</b>',
        response[1]['sms_template_name'],
        response[1]['sms_subject'],
        response[1]['sms_text'],
        response[1]['creator'],
        response[1]['updater'], 
        '<button class="btn btn-info view-sms mr-1" data-template="'+response[1]['sms_template_name']+'" data-subject="'+response[1]['sms_subject']+'" data-message="'+response[1]['sms_text']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#view_template_modal"><i class="fas fa-eye"></i></button><button class="btn btn-info edit-sms mr-1" data-template="'+response[1]['sms_template_name']+'" data-subject="'+response[1]['sms_subject']+'" data-message="'+response[1]['sms_text']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#edit_template_modal"><i class="fas fa-edit"></i></button><button class="btn btn-danger delete-sms ml-0" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#delete_template_modal"><i class="fas fa-trash-alt"></i></button>'
        ];
        table
        .row( 'tr#'+tr_id )
        .data(rData)
        .draw();
        
            // //   if(response[1]['id'] == id){
            //         var table = $('#example').DataTable();
            //           table.draw();
            // //   $('tr#'+tr_id).replaceWith("<tr id='sms-"+ response[1]['id']+"'>"+
            // //        '<td><b class="serial">'+ sl +'</b></td>'+
            // //        '<td>'+response[1]['sms_template_name']+ '</td>'+
            // //        '<td>'+response[1]['sms_subject']+ '</td>'+
            // //        '<td>'+response[1]['sms_text']+ '</td>'+
            // //        '<td>'+response[1]['creator']+ '</td>'+
            // //        '<td>'+response[1]['updater']+ '</td>'+
            // //        '<td>'+
            // //           '<button class="btn btn-info view-sms mr-1" data-template="'+response[1]['sms_template_name']+'" data-subject="'+response[1]['sms_subject']+'" data-message="'+response[1]['sms_text']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#view_template_modal"><i class="fas fa-eye"></i></button>'+
            // //           '<button class="btn btn-info edit-sms mr-1" data-template="'+response[1]['sms_template_name']+'" data-subject="'+response[1]['sms_subject']+'" data-message="'+response[1]['sms_text']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#edit_template_modal"><i class="fas fa-edit"></i></button>'+
            // //           '<button class="btn btn-danger delete-sms ml-0" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#delete_template_modal"><i class="fas fa-trash-alt"></i></button>'+
            // //        '</td>'+
            // //        '</tr>');
            swal('Congratulation!',response[0],'success').then(function() {
             $('#UpdateSms_Form')[0].reset();
             $("[data-dismiss=modal]").trigger({ type: "click" });

           });
          }
        },
        error:function(response){
          printSMSErrorMsg(response.responseJSON);
          swal('Oops...', 'Something went wrong!' , 'error');

        }
      });
});


 function printSMSErrorMsg (msg) {
  $(".print-error-msg").find("ul").html('');
  $(".print-error-msg").css('display','block');
  $.each( msg, function( key, value ) {
    $(".print-error-msg").find("ul").append('<li> <i class="fas fa-exclamation-triangle"></i> '+value+'</li>');
  });
}

$(document).on('click', '.delete-sms', function(){
  var tr = $(this).parents('tr');
  var tr_id=tr.attr('id');
        // alert(tr_id+ ' '+ 'tr#'+tr_id);

        var id = $(this).data('id');


        swal({
         title: 'Are you sure?',
         text: "You want to delete this Mail Template!",
         type: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!',
         showLoaderOnConfirm: true,
         preConfirm: function() {
           return new Promise(function(resolve) {
             $.ajax({
               url: '/delete/sms',
               type: 'post',
               data: {
                _token: CSRF_TOKEN,
                'id':id,
              },
              dataType: 'json'
            })
             .done(function(response){
              swal('Congratulation!',response[0],'success').then(function(){
                var table = $('#example').DataTable();
                table
                .row("tr#"+tr_id)
                .remove()
                .draw();
              });
            })
             .fail(function(response){
               swal('Oops...', 'Something went wrong!' , 'error');
             });
           });
         },
         allowOutsideClick: false
       });
      });

$('#change_password_form').on('submit',function(e){
  e.preventDefault();
  var form=$('#change_password_form');
  var formData=form.serialize();
  var url='/change/password';
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#change_password_form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      if(response[1]=='success'){
        swal('Congratulation!',response[0],'success').then(function() {
         $('#change_password_form')[0].reset();
         $("[data-dismiss=modal]").trigger({ type: "click" });
       });
      }
      if(response[1]=='fail'){
       swal('Sorry!',response[0],'warning');
     }

   },
   error:function(response){
            // printSMSErrorMsg(response.responseJSON);
            swal('Oops...', 'Something went wrong!' , 'error');
          }
        });
});
$('#AddAdmin_Form').on('submit',function(e){
  e.preventDefault();
  var form=$('#AddAdmin_Form');
  var formData=form.serialize();
  var url='/add/admin';
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#AddAdmin_Form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      var table = $('#example').DataTable();
      var  idx= table.rows().count();
      idx++;
      var rowNode = table
      .row.add( ['<b class="serial">'+idx+'</b>', response[1]['name'],response[1]['email'],response[1]['role'],response[1]['created_at'], 
        '<button class="btn btn-info edit-admin mr-1" data-name="'+response[1]['name']+'" data-email="'+response[1]['email']+'" data-role="'+response[1]['role']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#edit_template_modal"><i class="fas fa-edit"></i></button>'+
        '<button class="btn btn-danger delete-admin ml-0" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#delete_template_modal"><i class="fas fa-trash-alt"></i></button>'] )
      .order([0, 'dsc']).draw()
      .node().id = 'sms-'+idx;
      $( rowNode )
      .css( 'color', 'green' )
      .animate( { color: 'red' } );
      swal('Congratulation!',response[0],'success').then(function() {
       $('#AddAdmin_Form')[0].reset();
       $("[data-dismiss=modal]").trigger({ type: "click" });
       $(".print-error-msg").css('display','none');
     });
    },
    error:function(response){
      printSMSErrorMsg(response.responseJSON);
      swal('Oops...', 'Something went wrong!' , 'error');

    }
  });
});


$(document).on('click', '.edit-admin', function(){
 $('input.name').val($(this).data('name'));
 $('input.email').val($(this).data('email'));
 $('input.role').val($(this).data('role'));

 id = $(this).data('id');
 tr = $(this).parent().parent();
 tr_id=tr.attr('id');
 sl = $('#'+tr_id +" .serial").text();
});

$('#UpdateAdmin_Form').on('submit', function(e){
  e.preventDefault();
  var form=$('#UpdateAdmin_Form');
  var formData=form.serialize();
  var table = $('#example').DataTable();
  var url='/update/admin/'+id;
  var type='post';
  $.ajax({
    type:type,
    url:url,
    data:new FormData($("#UpdateAdmin_Form")[0]),
    processData:false,
    contentType:false,
    success:function(response){
      if(response[1]['id'] == id){
        var row_data = [
        '<b class="serial">'+sl+'</b>',
        response[1]['name'],
        response[1]['email'],
        response[1]['role'],
        response[1]['created_at'],
        '<button class="btn btn-info edit-admin mr-1" data-name="'+response[1]['name']+'" data-email="'+response[1]['email']+'" data-role="'+response[1]['role']+'" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#edit_template_modal"><i class="fas fa-edit"></i></button><button class="btn btn-danger delete-admin ml-0" data-id="'+response[1]['id']+'" data-toggle="modal" data-target="#delete_template_modal"><i class="fas fa-trash-alt"></i></button>'
        ];
        table
        .row( 'tr#'+tr_id )
        .data(row_data)
        .draw();
        swal('Congratulation!',response[0],'success').then(function() {
         $('#UpdateAdmin_Form')[0].reset();
         $("[data-dismiss=modal]").trigger({ type: "click" });
       });
      }
    },
    error:function(response){
      printSMSErrorMsg(response.responseJSON);
      swal('Oops...', 'Something went wrong!' , 'error');
    }
  });
});
$(document).on('click', '.delete-admin', function(){
  var tr = $(this).parents('tr');
  var tr_id=tr.attr('id');
        // alert(tr_id+ ' '+ 'tr#'+tr_id);
        var id = $(this).data('id');
        swal({
         title: 'Are you sure?',
         text: "You want to delete this Admin!",
         type: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!',
         showLoaderOnConfirm: true,
         preConfirm: function() {
           return new Promise(function(resolve) {
             $.ajax({
               url: '/delete/admin',
               type: 'post',
               data: {
                _token: CSRF_TOKEN,
                'id':id,
              },
              dataType: 'json'
            })
             .done(function(response){
              swal('Congratulation!',response[0],'success').then(function(){
                var table = $('#example').DataTable();
                table
                .row("tr#"+tr_id)
                .remove()
                .draw();
              });
            })
             .fail(function(response){
               swal('Oops...', 'Something went wrong!' , 'error');
             });
           });
         },
         allowOutsideClick: false
       });
      });

$(document).on('click','img.driver_photo',function(){
  $('.photo-title').text($(this).data('photomodalheader'));
  $('img#driver-photo-show').attr("src",$(this).attr('src'));
})

$('#special_case').on('change',function(){
  if(this.checked){
    $('.non-gov-data').attr('hidden',true);
    $('.non-gov-data input').attr('disabled',true);
    $('.gov-data').attr('hidden',false);
    $('.gov-data input').attr('disabled',false);
  }else{
   $('.non-gov-data').attr('hidden',false);
   $('.non-gov-data input').attr('disabled',false);
   $('.gov-data').attr('hidden',true);
   $('.gov-data input').attr('disabled',true);
 }
});
$('#normal_case').on('change',function(){
  if(this.checked){
   $('.non-gov-data').attr('hidden',false);
   $('.non-gov-data input').attr('disabled',false);
   $('.gov-data').attr('hidden',true);
   $('.gov-data input').attr('disabled',true);

 }else{
  $('.non-gov-data').attr('hidden',true);
  $('.non-gov-data input').attr('disabled',true);
  $('.gov-data').attr('hidden',false);
  $('.gov-data input').attr('disabled',false);
}
});
if($('#normal_case').is(':checked')){
 $('.non-gov-data').attr('hidden',false);
 $('.non-gov-data input').attr('disabled',false);
 $('.gov-data').attr('hidden',true);
 $('.gov-data input').attr('disabled',true);

}else{
  $('.non-gov-data').attr('hidden',true);
  $('.non-gov-data input').attr('disabled',true);
  $('.gov-data').attr('hidden',false);
  $('.gov-data input').attr('disabled',false);
}
 
  $(document).on('click','.deleteInv',function(){
   var invId = $(this).data('id');
   swal({
     title: 'Are you sure?',
     text: "You want to delete this Invoice!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, delete it!',
     showLoaderOnConfirm: true,
     preConfirm: function() {
         $.ajax({
           url: '/delete/invoice/'+invId,
           type: 'get',
           data: {
            'invId':invId,
          },
          dataType: 'json'
        })
         .done(function(response){
          console.log(response)
            swal('Deleted!','Your Requested invoice has been deleted','success');
            window.location.href='/invoice-list';
        })
         .fail(function(response){
           swal('Oops...', 'Something went wrong!' , 'error');
         });
     },
     allowOutsideClick: false
   });

 });
//
});
