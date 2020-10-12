@extends('layouts.admin-master')
@section('admin-sidebar')
    @include('layouts.admin-sidebar')
@endsection
@section('content')
    <div class="content-area" style="padding-top: 15px;">
        <div class="container-fluid pl-0 pr-0">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 id="inv_title"> Approved Temporary Applications</h3>
                <button id="invoice_report" class="ctg-p-button print-p" onclick="PrintIt_TR()" style="">print</button>
            </div>
         <div class="panel-body" style="padding:10px 0;">
             <div id="example-wrapper">

                <table id="approve-table" class="table table-bordered dt-responsive" style="text-align: center; width:100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="custName">Name</th>
                        <th scope="col">Reg. No.</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col" class="custDate">Date</th>
                        <th scope="col">Vehicle Type</th>
                        <th scope="col">Nat ID</th>
                        <th scope="col">Driver Org</th>
                        <!--<th scope="col" class="temp_ap_action">Action</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($temps))
                    <?php $sl=1; ?>
                     @foreach($temps as $key => $app)
                   <tr>
                       <th scope="row">{{$sl++}}</th>
                        <td class="custName">
                            <a href="{{url('/application-review')}}/{{$app->app_number}}">{{$app->applicant->name}}</a></td>
                        <td>{{$app->vehicleinfo->reg_number}}</td>
                        <td>{{$app->applicant->phone}} </td>
                        <td class="custDate">{{$app->app_date}}</td>
                        <td>{{$app->vehicleinfo->vehicleType->name}}</td>
                        <td>{{ isset($app->applicant->applicantDetail->nid_number) ? $app->applicant->applicantDetail->nid_number : '-' }}</td>
                        <td>{{ isset($app->driverinfoes[0]->org_name) ? $app->driverinfoes[0]->org_name : ((isset($app->driverinfoes[1]->org_name)) ? $app->driverinfoes[1]->org_name : '') }}</td> 
                        <!--<td class="temp_ap_action">-->
                        <!--    <button data-number="{{$app->app_number}}" id='issue_sticker' data-toggle="modal" data-target=" #myIssueModal"  class="btn  btn-success" style="color: #fff;">Issue</button>-->
                               
                        <!--</td>-->
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
<script type="text/javascript" src="{{asset('/assets/admins/js/temp-approved-pdf-print-custom.js')}}"></script>
<script>
    $(document).ready(function(){
     $('#approve-table').dataTable( {
                // "paging": false,
                // "searching": false
            } );
    })
</script>
@endsection