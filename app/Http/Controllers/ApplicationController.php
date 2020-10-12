<?php
namespace App\Http\Controllers;
use App\Application;
use App\DriverInfo;
use App\VehicleInfo;
use App\VehicleOwner;
use App\OwnerInfo;
use App\User;
use App\Applicant;
use App\Sms;
use App\FollowUp; 
use App\SmsApplicant;
use App\VehicleType;
use Auth;
use Mail;
use App\Notifications\ApplicationNotification;
use App\Mail\ApplicationSubmissionConfirm;
use App\ApplicantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Redirect;
class ApplicationController extends Controller
{
 public function submissionSmsSend($id){
  $sms_sent='';
  $mail_status='';
  $app=Application::findOrFail($id);
  $sms=Sms::where('type','=','submitted')->first();
  $final_subSms= str_replace('/reg/', $app->vehicleinfo->reg_number, $sms->sms_text);
  if(count(SmsApplicant::where('application_id',$id)->where('sms_id',$sms->id)->get())==0)
  {
    Mail::to($app->applicant->email)->send(new ApplicationSubmissionConfirm($final_subSms));
    if (Mail::failures()){
      $mail_status="fail";
    }else{
      $mail_status="success";
    }
    $post_url = 'http://smsportal.pigeonhost.com/smsapi' ;  
    $post_values = array( 
      'api_key' => '5715aa02de07dc08f6197a5850b92d76407666633e087f6c44d7e4df3e4984e1eaa03d84',
                'type' => 'text',  // unicode or text
                'senderid' => '8801552146120',
                'contacts' => $app->applicant->phone,
                'msg' => $final_subSms,
                'method' => 'api'
              );
    $post_string = "";
    foreach( $post_values as $key => $value )
    { 
      $post_string .= "$key=" . urlencode( $value ) . "&"; 
    }
    $post_string = rtrim( $post_string, "& " );
    $request_sms = curl_init($post_url);  
    curl_setopt($request_sms, CURLOPT_HEADER, 0);  
    curl_setopt($request_sms, CURLOPT_RETURNTRANSFER, 1);  
    curl_setopt($request_sms, CURLOPT_POSTFIELDS, $post_string); 
    curl_setopt($request_sms, CURLOPT_SSL_VERIFYPEER, FALSE);  
    $post_response = curl_exec($request_sms);
    curl_close ($request_sms);  
    $res = json_decode($post_response,true);
    if ($res['status'] == 'SUCCESS' ){
      $sms_applicant = new SmsApplicant;
      $sms_applicant->application_id = $app->id;
      $sms_applicant->sms_id = $sms->id;
      $sms_applicant->sms_status = $sms->type;
      $sms_applicant->api_CamID = $res['CamID'];
      $sms_applicant->save();
      $sms_sent='success';
    }else{
      $sms_sent='fail'; 
    }
    $follow_up =FollowUp::where('application_id',$app->id)->where('status','Application requested')->where('updated_by',auth()->guard('applicant')->user()->name)->orderBy('created_at','desc')->first();
    $follow_up->sms_sent=$sms_sent;
    $follow_up->mail_sent=$mail_status;
    $follow_up->comment=$final_subSms;
    $follow_up->update();
  }
}
public function submissionSmsSendRenew($id){
  $sms_sent='';
  $mail_status='';
  $app=Application::findOrFail($id);
  $sms=Sms::where('type','=','submitted-renew')->first();
  $final_subSms= str_replace('/reg/', $app->vehicleinfo->reg_number, $sms->sms_text);
  if(count(SmsApplicant::where('application_id',$id)->where('sms_id',$sms->id)->get())==0)
  {
    Mail::to($app->applicant->email)->send(new ApplicationSubmissionConfirm($final_subSms));
    if (Mail::failures()){
      $mail_status="fail";
    }else{
      $mail_status="success";
    }
   
//Incomming Data
$from =  "8804445653010"; // Sending VLN No
$to = $app->applicant->phone; // Destination Phone No , Format 8801874444324
$msg =  $final_subSms; // Text Body
$username = 'ennvisio'; //set username
$password = '7EBFP$ZRf]pYt'; //set password


//API Authorization
$auth_ready = "$username:$password";
$auth=base64_encode($auth_ready); // Base64 Encoded

//SMS Sending Via Curl
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://107.20.199.106/sms/1/text/single",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{ \"from\":\"$from\", \"to\":\"$to\", \"text\":\"$msg\" }",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "authorization: Basic $auth",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
    $res = json_decode($post_response,true);
    if ($res['status'] == 'SUCCESS' ){
      $sms_applicant = new SmsApplicant;
      $sms_applicant->application_id = $app->id;
      $sms_applicant->sms_id = $sms->id;
      $sms_applicant->sms_status = $sms->type;
      $sms_applicant->api_CamID = $res['CamID'];
      $sms_applicant->save();
      $sms_sent='success';
    }else{
      $sms_sent='fail'; 
    }
    $follow_up =FollowUp::where('application_id',$app->id)->where('status','Application requested')->where('updated_by',auth()->guard('applicant')->user()->name)->orderBy('created_at','desc')->first();
    $follow_up->sms_sent=$sms_sent;
    $follow_up->mail_sent=$mail_status;
    $follow_up->comment=$final_subSms;
    $follow_up->update();
  }
}
public function viewApplication($appNumber){
  $app = Application::where('app_number', $appNumber)->first();
  return view('layouts.applicant-app-review',compact('app'));
}
 public function applicationFormStore(Request $request){
   $exist_stickers = VehicleInfo::where('reg_number',$request->vehicle_reg_no)->get(); 
   $pending_count=0;
   $approve_count=0; 
   if(count($exist_stickers)>0){
    foreach($exist_stickers as $exist_sticker){
          // return $exist_sticker->application;
      if($exist_sticker->application->app_status =='pending' ){
       $pending_count++; 
     } 
     if($exist_sticker->application->app_status =='approved' ){
       $approve_count++;
     }
   }
 }
 if($pending_count==0 && $approve_count==0){

  DB::beginTransaction();
  try {
    $application = null;
    if(($request->sticker_category == 'E')|| ($request->sticker_category == 'F')|| ($request->sticker_category == 'S') || ($request->sticker_category == 'M') || ($request->sticker_category == 'T')){

      if($request->applicant_name != auth()->guard('applicant')->user()->name || $request->applicant_phone != auth()->guard('applicant')->user()->phone ) {
        $applicant = Applicant::findOrFail(auth()->guard('applicant')->user()->id);
        $applicant->name = $request->applicant_name;
        $applicant->phone = $request->applicant_phone;
        $applicant->save();
      }
      if(empty(auth()->guard('applicant')->user()->applicantDetail)){

      }
      if(!empty(auth()->guard('applicant')->user()->applicantDetail)){


      }
    }
    if(($request->sticker_category == 'A') || ($request->sticker_category == 'B') || ($request->sticker_category == 'C') || ($request->sticker_category == 'D') || ($request->sticker_category == 'E')|| ($request->sticker_category == 'F')|| ($request->sticker_category == 'S') || ($request->sticker_category == 'M') || ($request->sticker_category == 'T')){
     $application = new Application; 
     if($request->hasFile('app_photo')){
      $applicationname = time() . '.' . $request->app_photo->getClientOriginalExtension();
      $name = '/images/application/'.$applicationname;
      $request->app_photo->move(public_path('images/application'), $name);
    }
    $application->app_photo = $name;
    $application->app_number = (time()+rand(10,1000));
    $application->applicant_id=Auth::guard('applicant')->user()->id;
    $application->sticker_category=$request->sticker_category;
    $application->app_status="pending";
    $application->app_date=Carbon::now();
    $application->vehicle_type_id=$request->vehicle_type;
    $application->save();
    if(!empty($request->renew_request) && $request->renew_request=='yes'){
     $old_app = Application::findOrFail($request->app_id);
     $old_app->renew = 'renew-applied';
     $old_app->save();
   }

   
   $DriverInfo = new DriverInfo;
   $DriverInfo->application_id=$application->id;
   $DriverInfo->app_number =$application->app_number;

   if ($request->self_driven == '1')
   {
    $DriverInfo->driver_is_owner = $request->self_driven;
    $DriverInfo->licence_validity =$request->licence_validity;
    if($request->hasFile('licence_photo')){
     $driver_licence_filename = time() . '.' . $request->licence_photo->getClientOriginalExtension();
     $driver_licence_name ='/images/driver_licence/'.$driver_licence_filename;
     $request->licence_photo->move(public_path('images/driver_licence'),$driver_licence_name);
     $DriverInfo->licence_photo = $driver_licence_name;
   }
   if($request->hasFile('org_id_photo')){
    $driver_org_id_fileName = time() . '.' . $request->org_id_photo->getClientOriginalExtension();
    $driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
    $request->org_id_photo->move(public_path('images/driver_org_id'), $driver_org_id_name);
    $DriverInfo->org_id_photo = $driver_org_id_name;
  }
}
else{

  $DriverInfo->name =$request->name;
  $DriverInfo->nid_number = $request->nid_number;
  $present_address = array(
    "house" => $request->dri_pre_house,
    "road" => $request->dri_pre_road,
    "block" => $request->dri_pre_block,
    "area" => $request->dri_pre_area,
  );
  $permanent_address = array(
    "p_house" => $request->dri_per_house,
    "p_road" => $request->dri_per_road,
    "p_block" => $request->dri_per_block,
    "p_area" => $request->dri_per_area,
  );
  $driver_address =array(
    "present" => $present_address,
    "permanent" => $permanent_address,
  );

  $DriverInfo->address =json_encode($driver_address);
  $DriverInfo->licence_validity =$request->licence_validity;
  if($request->hasFile('licence_photo')){
    $driver_licence_filename = time() . '.' . $request->licence_photo->getClientOriginalExtension();
    $driver_licence_name ='/images/driver_licence/'.$driver_licence_filename;
    $request->licence_photo->move(public_path('images/driver_licence'),$driver_licence_name);
    $DriverInfo->licence_photo = $driver_licence_name;
  }
  if($request->hasFile('photo')){
    $driver_photo_fileName = time() . '.' . $request->photo->getClientOriginalExtension();
    $driver_photo_name = '/images/driver_photo/'.$driver_photo_fileName;
    $request->photo->move(public_path('images/driver_photo'), $driver_photo_name);
    $DriverInfo->photo = $driver_photo_name;               
  }            
  if($request->hasFile('nid_photo')){
    $driver_nid_fileName = time() . '.' . $request->nid_photo->getClientOriginalExtension();
    $driver_nid_name = '/images/driver_nid/'.$driver_nid_fileName;
    $request->nid_photo->move(public_path('images/driver_nid'), $driver_nid_name);
    $DriverInfo->nid_photo = $driver_nid_name;               
  }             
  if($request->hasFile('org_id_photo')){
    $driver_org_id_fileName = time() . '.' . $request->org_id_photo->getClientOriginalExtension();
    $driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
    $request->org_id_photo->move(public_path('images/driver_org_id'), $driver_org_id_name);
    $DriverInfo->org_id_photo = $driver_org_id_name;
  }
}
$DriverInfo->save();


}
// form all form cond end
DB::commit();
$users= User::all();
foreach ($users as $user) {
  if(isset($applicant->name) && $applicant->name!=''){
    $app_dtail = array(
      "app_number" => $application->app_number,
      "applicant_name" => $applicant->name,
    );
    $user->notify(new ApplicationNotification($app_dtail));
  } 
  else{
   $app_dtail = array(
    "app_number" => $application->app_number,
    "applicant_name" => auth()->guard('applicant')->user()->name,
  );
   $user->notify(new ApplicationNotification($app_dtail));
 }
}
if(!empty($request->renew_request) && $request->renew_request=='yes'){
  $data ="Application Submitted Successfully for Renew!!";
}
else{
  $data ="New Application Submitted Successfully!!";
}
$renew_flag ="success";
return (array($data,$renew_flag,$application->id));
}
catch (\Exception $e) {
  DB::rollback();
  $data_error_flag ="DB_Transaction_error";
  $data ="Application Not Submitted.Please give acceptable info in fields.";
  return (array($data,$data_error_flag));
}
}
else{
 $data ="You can not apply more for this vehicle now.";
 $not_now_flag ="fail renew";
 return (array($data,$not_now_flag));
 
}
}
public function applicationEditApplicant($appNumber){
  $vehicleTypes=VehicleType::all();
  $app = Application::where('app_number', $appNumber)->first();
  if($app->app_status=="pending" || $app->app_status=="rejected"){
   return view('forms.applicant-edit',compact('app','vehicleTypes'));
   
 }
 else{
   return Redirect::back()->withErrors(['You can only edit pending or rejected application. Thank You.']);
   
 } 
}



public function applicationFormEdit(Request $request,$appid){
  $app_edit= Application::findOrFail($appid);
  DB::beginTransaction();
  try {
    if(($request->sticker_category == 'E')|| ($request->sticker_category == 'F')|| ($request->sticker_category == 'S') || ($request->sticker_category == 'M') || ($request->sticker_category == 'T')){

      $applicant = Applicant::findOrFail($app_edit->applicant->id);
      $applicant->name = $request->applicant_name;
      $applicant->phone = $request->applicant_phone;
      $applicant->save();


      $ApplicantDetail =ApplicantDetail::findOrFail($app_edit->applicant->applicantDetail->id);
      if( $request->hasFile('applicant_photo') ){
        \File::delete('images/applicant_photo/' . basename($ApplicantDetail->applicant_photo));
        $applicant_photo_fileName = time() . '.' . $request->applicant_photo->getClientOriginalExtension();
        $applicant_photo_name = '/images/applicant_photo/'.$applicant_photo_fileName;
        $request->applicant_photo->move(public_path('images/applicant_photo'), $applicant_photo_name);
        $ApplicantDetail->applicant_photo = $applicant_photo_name;
      }
      if($request->hasFile('applicant_nid_photo')){
        \File::delete('images/applicant_nid/' . basename($ApplicantDetail->nid_photo));
        $applicant_nid_fileName = time() . '.' . $request->applicant_nid_photo->getClientOriginalExtension();
        $applicant_nid_name ='/images/applicant_nid/'.$applicant_nid_fileName;
        $request->applicant_nid_photo->move(public_path('images/applicant_nid'), $applicant_nid_name);
        $ApplicantDetail->nid_photo = $applicant_nid_name;
      }
      $office_address = array(
        "o_house" => $request->applicant_o_house,
        "o_road" => $request->applicant_o_road,
        "o_block" => $request->applicant_o_block,
        "o_area" => $request->applicant_o_area,
      );
      $present_address = array(
        "house" => $request->applicant_house,
        "road" => $request->applicant_road,
        "block" => $request->applicant_block,
        "area" => $request->applicant_area,
      );
      $permanent_address = array(
        "p_house" => $request->applicant_p_house,
        "p_road" => $request->applicant_p_road,
        "p_block" => $request->applicant_p_block,
        "p_area" => $request->applicant_p_area,
      );
      $applicant_address =array(
        "present" => $present_address,
        "permanent" => $permanent_address,
        "office" => $office_address,
      );
      if ($request->guardian == 1){
        $ApplicantDetail->father_name = $request->f_h_name;
      }
      else {
        $ApplicantDetail->husband_name = $request->f_h_name;
      }
      $ApplicantDetail->address = json_encode($applicant_address);
      $ApplicantDetail->nid_number = $request->applicant_nid;
      $ApplicantDetail->profession = $request->profession;
      $ApplicantDetail->designation = $request->designation;
      $ApplicantDetail->company_name = $request->ap_company_name;
      $ApplicantDetail->save();
    }

    if(($request->sticker_category == 'A') || ($request->sticker_category == 'B') || ($request->sticker_category == 'C') || ($request->sticker_category == 'D') ||
      ($request->sticker_category == 'E')|| ($request->sticker_category == 'F')|| ($request->sticker_category == 'S') || ($request->sticker_category == 'M') || ($request->sticker_category == 'T')){
      $application=Application::findOrFail($appid);
    if($request->hasFile('app_photo')){
      \File::delete('images/application/' . basename($application->app_photo));
      $applicationname = time() . '.' . $request->app_photo->getClientOriginalExtension();
      $name = '/images/application/'.$applicationname;
      $request->app_photo->move(public_path('images/application'), $name);
      $application->app_photo = $name;
    }
    $application->sticker_category=$request->sticker_category;
    $application->vehicle_type_id=$request->vehicle_type;
    if(!empty(auth()->guard('applicant')->user()->name)){
      $application->app_status="pending";
    }
    
    $application->save();


    $DriverInfo = DriverInfo::findOrFail($application->driverinfo->id);
    if( $request->self_driven == '1'){
      if($DriverInfo->driver_is_owner!='1'){
        \File::delete('images/driver_nid/' . basename($DriverInfo->nid_photo));
        $DriverInfo->nid_photo='';
        \File::delete('images/driver_photo/' . basename($DriverInfo->photo));
        $DriverInfo->photo='';
        $DriverInfo->licence_validity =$request->licence_validity;

        if($request->hasFile('licence_photo')) {
          \File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));

          $driver_licence_filename = time() . '.' . $request->licence_photo->getClientOriginalExtension();
          $driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
          $request->licence_photo->move(public_path('images/driver_licence'), $driver_licence_name);
          $DriverInfo->licence_photo = $driver_licence_name;
        }
        if($request->hasFile('org_id_photo')){
         \File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));
         $driver_org_id_fileName = time() . '.' . $request->org_id_photo->getClientOriginalExtension();
         $driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
         $request->org_id_photo->move(public_path('images/driver_org_id'), $driver_org_id_name);
         $DriverInfo->org_id_photo = $driver_org_id_name;
       }
       $DriverInfo->name ='';
       $DriverInfo->nid_number =null;
       $DriverInfo->address ='';
       $DriverInfo->driver_is_owner='1';
       $DriverInfo->save();
     }else{
      if($request->hasFile('licence_photo')) {
        \File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
        $driver_licence_filename = time() . '.' . $request->licence_photo->getClientOriginalExtension();
        $driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
        $request->licence_photo->move(public_path('images/driver_licence'), $driver_licence_name);
        $DriverInfo->licence_photo = $driver_licence_name;
      }
      $DriverInfo->licence_validity =$request->licence_validity;

      $DriverInfo->save();
    }
  }
  if($request->self_driven != '1'){
   if($DriverInfo->driver_is_owner=='1'){
    $DriverInfo->driver_is_owner=null;
  }
  $DriverInfo->licence_validity =$request->licence_validity;
  if($request->hasFile('licence_photo')) {
    \File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
    $driver_licence_filename = time() . '.' . $request->licence_photo->getClientOriginalExtension();
    $driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
    $request->licence_photo->move(public_path('images/driver_licence'), $driver_licence_name);
    $DriverInfo->licence_photo = $driver_licence_name;
  }
  $DriverInfo->name =$request->name;
  $DriverInfo->nid_number = $request->nid_number;
  $present_address = array(
    "house" => $request->dri_pre_house,
    "road" => $request->dri_pre_road,
    "block" => $request->dri_pre_block,
    "area" => $request->dri_pre_area,
  );
  $permanent_address = array(
    "p_house" => $request->dri_per_house,
    "p_road" => $request->dri_per_road,
    "p_block" => $request->dri_per_block,
    "p_area" => $request->dri_per_area,
  );
  $driver_address =array(
    "present" => $present_address,
    "permanent" => $permanent_address,
  );
  $DriverInfo->address =json_encode($driver_address);
  if( $request->hasFile('nid_photo')){
    \File::delete('images/driver_nid/' . basename($DriverInfo->nid_photo));

    $driver_nid_fileName = time() . '.' . $request->nid_photo->getClientOriginalExtension();
    $driver_nid_name = '/images/driver_nid/' . $driver_nid_fileName;
    $request->nid_photo->move(public_path('images/driver_nid'), $driver_nid_name);
    $DriverInfo->nid_photo = $driver_nid_name;
  }
  if($request->hasFile('photo')) {
    \File::delete('images/driver_photo/' . basename($DriverInfo->photo));

    $driver_photo_fileName = time() . '.' . $request->photo->getClientOriginalExtension();
    $driver_photo_name = '/images/driver_photo/' . $driver_photo_fileName;
    $request->photo->move(public_path('images/driver_photo'), $driver_photo_name);
    $DriverInfo->photo = $driver_photo_name;
  }
  if($request->hasFile('org_id_photo')){
    \File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));

    $driver_org_id_fileName = time() . '.' . $request->org_id_photo->getClientOriginalExtension();
    $driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
    $request->org_id_photo->move(public_path('images/driver_org_id'), $driver_org_id_name);
    $DriverInfo->org_id_photo = $driver_org_id_name;
  }

  $DriverInfo->save();
}
}

DB::commit();

$data ="Application Updated successfully!";
$renew_flag ="success";
$userType="";
if(isset(auth()->guard('applicant')->user()->name)){
  $userType="Customer";
}
return (array($data,$renew_flag,$userType));
}
catch (\Exception $e) {
  DB::rollback();
  $renew_flag ="DB_Transaction_error";
  $data ="Application Not Updated.Please give acceptable info in fields.";
  return (array($data,$renew_flag));
}   
}
}


