@extends('layouts.admin-master')
@section('admin-sidebar')
@include('layouts.admin-sidebar')
@endsection
@section('content')
<div class="content-area" id="review-content">
  <div id="action-bar">
    <ul>
      <li>
        <button  id='' data-toggle="modal" data-target="#myApproveModal" class="btn btn-success"><i class="fas fa-check"></i> Approve</button>
      </li>
      <li>
        <button data-number="{{$app->app_number}}" id='' data-toggle="modal" data-target="#myRejectModal" class="btn btn-warning"><i class="far fa-times-circle"></i> Reject</button>
      </li>
      <li>
        <a data-number="{{$app->app_number}}" href="{{url('/application/edit')}}/{{$app->app_number}}" id='edit_App' style="color: #fff;" class="btn btn-info"><i class="far fa-edit"></i> Edit</a>
      </li>
      <li>
        <button data-number="{{$app->app_number}}" id='notify_user' data-toggle="modal" data-target=" #notify_user_modal"  class="btn btn-info"><i class="far fa-bell"></i> Notify</button>
      </li>
      <li>
       <button data-number="{{$app->app_number}}" id='issue_sticker' data-toggle="modal" data-target=" #myIssueModal"  class="btn btn-success"><i class="fab fa-accusoft"></i> Issue</button>
     </li>
     <li>
      <button data-id="{{$app->id}}" id='undo_app' class="btn btn-info"><i class="fas fa-undo"></i> Undo</button>
    </li> 
    <li>
      <button data-number="{{$app->app_number}}" id='delete_App'  class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
    </li>
  </ul>
</div>
<div class="container-fluid" id="app-review">
  <div>

  </div>
  <div class="row app-section">
    <div class="col-md-12">
      <h5 class="text-center py-2">Applicant Details</h5>
    </div>
    <div class="col-md-3">
      <span>Name</span>
    </div>
    <div class="col-md-5">
      <span>{{$app->applicant->name}}</span>
    </div>
    <div class="col-md-4 py-1" style="position: relative;">
      @if(isset($app->applicant->applicantDetail))
      <img id="applicant_photo" src="{{url('/')}}{{$app->applicant->applicantDetail->applicant_photo}}" class="img-fluid preview-img-review" style="position: absolute; top: 0px; right: 15px; z-index: 2;cursor: pointer;" height="150" width="150" alt="{{$app->applicant->name}}" data-toggle="modal" data-target="#applicantPhotoModal">
      @endif
    </div>
    <div class="col-md-3">
      <span>Father/Husband's Name</span>
    </div>
    <div class="col-md-9">
      <span>
        @if(isset($app->applicant->applicantDetail))
        {{isset($app->applicant->applicantDetail->father_name) ? $app->applicant->applicantDetail->father_name : $app->applicant->applicantDetail->husband_name}}
        @else
        -
        @endif
      </span>
    </div>
    <div class="col-md-3">
      <span>Profession</span>
    </div>
    <div class="col-md-9">
      <span>
        @if(isset($app->applicant->applicantDetail))
        {{isset($app->applicant->applicantDetail->profession) ? $app->applicant->applicantDetail->profession : '-' }}
        @else
        -
      @endif</span>
    </div>
    <div class="col-md-3">
      <span>Company Name</span>
    </div>
    <div class="col-md-9">
      <span>
        @if(isset($app->applicant->applicantDetail))
        {{isset($app->applicant->applicantDetail->company_name) ? $app->applicant->applicantDetail->company_name : '-' }}
        @else
        -
        @endif

      </span>
    </div>
    <div class="col-md-3">
      <span>Designation</span>
    </div>
    <div class="col-md-9">
      <span>
        @if(isset($app->applicant->applicantDetail))
        {{isset($app->applicant->applicantDetail->designation) ? $app->applicant->applicantDetail->designation : '-' }}
        @else
        -
        @endif
      </span>
    </div>


    @if(isset($app->applicant->applicantDetail->address))
    <?php $app_address = json_decode($app->applicant->applicantDetail->address, true);   ?>
    @endif
    <div class="col-md-3">                            
      <p>Address</p>
    </div>
    <div class="col-md-9">
      <div class="row">
        @if(!empty($app_address['office']['o_house'])&&!empty($app_address['office']['o_road'])&&!empty($app_address['office']['o_block'])&&!empty($app_address['office']['o_area'])) 
        <div class="col-md-3">                     
          <div class="sta_address">
            <p class="address-title office">Office Address</p>
            <div class="office_address">
              <span>House: {{$app_address['office']['o_house'] }}</span><br>
              <span>Road: {{$app_address['office']['o_road'] }}</span><br>
              <span>Block: {{$app_address['office']['o_block'] }}</span><br>
              <span>Area: {{$app_address['office']['o_area'] }}</span>
            </div> 
          </div>                              
        </div>
        @endif 

        <div class="col-md-3">         
          @if(!empty($app_address['present']['house'])&&!empty($app_address['present']['road'])&&!empty($app_address['present']['block'])&&!empty($app_address['present']['area']))                   
          <div class="sta_address">
            <p class="address-title present">Present Address</p>
            <div class="present_address">

              <span>House: {{$app_address['present']['house'] }}</span><br>
              <span>Road: {{$app_address['present']['road'] }}</span><br>
              <span>Block: {{$app_address['present']['block'] }}</span><br>
              <span>Area: {{$app_address['present']['area'] }}</span>
            </div>  
          </div>
          @endif
        </div>

        <div class="col-md-3"> 
          @if(!empty($app_address['permanent']['p_house'])&&!empty($app_address['permanent']['p_road'])&&!empty($app_address['permanent']['p_block'])&&!empty($app_address['permanent']['p_area']))                                                
          <div class="sta_address">
            <p class="address-title permanent">Permanent Address</p>
            <div class="permanet_address">
              <span>House: {{$app_address['permanent']['p_house'] }}</span><br>
              <span>Road: {{$app_address['permanent']['p_road'] }}</span><br>
              <span>Block: {{$app_address['permanent']['p_block'] }} </span><br>
              <span>Area: {{$app_address['permanent']['p_area'] }} </span>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <span>Mobile No.</span>
    </div>
    <div class="col-md-9">
      <span>
        {{isset($app->applicant->phone) ? $app->applicant->phone : '-' }}
      </span>
    </div>
    <div class="col-md-3">
      <span>Email</span>
    </div>
    <div class="col-md-9">
      <span>
        {{isset($app->applicant->email) ? $app->applicant->email : '-' }}
      </span>
    </div>


    <div class="col-md-3">
      <span>Sticker Type</span>
    </div>
    <div class="col-md-9">
      <span>{{$app->sticker_category}} [<span id='app_status' style="color: red;">{{$app->app_status}}</span>]</span>
    </div>

  </div>

  <div class="row app-section mt-3">
    <div class="col-md-12">
      <h5 class="text-center py-2">Vehicle Details</h5>
    </div>
    <div class="col-md-3">
      <span>Vehicle Type</span>
    </div>
    <div class="col-md-9">
      <span>{{!empty($app->vehicleinfo->vehicleType->name)?$app->vehicleinfo->vehicleType->name:''}}</span>
    </div>
    <div class="col-md-3">
      <span>Vehicle Registration No.</span>
    </div>
    <div class="col-md-9">
      <span>{{!empty($app->vehicleinfo->reg_number)?$app->vehicleinfo->reg_number:''}}</span>
    </div>


    <div class="col-md-3">
      <span>
        Owner is company?
      </span>
    </div>
    <div class="col-md-9">
      <span>
        {{isset($app->vehicleowner->company_name) ? 'Yes' : 'No' }}

      </span>
    </div>

    <div class="col-md-3">
      <span>Company Name</span>
    </div>
    <div class="col-md-9">
     @if(isset($app->vehicleowner->company_name))
     <span>{{isset($app->vehicleowner->company_name) ? $app->vehicleowner->company_name : 'No' }}</span>
   </div>
   <div class="col-md-3">
    <p>Company Address</p>
  </div>
  <div class="col-md-9">
   <?php $com_address = json_decode($app->vehicleowner->company_address, true);   ?>
   <span>House: {{$com_address['house'] }}</span><br>
   <span>Road: {{$com_address['road'] }}</span><br>
   <span>Block: {{$com_address['block'] }}</span><br>
   <span>Area: {{$com_address['area'] }}</span>
   @endif
 </div>
 <div class="col-md-3">
  <span>Owner Name</span>
</div>
<div class="col-md-9">
  <span>
    {{isset($app->vehicleowner->owner_name) ? $app->vehicleowner->owner_name : '-' }}
  </span>
</div>
@if(!empty($app->vehicleowner->owner_address))
<div class="col-md-3">                            
  <p>Owner Address</p>
</div>

<div class="col-md-9">
  <div class="row">

    <div class="col-md-3">     
      <?php $own_address = json_decode($app->vehicleowner->owner_address, true);  ?>
      @if(!empty($own_address['present']['pre_house'])&&!empty($own_address['present']['pre_road'])&&!empty($own_address['present']['pre_block'])&&!empty($own_address['present']['pre_area'])) 
      <div class="sta_address">
        <p class="address-title present">Present Address</p>
        <div class="present_address">                                 
          <span>House: {{!empty($own_address['present']['pre_house'])?$own_address['present']['pre_house']:'' }}</span><br>
          <span>Road: {{!empty($own_address['present']['pre_road'])?$own_address['present']['pre_road']:'' }}</span><br>
          <span>Block: {{!empty($own_address['present']['pre_block'])?$own_address['present']['pre_block']:'' }}</span><br>
          <span>Area: {{!empty($own_address['present']['pre_area'])?$own_address['present']['pre_area']:'' }}</span><br>
        </div>                               
      </div>                                
      @endif 
    </div>

    <div class="col-md-3"> 
      @if(!empty($own_address['permanent']['per_house'])&&!empty($own_address['permanent']['per_road'])&&!empty($own_address['permanent']['per_block'])&&!empty($own_address['permanent']['per_area']))                           
      <div class="sta_address">
        <p class="address-title permanent">Permanent Address</p>
        <div class="permanet_address">
          <span>House: {{$own_address['permanent']['per_house'] }}</span><br>
          <span>Road: {{$own_address['permanent']['per_road'] }}</span><br>
          <span>Block: {{$own_address['permanent']['per_block'] }} </span><br>
          <span>Area: {{$own_address['permanent']['per_area'] }} </span>
        </div>

      </div>   
      @endif 
    </div> 
    <div class="col-md-3">

    </div> 

  </div> 
</div> 

@endif
<div class="col-md-3">
  <span>Owner NID No.</span>
</div>
<div class="col-md-9">
  <span>{{isset($app->vehicleowner->nid_number) ? $app->vehicleowner->nid_number : '-' }}</span>
</div>


<div class="col-md-3">
  <span>Tax Paid Upto</span>
</div>
<div class="col-md-9">
  <span>
    {{isset($app->vehicleinfo->tax_token_validity) ? Carbon\Carbon::parse($app->vehicleinfo->tax_token_validity)->format('d/m/Y') : '-' }}

  </span>
</div>


<div class="col-md-3">
  <span>Fitness Validity</span>
</div>
<div class="col-md-9">
  <span>
    {{isset($app->vehicleinfo->fitness_validity) ? Carbon\Carbon::parse($app->vehicleinfo->fitness_validity)->format('d/m/Y') : '-' }}
  </span>
</div>


<div class="col-md-3">
  <span>Insurance Validity</span>
</div>
<div class="col-md-9">
  <span>
    {{isset($app->vehicleinfo->insurance_validity) ? Carbon\Carbon::parse($app->vehicleinfo->insurance_validity)->format('d/m/Y') : '-' }}
  </span>
</div>


<div class="col-md-3">
  <span>Necessity of Using CP Area</span>
</div>
<div class="col-md-9">
  <span>
    {{isset($app->vehicleinfo->necessity_to_use) ? $app->vehicleinfo->necessity_to_use : '-' }}
  </span>
</div>

</div>

<div class="row app-section mt-3">
  <div class="col-md-12">
    <h5 class="text-center py-2">Driver Details</h5>
  </div>
  @if(!empty($app->driverinfoes) && count($app->driverinfoes)>0)
  @foreach($app->driverinfoes as $driverinfo)
  <div class="col-md-12  driver-wrapper">
   <h4 class="text-center py-2"><label class="driver-helper-title" for="">
     Number {{$loop->iteration}} Driver Detail</label></h4>      

     @if(!empty($driverinfo->driver_is_owner) && $driverinfo->driver_is_owner == '1')
     <div class="row">
       <div class="col-md-3">
        <span>Vehicle is self driven?</span>
      </div>
      <div class="col-md-9">
        <span>
         Yes
       </span>
     </div>

     <div class="col-md-3">
      <span>Driver's Name</span>
    </div>
    <div class="col-md-4" style="border: none;">
      <span>
        -
      </span>
    </div>
    <div class="col-md-5" style="position: relative;">
      <img id="driver_photo{{$loop->iteration}}" src="{{url('/')}}{{!empty($app->applicant->applicantDetail->applicant_photo) ? $app->applicant->applicantDetail->applicant_photo:''}}" data-photomodalheader="Number {{$loop->iteration}} Driver Photo" class="img-fluid driver_photo preview-img-review" alt="" style="position: absolute; top: 15px; right: 15px; z-index: 2;cursor: pointer;" height="150" width="150" data-toggle="modal" data-target="#DriverPhotoModal">
    </div>

    <div class="col-md-3">
      <p>Present Address</p>
    </div>
    <div class="col-md-9">
      -
    </div>

    <div class="col-md-3">
      <p>Permanent Address</p>
    </div>
    <div class="col-md-9">
      -
    </div>

    <div class="col-md-3">
      <span>NID No.</span>
    </div>
    <div class="col-md-9">
      <span>
        -
      </span>
    </div>

  </div>
</div>
<!-- <div class="clar-both"></div> -->
@endif
@if(empty($driverinfo->driver_is_owner) && $driverinfo->driver_is_owner == '')
<div class="row">
  <div class="col-md-3">
    <span>Vehicle is self driven?</span>
  </div>
  <div class="col-md-9">
    <span>
      No
    </span>

  </div>
  <div class="col-md-3">
    <span>Driver's Name</span>
  </div>
  <div class="col-md-4" style="border: none;">
    <span>
      {{isset($driverinfo->name) ? $driverinfo->name : '-' }}

    </span>
  </div>
  <div class="col-md-5" style="position: relative;">
    <img id="driver_photo{{$loop->iteration}}" src="{{url('/')}}{{!empty($driverinfo->photo)?$driverinfo->photo:''}}" class="img-fluid preview-img-review driver_photo" data-photomodalheader="Number {{$loop->iteration}} Driver Photo" alt="" style="position: absolute; top: 15px; right: 15px; z-index: 2;cursor: pointer;" height="150" width="150" data-toggle="modal" data-target="#DriverPhotoModal">
  </div>

  <div class="col-md-3">
    <span>NID No.</span>
  </div>
  <div class="col-md-9">
    <span>
      {{isset($driverinfo->nid_number) ? $driverinfo->nid_number : '-' }}
    </span>
  </div>
  <div class="col-md-3">
    <span>Licence Validity</span>
  </div>
  <div class="col-md-9">
    <span>
      {{isset($driverinfo->licence_validity) ? $driverinfo->licence_validity : '-' }}
    </span>
  </div>
  <div class="col-md-3">
    <span>Organization Name</span>
  </div>
  <div class="col-md-9">
    <span>
      {{isset($driverinfo->org_name) ? $driverinfo->org_name : '-' }}
    </span>
  </div>
  @if(isset($driverinfo->address) && isset($driverinfo->address)!='')

  <?php  $driver_address = json_decode($driverinfo->address, true);   ?>
  <div class="col-md-3">
    <p>Address</p>
  </div>

  <div class="col-md-9">
    <div class="row">

      <div class="col-md-3">                           
        <div class="sta_address">

          <p class="address-title present">Prersent Address</p>
          <div class="present_address">
            <span>House: {{!empty($driver_address['present']['house']) ? $driver_address['present']['house'] : ''}}</span> <br>
            <span>Road: {{!empty($driver_address['present']['road']) ? $driver_address['present']['road'] : ''}}</span> <br>
            <span>Block: {{!empty($driver_address['present']['block']) ? $driver_address['present']['block'] : ''}}</span> <br>
            <span>Area: {{!empty($driver_address['present']['area']) ? $driver_address['present']['area'] : ''}}</span>
          </div> 
        </div> 
      </div>
      <div class="col-md-3">                           
        <div class="sta_address">
          <p class="address-title permanent">Permanent Address</p>
          <div class="permanant_address">
            <span>House: {{!empty($driver_address['permanent']['p_house']) ? $driver_address['permanent']['p_house'] : '-' }}</span> <br>
            <span>Road: {{!empty($driver_address['permanent']['p_road']) ? $driver_address['permanent']['p_road'] : '-'}}</span> <br>
            <span>Block: {{!empty($driver_address['permanent']['p_block']) ? $driver_address['permanent']['p_block'] : '-'}}</span> <br>
            <span>Area: {{!empty($driver_address['permanent']['p_area']) ? $driver_address['permanent']['p_area'] : '-'}}</span>
          </div> 
        </div> 
      </div>

      <div class="col-md-3">
      </div>


    </div>
  </div>
  @endif


</div>
</div>
@endif

@endforeach
@endif
</div>
<!-- ----------------------- helper  Details-->
@if(!empty($app->helperinfoes) && count($app->helperinfoes)>0)
<div class="row app-section mt-3">
  <div class="col-md-12">
    <h5 class="text-center py-2">Helper Details</h5>
  </div>

  @foreach($app->helperinfoes as $helperinfo)
  <div class="col-md-12 helper-wrapper">
    <h4 class="text-center py-2"><label class="driver-helper-title" for="">
      Number {{$loop->iteration}} Helper Detail</label>
    </h4>

    <div class="row"> 
      <div class="col-md-3">
        <span>Helper's Name</span>
      </div>
      <div class="col-md-4" style="border: none;">
        <span>
          {{isset($helperinfo->helper_name) ? $helperinfo->helper_name : '-' }}

        </span>
      </div>
      <div class="col-md-5" style="position: relative;">
        <img id="driver_photo{{$loop->iteration}}" data-photomodalheader="Number {{$loop->iteration}} Helper Photo." src="{{url('/')}}{{!empty($helperinfo->helper_photo)?$helperinfo->helper_photo:''}}" class="img-fluid preview-img-review driver_photo" alt="" style="position: absolute; top: 15px; right: 15px; z-index: 2;cursor: pointer;" height="150" width="150" data-toggle="modal" data-target="#DriverPhotoModal">
      </div>
      <div class="col-md-3">
        <p>Address</p>
      </div>

      @if(isset($helperinfo->helper_address) && isset($helperinfo->helper_address)!='')
      <?php  $helper_address = json_decode($helperinfo->helper_address, true);   ?>

      <div class="col-md-9">
        <div class="row">

          <div class="col-md-3">                               
            <div class="sta_address">
              <p class="address-title present">Prersent Address</p>
              <div class="present_address">
                <span>House: {{!empty($helper_address['present']['house']) ? $helper_address['present']['house'] : ''}}</span> <br>
                <span>Road: {{!empty($helper_address['present']['road']) ? $helper_address['present']['road'] : ''}}</span> <br>
                <span>Block: {{!empty($helper_address['present']['block']) ? $helper_address['present']['block'] : ''}}</span> <br>
                <span>Area: {{!empty($helper_address['present']['area']) ? $helper_address['present']['area'] : ''}}</span>
              </div> 
            </div> 
          </div>
          <div class="col-md-3">                           
            <div class="sta_address">
              <p class="address-title permanent">Permanent Address</p>
              <div class="permanant_address">
                <span>House: {{!empty($helper_address['permanent']['p_house']) ? $helper_address['permanent']['p_house'] : '-' }}</span> <br>
                <span>Road: {{!empty($helper_address['permanent']['p_road']) ? $helper_address['permanent']['p_road'] : '-'}}</span> <br>
                <span>Block: {{!empty($helper_address['permanent']['p_block']) ? $helper_address['permanent']['p_block'] : '-'}}</span> <br>
                <span>Area: {{!empty($helper_address['permanent']['p_area']) ? $helper_address['permanent']['p_area'] : '-'}}</span>
              </div> 
            </div> 
          </div>
          <div class="col-md-3">
          </div>

        </div>
      </div>
      @endif

      <div class="col-md-3">
        <span>NID No.</span>
      </div>
      <div class="col-md-9">
        <span>
          {{isset($helperinfo->helper_nid_number) ? $helperinfo->helper_nid_number : '-' }}
        </span>
      </div>
    </div>
  </div>

  @endforeach
</div>
@endif





<div class="row app-section doc-section mt-3">
  <div class="col-md-12">
    <h5 class="text-center py-2">Documents</h5>
  </div>
  <div class="col-md-4">
    <span>Applicant NID Copy</span>
  </div>
  <div class="col-md-1  text-right">
    @if(isset($app->applicant->applicantDetail->nid_photo))
    <button type="button"  class="btn btn-info doc_img_prev" data-toggle="modal"  data-target="#nid1-copy">
      View
    </button>

    <div class="modal fade" id="nid1-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            Applicant's NID Card
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="margin: auto;">
            <img  src="{{url('/')}}{{$app->applicant->applicantDetail->nid_photo}}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>


    @else
    -
    @endif

  </div>



  <div class="col-md-4 offset-md-1">
    <span>Application Copy</span>
  </div>
  <div class="col-md-1 text-right">
    @if(isset($app->app_photo))
    <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid2-copy">
      View
    </button>
    <div class="modal fade" id="nid2-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            Application Copy
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="margin: auto;">
            <img src="{{url('/')}}{{$app->app_photo}}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>

    @else
    -
    @endif

  </div>


  <div class="col-md-4">
    <span>Vehicle Registration Copy</span>
  </div>
  <div class="col-md-1  text-right">
    @if(isset($app->vehicleinfo->reg_cert_photo))
    <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid3-copy">
      View
    </button>
    <div class="modal fade" id="nid3-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            Vehicle Registration Copy
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="margin: auto;">
            <img src="{{url('/')}}{{$app->vehicleinfo->reg_cert_photo}}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>

    @else
    -
    @endif
  </div>

  <div class="col-md-4 offset-md-1">
    <span>Owner NID Copy</span>
  </div>
  <div class="col-md-1 text-right">
    @if(isset($app->vehicleowner->nid_photo))
    <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid4-copy">
      View
    </button>
    <div class="modal fade" id="nid4-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            Owner NID Copy
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="margin: auto;">
            <img src="{{url('/')}}{{$app->vehicleowner->nid_photo}}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>

    @else
    -
    @endif
  </div>

  <div class="col-md-4">
    <span>Tax Token Copy</span>
  </div>

  <div class="col-md-1  text-right">
    @if(isset($app->vehicleinfo->tax_token_photo))
    <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid5-copy">
      View
    </button>
    <div class="modal fade" id="nid5-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            Tax Token Copy
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="margin: auto;">
            <img src="{{url('/')}}{{$app->vehicleinfo->tax_token_photo}}" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
    @else
    -
    @endif
  </div>

  <div class="col-md-4 offset-md-1">
    <span>Fitness Certificate Copy</span>
  </div>
  <div class="col-md-1 text-right">
   @if(isset($app->vehicleinfo->fitness_cert_photo))
   <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid6-copy">
    View
  </button>
  <div class="modal fade" id="nid6-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          Fitness Certificate Copy
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="margin: auto;">
          <img src="{{url('/')}}{{$app->vehicleinfo->fitness_cert_photo}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </div>

  @else
  -
  @endif
</div>

<div class="col-md-4">
  <span>Insurance Certificate Copy</span>
</div>
<div class="col-md-1  text-right">
 @if(isset($app->vehicleinfo->insurance_cert_photo))

 <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid7-copy">
  View
</button>
<div class="modal fade" id="nid7-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Insurance Certificate Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$app->vehicleinfo->insurance_cert_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>


@else
-
@endif
</div>

<div class="col-md-4 offset-md-1">
  <span>Road Permit Copy</span>
</div>
<div class="col-md-1 text-right">
 @if(isset($app->vehicleinfo->road_permit_photo))

 <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid8-copy">
  View
</button>
<div class="modal fade" id="nid8-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Road Permit Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$app->vehicleinfo->road_permit_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>

@else
-
@endif
</div>

<div class="col-md-4">
  <span>Jetty License Copy</span>
</div>
<div class="col-md-1  text-right">
  @if(isset($app->vehicleinfo->jt_licence_photo))

  <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid9-copy">
    View
  </button>

  <div class="modal fade" id="nid9-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          Jetty License Copy
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="margin: auto;">
          <img src="{{url('/')}}{{$app->vehicleinfo->jt_licence_photo}}" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </div>
  @else
  -
  @endif
</div>

<div class="col-md-4 offset-md-1">
  <span>Port Entry Pass Copy</span>
</div>
<div class="col-md-1 text-right">
 @if(isset($app->vehicleinfo->port_entry_pass_photo))
 <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid10-copy">
  View
</button>
<div class="modal fade" id="nid10-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Port Entry Pass Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$app->vehicleinfo->port_entry_pass_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>

@else
-
@endif
</div>

@if(!empty($app->driverinfoes))
@foreach($app->driverinfoes as $eachdriverinfo)

<div class="col-md-2 {{$loop->iteration%2==0?'offset-md-1':''}}">
  <span>
    Number {{$loop->iteration}} Driver
  </span>

</div>

<div class="col-md-3 text-right">
 @if(isset($eachdriverinfo->nid_photo))
 <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid11-copy_{{$eachdriverinfo->id}}">
  NID
</button>
<div class="modal fade" id="nid11-copy_{{$eachdriverinfo->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Driver {{$loop->iteration}} NID Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$eachdriverinfo->nid_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>
@endif
@if(isset($eachdriverinfo->licence_photo))
<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid12-copy_{{$eachdriverinfo->id}}">
  License
</button>
<div class="modal fade" id="nid12-copy_{{$eachdriverinfo->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Driver {{$loop->iteration}} Driving License Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$eachdriverinfo->licence_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>
@endif
@if(isset($eachdriverinfo->org_id_photo))
<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid13-copy_{{$eachdriverinfo->id}}">
  Org. ID
</button>

<div class="modal fade" id="nid13-copy_{{$eachdriverinfo->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Driver {{$loop->iteration}} Organizational ID Card Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$eachdriverinfo->org_id_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>
@endif
</div>
@endforeach
@endif

@if(!empty($app->helperinfoes))
@foreach($app->helperinfoes as $eachelperinfo)
<div class="col-md-2 {{$loop->iteration%2==0?'offset-md-1':''}}">
  <span>
    Number {{$loop->iteration}} Helper
  </span>

</div>

<div class="col-md-3 text-right">
 @if(isset($eachelperinfo->helper_nid_photo))
 <button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid11-copy__helper{{$eachelperinfo->id}}">
  NID
</button>
<div class="modal fade" id="nid11-copy__helper{{$eachelperinfo->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Helper {{$loop->iteration}} NID Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$eachelperinfo->helper_nid_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>
@endif
@if(isset($eachelperinfo->helper_org_id_photo))
<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid13-copy__helper{{$eachelperinfo->id}}">
  Org. ID
</button>

<div class="modal fade" id="nid13-copy__helper{{$eachelperinfo->id}}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Helper {{$loop->iteration}} Organizational ID Card Copy
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin: auto;">
        <img src="{{url('/')}}{{$eachelperinfo->helper_org_id_photo}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>
@endif
</div>
@endforeach
@endif

</div>
<div class="row app-section doc-section mt-3">
  <div class="col-md-12">
    <h5 class="text-center py-2  heading-bg">Follow Up</h5>
  </div>
  <table class="table table-bordered table-striped follow-up-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Status</th>
        <th>Comments</th>
        <th>Notified</th>
        <th>By</th>
      </tr>
    </thead>
    <tbody>
      @if(isset($app->followups) && count($app->followups)>0)
      @foreach($app->followups->sortByDesc('created_at') as $follow_up)
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{ \Carbon\Carbon::parse($follow_up->created_at)->toDayDateTimeString()}}</td>
        <td>
          {{$follow_up->status}}
        </td>
        <td>{{!empty($follow_up->comment)?$follow_up->comment:''}}</td>
        <td class="text-center">
          @if($follow_up->sms_sent=='success')
          <span style="color: green;" title="sms sent"><i class="fas fa-check"></i></span>
          @elseif($follow_up->sms_sent=='fail')
          <span style="color: red;" title="sms not sent"><i class="fas fa-times"></i></span>
          @elseif($follow_up->sms_sent==null)

          @endif
          @if($follow_up->mail_sent=='success')
          <span style="color: green;" title="mail sent"><i class="fas fa-check"></i></span>
          @elseif($follow_up->mail_sent=='fail')
          <span style="color: red;" title="mail not sent"><i class="fas fa-times"></i></span>
          @else
          @endif
        </td>
        <td>{{$follow_up->updated_by}}</td>
      </tr>  
      @endforeach
      @endif
    </tbody>
  </table>
</div>
</div>
</div>
<!-- Approve Modal -->

<div class="modal fade" id="myApproveModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #4785c7; padding: 10px 0;">
        <legend style="color:#fff; text-align: center; ">Select Delivery Date</legend>
        <button style="color: #fff;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="padding:10px 10px 0 0;">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding:0;">
       <div class="row">
        <div class="col-md-4 offset-md-1">
          <label for="" class="label-form"> Delivery Date </label> <span>*</span> <br>
          <small></small>
        </div>
        <div class="col-md-7">
         <input type="date" id="sticker_delivery_date" value="" name="sticker_delivery_date"  class="form-control in-form" placeholder="" required>
         <div id="err_msg_delDate" class="" style="color:#bd2130;" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_delDate"> </span>
         </div>
       </div>
     </div>

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" data-number="{{$app->app_number}}" class="btn btn-primary custm-btn" id="approve_App">Confirm Approve</button>
  </div>
</div>
</div>
</div>
<!-- The Modal -->   
<!-- Reject Modal -->
<div class="modal fade" id="myRejectModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #4785c7; padding: 10px 0;">
        <legend style="color:#fff; text-align: center; ">Choose Mismatched File</legend>
        <button style="color: #fff;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="padding:10px 10px 0 0;">&times;</span>
        </button>
      </div>
      <div class="modal-body mt-2" style="padding:0;" >
       <div class="row">
        <div class="col offset-md-2" id="mis_matched">
         <fieldset border>


          <div class="row">
            <div class="col-md-5">
              <div>
                <input type="checkbox" id="App_Photo" name="App_Photo"
                value="Application Copy" />
                <label for="App_Photo">Application Copy</label>
              </div> 
              <div>
                <input type="checkbox" id="Applicant_Photo" name="Applicant_Photo"
                value="Applicant Photo" />
                <label for="Applicant_Photo">Applicant Photo</label>
              </div>

              <div>
                <input type="checkbox" id="Applicant_NID" name="Applicant_NID"
                value="Applicant NID" />
                <label for="Applicant_NID">Applicant NID</label>
              </div>

              <div>
                <input type="checkbox" id="Driver_Photo" name="Driver_Photo"
                value="Driver Photo" />
                <label for="Driver_Photo">Driver Photo</label>
              </div> 
              <div>
                <input type="checkbox" id="Driver_NID" name="Driver_NID"
                value="Driver NID" />
                <label for="Driver_NID">Driver NID</label>
              </div>  
              <div>
                <input type="checkbox" id="Driver_License_Copy" name="Driver_License_Copy"
                value="Driver License Copy" />
                <label for="Driver_License_Copy">Driver License Copy</label>
              </div>   
              <div>
                <input type="checkbox" id="Driver_Organizational_ID" name="Driver_Organizational_ID"
                value="Driver Organizational ID" />
                <label for="Driver_Organizational_ID">Driver Organizational ID</label>
              </div>
            </div>

            <div class="col-md-5">
              <div>
                <input type="checkbox" id="Owner_NID" name="Owner_NID"
                value="Owner NID"  />
                <label for="Owner_NID">Owner NID</label>
              </div>

              <div>
                <input type="checkbox" id="Vehicle_Reg_Copy" name="Vehicle_Reg_Copy"
                value="Vehicle Reg Copy" />
                <label for="Vehicle_Reg_Copy">Vehicle Reg Copy</label>
              </div>
              <div>
                <input type="checkbox" id="Tax_Token_Copy" name="Tax_Token_Copy"
                value="Tax Token Copy" />
                <label for="Tax_Token_Copy">Tax Token Copy</label>
              </div> 
              <div>
                <input type="checkbox" id="Fitness_Certificate_Copy" name="Fitness_Certificate_Copy"
                value="Fitness Certificate Copy" />
                <label for="Fitness_Certificate_Copy">Fitness Certificate Copy</label>
              </div>
              <div>
                <input type="checkbox" id="Insurance_Certificate_Copy" name="Insurance_Certificate_Copy"
                value="Insurance Certificate Copy" />
                <label for="Insurance_Certificate_Copy">Insurance Certificate Copy</label>
              </div>
              <div>
                <input type="checkbox" id="Road_Permit_Copy" name="Road_Permit_Copy"
                value="Road Permit Copy" />
                <label for="Road_Permit_Copy">Road Permit Copy</label>
              </div> 
              <div>
                <input type="checkbox" id="Port_Entry_Pass_Copy" name="Port_Entry_Pass_Copy"
                value="Port Entry Pass Copy" />
                <label for="Port_Entry_Pass_Copy">Port Entry Pass Copy</label>
              </div>    
              <div>
                <input type="checkbox" id="Jetty_License_Copy" name="Jetty_License_Copy"
                value="Jetty License Copy" />
                <label for="Jetty_License_Copy">Jetty License Copy</label>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" data-number="{{$app->app_number}}" class="btn btn-primary" id="reject_App">Confirm Reject</button>
  </div>
</div>
</div>
</div>
<!-- The Modal -->

<div class="modal fade" id="myIssueModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header" style="background-color: #4785c7; padding: 10px 0;">
      <legend style="color:#fff; text-align: center; ">Issue Vehicle Sticker</legend>
      <button style="color: #fff;" type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true" style="padding:10px 10px 0 0;">&times;</span>
     </button>
   </div>
   <form id="issueSticker_Form">
    {{csrf_field()}}
    <div class="modal-body">
      <div class="row justify-content-center">
        <div class="col-md-3 offset-md-1">
          <label for="" class="label-form">Applicant Name</label><span></span> <br>
          <small></small>
        </div>
        <div class="col-md-7 marg-top-10px">
          {{!empty($app->applicant->name)?$app->applicant->name:''}}
        </div>
        <div class="col-md-3 offset-md-1">
          <label for="" class="label-form">Phone Number</label><span></span> <br>
          <small></small>
        </div>
        <div class="col-md-7 marg-top-10px">
          {{$app->applicant->phone}}
        </div>  <div class="col-md-3 offset-md-1">
          <label for="" class="label-form">Sticker Type</label><span></span> <br>
          <small></small>
        </div>
        <div class="col-md-7 marg-top-10px">
          {{!empty($app->sticker_category)?$app->sticker_category:''}}
        </div>
        <div class="col-md-3 offset-md-1">
          <label for="" class="label-form">Vehicle:</label><span></span> <br>
          <small></small>
        </div>
        <div class="col-md-7 marg-top-10px">
         {{!empty($app->vehicleinfo->vehicleType->name)?$app->vehicleinfo->vehicleType->name:''}} (      {{!empty($app->vehicleinfo->reg_number)?$app->vehicleinfo->reg_number:''}}
         )
       </div>


       <div class="col-md-3 offset-md-1">
        <label for="" class="label-form">Fee Per Day</label><span></span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        {{!empty($app->vehicleinfo->vehicleType->fee)?$app->vehicleinfo->vehicleType->fee:""}} TK
      </div>
      @if(isset($app->sticker_category) && $app->sticker_category !='T' )
      <div class="col-md-3 offset-md-1">
        <label for="" class="label-form">Sticker Number</label><span>*</span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <input type="text" id="sticker_number" value="" name="sticker_number"  class="form-control in-form" placeholder="" required>
      </div>
      @endif
      <div class="col-md-3 offset-md-1"><label class="label-form">Issue Type </label> <span style="">*</span><small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <div class="row funkyradio">
          <div class="funkyradio-primary col-md-5">
            <input type="radio" name="issue_type" id="normal_case" checked="checked" value="non-govt"> <label for="normal_case">Non-Govt.</label>
          </div> 
          <div class="funkyradio-warning col-md-5">
            <input type="radio" name="issue_type" id="special_case" value="govt"> <label for="special_case">Govt.</label>
          </div>
        </div>
      </div>
      <div class="col-md-3 offset-md-1">
        <label for="" class="label-form">Gate No.</label><span>*</span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <input type="text" id="gate_number" value="" name="gate_number"  class="form-control in-form" placeholder="" required>
      </div>
      @if(isset($app->sticker_category) && $app->sticker_category =='T')
      <div class="col-md-3 offset-md-1">
        <label for="" class="label-form">Starting Date</label> <span>*</span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <input type="date" disabled style="cursor: not-allowed;" id="temp_sticker_start_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" name="temp_sticker_start_date" class="form-control in-form" placeholder="" required>
      </div>
      <div class="col-md-3 offset-md-1">
        <label for="" class="label-form">Expired Date</label> <span>*</span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <input type="date" id="temp_sticker_exp_date" value="" name="temp_sticker_exp_date"  class="form-control in-form" placeholder="" required>
        <input type="hidden" value="{{$app->app_number}}" name="app_number"  class="form-control in-form" placeholder="">
      </div>
      @endif
      @if(isset($app->sticker_category) && $app->sticker_category !='T' )
      <div class="col-md-3 offset-md-1">
        <label for="" class="label-form">Expired Date</label> <span>*</span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <input type="date" id="sticker_exp_date" value="" name="sticker_exp_date"  class="form-control in-form" placeholder="" required>
        <input type="hidden" value="{{$app->app_number}}" name="app_number"  class="form-control in-form" placeholder="">
      </div>
      @endif

      @if( $app->sticker_category =='A' || $app->sticker_category =='B' )
      <div class="col-md-3 offset-md-1">
        <label for="" class="label-form"></label>Total Days<span></span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <input  type="text" id="numberOfDays" value="" name="numberOfDays"  class="form-control in-form" placeholder="" >
      </div>
      @else         
      <div class="col-md-3 offset-md-1 non-gov-data">
        <label for="" class="label-form"></label>Total<span></span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px non-gov-data">
        <div class="row" >
          <input style="margin-left: 15px"  type="text" id="feePerDay" value="{{!empty($app->vehicleinfo->vehicleType->fee)?$app->vehicleinfo->vehicleType->fee:''}}" name="feePerDay"  class="form-control col-md-2 in-form" placeholder="" ><span style="padding:10px 0 0 2px; ">Tk * </span>
          <input style="margin-left: 5px"  type="text" id="numberOfDays" value="" name="numberOfDays"  class="col-md-2 form-control in-form numberOfDays" placeholder="" >
          <span style="padding:10px 0 0 28px; ">Days</span>
          <input style="margin-left: 35px"  type="text" id="totalAmount" value="" name="totalAmount"  class="col-md-3 form-control in-form" placeholder="" ><span style="padding:10px 0 0 2px; ">Tk</span>
        </div>
      </div> 
      <div class="col-md-3 offset-md-1 non-gov-data">
        <label for="" class="label-form"></label>Grand Total<span></span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px non-gov-data">
        <div class="row" >
          <input style="margin-left: 15px"  type="text" id="totalFee" value=""   class="form-control col-md-2 in-form" placeholder="" ><span style="padding:10px 0 0 2px; ">Tk * </span>
          <input style="margin-left:5px"  type="text" id="vatamount" value="" name="vatamount"  class="col-md-2 form-control in-form" placeholder="" >
          <span style="padding:10px 0 0 2px; ">Tk (15% Vat)</span>
          <input style="margin-left: 5px"  type="text" id="grandTotal" value="" name="grandTotal"  class="col-md-3 form-control in-form" placeholder="" ><span style="padding:10px 0 0 2px; ">Tk</span>
        </div>

      </div> 
      @endif

      <div class="col-md-3 offset-md-1 gov-data"><label class="label-form"> Number Of Days </label> <span style="">*</span><small></small>
      </div>
      <div class="col-md-7 marg-top-10px gov-data">
        <input type="text" id="numberOfDaysForGov" value="" name="numberOfDays"  class="form-control in-form numberOfDays" placeholder="" >
      </div>
      <div class="col-md-3 offset-md-1">
        <label for="" class="label-form">Sticker Issue Date</label> <span>*</span> <br>
        <small></small>
      </div>
      <div class="col-md-7 marg-top-10px">
        <input type="date" id="issue_sticker_date" value="{{Carbon\Carbon::now()->format('Y-m-d')}}" name="issue_sticker_date"  class="form-control in-form" placeholder="" required>
      </div>
    </div>
  </div>     

  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="confirm_sticker">Confirm Sticker</button>
  </div>
</form>
</div>
</div>
</div>
<!-- Notify Modal -->
<div class="modal fade" id="notify_user_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header" style="background-color: #4785c7; padding: 10px 0;">
      <legend style="color:#fff; text-align: center; ">Send Mail To Notify User </legend>
      <button style="color: #fff;" type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true" style="padding:10px 10px 0 0;">&times;</span>
     </button>
   </div>
   <form id="sendSms_Form">
    {{csrf_field()}}
    <div class="modal-body">
     <div class="row">
       <div class="col-md-4 offset-md-1">
        <label for="" class="label-form">Mail Template</label><span>*</span> <br>
        <small></small>
      </div>
      <div class="col-md-7">
       <select name="sms_template" data-sms="{{$all_sms}}" id="sms_template" 
       class="form-control in-form" >
       <option value="">--Select Mail Template--</option>
       @if(isset($all_sms) && (count($all_sms) > 0))
       @foreach($all_sms as $sms)
       <option value="{{$sms->id}}">{{$sms->sms_template_name}}</option>
       @endforeach
       @endif
     </select>
   </div>
   <div class="col-md-4 offset-md-1">
    <label for="" class="label-form">Subject</label><span>*</span> <br>
    <small></small>
  </div>
  <div class="col-md-7">
    <input type="text" name="sms_subject" id="sms_subject" class="form-control in-form" value="">
  </div> 
  <div class="col-md-4 offset-md-1">
    <label for="" class="label-form">Message</label><span>*</span> <br>
    <small></small>
  </div>
  <div class="col-md-7">
    <textarea type="text" rows='5' id="sms_text"  name="sms_text" class="form-control in-form" ></textarea>
  </div>
  <input type="hidden" name="app_phone_num" id="app_phone_num" class="form-control in-form" value="{{$app->applicant->phone}}">
  <input type="hidden" name="app_email" id="app_email" class="form-control in-form" value="{{$app->applicant->email}}">
  <input type="hidden"  name="app_id" id="app_id" class="form-control in-form" value="{{$app->id}}">
</div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
  <button type="submit" class="btn btn-primary" id="confirm_sms">Send Mail</button>
</div>
</form>
</div>
</div>
</div>
<!-- Applicant Photo --> 
<div class="modal fade" id="applicantPhotoModal" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        Applicant's Photo
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
      </div>
      <div class="modal-body" style="margin:auto">
        <img src="{{!empty($app->applicant->applicantDetail->applicant_photo)?url($app->applicant->applicantDetail->applicant_photo):''}}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>
<!-- End App Photo Modal --> 
<!-- Driver Photo --> 
<div class="modal fade" id="DriverPhotoModal" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <span class="photo-title"> </span> 
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
      </div>
      <div class="modal-body" style="margin:auto">
        <img id="driver-photo-show" src="" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</div>

<!-- End Driver Photo Modal -->

@endsection

@section('admin-script')
<link href="{{asset('assets/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
<script src="{{asset('assets/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/assets/admins/js/admin-script.js')}}"></script>
@endsection
