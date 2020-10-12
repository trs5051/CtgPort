@extends('layouts.admin-master')
@section('admin-sidebar')
    @include('layouts.admin-sidebar')
@endsection
@section('content')
    <div class="content-area" style="padding-top: 15px;">
        <div class="container-fluid  pl-0 pr-0">
            <div class="panel panel-default">
            <div class="panel-heading"><h3 id="inv_title">Expired Vehicle Stickers</h3>
                <button id="invoice_report" class="ctg-p-button print-p" onclick="PrintIt_allpage()" style="">print</button>
            </div>
             <div class="panel-body" style="padding:10px 0;" >
                <div id="example-wrapper">
                <table id="example" class="table table-bordered dt-responsive" style="text-align: center;">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="custName">Name</th>
                        <th scope="col">Reg. No.</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col" class="custDate">Exp Date</th>
                        <th scope="col">Vehicle Type</th>
                        <th scope="col">Sticker No.</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($apps))
                    <?php $sl=1; ?>
                     @foreach($apps as $key => $app)
                   <tr>
                       <th scope="row">{{$sl++}}</th>
                        <td class="custName">
                            <a href="{{url('/application-review')}}/{{$app->app_number}}">{{$app->applicant->name}}</a> </td>
                        <td> {{!empty($app->vehicleinfo->reg_number) ? $app->vehicleinfo->reg_number:''}} </td>
                        <td> {{!empty($app->applicant->phone)?$app->applicant->phone:''}} </td>
                        <td class="custDate"> {{!empty($app->vehicleSticker->exp_date)?Carbon\Carbon::parse($app->vehicleSticker->exp_date)->format('d/m/Y'):''}} </td>
                        <td> {{!empty($app->vehicleinfo->vehicleType->name)?$app->vehicleinfo->vehicleType->name:''}} </td>
                        <td> {{ isset($app->vehicleSticker->sticker_number) ? $app->vehicleSticker->sticker_number : '-' }} </td>
                   </tr>
                       @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
            </div>
        </div>

       </div>
        

    </div>
  
@endsection