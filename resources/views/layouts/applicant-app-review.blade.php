 @extends('layouts.admin-master')
 @section('content')
 <div class="content-area" id="review-content">
 	<div class="container-fluid" id="app-review">
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
 								<span>House: {{$own_address['present']['pre_house'] }}</span><br>
 								<span>Road: {{$own_address['present']['pre_road'] }}</span><br>
 								<span>Block: {{$own_address['present']['pre_block'] }}</span><br>
 								<span>Area: {{$own_address['present']['pre_area'] }}</span>
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





@extends('layouts.customer-master')
@section('content')
<div class="col-md-10" id="content_term_condition">  	
	<div class="content-area">
		<div class="container-fluid" id="app-review">
			<div class="row app-section">
				<div class="col-md-12">
					<h5 class="text-center py-2 heading-bg">
						Application Summary
						<button data-number="{{$app->app_number}}" id='print_App' data-logo="{{asset('assets/images/LogoS1.png')}}" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
					</h5>

				</div>
				@if(!empty($app->app_status))
				<div class="col-md-3">
					<span>Status</span>
				</div>
				<div class="col-md-9">
					<span style="color: red;" id="app_status">{{$app->app_status}}</span>
				</div> 
				@endif
				@if(!empty($app->sticker_category))
				<div class="col-md-3">
					<span>Sticker Type</span>
				</div>
				<div class="col-md-9">
					<span>{{$app->sticker_category}}</span>
				</div>
				@endif
				@if(!empty($app->vehicleSticker->sticker_number))
				<div class="col-md-3">
					<span>Sticker No.</span>
				</div>
				<div class="col-md-9">
					<span>{{$app->vehicleSticker->sticker_number}}</span>
				</div>
				@endif
				@if(!empty($app->applicationNotify->sticker_delivery_date))
				<div class="col-md-3">
					<span>Delivery Date</span>
				</div>
				<div class="col-md-9">
					<span>{{$app->applicationNotify->sticker_delivery_date}}</span>
				</div>
				@endif
				@if(!empty($app->vehicleSticker->issue_date))
				<div class="col-md-3">
					<span>Sticker Issue Date</span>
				</div>
				<div class="col-md-9">
					<span>{{$app->vehicleSticker->issue_date}} </span>
				</div>
				@endif
				@if(!empty($app->applicant->user_name))
				<div class="col-md-3">
					<span>User Name</span>
				</div>
				<div class="col-md-9">
					<span>{{$app->applicant->user_name}}</span>
				</div>
				@endif
			</div>

			<div class="row app-section">
				<div class="col-md-12">
					<h5 class="text-center py-2 heading-bg">Applicant Details</h5>
				</div>
				<div class="col-md-3">
					<span>Applicant Full Name</span>
				</div>
				<div class="col-md-5">
					<span>{{$app->applicant->name}}</span>
				</div>
				<div class="col-md-4 py-1" style="position: relative;border:none;">
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

				@if(!empty($app->applicant->applicantDetail->applicant_BA_no))
				<div class="col-md-3">
					<span>BA No</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->applicant_BA_no}}
					</span>
				</div>  
				@endif    
				@if(!empty($app->applicant->applicantDetail->rank->name))
				<div class="col-md-3">
					<span>Rank</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->rank->name}}
					</span>
				</div>  
				@endif
				@if(!empty($app->applicant->applicantDetail->spouseOrParent_BA_no))
				<div class="col-md-3">
					<span>Spouse/Parent BA No</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->spouseOrParent_BA_no}}
					</span>
				</div>  
				@endif

				@if(!empty($app->applicant->applicantDetail->spouseOrParent_Rank))
				<div class="col-md-3">
					<span>Spouse/Parent Rank</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->spouseOrParent_Rank}}
					</span>
				</div>  
				@endif 

				@if(!empty($app->applicant->applicantDetail->is_spouseOrChild))
				<div class="col-md-3">
					<span>Is Applicant Def Person's Spouse/Child?</span>
				</div>
				<div class="col-md-9">
					<span>
						{{!empty($app->applicant->applicantDetail->is_spouseOrChild)?'Yes':''}}
					</span>
				</div>  
				@endif 

				@if(!empty($app->applicant->applicantDetail->spouseOrParent_Name))
				<div class="col-md-3">
					<span>Spouse/Parent Name</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->spouseOrParent_Name}}
					</span>
				</div>  
				@endif
				@if(!empty($app->applicant->applicantDetail->spouseOrParent_Unit))
				<div class="col-md-3">
					<span>Spouse/Parent Unit</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->spouseOrParent_Unit}}
					</span>
				</div>  
				@endif 
				@if(!empty($app->applicant->applicantDetail->profession))
				<div class="col-md-3">
					<span>Profession</span>
				</div>
				<div class="col-md-9">
					<span>

						{{ $app->applicant->applicantDetail->profession }}


					</span>
				</div>
				@endif
				@if(!empty($app->applicant->applicantDetail->company_name))
				<div class="col-md-3">
					<span>Company Name</span>
				</div>
				<div class="col-md-9">
					<span>
						{{ $app->applicant->applicantDetail->company_name}}
					</span>
				</div>
				@endif
				@if(!empty($app->applicant->applicantDetail->designation))
				<div class="col-md-3">
					<span>Designation</span>
				</div>

				<div class="col-md-9">
					<span>


						{{$app->applicant->applicantDetail->designation}}


					</span>
				</div>
				@endif

				@if(isset($app->applicant->applicantDetail->address))
				<?php $app_address = json_decode($app->applicant->applicantDetail->address, true);   ?>
				@endif  


				<div class="col-md-3">                            
					<p>Address</p>
				</div>
				@if(!empty($app_address['office']['o_flat'])&&!empty($app_address['office']['o_house'])&&!empty($app_address['office']['o_road'])&&!empty($app_address['office']['o_block'])&&!empty($app_address['office']['o_area'])) 
				<div class="col-md-3">                     
					<div class="sta_address">
						<p class="address-title office">Office Address</p>
						<div class="office_address">
							<span><b>Flat</b>: {{$app_address['office']['o_flat'] }}</span> <br>
							<span><b>House</b>: {{$app_address['office']['o_house'] }}</span><br>
							<span><b>Road</b>: {{$app_address['office']['o_road'] }}</span><br>
							<span><b>Block</b>: {{$app_address['office']['o_block'] }}</span><br>
							<span><b>Area</b>: {{$app_address['office']['o_area'] }}</span>
						</div> 
					</div>                              
				</div>
				@endif 

				<div class="col-md-3">         
					@if(!empty($app_address['present']['flat'])&&!empty($app_address['present']['house'])&&!empty($app_address['present']['road'])&&!empty($app_address['present']['block'])&&!empty($app_address['present']['area']))                   
					<div class="sta_address">
						<p class="address-title present">Present Address</p>
						<div class="present_address">

							<span><b>Flat</b>: {{$app_address['present']['flat'] }}</span><br>
							<span><b>House</b>: {{$app_address['present']['house'] }}</span><br>
							<span><b>Road</b>: {{$app_address['present']['road'] }}</span><br>
							<span><b>Block</b>: {{$app_address['present']['block'] }}</span><br>
							<span><b>Area</b>: {{$app_address['present']['area'] }}</span>
						</div>  
					</div>
					@endif
				</div>

				<div class="col-md-3"> 
					@if(!empty($app_address['permanent']['p_flat'])&&!empty($app_address['permanent']['p_house'])&&!empty($app_address['permanent']['p_road'])&&!empty($app_address['permanent']['p_block'])&&!empty($app_address['permanent']['p_area']))                                                
					<div class="sta_address">
						<p class="address-title permanent">Permanent Address</p>
						<div class="permanet_address">
							<span><b>Flat</b>: {{$app_address['permanent']['p_flat'] }}</span><br>
							<span><b>House</b>: {{$app_address['permanent']['p_house'] }}</span><br>
							<span><b>Road</b>: {{$app_address['permanent']['p_road'] }}</span><br>
							<span><b>Block</b>: {{$app_address['permanent']['p_block'] }} </span><br>
							<span><b>Area</b>: {{$app_address['permanent']['p_area'] }} </span>
						</div>
					</div>
					@endif
				</div>
				@if(empty($app_address['office']['o_flat'])&&empty($app_address['office']['o_house'])&&empty($app_address['office']['o_road'])&&empty($app_address['office']['o_block'])&&empty($app_address['office']['o_area'])) 
				<div class="col-md-3">                     

				</div>
				@endif 
				<div class="col-md-3">
					<span>Residence Type</span>
				</div>
				<div class="col-md-9">
					<span>
						{{isset($app->applicant->applicantDetail->residence_type) ? $app->applicant->applicantDetail->residence_type : '-' }}
					</span>
				</div> 
				<div class="col-md-3">
					<span>National ID</span>
				</div>
				<div class="col-md-9">
					<span>
						{{isset($app->applicant->applicantDetail->nid_number) ? $app->applicant->applicantDetail->nid_number : '-' }}
					</span>
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
					<span>Tin</span>
				</div>
				<div class="col-md-9">
					<span>
						{{isset($app->applicant->applicantDetail->tin) ? $app->applicant->applicantDetail->tin : '-' }}
					</span>
				</div>
				@if(!empty($app->applicant->applicantDetail->no_sticker_to_self_family))
				<div class="col-md-3">
					<span>Number Of Sticker allocated to applicant/applicant's family 2018</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->no_sticker_to_self_family}}
					</span>
				</div>
				@endif
				@if(!empty($app->applicant->applicantDetail->allocated_current_sticker_type))
				<div class="col-md-3">
					<span>Currently allocated Sticker Types</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->allocated_current_sticker_type}}
					</span>
				</div>
				@endif
				@if(!empty($app->applicant->applicantDetail->allocated_current_sticker_no))
				<div class="col-md-3">
					<span>Currently allocated Sticker No</span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->allocated_current_sticker_no}}
					</span>
				</div>
				@endif
				@if(!empty($app->applicant->applicantDetail->applicant_remark))
				<div class="col-md-3">
					<span>Applicant Remarks  </span>
				</div>
				<div class="col-md-9">
					<span>
						{{$app->applicant->applicantDetail->applicant_remark}}
					</span>
				</div>
				@endif
			</div>
			<div class="row app-section mt-3">
				<div class="col-md-12">
					<h5 class="text-center py-2 heading-bg">Vehicle Details</h5>
				</div>
				<div class="col-md-3">
					<span>Vehicle Type</span>
				</div>
				<div class="col-md-9">
					<span>{{$app->vehicleinfo->vehicleType->name}}</span>
				</div>
				<div class="col-md-3">
					<span>Vehicle Registration No.</span>
				</div>
				<div class="col-md-9">
					<span>{{$app->vehicleinfo->reg_number}}</span>
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
				<div class="col-md-3">                            
					<p>Owner Address</p>
				</div>
				<div class="col-md-3">     
					<?php $own_address = json_decode($app->vehicleowner->owner_address, true);  ?>
					@if(!empty($own_address['present']['pre_flat'])&&!empty($own_address['present']['pre_house'])&&!empty($own_address['present']['pre_road'])&&!empty($own_address['present']['pre_block'])&&!empty($own_address['present']['pre_area'])) 
					<div class="sta_address">
						<p class="address-title present">Present Address</p>
						<div class="present_address">                                 
							<span><b>Flat</b>: {{$own_address['present']['pre_flat'] }}</span><br>
							<span><b>House</b>: {{$own_address['present']['pre_house'] }}</span><br>
							<span><b>Road</b>: {{$own_address['present']['pre_road'] }}</span><br>
							<span><b>Block</b>: {{$own_address['present']['pre_block'] }}</span><br>
							<span><b>Area</b>: {{$own_address['present']['pre_area'] }}</span>
						</div>                               
					</div>                                
					@endif 
				</div>

				<div class="col-md-3"> 
					@if(!empty($own_address['permanent']['per_flat'])&&!empty($own_address['permanent']['per_house'])&&!empty($own_address['permanent']['per_road'])&&!empty($own_address['permanent']['per_block'])&&!empty($own_address['permanent']['per_area']))                           
					<div class="sta_address">
						<p class="address-title permanent">Permanent Address</p>
						<div class="permanet_address">
							<span><b>Flat</b>: {{$own_address['permanent']['per_flat'] }}</span><br>
							<span><b>House</b>: {{$own_address['permanent']['per_house'] }}</span><br>
							<span><b>Road</b>: {{$own_address['permanent']['per_road'] }}</span><br>
							<span><b>Block</b>: {{$own_address['permanent']['per_block'] }} </span><br>
							<span><b>Area</b>: {{$own_address['permanent']['per_area'] }} </span>
						</div>

					</div>   
					@endif 
				</div> 
				<div class="col-md-3">

				</div>    

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
					<span>Loan Taken?</span>
				</div>
				<div class="col-md-9">
					<span>
						{{!empty($app->vehicleinfo->loan_taken) ? 'Yes' : 'No' }}

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
					<span>Necessity of Using Station HQ </span>
				</div>
				<div class="col-md-9">
					<span>
						{{isset($app->vehicleinfo->necessity_to_use) ? $app->vehicleinfo->necessity_to_use : '-' }}
					</span>
				</div>

			</div>

			<div class="row app-section mt-3">
				<div class="col-md-12">
					<h5 class="text-center py-2 heading-bg">Driver Details</h5>
				</div>
				@if($app->driverinfo->driver_is_owner == '1')


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
				<div class="col-md-5" style="position: relative; border: none;">
					<img id="driver_photo" src="{{url('/')}}{{!empty($app->applicant->applicantDetail->applicant_photo) ? $app->applicant->applicantDetail->applicant_photo:''}}" class="img-fluid preview-img-review" alt="" style="position: absolute; top: 15px; right: 15px; z-index: 2;cursor: pointer;" height="150" width="150" data-toggle="modal" data-target="#DriverPhotoModaldata" >
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
				@elseif(empty($app->driverinfo->driver_is_owner))
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
						{{isset($app->driverinfo->name) ? $app->driverinfo->name : '-' }}

					</span>
				</div>
				<div class="col-md-5"  style="position: relative;">
					<img id="driver_photo" src="{{url('/')}}{{!empty($app->driverinfo->photo)?$app->driverinfo->photo:''}}" class="img-fluid preview-img-review" alt="" style="position: absolute; top: 15px; right: 15px; z-index: 2;cursor: pointer;" height="150" width="150" data-toggle="modal" data-target="#DriverPhotoModaldata" >
				</div>


				@if(isset($app->driverinfo->address) && isset($app->driverinfo->address)!='')

				<?php  $driver_address = json_decode($app->driverinfo->address, true);   ?>
				<div class="col-md-3">
					<p>Address</p>
				</div>

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
				@endif





				<div class="col-md-3">
					<span>NID No.</span>
				</div>
				<div class="col-md-9">
					<span>
						{{isset($app->driverinfo->nid_number) ? $app->driverinfo->nid_number : '-' }}
					</span>
				</div>
				@endif

			</div>


			<div class="row app-section doc-section mt-3">
				<div class="col-md-12">
					<h5 class="text-center py-2 heading-bg">Documents</h5>
				</div>
				<div class="col-md-4">
					<span>Applicant NID Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->applicant->applicantDetail->nid_photo))
					<button type="button"  class="btn btn-info doc_img_prev" data-toggle="modal"  data-target="#nid1-copy">
						View
					</button>

					<div class="modal fade" id="nid1-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Applicant NID Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->applicant->applicantDetail->nid_photo}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>


					@else
					-
					@endif

				</div>



				<div class="col-md-4 offset-md-1">
					<span>Applicant Def ID Copy</span>
				</div>
				<div class="col-md-2">
					@if(!empty($app->applicant->applicantDetail->defIdCopy))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#defID-copy">
						View
					</button>
					<div class="modal fade" id="defID-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Applicant Def ID Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->applicant->applicantDetail->defIdCopy}}" class="img-fluid" alt="">
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
				<div class="col-md-1">
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
								<div class="modal-body" style="padding:0;">
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
				<div class="col-md-2">
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
								<div class="modal-body" style="padding:0;">
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

				<div class="col-md-1">
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
								<div class="modal-body" style="padding:0;">
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
				<div class="col-md-2">
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
								<div class="modal-body" style="padding:0;">
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
				<div class="col-md-1">
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
								<div class="modal-body" style="padding:0;">
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
					<span>Civil Service ID Copy</span>
				</div>
				<div class="col-md-2">
					@if(isset($app->document->civil_service_id))

					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid8-copy">
						View
					</button>
					<div class="modal fade" id="nid8-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Civil Service ID Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->civil_service_id}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div>

				<div class="col-md-4">
					<span>Proyash School Certificate Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->document->school_cert))

					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid9-copy">
						View
					</button>

					<div class="modal fade" id="nid9-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Proyash School Certificate Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->school_cert}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>
					@else
					-
					@endif
				</div>

				<div class="col-md-4 offset-md-1">
					<span>Marriage Certificate Copy</span>
				</div>
				<div class="col-md-2">
					@if(isset($app->document->marriage_cert))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid10-copy">
						View
					</button>
					<div class="modal fade" id="nid10-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Marriage Certificate Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->marriage_cert}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div>

				<div class="col-md-4">

					<span>Driver NID Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->driverinfo->nid_photo))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid11-copy">
						View
					</button>
					<div class="modal fade" id="nid11-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Driver NID Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->driverinfo->nid_photo}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div>

				<div class="col-md-4 offset-md-1">
					<span>Driving License Copy</span>
				</div>
				<div class="col-md-2">
					@if(isset($app->driverinfo->licence_photo ))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid12-copy">
						View
					</button>

					<div class="modal fade" id="nid12-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Driving License Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->driverinfo->licence_photo}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>
					@else
					-
					@endif
				</div>

				<div class="col-md-4 ">
					<span>Job Certificate Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->document->job_cert))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid13-copy">
						View
					</button>
					<div class="modal fade" id="nid13-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Job Certificate Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->job_cert}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div> 


				<div class="col-md-4 offset-md-1">
					<span>House Owner Certificate Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->document->house_owner_cert))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid14-copy">
						View
					</button>
					<div class="modal fade" id="nid14-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									House Owner Certificate Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->house_owner_cert}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div> 

				<div class="col-md-4 ">
					<span>Ward Commissioner Certificate Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->document->ward_comm_cert))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid15-copy">
						View
					</button>
					<div class="modal fade" id="nid15-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Ward Commissioner Certificate Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->ward_comm_cert}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div>

				<div class="col-md-4 offset-md-1">
					<span>Autorised Certificate Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->document->auth_cert))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid16-copy">
						View
					</button>
					<div class="modal fade" id="nid16-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Autorised Certificate Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->auth_cert}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div> 

				<div class="col-md-4 ">
					<span>Father Testimonial Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->document->father_testm))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid17-copy">
						View
					</button>
					<div class="modal fade" id="nid17-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Father Testimonial Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->father_testm}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div>

				<div class="col-md-4 offset-md-1">
					<span>Mother Testimonial Copy</span>
				</div>
				<div class="col-md-1">
					@if(isset($app->document->mother_testm))
					<button type="button" class="btn btn-info doc_img_prev" data-toggle="modal" data-target="#nid18-copy">
						View
					</button>
					<div class="modal fade" id="nid18-copy" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									Mother Testimonial Copy
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body" style="padding:0;">
									<img src="{{url('/')}}{{$app->document->mother_testm}}" class="img-fluid" alt="">
								</div>
							</div>
						</div>
					</div>

					@else
					-
					@endif
				</div>
			</div>
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
			<div class="modal-body" style="padding:0;">
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
				Driver's Photo
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

				</button>

			</div>
			<div class="modal-body" style="padding:0;">
				@if(!empty($app->driverinfo->photo) && $app->driverinfo->driver_is_owner=='')
				<img src="{{!empty($app->driverinfo->photo)?url($app->driverinfo->photo):''}}" class="img-fluid" alt="">
				@elseif(empty($app->driverinfo->photo) && $app->driverinfo->driver_is_owner=='1')
				<img src="{{!empty($app->applicant->applicantDetail->applicant_photo)?url($app->applicant->applicantDetail->applicant_photo):''}}" class="img-fluid" alt="">
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('/assets/admins/js/review-blade.js')}}"></script>
@endsection
