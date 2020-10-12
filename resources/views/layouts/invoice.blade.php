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
    <style>
      .card {
        min-height: 211px;
      }
      .divider {
        content: "";
        border-top: 1px dashed #000;
        margin: 10px 0;
      }
      @media print {
        #print-btn {
            display :  none;
        }
      }
    </style>

    <title>Invoice Details | CPA</title>
  </head>
  <body >
  
    <div class="container content" id="invoice">
      <div class="row">
        <div class="col-md-3 logo">          
          <img src="{{asset('/assets/images/logo.png')}}" alt="" class="img-fluid pt-3" style="width: 120px;">
        </div>
        <div class="col-md-6 text-center">
          <h3 style="margin-top: 10px;">Chittagong Port Authority</h3>
          <div class="header-info">
            <ul class="mt-0">
                <li><i class="fas fa-map-marker"></i> Bandar Bhaban, Chattogram-4100, Bangladesh</li>
                <li><i class="fas fa-envelope"></i> info@cpa.gov.bd &nbsp;&nbsp; <i class="fas fa-phone-volume" style="transform: rotate(-15deg);"></i> <b>Tel:</b> +880-31-2522200-29</li>
                <li><i class="fas fa-fax"></i> <b>Fax:</b> +880-31-2510889</li>
            </ul>
          </div>
          <h4 class="inv_title">Invoice</h4>
        </div>
        <div class="col-md-3 text-right">
          <button onclick="myFunction()" style="position: relative; top: 20px; right: 0;" class="btn btn-success" id="print-btn">Print this page</button>
        </div>
      </div>

      <div class="row" style="margin-top: 5px;">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-header">
              Billing To
            </div>
            <div class="card-body">
              <p>Name: {{$invoice->application->applicant->name}}</p> <span> </span>
              <p>Phone: {{$invoice->application->applicant->phone}} </p> <span></span>
              <p>Sticker Category: {{$invoice->stickerCategory->value}}</p> <span></span>

            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-header">
              Application Details
            </div>
            <div class="card-body">
              <p>Application Number: {{$invoice->application->app_number}} </p> <span></span>
              <p>Reg. Number: {{!empty($invoice->application->vehicleinfo->reg_number)?$invoice->application->vehicleinfo->reg_number:''}} </p> <span></span>
              <p>Chassis Number: {{!empty($invoice->application->vehicleinfo->chassis_number)?$invoice->application->vehicleinfo->chassis_number:''}} </p> <span></span>
              <p>Vehicle Type: {{$invoice->vehicleType->name}} </p> <span></span>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="card">
            <div class="card-header">
              Invoice Information
            </div>
            <div class="card-body">
              <p>Invoice Number: {{$invoice->number}} </p> <span></span>
              <p>Date of Invoice: {{Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y')}} </p> <span></span>
              <p>Created By: {{$invoice->collector}} </p> <span></span>
            </div>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">

          <div class="card">
            <div class="card-header">
              <h4 style="text-align: center;">Item Summary</h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Sticker No</th>
                    <th scope="col">Fee</th>
                    <th scope="col">Days</th>
                    <th scope="col">Amount</th>
                    <th scope="col">VAT</th>
                    <th scope="col">Total Amount</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <th>1</th>
                    <td>{{$invoice->fee}}</td>
                    <td>{{$invoice->days}}</td>
                    <td>{{$invoice->amount}}</td>
                    <td>{{$invoice->vat}}</td>
                    <td>{{$invoice->total}}</td>
                  </tr>
                  <!-- load table rows <tr> from db -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="container divider-p" style="height: 1px;margin-top: 35px;margin-bottom: 35px ">
      <div class="divider"></div>
    </div>

    <div id="empty">

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    var prin = document.getElementsByClassName("content")[0];
    var body = document.getElementsByTagName("body")[0];

    function myFunction() {
        $(prin).clone().appendTo("#empty");
        window.print();
        location.reload();
    }
    </script>
  </body>
</html>
