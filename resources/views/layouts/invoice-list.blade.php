@extends('layouts.admin-master')
@section('admin-sidebar')
@include('layouts.admin-sidebar')
@endsection
@section('content')
<div class="content-area" style="padding-top: 15px;">
    <div class="container-fluid  pl-0 pr-0" >
        <div class="panel panel-default">
            <div class="panel-heading" style="overflow: hidden;">
                <h3 style="float: left;" id="inv_title">Invoice List</h3>  
                <button id="invoice_report" class="ctg-p-button print-p" onclick="PrintIt_allpage()" style="">print</button>
                <div class="invoice_date_filter" style="float: right; margin-right:20px;">
                    <form action="/search/invoice" method="post">
                        {{ csrf_field() }}
                        <label> From: </label> <input style="border: none; padding: 2px 5px;" class="" type="date" name="start_inv_date" value="{{isset($date_from) ? $date_from : ''}}">
                        <label>To:</label> <input class="" type="date" style="border: none; padding: 2px 5px;" name="end_inv_date" value="{{isset($date_to) ? $date_to : ''}}">
                        <button type="submit" style="border: none; padding: 2px 5px; font-size: 14px;" class="btn-info">Show Invoice</button>
                    </form>
                </div>  

            </div>
            <div class="panel-body" style="padding:10px 0;" >
            	<div id="example-wrapper">

                   <table id="example" class="table table-bordered dt-responsive" style="border-collapse: collapse!important;text-align:center;">
                    <thead>
                        <tr>
                            <th scope="col" style="border: 1px solid #ddd;">#</th>
                            <th scope="col" style="border: 1px solid #ddd;">Invoice Number</th>
                            <th scope="col" style="border: 1px solid #ddd;" class="custName">Applicant Name</th>
                            <th scope="col" style="border: 1px solid #ddd;">Veh. Type</th>
                            <th scope="col" style="border: 1px solid #ddd;">Reg. No.</th>
                            <th scope="col" style="border: 1px solid #ddd;">Stkr. Type</th>
                            <th scope="col" style="border: 1px solid #ddd;">Received By</th>
                            <th scope="col" style="border: 1px solid #ddd;">Total</th>
                            @if(auth()->user()->role=='super-admin')
                            <th scope="col" class="action">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($invoices) &&  $invoices !='')
                        @foreach($invoices as $key => $invoice)
                        <tr id="invoice-{{$invoice->id}}" style="text-align:left;">
                            <td  scope="row" style="text-align:center;">{{$loop->iteration}}</td>
                            <td class="invnum"><a target="_blank" href="{{url('/invoice')}}/{{$invoice->id}}">{{$invoice->number}}</a></td>
                            <td > {{$invoice->application->applicant->name}} </td>
                            <td> {{$invoice->vehicleType->name}}</td>
                            <td> {{$invoice->application->vehicleinfo->reg_number ?? ''}}</td>
                            <td> {{$invoice->stickerCategory->value}}</td>
                            <td> {{$invoice->collector}} <br>{{$invoice->invoice_date}}
                            </td>
                            <td style="text-align:right;"> {{sprintf('%0.2f', $invoice->total)}}</td>
                            @if(auth()->user()->role=='super-admin')
                            <td class="action">
                               <button data-id='{{$invoice->id}}' class="deleteInv btn btn-danger"><i class="far fa-trash-alt"></i></button>
                           </td>
                           @endif

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
@section('admin-script')
<link href="{{asset('assets/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
<script src="{{asset('assets/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/admins/js/admin-script.js')}}"></script>
@endsection