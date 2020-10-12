@extends('layouts.admin-master')
@section('admin-sidebar')
    @include('layouts.admin-sidebar')
@endsection
@section('content') 
    <div class="content-area">
        <div class="container-fluid" id="search-form">
            <form action="{{url('/admin-search')}}" method="post">
                {{csrf_field()}}
            <div class="row">
                <div class="col-md-6">
                    @if(isset($applicant_name) && $applicant_name!='')
                    <input type="checkbox"  id="name_check" class="check_box_select" data-input="{{$applicant_name}}" name="name_check" value="1" checked>
                    <label for="">Applicant Name</label>
                    <input type="text" name="name"   id="name_inp" class="form-control" value="{{$applicant_name}}">
                    @else
                    <input type="checkbox"  id="name_check" class="check_box_select" name="name_check" value="1">
                    <label for="">Applicant Name</label>
                    <input type="text" name="name" readonly="" placeholder="" id="name_inp" class="form-control">
                    @endif
                </div>
                <div class="col-md-6">
                  @if(isset($applicant_phone) && $applicant_phone!='')
                    <input type="checkbox" class="phone_check check_box_select" data-input="{{$applicant_phone}}" name="phone_check" value="1" checked="">
                    <label for="">Phone Number</label>
                    <input type="text" name="phone" placeholder="" class="form-control phone_inp" value="{{$applicant_phone}}">
                  @else
                    <input type="checkbox" class="phone_check check_box_select" name="phone_check" value="1">
                    <label for="">Phone Number</label>
                    <input type="text" name="phone" placeholder="" class="form-control phone_inp" readonly="">
                     @endif
                </div>
                <div class="col-md-6">
                    @if(isset($reg_no) && $reg_no!='')
                    <input type="checkbox" class="reg_check check_box_select" data-input="{{$reg_no}}" name="reg_check" value="1" checked>
                    <label for="">Vehicle Reg No</label>
                    <input type="text" name="reg_no" placeholder="" value="{{$reg_no}}" class="form-control reg_inp">
                    @else
                    <input type="checkbox" class="reg_check check_box_select" name="reg_check" value="1">
                    <label for="">Vehicle Reg No</label>
                    <input type="text" name="reg_no" placeholder="" class="form-control reg_inp" readonly="">
                     @endif
                </div>

                <div class="col-md-6">
                    @if(isset($applicant_nid_number) && $applicant_nid_number!='')
                    <input type="checkbox" name="nid_check" class="check_box_select" data-input="{{$applicant_nid_number}}" value="1" checked>
                    <label for="">Nat ID</label>
                    <input type="text" name="nid_number" placeholder="" class="form-control nid_inp" value="{{$applicant_nid_number}}">
                    @else
                    <input type="checkbox" name="nid_check" class="check_box_select" value="1">
                    <label for="">Nat ID</label>
                    <input type="text" name="nid_number" placeholder="" class="form-control nid_inp" readonly="">
                     @endif
                </div>

                <div class="col-md-6">
                    @if(isset($sticker_no) && $sticker_no!='')
                    <input type="checkbox" class="check_box_select" data-input="{{$sticker_no}}" name="sticker_no_check" value="1" checked>
                    <label for="">Sticker No.</label>
                    <input type="text" name="sticker_no" placeholder="" class="form-control sticker_no_inp" value="{{$sticker_no}}">
                    @else
                    <input type="checkbox" class="check_box_select" name="sticker_no_check" value="1">
                    <label for="">Sticker No.</label>
                    <input type="text" name="sticker_no" placeholder="" class="form-control sticker_no_inp" readonly="">
                    @endif
                </div>
                <div class="col-md-6">
                    @if(isset($vehicle_type) && $vehicle_type!='')
                      <input type="checkbox" class="check_box_select" data-vehicle="{{$vehicle_type->id}}" data-select="{{$vehicle_type->name}}" name="vehicle_type_check" value="1" checked>
                      <label for="">Vehicle Type</label>
                      <select name="vehicle_type" id="" class="form-control-sm vehicle_type_inp">
                        <option selected value="{{$vehicle_type->id}}"> {{$vehicle_type->name}}</option>
                        @if(isset($vehicleTypes) && $vehicleTypes!='')
                        @foreach($vehicleTypes as $vehicleType)
                         <option value="{{$vehicleType->id}}"> {{$vehicleType->name}} </option>
                        @endforeach
                     @endif
                     </select>
                    @else
                    <input type="checkbox" class="check_box_select" name="vehicle_type_check" value="1">
                    <label for="">Vehicle Type</label>
                    <select name="vehicle_type" id="" class="form-control-sm vehicle_type_inp" disabled="">
                        <option readonly> Select One </option>
                     @if(isset($vehicleTypes) && $vehicleTypes!='')
                        @foreach($vehicleTypes as $vehicleType)
                         <option value="{{$vehicleType->id}}"> {{$vehicleType->name}} </option>
                        @endforeach
                     @endif
                    </select>
                    @endif
                </div>
                <div class="col-md-6">
                    @if(isset($date_from) && $date_from !='')
                    <input type="checkbox" class="check_box_select" data-input="{{$date_from}}" checked name="from_date_check" value="1">
                    <label for="">From Date</label>
                    <input type="date" name="from_date" value="{{$date_from}}" placeholder="hello" class="form-control from_date_inp datetimepicker-input" id="" data-toggle="datetimepicker" data-target="#datetimepicker5">
                    @else
                   <input type="checkbox" class="check_box_select"  name="from_date_check" value="1">
                    <label for="">From Date</label>
                    <input type="date" name="from_date" value="" placeholder="" class="form-control from_date_inp" readonly="">
                    @endif
                </div>
                <div class="col-md-6">
                     @if(isset($date_to) && $date_to !='')
                     <input type="checkbox" class="check_box_select" data-input="{{$date_to}}" name="end_date_check" value="1" checked>
                     <label for="">To Date</label>
                     <input type="date" name="end_date" value="{{$date_to}}" placeholder="" class="form-control end_date_inp" >
                     @else
                     <input type="checkbox" class="check_box_select" name="end_date_check" value="1">
                     <label for="">To Date</label>
                     <input type="date" name="end_date" value="" placeholder="" class="form-control end_date_inp" readonly="">
                     @endif
                </div>
                <div class="col-md-2 offset-md-5">
                    <button type="submit" class="btn btn-success btn-block mb-4" style="background-color:#0098dd;" id="search-btn">Search</button>
                </div>
            </div>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 id="inv_title">Recent Applications </h3>
              <button id="invoice_report" class="ctg-p-button print-p home-print" onclick="PrintIt_home()" style="">Print</button>
            </div>

             <div class="panel-body" style="padding:10px 0;">
              <div id="example-wrapper">
                
                <table id="exampleR" class="rAtable table table-bordered dt-responsive" style="text-align: center;">                    
                  <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">NID</th>
                        <th scope="col">Apply Date</th>
                        <th scope="col">Vehicle Type</th>
                        <th scope="col">Reg. No.</th>
                        <th scope="col">St. Type</th>
                        <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $sl = 1; ?>
                    @if(isset($apps) && count($apps)>0)
                     @foreach($apps as $key => $app)
                   <tr>
                       <th scope="row">{{$sl}}</th>
                        <td style="min-width: 150px;" class="custName"><a href="{{url('/application-review')}}/{{$app->app_number}}">{{!empty($app->applicant->name)?$app->applicant->name:''}}</a></td>
                        <td>{{!empty($app->applicant->phone)?$app->applicant->phone:''}} </td>
                         <td>
                              {{ isset($app->applicant->applicantDetail->nid_number) ? $app->applicant->applicantDetail->nid_number : '-' }}
                        </td>
                        <td>{{$app->app_date}}</td>
                        <td>{{!empty($app->vehicleType->name)?$app->vehicleType->name:''}}</td>
                        <td>{{!empty($app->vehicleinfo->reg_number)?$app->vehicleinfo->reg_number:''}}</td>
                        <td>{{!empty($app->sticker_category)?$app->sticker_category:''}}</td>
                        <td>{{!empty($app->app_status)?$app->app_status:''}}</td>
                        
                   </tr>

                   <?php $sl++; ?>
                       @endforeach
                    @endif
                     @if(isset($applicant_details))
                        @foreach($applicant_details as $key => $applicant_detail)
                            @foreach($applicant_detail->applicant->applications as $key => $app)
                    <tr>
                        <th scope="row">{{$sl}}</th>
                        <td class="custName"><a href="{{url('/application-review')}}/{{$app->app_number}}">{{$app->applicant->name}}</a></td>
                        <td>{{$app->applicant->phone}} </td>
                         <td>
                            {{ isset($app->applicant->applicantDetail->nid_number) ? $app->applicant->applicantDetail->nid_number : '-' }}
                        </td>
                        <td>{{$app->app_date}}</td>
                        <td>{{$app->vehicleinfo->vehicleType->name}}</td>
                         <td>{{$app->vehicleinfo->reg_number}}</td>
                        <td>{{$app->sticker_category}}</td>
                        <td>{{$app->app_status}}</td>
                    </tr>
                    <?php $sl++; ?>
                       @endforeach
                       @endforeach
                    @endif
                     @if(isset($applicants))
                       @foreach($applicants as $key => $applicant)
                         @foreach($applicant->applications as $key => $app)
                    <tr>
                        <th scope="row">{{$sl}}</th>
                        <td class="custName"><a href="{{url('/application-review')}}/{{$app->app_number}}">{{$app->applicant->name}}</a></td>
                        <td>{{$app->applicant->phone}} </td>
                        <td>
                            {{ isset($app->applicant->applicantDetail->nid_number) ? $app->applicant->applicantDetail->nid_number : '-' }}
                        </td>
                        <td>{{$app->app_date}}</td>
                        <td>{{$app->vehicleinfo->vehicleType->name}}</td>
                        <td>{{$app->vehicleinfo->reg_number}}</td>
                        <td>{{$app->sticker_category}}</td>
                        <td>{{$app->app_status}}</td>
                   </tr>
                   <?php $sl++; ?>
                          @endforeach
                       @endforeach
                       @endif

                    @if(isset($stickers) && $stickers !='' )
                    <tr>
                        <th scope="row">{{$sl}}</th>
                        <td class="custName"><a href="{{url('/application-review')}}/{{$stickers->application->app_number}}">{{$stickers->application->applicant->name}}</a></td>
                        <td>{{$stickers->application->applicant->phone}}</td>
                        <td>
                            {{ isset($stickers->application->applicant->applicantDetail->nid_number) ? $stickers->application->applicant->applicantDetail->nid_number : '-' }}
                        </td>
                        <td>{{$stickers->application->app_date}}</td>
                        <td>{{$stickers->application->vehicleType->name}}</td>
                        <td>{{$stickers->reg_number}}</td>
                        <td>{{$stickers->application->sticker_category}}</td>
                        <td>{{$stickers->application->app_status}}</td>
                   </tr>
                   <?php $sl++; ?>
                 @endif

                   @if(isset($vehicles))
                     @foreach($vehicles as $key => $vehicle)
                    <tr>
                        <th scope="row">{{$sl}}</th>
                        <td class="custName" style="white-space: nowrap;"><a href="{{url('/application-review')}}/{{$vehicle->application->app_number}}">{{$vehicle->application->applicant->name}}</a></td>
                        <td>{{$vehicle->application->applicant->phone}}</td>
                        <td>
                            {{ isset($vehicle->application->applicant->applicantDetail->nid_number) ? $vehicle->application->applicant->applicantDetail->nid_number : '-' }}
                        </td>
                        <td>{{$vehicle->application->app_date}}</td>
                        <td>{{$vehicle->vehicleType->name}}</td>
                        <td>{{$vehicle->reg_number}}</td>
                        <td>{{$vehicle->application->sticker_category}}</td>
                        <td>{{$vehicle->application->app_status}}</td>
                   </tr>
                   <?php $sl++; ?>
                     @endforeach
                 @endif
                    @if (isset($message))
                    <tr>
                       <td colspan="10" class="alert alert-warning" align="center">{{$message}}</td>
                   </tr>
                    @endif
                  </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('admin-script')
<script type="text/javascript" src="{{asset('/assets/admins/js/admin-script.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/admins/js/home-pdf-print-custom.js')}}"></script>
@endsection
