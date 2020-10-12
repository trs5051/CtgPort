<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/fontawesome-all.css"> -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="{{asset('/assets/admins/css/style.css')}}">
  <title>Temporary Pass | CPA</title>
  <style>

  #temp_qr{
    bottom: 0px;
  }
  /* Case: Full-Data */
  .header-data.Only-Layout, .footer-data.Only-Layout{
    visibility: hidden;
  }
  .main-data-wrapper.Only-Layout{
    visibility: visible;
  }

  /* Case: Only-Main-Data */
  .header-data.Only-Main-Data, .footer-data.Only-Main-Data {
    visibility: hidden;
  }
  .main-data-wrapper.Only-Main-Data{
    visibility: visible;
    margin-top: 300px;
  }

  /* Case: Only-Layout */
  .header-data.Only-Layout, .footer-data.Only-Layout{
    visibility: visible;
  }
  .main-data-wrapper.Only-Layout{
    visibility: hidden;
  }

  .header-data button {
    visibility: visible;
  } 
  .infoRight table {
    background: #fff;
  }

  .tempass-body{
    position: relative;
  }
  .temp-bg-img{
    position: absolute;top: 0;margin-top: -52px;left: 50%;margin-left: -479px;width: 960px;z-index: -1;display:none;
   }
   
   .infoLeft, .infoRight {
     padding-top: 0px;
   }
   
.infoLeft p, .infoRight p {
    margin-bottom: 8px;
    color: #000;
}

.infoRight p span {
    font-weight: 400;
}

.infoRight table {
    margin-top: 15px;
}

.table td, .table th {
    padding: 9px;
}
  .authorized-sig{
    color: #000;margin-top: 10px;font-weight:bold;border-bottom: 0px solid #000;margin-bottom: 0px;padding: 0px 0 5px;width: calc( 25% - 15px );margin-left: auto;text-align: center;
  }
  .temp-pbtn{
    position: absolute; top: -6px;right:15px
  }
  .pwrdby{
    font-size:12px;
  }

#empty {
    margin-top: 85px;
}


  @media print {
    #layout-select{
      visibility: hidden;
    }
    .temp-bg-img{
      position: absolute;top: 0;left: 0;margin-left: 0px;width: 100%;z-index: -1;
    }
    
    .tempass-body{
        zoom: 75%;
    }

  }
  

</style>
</head>
<body class="tempass-body" style="padding-top:20px;">
         <?php 
        $driver1='';
        $driver2='';
        $org1='';
        $org2='';
        ?>
        @if(!empty($invoice->application->driverinfoes))
        @foreach($invoice->application->driverinfoes as $k=> $d)
          <?php
            if($k==0 && $d->name=='' && $d->driver_is_owner=='1')
            {
              $driver1=$invoice->application->vehicleowner->owner_name;
              if(!empty($d->org_name))
              $org1=$d->org_name;
            }
            elseif($k==0 && $d->name!=''){
              $driver1=$d->name;
             if(!empty($d->org_name))
              $org1=$d->org_name;
            }
            if($k==1 && $d->name!=''){
              $driver2='/'.$d->name;
             if(!empty($d->org_name))
              $org2='/'.$d->org_name;
            }
          ?>
        @endforeach
        @endif
  <img class="temp-bg-img" src="{{asset('/assets/images/temp-pass-bg-c.jpg')}}" alt="bg">

  <!-- <page size="A4"></page> -->
  <select id="layout-select" style="position:fixed;right: 15px;bottom: 15px;font-size: 14px;">     
    <option value="layout-1">Only-Layout</option>    
    <option value="layout-3">Full-Data</option>   
    <option selected="" value="layout-2">Only-Main-Data</option>
  </select>

  <div class="container print-wrap header-data" style="position: relative;max-width: 960px;display: flex;justify-content: space-between;align-items: center;">             
    <button onclick="myFunction()" class="btn btn-success temp-pbtn" id="print-btn">Print Invoice</button>  

    <p class="ucopy text-left" style="padding-right: 20px;font-size:  16px;font-weight:  700;">For Single Entry Only</p>
    <p class="ucopy text-right" style="padding-left: 20px;font-size:  12px;font-weight:  700;">User Copy</p> 
  </div>
  <div class="container content" id="invoice" style="padding-top: 10px;padding-bottom: 10px;max-width: 960px;">
    <div class="row header-data">
      <div class="col-md-2 logo">
        <img src="{{asset('/assets/images/logo.png')}}" alt="" class="img-fluid">
      </div> 
      <div class="col-md-8  heading" id="" >
        <h2>Chattogram Port Authority</h2>
        <p>(Reserved &amp; Restricted Area)</p>
        <p style="margin-left:-25px;">[Authority: The protection of port (Special Measures) Act, 1948 (Act No. XVII of 1948)]</p>
      </div>
      <div id="photo-box" style="border: 1px solid #000;width: 100px;height: 100px;box-sizing:border-box; margin-right:15px;margin-bottom:15px;margin-left:auto;">
        <p style="text-align: center; line-height:100px;"> Photo </p>
      </div>
    </div>
    <div class="row header-data">
      <div class="col-md-12 warning" id="">
        <h3 style="font-size:24px">[Entrance Prohibited at car sheds/dumping yard]</h3>
      </div>
    </div>
    <div class="row main-data-wrapper">
      <div class="col-md-6 infoLeft" id="">
        <p>Pass No : <span>{{$invoice->temporaryPass->number}}</span></p>
        <p>Gate No : <span>{{$invoice->temporaryPass->gate_no}}</span></p>
        <p>Name :  <span>{{$invoice->application->applicant->name}}</span></p>
        <p>Org. Name :  <span>{{$org1.$org2}}</span></p>
        <p>Vehicl Reg: <span>{{$invoice->temporaryPass->reg_number}}</span></p>
        <p>Chass No: {{!empty($invoice->application->vehicleinfo->chassis_number)?$invoice->application->vehicleinfo->chassis_number:''}} </p> 
        <!--<p>
            Present. Add. : <span>
             @if(isset($invoice->application->applicant->applicantDetail->address))
              <?php $app_address = json_decode($invoice->application->applicant->applicantDetail->address, true);   ?>
              <span>House: {{$app_address['present']['house'] }}</span>,
              <span>Road: {{$app_address['present']['road'] }}</span>,
              <span>Block: {{$app_address['present']['block'] }}</span>,
              <span>Area: {{$app_address['present']['area'] }}</span>.
              @endif
            </span>
          </p>
          <p>
            Permanent. Add. : <span>
              @if(isset($invoice->application->applicant->applicantDetail->address))
                <?php $app_address = json_decode($invoice->application->applicant->applicantDetail->address, true);   ?>
                <span>House: {{$app_address['permanent']['p_house'] }}</span>,
                <span>Road: {{$app_address['permanent']['p_road'] }}</span>,
                <span>Block: {{$app_address['permanent']['p_block'] }} </span>,
                <span>Area: {{$app_address['permanent']['p_area'] }} </span>.
              @endif
            </span>
          </p> -->
          <p>
            Purpose : <span>{{$invoice->application->vehicleinfo->necessity_to_use ? $invoice->application->vehicleinfo->necessity_to_use :'' }}</span>
          </p>
          <p>Valid From : <span style='font-weight:bold'>{{Carbon\Carbon::parse($invoice->temporaryPass->start_date)->format('d-m-Y')}}</span></p>
          <p>Valid Upto : <span style='font-weight:bold'>{{Carbon\Carbon::parse($invoice->temporaryPass->exp_date)->format('d-m-Y')}}</span></p>
        </div>

        <div class="col-md-6 infoRight" id="" style="position: relative;">
          <p>
           Issue Type : <span style="text-transform: capitalize;">{{$invoice->temporaryPass->issue_type}}</span>
         </p>
         <p>
           Issue Date : <span>{{Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y')}}</span>
         </p>
         <p>
          Time : <span>{{$invoice->created_at->format('H:i:s')}}</span>
        </p>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Vehicle Type</th>
              <th scope="col">Days</th>
              <th scope="col">Per Day Fee</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$invoice->vehicleType->name}}</td>
              <td>{{$invoice->days}}</td>
              <td>{{$invoice->fee}}</td>
              <td>{{$invoice->amount}}</td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: center;">Vat (15%)</td>
              <td>{{$invoice->vat}}</td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: center;">Total Amount</td>
              <td>{{$invoice->total}}</td>
            </tr>
          </tbody>
        </table>
   
        <div id="temp_qr"> 
         <?php 
         QRCode::text('Driver: '.$driver1. $driver2.', Organization: '.$org1.$org2.', Reg No: '.$invoice->temporaryPass->reg_number.',  Chassis No: '.$invoice->application->vehicleinfo->chassis_number.', Valid From: '.Carbon\Carbon::parse($invoice->temporaryPass->start_date)->format('d-m-Y').', Valid Upto: '.Carbon\Carbon::parse($invoice->temporaryPass->exp_date)->format('d-m-Y').', Issue Date: '.Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y').'.')->svg();
         ?> 
       </div>
     </div>

   </div>
   <p class="footer-data authorized-sig">Authorized Signatory</p>
   <div class="pwrdby text-right footer-data">Powered By Ennvisio Digital Pvt. Ltd.</div>
 </div>

 <div class="container divider-p sdfsfds footer-data" style="padding:05px 0px; max-width: 930px;margin-top: 15px;margin-bottom: 30px ">
  <div class="divider " style="height: 1px;"></div>  
  <img class="jolchap0" src="{{asset('/assets/images/CTG-Port-Security-Logo-01.png')}}" alt="CTG-Port-Security-Logo">
  <img class="jolchap1" src="{{asset('/assets/images/logo.png')}}" alt="jolchap1" style="    width: 480px;">
  <img class="jolchap2" src="{{asset('/assets/images/CTG-Port-Security-Logo-01.png')}}" alt="CTG-Port-Security-Logo">
</div>




<div id="empty">
  <div hidden="" class="container print-wrap header-data" style="position: relative;margin-top:15px;max-width: 960px;display: flex;justify-content: space-between;align-items: center;">             
    <p class="ucopy text-left" style="padding-right: 20px;font-size:  16px;font-weight:  700;">For Single Entry Only</p>           
    <p class="ucopy text-right" style="padding-left: 20px;font-size:  12px;font-weight:  700;">Office Copy</p> 
  </div>

</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
  var prin = document.getElementsByClassName("content")[0];
  var body = document.getElementsByTagName("body")[0];

  function myFunction() {
    $('.print-wrap').attr('hidden',false);
    $(prin).clone().appendTo("#empty");
    window.print();
    location.reload();
  }

  $(document).ready(function(){
    var selected_option = $('#mySelectBox option:selected');
  });

  $( ".header-data, .footer-data, .main-data-wrapper" ).removeClass("Only-Layout Only-Main-Data Full-Data").addClass( 'Only-Main-Data' );

  $( "select#layout-select" ).on('change', function() {
    var str = "";   
    $( "select option:selected" ).each(function() {
      str = $( this ).text() + " ";
    });
    $( ".header-data, .footer-data, .main-data-wrapper" ).removeClass("Only-Layout Only-Main-Data Full-Data").addClass( str );
  });
</script>
</body>
</html>
