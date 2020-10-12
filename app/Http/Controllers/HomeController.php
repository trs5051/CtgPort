<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Applicant;
use App\VehicleInfo;
use Session;
use App\ApplicantDetail;
use App\User;
use App\FollowUp;
use App\ApplicationNotify;
use App\VehicleSticker;
use App\Invoice;
use App\StickerCategory;
use App\VehicleType;
use Carbon\Carbon;
use App\TemporaryPass;
use App\Sms;
use App\SmsApplicant;
use Mail;
use App\Mail\NotifyApplicant;
use App\Mail\notifyApproveMail;
use App\Mail\notifyRejectMail;
use App\Mail\IssuedMail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $apps = Application::where('app_status','!=','processing')->orderBy('created_at','desc')->get();
      $vehicleTypes =VehicleType::all();
      return view('home',compact('apps','vehicleTypes'));
    }
    public function adminSearch(Request $request)
    {
      $vehicleTypes =VehicleType::all();
      $applicant_details=null;
      $applicants=null;
      $vehicles=null;
      $stickers=null;
      $apps=null;
      $vehicle_type1=null;
      if($request->name_check == '1' || $request->phone_check=='1' || $request->nid_check=='1' || $request->reg_check=='1'  || $request->sticker_no_check=='1'|| $request->vehicle_type_check=='1'|| $request->from_date_check=='1' || $request->end_date_check=='1' ){
       if ($request->phone!='') {
         $applicants = Applicant::where( 'phone', $request->phone)->get();
       }   
       elseif ($request->name!='') {
         $applicants = Applicant::where('name', 'LIKE',  '%' . $request->name . '%')->get();
       }
       elseif ($request->sticker_no != '') {
        $stickers = VehicleSticker::where('sticker_number', $request->sticker_no)->first(); 
      }   
      elseif ($request->nid_number != '') {
        $applicant_details = ApplicantDetail::where('nid_number', $request->nid_number)->get(); 
      }  
      elseif ($request->vehicle_type!='') {
       $vehicle_type1=VehicleType::find($request->vehicle_type);
       $apps = Application::where('vehicle_type_id', $request->vehicle_type)->get();          
     }  
     elseif ($request->reg_no!='') {
       $vehicles = VehicleInfo::where('reg_number', 'LIKE',  '%' . $request->reg_no . '%' )->get();           
     } 
     elseif (($request->from_date != '') && ($request->end_date!='')){
      $apps= Application::whereBetween('app_date', [$request->from_date, $request->end_date])->get();     
    }
    elseif(($request->from_date != '') && ($request->end_date=='')){
     $apps= Application::whereDate('app_date', $request->from_date)->get(); 
   }  
   elseif(($request->from_date == '') && ($request->end_date!='')){
    $apps= Application::whereDate('app_date' , $request->end_date)->get();     
  }
  return view('home')->with('applicants', $applicants)->with('applicant_details', $applicant_details)->with('vehicles', $vehicles)->with('apps', $apps)->with('date_to', $request->end_date)->with('date_from', $request->from_date)->with('applicant_name', $request->name)->with('vehicle_type', $vehicle_type1)->with('applicant_phone', $request->phone)->with('applicant_nid_number', $request->nid_number)->with('reg_no', $request->reg_no)->with('vehicleTypes', $vehicleTypes)
  ->with('stickers', $stickers)->with('sticker_no', $request->sticker_no);
}  
elseif($applicants=='' && $applicant_details=='' && $vehicles=='' && $apps=='' && $stickers==''){
 $message = "No Application Found As Given Information";
 return view('home',compact('message'));
}
}


public function pendingApp(){
  $apps = Application::where('app_status','pending')->where('sticker_category','!=','T')->orderBy('created_at','desc')->get();
  return view('apps.pending',compact('apps'));
} 
public function approvedApp(){
  $apps = Application::where('app_status','approved')->where('sticker_category','!=','T')->orderBy('updated_at','desc')->get();
  return view('apps.approved',compact('apps'));
} 
public function rejectedApp(){
  $apps = Application::where('app_status','rejected')->where('sticker_category','!=','T')->orderBy('updated_at','desc')->get();
  return view('apps.rejected',compact('apps'));
}  
public function deliveredApp(){
  $apps = Application::where('app_status','issued')->where('sticker_category','!=','T')->orderBy('updated_at','desc')->get();
  return view('apps.delivered',compact('apps'));
}  
public function expiredSticker(){
 $apps = Application::where('app_status','expired')->where('sticker_category','!=','T')->orderBy('updated_at','desc')->get();
 return view('apps.expired',compact('apps'));
} 
public function applicationReview($app_number){
 $all_sms=Sms::where('type','manual')->get();
 $app = Application::where('app_number',$app_number)->first();
 return view('apps.review',compact('app','all_sms'));
}  
public function applicationRevewFromNotification($app_number,$not_id){
 $all_sms=Sms::where('type','manual')->get();

 $app = Application::where('app_number',$app_number)->first();
 $user = \Auth::user();
 $notification = $user->notifications()->where('id',$not_id)->first();
 if ($notification)
 {
   $notification->markAsRead();
               // auth()->user()->unreadNotifications->markAsRead();
 }
 if (!empty($app)){
  return view('apps.review',compact('app','all_sms'));
}else{
  return back();
}
}   
public function applicationApprove(Request $request){
  $final_approveSms='';
  $mail_status='';
  $sms_sent_status='';
  $app = Application::where('app_number',$request->app_num)->first();
  $appnotifyexist=ApplicationNotify::where('application_id', $app->id)->first();
  if($app->app_status == "pending"){
    $app->app_status = "approved";
    $app->save();
    $ApplicationNotify = new ApplicationNotify;
    $ApplicationNotify->application_id = $app->id;
    $ApplicationNotify->applicant_phone = $app->applicant->phone;
    $ApplicationNotify->app_status = $app->app_status;
    $ApplicationNotify->sticker_delivery_date = $request->sticker_delivery_date;
    $ApplicationNotify->save();

    $sms=Sms::where('type','=','approved')->first();
    $ApprMsg= str_replace('//', $ApplicationNotify->sticker_delivery_date, $sms->sms_text);
    $final_approveSms= str_replace('/reg/', $app->vehicleinfo->reg_number, $ApprMsg);
    $res=$this->callSmsApi($ApplicationNotify->applicant_phone,$final_approveSms);
    if ($res['status'] == 'SUCCESS' ){
      $sms_applicant = new SmsApplicant;
      $sms_applicant->application_id =  $app->id;
      $sms_applicant->sms_id = $sms->id;
      $sms_applicant->sms_status = $sms->type;
      $sms_applicant->api_CamID = $res['CamID'];
      $sms_applicant->save();

      $sms_status="SMS sent";
      $sms_sent_status="success";
    }else{
      $sms_sent_status="fail";
      $sms_status="SMS not sent.Contact with your SMS provider.Thank You.";
    }
    Mail::to($app->applicant->email)->send(new notifyApproveMail($final_approveSms));
    if (Mail::failures()){
     $mail_status='fail';
   }
   else{
    $mail_status='success';
  }
  $followUpStatus="Application approved";
  FollowUp::createFollowUp($app,$sms_sent_status,$mail_status,$followUpStatus,$final_approveSms);
  $data ="Application has been approved successfully!!";
  $flag=11;
  return array($flag,$data,$app->app_status,$sms_status);
}
elseif($app->app_status == "approved"){
  $data ="This Application already has been approved";
  $flag=10;
  return array($flag,$data);
}  
else{
  $data ="You can approve pending application only.Thank You.";
  $flag=12;
  return array($flag,$data);
}
}  
public function applicationReject(Request $request){
  $final_rejectSms='';
  $mail_status='';
  $sms_sent_status='';
  $app = Application::where('app_number',$request->app_num)->first();
  if($app->app_status == "pending" && $request->missMatch!=''){
    $app->app_status = "rejected";
    $app->rejected_date = Carbon::now();
    $app->save();
    $appnotifyexist=ApplicationNotify::where('application_id', $app->id)->first();
    $ApplicationNotify = new ApplicationNotify;
    $ApplicationNotify->application_id = $app->id;
    $ApplicationNotify->applicant_phone = $app->applicant->phone;
    $ApplicationNotify->app_status = $app->app_status;
    $ApplicationNotify->mis_matched = json_encode($request->missMatch);
    $ApplicationNotify->save();
    $sms=Sms::where('type','=','rejected')->first();
    $missFile=json_decode($ApplicationNotify->mis_matched, true);
    $allMissFile=implode( ", ", $missFile );
    $final_rejectSms= str_replace('//', $allMissFile, $sms->sms_text);
    $res=$this->callSmsApi($ApplicationNotify->applicant_phone,$final_rejectSms);
    if ($res['status'] == 'SUCCESS' ){
      $sms_applicant = new SmsApplicant;
      $sms_applicant->application_id =  $app->id;
      $sms_applicant->sms_id = $sms->id;
      $sms_applicant->sms_status = $sms->type;
      $sms_applicant->api_CamID = $res['CamID'];
      $sms_applicant->save();
      $sms_status="SMS sent";
    }else{
      $sms_status="SMS not sent.Contact with your SMS provider.Thank You.";
    }
    Mail::to($app->applicant->email)->send(new notifyRejectMail($final_rejectSms));
    if (Mail::failures()){
      $mail_status="fail";
    }else{
      $mail_status="success";
    }
    $followUpStatus="Application rejected";
    FollowUp::createFollowUp($app,$sms_sent_status,$mail_status,$followUpStatus,$final_rejectSms);
    $data ="Application has been rejected successfully!!";
    $flag=11;
    return array($flag,$data,$app->app_status,$sms_status);
  }
  elseif($app->app_status == "rejected"){
    $data ="This Application already has been rejected";
    $flag=10;
    return array($flag,$data);
  } 
  elseif($app->app_status != "rejected" || $app->app_status != "pending" ){
    $data ="You can reject pending application only.Thank You.";
    $flag=12;
    return array($flag,$data);
  }   
}    
public function applicationDelete(Request $request){
  $app = Application::where('app_number',$request->app_num)->first();
  if(auth()->user()->role =='super-admin'){
    if(!empty($app->driverinfo)){
      \File::delete('images/driver_nid/' . basename($app->driverinfo->nid_photo));
      \File::delete('images/driver_photo/' . basename($app->driverinfo->photo));
      \File::delete('images/driver_licence/' . basename($app->driverinfo->licence_photo));
      \File::delete('images/driver_org_id/' . basename($app->driverinfo->org_id_photo));
      $app->driverinfo->delete();
    }
    if(!empty($app->vehicleowner)){
      \File::delete('images/vehicle_owner_nid/' . basename($app->vehicleowner->nid_photo));
      $app->vehicleowner->delete();
    }
    if(!empty($app->vehicleinfo)){
      \File::delete('images/vehicle_reg/' . basename($app->vehicleinfo->reg_cert_photo));
      \File::delete('images/vehicle_insurance/' . basename($app->vehicleinfo->insurance_cert_photo));
      \File::delete('images/vehicle_tax_token/' . basename($app->vehicleinfo->tax_token_photo));
      \File::delete('images/vehicle_fitness/' . basename($app->vehicleinfo->fitness_cert_photo));
      \File::delete('images/vehicle_road_permit/' . basename($app->vehicleinfo->road_permit_photo));
      \File::delete('images/vehicle_port_pass/' . basename($app->vehicleinfo->port_entry_pass_photo));
      \File::delete('images/vehicle_jt_licence/' . basename($app->vehicleinfo->jt_licence_photo));
      $app->vehicleinfo->delete();
    }
    if(!empty($app->vehicleSticker))
      {$app->vehicleSticker->delete();}
    if(count($app->invoices)>0)
    {
      foreach ($app->invoices as $key => $value) {
        $value->delete();
      }
    }
    if(count($app->temporaryPasses)>0)
    {
      foreach ($app->temporaryPasses as $key => $value) {
        $value->delete();
      }
    }
    if(!empty($app->applicationNotify)){ 
      $app->applicationNotify->delete();
    }
    \File::delete('images/application/' . basename($app->app_photo));
    $app->delete();
    $data ="Application deleted successfully!!";
    $flag=13;
    return array($flag,$data);
  }
  if($app->app_status  == "pending"){
    $app->app_status = "deleted";
    $app->save();
    $data ="Application deleted temporarily. Only Super Admin can delete permanently.";
    $flag=11;
    return array($flag,$data,$app->app_status);
  }
  elseif($app->app_status == "deleted"){
    $data ="Already deleted. Only Super Admin can delete permanently.";
    $flag=10;
    return array($flag,$data);
  } 
  elseif($app->app_status != "deleted" || $app->app_status  != "pending"){
    $data ="You can delete pending application only.Thank You.";
    $flag=12;
    return array($flag,$data);
  }

}  
public function applicationEdit($appNumber){
  $vehicleTypes=VehicleType::all();
  $app = Application::where('app_number', $appNumber)->first();
  return view('apps.edit',compact('app','vehicleTypes'));

}    
public function issueSticker(Request $request){
  $final_issueSms='';
  $mail_status='';
  $application='';
  $sms_sent_status='';
  $app = Application::where('app_number',$request->app_number)->first();
  if($app->app_status == "approved"){
   $sms=Sms::where('type','=','issued')->first();
   $dummy_data = ["/reg/", "/issued-date/", "/expired-date/"];
   if($request->sticker_number=='' && $request->temp_sticker_exp_date !='')
   {
    // return $request->all();
    $temp = new TemporaryPass;
    $temp->application_id=$app->id;
    $temp->reg_number=$app->vehicleinfo->reg_number;
    $temp->start_date=Carbon::now();
    $temp->exp_date=$request->temp_sticker_exp_date;
    $todays_date=Carbon::now()->toDateString();
    $get_date_invoices=Invoice::whereDate('invoice_date', $todays_date)->where('vehicle_sticker_id','=','')->get();
    $no_of_pass=count($get_date_invoices)+1;
    $pass_number=$todays_date.'-'.$no_of_pass;
    $temp->number=$pass_number;
    $temp->gate_no=$request->gate_number;
    $temp->issue_date=$request->issue_sticker_date;
    $temp->issue_type=$request->issue_type;
    $temp->save();
    $real_dataSms   = [$temp->reg_number, $temp->issue_date, $temp->exp_date];
    $final_issueSms= str_replace($dummy_data, $real_dataSms, $sms->sms_text);
    $invoice = new Invoice;
    $invoice->application_id=$app->id;
    $invoice->temporary_pass_id=$temp->id;
    $invoice->number="CtgPort-".$app->app_number;
    $sticker_category=StickerCategory::where('value',$app->sticker_category)->first();
    $invoice->sticker_category_id=$sticker_category->id;
    $invoice->vehicle_type_id=$app->vehicleinfo->vehicleType->id;
    $invoice->fee=$request->issue_type=='govt'?'':$request->feePerDay;
    $invoice->days=$request->numberOfDays;
    $invoice->amount=$request->issue_type=='govt'?'':$request->totalAmount;
    $invoice->vat=$request->issue_type=='govt'?'':$request->vatamount;
    $invoice->total=$request->issue_type=='govt'?'':$request->grandTotal;
    $invoice->collector=auth()->user()->name;
    $invoice->invoice_date=Carbon::now();
    $invoice->comments=$app->app_number;
    $invoice->save();
    $application =Application::findOrFail($app->id);
  }elseif($request->sticker_number!='' && $request->temp_sticker_exp_date 
    == '')
  {
    $sticker = new VehicleSticker;
    $sticker->application_id=$app->id;
    $sticker->sticker_value=$app->sticker_category;
    $sticker->reg_number=$app->vehicleinfo->reg_number;
    $sticker->exp_date=$request->sticker_exp_date;
    $sticker->sticker_number=$request->sticker_number;
    $sticker->gate_no=$request->gate_number;
    $sticker->applicant_id=$app->applicant->id;
    $sticker->issue_date=$request->issue_sticker_date;
    $sticker->save();
    $real_dataSms   = [$sticker->reg_number, $sticker->issue_date, $sticker->exp_date];
    $final_issueSms= str_replace($dummy_data, $real_dataSms, $sms->sms_text);
    $invoice = new Invoice;
    $invoice->application_id=$app->id;
    $invoice->vehicle_sticker_id=$sticker->id;
    $invoice->number="CtgPort-".$app->app_number;
    $sticker_category=StickerCategory::where('value',$app->sticker_category)->first();
    $invoice->sticker_category_id=$sticker_category->id;
    $invoice->vehicle_type_id=$app->vehicleinfo->vehicleType->id;
    $invoice->days=$request->numberOfDays;
    if($sticker_category->value=='A' || $sticker_category->value=='B'){
      $invoice->fee='';
      $invoice->amount='';
      $invoice->vat='';
      $invoice->total='';
    }else{
      $invoice->fee=$app->vehicleinfo->vehicleType->fee;
      $invoice->amount=$request->totalAmount;
      $invoice->vat=$request->vatamount;
      $invoice->total=$request->grandTotal;
    }
    $invoice->collector=auth()->user()->name;
    $invoice->invoice_date=Carbon::now();
    $invoice->comments=$app->app_number;
    $invoice->save();
    $application =Application::findOrFail($app->id);
    $application->app_status="issued";
    $application->save();
  }
  
  // TODO == Mail off Temporarily
  
//   Mail::to($app->applicant->email)->send(new IssuedMail($final_issueSms));
//   if (Mail::failures()){
//     $mail_status="fail";
//   }else{
//     $mail_status="success";
//   }
  $followUpStatus="Application Issued";
  FollowUp::createFollowUp($application,$sms_sent_status,$mail_status,$followUpStatus,$final_issueSms);
  $data ="";
  if($request->pass_number !='')
  {
    $data ="Temporary Pass has been issued successfully!!";
  }else{
    $data ="Sticker has been issued successfully!!";
  }
  $flag=11;
  return array($flag,$data,$invoice,$invoice->application->app_status);

}
elseif($app->app_status == "issued"){
  $data ="This Application already  has been issued.";
  $flag=10;
  return array($flag,$data);
}

else {
  $flag=12;
  $data ="Not Approved Sticker can not be Issued.";
  return array($flag,$data);
}   
}
public function sendSms(Request $request){
  // return $request->all();
  $msg=$request->sms_text;   
  $sms_sent_status='';
  $mail_status='';
  Mail::to($request->app_email)->send(new NotifyApplicant($msg));
  if (Mail::failures()) {
    $data="Mail not sent.";
    $flag="failed";
    $mail_status='fail';
    return array($data,$flag);
  }else {
    $mail_status='success';
    $application=Application::findOrFail($request->app_id);
    $followUpStatus="Notified applicant via mail";
    FollowUp::createFollowUp($application,$sms_sent_status,$mail_status,$followUpStatus,$msg);
    $data="Mail has been sent Successfully!";
    $flag="success";
    return array($data,$flag);
  }

}
public function adminsList(){
  $admins = User::where('role','admin')->get();
  return view('layouts.admin-list',compact('admins'));
} 
public function addAdmin(Request $req){
 $this->validate($req,[
  'name' => 'required|unique:users',
  'email' => 'required|min:4',
  'role' => 'required|min:4',
  'password' => 'required|confirmed|min:4'
]);
 $user = new User; 
 $user->name=$req->name;
 $user->email=$req->email;
 $user->role=$req->role;
 $user->password=bcrypt($req->password);
 $user->save(); 
 $data ="New Admin has been added successfully.";
 return array($data,$user);
} 

public function updateAdmin(Request $req,$id){
  $user =USer::findOrFail($id);
  $user->name=$req->name;
  $user->email=$req->email;
  $user->role=$req->role;
  $user->update(); 
  $data ="Admin has been updated successfully.";
  return array($data,$user);
} 
public function deleteAdmin(Request $req){
  $user =USer::findOrFail($req->id);
  $user->delete(); 
  $data ="Admin has been deleted successfully!";
  return array($data);
}

public function undoApplication(Request $request){
  $mail_status='';
  $sms_sent_status='';
  $msg='';
  $followups = FollowUp::where('application_id',$request->app_id)->where('app_status','!=','warned')->where('app_status','!=','expired')->where('app_status','!=','')->orderBy('created_at','desc')->get();
  $undostatus=array();
  $app=Application::findOrFail($request->app_id);
  foreach($followups as $key=>$follow_up){
    array_push($undostatus,$follow_up->app_status);
  }
  foreach($undostatus as $k=>$undo ){
    if($undo=="issued"){
      if(!empty($app->vehicleSticker))
      {
        $app->vehicleSticker->delete();
      } 
      elseif(!empty($app->vehicleSticker))
      {
        $app->vehicleSticker->delete();
      }
      $app->app_status="approved";
      $app->save();
      $followUpStatus="Backed into".' '.$app->app_status;      
      break;
    }
    elseif($undo=="approved"){
     if(!empty($app->applicationNotify))
     {
       $app->applicationNotify->delete();
     }
     $app->app_status="pending";
     $app->save();

     $followUpStatus="Backed into".' '.$app->app_status;
     break;
   }
   elseif($undo=="rejected"){
    if(!empty($app->applicationNotify)){
      $app->applicationNotify->delete();
    }
    $app->app_status="pending";
    $app->rejected_date="";
    $app->save();
    $followUpStatus="Backed into".' '.$app->app_status;
    break;
  }elseif($undo=="deleted"){
    $app->app_status="pending";
    $app->save();
    $followUpStatus="Backed into".' '.$app->app_status;
    break;
  }else{
   $res = 'No more undo at this time';
   $failOrSuccess="fail";
   return array($res,$failOrSuccess);
 }
}
FollowUp::createFollowUp($app,$sms_sent_status,$mail_status,$followUpStatus,$msg);
$res='Undo done successfully';
$failOrSuccess="success";
return array($res,$failOrSuccess, $app->app_status);
}
private function callSmsApi($applicant_phone,$sms){
 $post_url = 'http://smsportal.pigeonhost.com/smsapi';  
 $post_values = array( 
  'api_key' => '5715aa02de07dc08f6197a5850b92d76407666633e087f6c44d7e4df3e4984e1eaa03d84',
    'type' => 'text',  // unicode or text
    'senderid' => '8801552146120',
    'contacts' => $applicant_phone,
    'msg' => $sms,
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
return json_decode($post_response,true);
}
}
