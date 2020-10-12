<div class="content-area" id="app-content-area">
  <div id="content-heading">
    <h4>Government Vehicle 
      @if(!empty($app))
      {{'('.$app->sticker_category.')'}}
      @else
      <span class="sticker_category_name"></span>
      @endif
      Application Edit Form
    </h4>
  </div>
  <div id="form_B_tabs">
    <ul class="nav nav-tabs" id="B-myTab" role="tablist">
      <li class="nav-item" >
        <a class="nav-link active" id="app-info-tab" data-toggle="tab" href="#app-info" role="tab" aria-controls="app-info" aria-selected="true">Application's Details</a>
      </li>
      <li class="nav-item" >
        <a class="nav-link"  id="vehicle-tab"  data-toggle="tab" href="#vehicle" role="tab" aria-controls="vehicle" aria-selected="false">Vehicle's details</a>
      </li>
      <li class="nav-item" >
        <a class="nav-link"  id="driver-tab"  data-toggle="tab" href="#driver" role="tab" aria-controls="driver" aria-selected="false">Driver's details</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane show fade active" id="app-info" role="tabpanel" aria-labelledby="app-info-tab">
        <div class="container-fluid">
          <form id="application_edit_form"  data-id="{{$app->id}}" class="Applycationform form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row vehi">

              <div class="col-md-12 text-center">
                <label class="another-driver-heading">
                  Application's Details
                </label>            
              </div>

              <div class="col-md-2 offset-md-1">
                <label for="" class="label-form">Sticker type</label> <span>*</span> <br>
                <small></small>
              </div>
              @if(!empty($app))
              <div class="col-md-8">
                <input type="text" value="{{$app->sticker_category}}" name="sticker_category"  class="form-control in-form mandatory" placeholder="" >
              </div>
              @elseif(empty($app))
              <div class="col-md-8">
                <input type="text" id="sticker_category" value="" name="sticker_category" class="form-control in-form mandatory" placeholder="" >
              </div>
              @endif
              <div class="col-md-2 offset-md-1 mt-2">
                <label for="" class="">Application copy</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8">
                <div>
                  <img src="{{url('')}}{{$app->app_photo}}" id="prev_image1_b_exist" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;" >
                </div>
                <input type="file" id="image1_b_exist" name="app_photo" accept="image/*" class="form-control in-form" >
              </div>
              <div class="col-md-2 offset-md-4">
                <button type="submit" class="btn btn-primary next_btn custm-btn" id="B-n-btn1">Update & Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="tab-pane" id="vehicle" role="tabpanel" aria-labelledby="vehicle-tab">
        <div class="container-fluid">
          <form id="vehicle_detail_edit_form" data-id="{{$app->id}}" class="Applycationform form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row vehi vh2">
              <div class="col-md-12 text-center">
                <label class="another-driver-heading">
                  Vehicle's Details
                </label>            
              </div>
              <div class="col-md-2 offset-md-1">
                <label for="" class="label-form">Vehicle type</label> <span>*</span> <br>
                <small></small>
              </div>
              @if(!empty($app))
              <div class="col-md-8">
                <select name="vehicle_type" id="vehicle_type" class="form-control-sm mandatory" >
                  <option  selected value="{{$app->vehicleType->id}}">{{$app->vehicleType->name}}</option>
                  <?php $vehicleTypes=App\VehicleType::all(); ?>
                  @if(isset($vehicleTypes))
                  @foreach($vehicleTypes as $vehicleType)
                  <option value="{{$vehicleType->id}}">{{$vehicleType->name}}</option>
                  @endforeach
                  @endif
                </select>

              </div>
              @else

              <div class="col-md-8">
                <select name="vehicle_type" id="vehicle_type" class="form-control-sm mandatory" >
                  <option selected="" disabled> Select A Vehicle</option>
                  @if(isset($vehicleTypes))
                  @foreach($vehicleTypes as $vehicleType)
                  <option value="{{$vehicleType->id}}">{{$vehicleType->name}}</option>
                  @endforeach
                  @endif
                </select>

                <div id="err_msg_vehicletype" class="err_msg" hidden> <i class="fas fa-exclamation-triangle"></i>
                  <span id="err_vehicletype"> </span>
                </div>
              </div>
              @endif
              <div class="col-md-2 offset-md-1">
                <label for="" class="label-form">Vehicle registration number</label> <span>*</span> <br>
                <small></small>
              </div>
              @if(!empty($app))
              <div class="col-md-8">
                <input type="text" name="vehicle_reg_no" id="vehicle_reg_no" class="form-control in-form mandatory" value="{{$app->vehicleinfo->reg_number}}" >
              </div>
              @else
              <div class="col-md-8">
                <input type="text" name="vehicle_reg_no" id="vehicle_reg_no" class="form-control in-form mandatory" placeholder="5654445454" >
                <div id="err_msg_vehiclereg" class="err_msg" hidden><i  class="fas fa-exclamation-triangle"></i>
                  <span id="err_vehiclereg"> </span>
                </div>
              </div>
              @endif
              <div class="col-md-2 offset-md-1">
                <label for="" class="label-form">Registration certificate copy</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8">
                @if(!empty($app))
                <div>
                  <img src="{{url('')}}{{$app->vehicleinfo->reg_cert_photo}}" id="prev_image2_b_exist" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
                </div>
                <input type="file" id="image2_b_exist" accept="image/*" class="form-control in-form mandatory" name="vehicle_reg_photo">


                <div id="err_msg_vehicleregphoto" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_vehicleregphoto"> </span>
                </div>
                @else
                <div>
                  <img src="" id="prev_image2_b" alt="preview application" hidden>
                </div>
                <input type="file" id="image2_b" accept="image/*" class="form-control in-form mandatory" name="vehicle_reg_photo" >
                <div id="err_msg_vehicleregphoto" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_vehicleregphoto"> </span>
                </div>
                @endif
              </div>
              <div class="col-md-2 offset-md-1">
                <label for="" class="label-form">Vehicle chassis number</label> <span>*</span> <br>
                <small></small>
              </div>
              @if(!empty($app))
              <div class="col-md-8">
               <input type="text" name="vehicle_chassis_no" id="vehicle_chassis_no" class="form-control in-form mandatory" value="{{!empty($app->vehicleinfo->chassis_number)?$app->vehicleinfo->chassis_number:''}}" required>
             </div>
             @else
             <div class="col-md-8">
               <input type="text" name="vehicle_chassis_no" id="vehicle_chassis_no" class="form-control in-form mandatory" placeholder="" required>
               <div id="err_msg_vehicleChassis" class="err_msg" hidden><i  class="fas fa-exclamation-triangle"></i> 
                <span id="err_vehicleChassis"> </span>
              </div>
            </div>
            @endif
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Owner name</label><span>*</span><br>
              <small></small>
            </div>
            @if(!empty($app))
            <div class="col-md-8">
              <input type="text" name="owner_name" id="owner_name" class="form-control in-form mandatory" value="{{$app->vehicleowner->owner_name}}" >
            </div>
            @else
            <div class="col-md-8">
              <input type="text" name="owner_name" id="owner_name" class="form-control in-form mandatory" >
              <div id="err_msg_ownername" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownername"> </span>
              </div>
            </div>
            @endif

            @if(!empty($app->vehicleowner->company_name))
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">If owner is a company</label> <span></span> <br>
              <small></small>
            </div>

            <div class="col-md-8 mt-2">
              <input type="checkbox"  name="owner_is_company" checked class="owner_is_company" value="1" style="margin-top: 3px;" >
            </div>

            <div class="col-md-2 offset-md-1 company_info_field" >
              <label for="" class="label-form">Name Of Company</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" >
              <input type="text" name="company_name" class="form-control in-form" value="{{$app->vehicleowner->company_name}}">
            </div>
            <?php $com_address = json_decode($app->vehicleowner->company_address, true);   ?>
            <div class="col-md-2 offset-md-1 company_info_field">
              <p style="margin-bottom: 0px; margin-top: 30px;">Company's Address:</p> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" >
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" >
              <label for="" class="label-form">House No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" >
              <input type="text" name="c_house" class="c_house form-control in-form" value="{{$com_address['house']}}">
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" >
              <label for="" class="label-form">Road No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" >
              <input type="text" name="c_road" class="c_road form-control in-form" value="{{$com_address['road']}}" >
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" >
              <label for="" class="label-form">Block/Section</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" >
              <input type="text" name="c_block" class="c_block form-control in-form" value="{{$com_address['block'] }}" >
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" >
              <label for="" class="label-form">Area</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" >
              <input type="text" name="c_area" class="c_area form-control in-form" value="{{$com_address['area'] }}" >
            </div>

            @else
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">If owner is a company</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 mt-2">
              <input type="checkbox"  name="owner_is_company" class="owner_is_company" value="1" style="margin-top: 3px;" >
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" hidden>
              <label for="" class="label-form">Name Of Company</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" hidden>
              <input type="text" name="company_name" class="form-control in-form" value="">
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" hidden>
              <p style="margin-bottom: 0px; margin-top: 30px;">Company's Address:</p> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" hidden>
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" hidden>
              <label for="" class="label-form">House No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" hidden>
              <input type="text" name="c_house" class="c_house form-control in-form" placeholder="" >
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" hidden>
              <label for="" class="label-form">Road No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" hidden>
              <input type="text" name="c_road" class="c_road form-control in-form" placeholder="" >
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" hidden>
              <label for="" class="label-form">Block/Section</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" hidden>
              <input type="text" name="c_block" class="c_block form-control in-form" placeholder="" >
            </div>
            <div class="col-md-2 offset-md-1 company_info_field" hidden>
              <label for="" class="label-form">Area</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8 company_info_field" hidden>
              <input type="text" name="c_area" class="c_area form-control in-form" placeholder="" >
            </div>
            @endif


            @if(!empty($app->vehicleowner->owner_address))
            <?php $own_address = json_decode($app->vehicleowner->owner_address, true);   ?>

            <div class="col-md-2 offset-md-1">
              <p style="margin-bottom: 0px; margin-top: 30px;">Owner Present Address:</p> <br>
              <small></small>
            </div>
            <div class="col-md-8">

            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">House No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_house" id="o_house" class="o_house form-control in-form mandatory" placeholder=""  value="{{isset($own_address['present']['pre_house']) ? $own_address['present']['pre_house'] : '' }}">

            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Road No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_road" id="o_road" class="o_road form-control in-form mandatory" value="{{isset($own_address['present']['pre_road']) ? $own_address['present']['pre_road'] : '' }}" >

            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Block/Section</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_block" id="o_block" class="o_block form-control in-form mandatory" value="{{isset($own_address['present']['pre_block']) ? $own_address['present']['pre_block'] : '' }}" >

            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Area</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_area" id="o_area" class="o_area form-control in-form mandatory" value="{{isset($own_address['present']['pre_area']) ? $own_address['present']['pre_area'] : '' }}" >

            </div>

            <div class="col-md-2 offset-md-1 owner_per_address">
              <p style="margin-bottom: 0px; margin-top: 30px;">Permanent Address:</p> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              @if(($own_address['present']['pre_house'] == $own_address['permanent']['per_house']) && ($own_address['present']['pre_road'] == $own_address['permanent']['per_road']) && ($own_address['present']['pre_block'] == $own_address['permanent']['per_block']) && ($own_address['present']['pre_area'] == $own_address['permanent']['per_area'])
              )
              <input type="checkbox"  name="owner_address_permanent" class="owner_address_permanent"  style="margin-top: 3px;" checked>
              @else
              <input type="checkbox"  name="owner_address_permanent" class="owner_address_permanent"  style="margin-top: 3px;" >
              @endif

              <a style="display: inline-block; margin-bottom: 0px; margin-top: 30px;"  title="Use present address">Same as present address
              </a>
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">House No.</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_house" class="o_per_house form-control in-form" value="{{isset($own_address['permanent']['per_house']) ? $own_address['permanent']['per_house'] : '' }}" >
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">Road No.</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_road" class="o_per_road form-control in-form" value="{{isset($own_address['permanent']['per_road']) ? $own_address['permanent']['per_road'] : '' }}" >
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">Block/Section</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_block" class="o_per_block form-control in-form" value="{{isset($own_address['permanent']['per_block']) ? $own_address['permanent']['per_block'] : '' }}" >
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">Area</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_area" class="o_per_area form-control in-form" value="{{isset($own_address['permanent']['per_area']) ? $own_address['permanent']['per_area'] : '' }}" >
            </div>
            @else
            <div class="col-md-2 offset-md-1">
              <p style="margin-bottom: 0px; margin-top: 30px;">Owner Present Address:</p> <br>
              <small></small>
            </div>
            <div class="col-md-8">

            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">House No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_house" id="o_house" class="o_house form-control in-form mandatory" placeholder="" >
              <div id="err_msg_ownerhouse" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownerhouse"> </span>
              </div>
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Road No.</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_road" id="o_road" class="o_road form-control in-form mandatory" placeholder="" >
              <div id="err_msg_ownerroad" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownerroad"> </span>
              </div>
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Block/Section</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_block" id="o_block" class="o_block form-control in-form mandatory" placeholder="" >
              <div id="err_msg_ownerblock" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownerblock"> </span>
              </div>
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Area</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              <input type="text" name="o_area" id="o_area" class="o_area form-control in-form mandatory" placeholder="" >
              <div id="err_msg_ownerarea" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownerarea"> </span>
              </div>
            </div>

            <div class="col-md-2 offset-md-1 owner_per_address">
              <p style="margin-bottom: 0px; margin-top: 30px;">Permanent Address:</p> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="checkbox"  name="owner_address_permanent" class="owner_address_permanent"  style="margin-top: 3px;" >
              <a style="display: inline-block; margin-bottom: 0px; margin-top: 30px;"  title="Use present address">Same as present address
              </a>
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">House No.</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_house" class="o_per_house form-control in-form" placeholder="" >
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">Road No.</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_road" class="o_per_road form-control in-form" placeholder="" >
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">Block/Section</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_block" class="o_per_block form-control in-form" placeholder="" >
            </div>
            <div class="col-md-2 offset-md-1 owner_per_address">
              <label for="" class="label-form">Area</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8 owner_per_address">
              <input type="text" name="o_per_area" class="o_per_area form-control in-form" placeholder="" >
            </div>
            @endif

            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Owner National ID number</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleowner->nid_number))
              <input type="number" name="owner_nid" id="owner_nid" class="form-control in-form mandatory" value="{{$app->vehicleowner->nid_number}}" >
              @else
              <input type="number" name="owner_nid" id="owner_nid" class="form-control in-form mandatory" placeholder="" >
              <div id="err_msg_ownerNid" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownerNid"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Owner NID copy</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleowner->nid_photo))
              <div>
                <img src="{{url('')}}{{$app->vehicleowner->nid_photo}}" id="prev_image3_b_exist" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" id="image3_b_exist" accept="image/*" name="owner_nid_photo" class="form-control in-form mandatory" >
              <div id="err_msg_ownerNidCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownerNidCopy"> </span>
              </div>
              @else
              <div>
                <img src="" id="prev_image3_b" alt="preview application" hidden>
              </div>
              <input type="file" id="image3_b" accept="image/*" name="owner_nid_photo" class="form-control in-form mandatory" >
              <div id="err_msg_ownerNidCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_ownerNidCopy"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Tax paid upto</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->tax_token_validity))
              <input type="date" data-date=""  data-date-format="DD MMMM YYYY" value="{{$app->vehicleinfo->tax_token_validity}}" name="tax_paid_upto" id="tax_paid_upto" class="form-control in-form mandatory" >
              <div id="err_msg_taxVal" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_taxVal"> </span>
              </div>
              @else
              <input type="date" data-date=""  data-date-format="DD MMMM YYYY" value="" name="tax_paid_upto" id="tax_paid_upto" class="form-control in-form mandatory" >
              <div id="err_msg_taxVal" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_taxVal"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Tax token copy</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->tax_token_photo))

              <div>
                <img src="{{url('')}}{{$app->vehicleinfo->tax_token_photo}}" id="prev_image4_b_exist" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" id="image4_b_exist" accept="image/*" name="tax_token_photo" class="form-control in-form mandatory" >
              <div id="err_msg_taxCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_taxCopy"> </span>
              </div>
              @else
              <div>
                <img src="" id="prev_image4_b" alt="preview application" hidden>
              </div>
              <input type="file" id="image4_b" accept="image/*" name="tax_token_photo" class="form-control in-form mandatory" >
              <div id="err_msg_taxCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_taxCopy"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Fitness validity</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->fitness_validity))
              <input type="date" value="{{$app->vehicleinfo->fitness_validity}}" name="fitnness_validity" id="fitnness_validity" class="form-control in-form mandatory" >
              <div id="err_msg_fitnessVal" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_fitnessVal"> </span>
              </div>
              @else
              <input type="date" value="" name="fitnness_validity" id="fitnness_validity" class="form-control in-form mandatory" >
              <div id="err_msg_fitnessVal" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_fitnessVal"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Fitness certificate copy</label> <span>*</span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->fitness_cert_photo))

              <div>
                <img src="{{url('')}}{{$app->vehicleinfo->fitness_cert_photo}}" id="prev_image5_b_exist" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" id="image5_b_exist" name="fitness_cert_photo" accept="image/*" class="form-control in-form mandatory" >
              <div id="err_msg_fitnessCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_fitnessCopy"> </span>
              </div>

              @else
              <div>
                <img src="" id="prev_image5_b" alt="preview application" hidden>
              </div>
              <input type="file" id="image5_b" name="fitness_cert_photo" accept="image/*" class="form-control in-form mandatory" >
              <div id="err_msg_fitnessCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_fitnessCopy"> </span>
              </div>
              @endif
            </div>

            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Insurance validity</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->insurance_validity))
              <input type="date" value="{{$app->vehicleinfo->insurance_validity}}" name="insurance_validity" id="insurance_validity" class="form-control in-form mandatory" >
              <div id="err_msg_insuranceValidity" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_insuranceValidity"> </span>
              </div>
              @else
              <input type="date" value="" name="insurance_validity" id="insurance_validity" class="form-control in-form mandatory" >
              <div id="err_msg_insuranceValidity" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_insuranceValidity"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Insurance certificate copy</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->insurance_cert_photo))
              <div>
                <img src="{{url('')}}{{$app->vehicleinfo->insurance_cert_photo}}" id="prev_image6_b_exist" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" id="image6_b_exist" name="insurance_cert_photo" accept="image/*" class="form-control in-form mandatory" >
              <div id="err_msg_insuranceCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_insuranceCopy"> </span>
              </div>
              @else
              <div>
                <img src="" id="prev_image6_b" alt="preview application" hidden>
              </div>
              <input type="file" id="image6_b" name="insurance_cert_photo" accept="image/*" class="form-control in-form mandatory" >
              <div id="err_msg_insuranceCopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_insuranceCopy"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1" id="Necessity-div">
              <label for="" class="label-form">Necessity of using CP area</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->necessity_to_use))
              <textarea type="text" id="necessity_to_use"  name="necessity_to_use" class="form-control in-form" >{{$app->vehicleinfo->necessity_to_use}}</textarea>
              <div id="err_msg_necessity" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_necessity"> </span>
              </div>
              @else
              <textarea type="text" id="necessity_to_use" value="" name="necessity_to_use" class="form-control in-form" ></textarea>
              <div id="err_msg_necessity" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_necessity"> </span>
              </div>
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Road permit copy</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->road_permit_photo))

              <div>
                <img src="{{url('')}}{{$app->vehicleinfo->road_permit_photo}}" id="prev_image7_b" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" id="image7_b" name="road_permit_photo" accept="image/*" class="form-control in-form" >
              @else
              <div>
                <img src="" id="prev_image7_b" alt="preview application" hidden>
              </div>
              <input type="file" id="image7_b" name="road_permit_photo" accept="image/*" class="form-control in-form" >
              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Jetty license copy</label> <span></span> <br>
              <small>if owner/jetty sorker</small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->jt_licence_photo))

              <div>
                <img src="{{url('')}}{{$app->vehicleinfo->jt_licence_photo}}" id="prev_image8_b" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" id="image8_b" name="jt_licence_photo" accept="image/*" class="form-control in-form">
              @else
              <div>
                <img src="" id="prev_image8_b" alt="preview application" hidden>
              </div>
              <input type="file" id="image8_b" name="jt_licence_photo" accept="image/*" class="form-control in-form">

              @endif
            </div>
            <div class="col-md-2 offset-md-1">
              <label for="" class="label-form">Port entry pass copy</label> <span></span> <br>
              <small></small>
            </div>
            <div class="col-md-8">
              @if(!empty($app->vehicleinfo->port_entry_pass_photo))

              <div>
                <img src="{{URL('')}}{{$app->vehicleinfo->port_entry_pass_photo}}" id="prev_image9_b"   alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" id="image9_b" name="entry_pass_photo" accept="image/*" class="form-control in-form">
              @else
              <div>
                <img src="" id="prev_image9_b"   alt="preview application" hidden>
              </div>
              <input type="file" id="image9_b" name="entry_pass_photo" accept="image/*" class="form-control in-form">

              @endif
            </div>

            <div class="col-md-1 offset-md-4 btn-veh">
              <button type="button" class="btn btn-secondary custm-btn" id="B-p-btn1">Previous</button>
            </div>
            <div class="col-md-1 btn-veh">
              <button type="submit" class="btn btn-primary next_btn custm-btn" id="B-n-btn2">Update & Save</button>
            </div>

          </div>
        </form>
      </div>
    </div>
    <div class="tab-pane" id="driver" role="tabpanel" aria-labelledby="driver-tab">
      <div class="row justify-content-center">
        <button class="btn btn-info" id="add_driver"><i class="far fa-plus-square"></i> Add  Driver Form</button> <button style="color: #fff; margin-left: 15px;margin-right: 20%;" class="btn btn-warning" id="remove_driver"><i class="far fa-minus-square"></i> Remove  Driver Form</button>
      </div>
      <div class="container-fluid">
        <form id="driver_detail_edit_form" data-id="{{$app->id}}" class="Applycationform form" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="row">
            @if(!empty($app->driverinfoes) && count($app->driverinfoes)>0)
            @foreach($app->driverinfoes as $k=>$driverinfo)
            <div id="driverID_{{$driverinfo->id}}" class="driver driverform_fields row {{$loop->last?'driver-1':''}}" data-lastdrinum="{{count($app->driverinfoes)}}" style="margin-bottom:20px;" data-total='{{count($app->driverinfoes)}}'>
              <div class="col-md-12 text-center">
                <label class="another-driver-heading driver_serial">Number <span class="driver_serial_no" id="driver-num{{$loop->iteration}}">{{$loop->iteration}}</span> Driver Detail</label>
              </div>
              <button id="removeDriver" data-id='{{$driverinfo->id}}' class="btn btn-danger removeDriver ctg-close" title="Delete this saved driver"><i class="fa fa-times"></i></button>
              @if(!empty($driverinfo->driver_is_owner) && $driverinfo->driver_is_owner == 1)
              <div class="col-md-2 offset-md-1 isvehicleselfdriven">
                <label for="" class="label-form">Is Vehicle Self Driven?</label> <span></span> <br>
              </div> 
              <div class="col-md-8 isvehicleselfdriven">
                <input type="checkbox" id="self_driven_checked" value="1"  name="drivers[{{$driverinfo->id}}][self_driven]" checked class="self_driven"  style="margin-top: 3px;width: 16px; height: 16px;">
              </div>
              @endif
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">Driver's name</label> <span>*</span> <br>
                <small></small>
              </div>

              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                @if(!empty($driverinfo->name))
                <input type="text"  name="drivers[{{$driverinfo->id}}][name]" id="driver_name" class="form-control in-form" required="false" value="{{!empty($driverinfo->name)?$driverinfo->name:''}}">
                <div id="err_msg_drivername" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_drivername"> </span>
                </div>
                @else
                <input type="text"  name="drivers[{{$driverinfo->id}}][name]" id="driver_name" class="form-control in-form" required="false">
                <div id="err_msg_drivername" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_drivername"> </span>
                </div>
                @endif
              </div>

              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">Driver's photo</label> <span>*</span> <br>
                <small></small>
              </div>

              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                @if(!empty($driverinfo->photo))
                <div>
                  <img src="{{!empty($driverinfo->photo)?url($driverinfo->photo):''}}"  id="prev_image10_b_exist{{$driverinfo->id}}" alt="preview application" style="display: inline-block; height: auto; padding: 10px 0px; max-width: 70%; width: auto; max-height: 200px;">
                </div>

                <input type="file" id="image10_b_exist{{$driverinfo->id}}" accept="image/*"  name="drivers[{{$driverinfo->id}}][photo]" class="form-control in-form" placeholder="" disabled>
                <button type="button" name="" class="btn btn-info change-btn" data-photo="{{!empty($driverinfo->photo)?url($driverinfo->photo):''}}">Change</button>
                <button type='button' class='btn btn-warning cancel-btn' hidden="">Cancel</button>
                <div id="err_msg_driverphoto" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverphoto"> </span>
                </div>
                @else
                <div>
                  <img src=""  id="prev_image10_b{{$driverinfo->id}}" alt="preview application" hidden>
                </div>
                <input type="file" id="image10_b{{$driverinfo->id}}" accept="image/*"  name="drivers[{{$driverinfo->id}}][photo]" class="form-control in-form" placeholder="" required>
                <div id="err_msg_driverphoto" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverphoto"> </span>
                </div>
                @endif
              </div>
              <?php $driver_address=null; ?>
              @if(!empty($driverinfo->address))
              <?php $driver_address = json_decode($driverinfo->address, true);  ?>
              @endif
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <p style="margin-bottom: 0px; margin-top: 30px;">Present address</p> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">House No.</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_pre_house]" id="dri_pre_house" class="driver_pre_house form-control in-form" required value="{{!empty($driver_address['present']['house'])?$driver_address['present']['house']:''}}">
                <div id="err_msg_driverhouse" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverhouse"> </span>
                </div>
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">Road No.</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_pre_road]" id="dri_pre_road" class="driver_pre_road form-control in-form" placeholder="" required value="{{!empty($driver_address['present']['road'])?$driver_address['present']['road']:''}}">
                <div id="err_msg_driverroad" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverroad"> </span>
                </div>
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">Block/Section</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_pre_block]" id="dri_pre_block" class="driver_pre_block form-control in-form" placeholder="" required value="{{!empty($driver_address['present']['block'])?$driver_address['present']['block']:''}}">
                <div id="err_msg_driverblock" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverblock"> </span>
                </div>
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">Area</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_pre_area]" id="dri_pre_area" class="driver_pre_area form-control in-form" placeholder="" required value="{{!empty($driver_address['present']['area'])?$driver_address['present']['area']:''}}">
                <div id="err_msg_driverarea" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverarea"> </span>
                </div>
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <p style="margin-bottom: 0px; margin-top: 30px;">Permanent address</p> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                @if(($driver_address['permanent'] !='') && ($driver_address['present']['house'] == $driver_address['permanent']['p_house']) && ($driver_address['present']['road'] == $driver_address['permanent']['p_road']) && ($driver_address['present']['block'] == $driver_address['permanent']['p_block']) && ($driver_address['present']['area'] == $driver_address['permanent']['p_area'])) 
                <input type="checkbox"  name="drivers[{{$driverinfo->id}}][driver_address_same_as_present]" id="driver_address_same_as_present" class="driver_address_same_as_present" checked style="margin-top: 3px;width: 16px; height: 16px;" >
                @else
                <input type="checkbox"  name="drivers[{{$driverinfo->id}}][driver_address_same_as_present]" id="driver_address_same_as_present" class="driver_address_same_as_present"  style="margin-top: 3px;width: 16px; height: 16px;" >
                @endif
                <label for="driver_address_same_as_present" style="display: inline-block; margin-bottom: 0px; margin-top: 30px;"  title="Use present address">Same as present address</label>
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">House No.</label> <span></span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}} driver_perm">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_per_house]"  class="driver_per_house form-control in-form" placeholder="" value="{{!empty($driver_address['permanent']['p_house'])? $driver_address['permanent']['p_house'] :''}}" >
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}" >
                <label for="" class="label-form">Road No.</label> <span></span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}} driver_perm">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_per_road]"  class="driver_per_road form-control in-form" placeholder="" value="{{!empty($driver_address['permanent']['p_road'])? $driver_address['permanent']['p_road'] :''}}">
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">Block/Section</label> <span></span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}} driver_perm">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_per_block]"  class="driver_per_block form-control in-form" placeholder="" value="{{!empty($driver_address['permanent']['p_block'])? $driver_address['permanent']['p_block'] :''}}">
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">Area</label> <span></span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}} driver_perm">
                <input type="text" name="drivers[{{$driverinfo->id}}][dri_per_area]"  class="driver_per_area  form-control in-form" placeholder="" value="{{!empty($driver_address['permanent']['p_area'])? $driver_address['permanent']['p_area'] :''}}">
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">National ID number</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                @if(!empty($driverinfo->nid_number))
                <input type="number" name="drivers[{{$driverinfo->id}}][nid_number]" id="drivernid_number" class="form-control in-form mandatory" placeholder="Type NID Number" required value="{{!empty($driverinfo->nid_number)?$driverinfo->nid_number:''}}">
                <div id="err_msg_driverNid" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverNid"> </span>
                </div>
                @else
                <input type="number" name="drivers[{{$driverinfo->id}}][nid_number]" id="drivernid_number" class="form-control in-form mandatory" placeholder="Type NID Number" required>
                <div id="err_msg_driverNid" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverNid"> </span>
                </div>
                @endif
              </div>
              <div class="col-md-2 offset-md-1  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                <label for="" class="label-form">NID copy</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8  {{empty($driverinfo->driver_is_owner)?'driver-is-not-owner':'driver-is-owner not_self_driven'}}">
                @if(!empty($driverinfo->nid_photo))
                <div>
                  <img src="{{!empty($driverinfo->nid_photo)?url($driverinfo->nid_photo):''}}" id="prev_image11_b_exist{{$driverinfo->id}}" alt="preview application" style="display: inline-block; height: auto; padding: 10px 0px; max-width: 70%; width: auto; max-height: 200px;">
                </div>
                <input type="file" accept="image/*" id="image11_b_exist{{$driverinfo->id}}"  name="drivers[{{$driverinfo->id}}][nid_photo]" class="form-control mandatory in-form" disabled>
                <button type="button" name="" class="btn btn-info change-btn" data-photo="{{!empty($driverinfo->nid_photo)?url($driverinfo->nid_photo):''}}">Change</button>
                <button type='button' class='btn btn-warning cancel-btn' hidden="">Cancel</button>
                <div id="err_msg_driverNidcopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverNidcopy"> </span>
                </div>
                @else
                <div>
                  <img src="" id="prev_image11_b{{$driverinfo->id}}" alt="preview application" hidden>
                </div>
                <input type="file" accept="image/*" id="image11_b{{$driverinfo->id}}"  name="drivers[{{$driverinfo->id}}][nid_photo]" class="form-control mandatory in-form" required>
                <div id="err_msg_driverNidcopy" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverNidcopy"> </span>
                </div>
                @endif
              </div>
              <div class="col-md-2 offset-md-1">
                <label for="" class="label-form">Driving license Validity</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8" >
                @if(!empty($driverinfo->licence_validity))
                <input type="date" id="licence_validity" name="drivers[{{$driverinfo->id}}][licence_validity]" class="form-control in-form mandatory" required
                value="{{!empty($driverinfo->licence_validity)?$driverinfo->licence_validity:''}}">
                <div id="err_msg_drivingValidity" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_drivingValidity"> </span>
                </div>
                @else
                <input type="date" id="licence_validity"  name="drivers[{{$driverinfo->id}}][licence_validity]" class="form-control in-form mandatory" required>
                <div id="err_msg_drivingValidity" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_drivingValidity"> </span>
                </div>
                @endif
              </div>
              <div class="col-md-2 offset-md-1">
                <label for="" class="label-form">Driving license copy</label> <span>*</span> <br>
                <small></small>
              </div>
              <div class="col-md-8" >
                @if(!empty($driverinfo->licence_photo))
                <div>
                  <img src="{{!empty($driverinfo->licence_photo)?url($driverinfo->licence_photo):''}}" id="prev_image12_b_exist{{$driverinfo->id}}" alt="preview application" style="display: inline-block; height: auto; padding: 10px 0px; max-width: 70%; width: auto; max-height: 200px;">
                </div>
                <input type="file" id="image12_b_exist{{$driverinfo->id}}" accept="image/*"  name="drivers[{{$driverinfo->id}}][licence_photo]" class="form-control in-form mandatory" disabled>
                <button type="button" name="" class="btn btn-info change-btn" data-photo="{{!empty($driverinfo->licence_photo)?url($driverinfo->licence_photo):''}}">Change</button>
                <button type='button' class='btn btn-warning cancel-btn' hidden="">Cancel</button>
                <div id="err_msg_driverlicence" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverlicence"> </span>
                </div>
                @else
                <div>
                  <img src="" id="prev_image12_b{{$driverinfo->id}}" alt="preview application" hidden>
                </div>
                <input type="file" id="image12_b{{$driverinfo->id}}" accept="image/*"  name="drivers[{{$driverinfo->id}}][licence_photo]" class="form-control in-form mandatory" required>
                <div id="err_msg_driverlicence" class="err_msg" hidden> <i  class="fas fa-exclamation-triangle"></i> <span id="err_driverlicence"> </span>
                </div>
                @endif
              </div>
              <div class="col-md-2 offset-md-1 driver-org-nid-copy-of-1" >
                <label for="" class="label-form">Driver's Org. ID card copy</label> <span></span> <br>
                <small></small>
              </div>
              <div class="col-md-8  driver_perm">
               @if(!empty($driverinfo->org_id_photo))
               <div>
                <img src="{{!empty($driverinfo->org_id_photo)?url($driverinfo->org_id_photo):''}}" id="prev_image13_b{{$driverinfo->id}}" alt="preview application" style="display: inline-block; height: auto;max-width:70%; width: auto; max-height: 200px; padding: 10px 0px;">
              </div>
              <input type="file" accept="image/*" id="image13_b{{$driverinfo->id}}"  name="drivers[{{$driverinfo->id}}][org_id_photo]" class="form-control in-form">
              @else
              <div>
                <img src="" id="prev_image13_bii{{$driverinfo->id}}" alt="preview application" hidden>
              </div>
              <input type="file" accept="image/*" id="image13_bii{{$driverinfo->id}}"  name="drivers[{{$driverinfo->id}}][org_id_photo]" class="form-control in-form">
              @endif
            </div>
          </div>
          @endforeach
          @endif
          @if(!empty($renew_app->sticker_category) && $renew_app->sticker_category!='F')
          <input type="hidden" name="renew_app" class="form-control in-form" value="yes">
          <input type="hidden" name="app_id" class="form-control in-form" value="{{$renew_app->id}}">
          @endif
          <div class="col-md-1 offset-md-4" id="driver_prev_btn">
            <button type="button" class="btn btn-secondary custm-btn" id="E-p-btn2">Previous</button>
          </div>
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary next_btn custm-btn" id="submit-btn">Update & Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
<div id="ajax-loader" hidden>
 <div>
   <img src="{{ url('assets/images/loading_spinner.gif') }}" />
   <div>Please wait for a while</div>
 </div>
</div>

