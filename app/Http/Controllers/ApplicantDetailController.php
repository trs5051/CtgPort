<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Applicant;
use App\ApplicantDetail;
use App\Application;
use App\FollowUp;
use Auth;
use App\Notifications\ApplicationNotification;
use App\User;
use Carbon\Carbon; 
class ApplicantDetailController extends Controller
{
	public function storeApplicantDetails(Request $request){
		$application = null;
		if(empty(auth()->guard('applicant')->user()->app_id) && empty(auth()->guard('applicant')->user()->app_number)){
			$application = $this->CreateNewApplication((object) $request->all());
			$applicant = $this->updateApplicant($application, (object) $request->all());
			if($request->sticker_category=='E' || $request->sticker_category=='M' || $request->sticker_category=='S' || $request->sticker_category=='T'|| $request->sticker_category=='F'){
				if(empty(auth()->guard('applicant')->user()->applicantDetail)){
					$this->CreateNewApplicantDetail((object) $request->all());
				}				
				elseif(!empty(auth()->guard('applicant')->user()->applicantDetail)){
					$this->UpdateApplicantInfo($application,(object) $request->all());
				}
			}
		}elseif(!empty(auth()->guard('applicant')->user()->app_id) && !empty(auth()->guard('applicant')->user()->app_number)){
			if($request->hasFile('app_photo') || $request->sticker_category!=''){
				$application = $this->UpdateApplication(auth()->guard('applicant')->user()->app_id,(object) $request->all());
			}
			if($request->sticker_category=='E' || $request->sticker_category=='M' || $request->sticker_category=='S' || $request->sticker_category=='T'|| $request->sticker_category=='F'){
				if(!empty(auth()->guard('applicant')->user()->applicantDetail)){
					$this->UpdateApplicantInfo($application,(object) $request->all());
				}
			}
		}
	}
	public function updateFormBApplication(Request $request, $app_id){
		$application = Application::findOrFail($app_id);
		if(!empty($request->app_photo) || $request->sticker_category!=$application->sticker_category){
			$this->UpdateApplication($application->id,(object) $request->all());
		}
	}
	public function updateApplicantDetail(Request $request, $app_id){
		$application = Application::findOrFail($app_id);
		if(!empty($request->app_photo) || $request->sticker_category!=$application->sticker_category){
			$this->UpdateApplication($application->id,(object) $request->all());
		}
	$applicant = $this->updateApplicant($application, (object) $request->all());
// 		$updateStatus="updated applicant detail";
		$this->UpdateApplicantInfo($application,(object) $request->all());
		$updateStatus="updated applicant detail";
		User::notifyUserForUpdate($application->app_number,$updateStatus);
		$follow_up_status="Applicant Info Updated";
		FollowUp::createFollowUp($application,'','',$follow_up_status,'');
		$flag = "success";
		$data = "Applicant Details Updated Successfully!";
		return (array($data,$flag));
	}
	public static function updateApplicant($app,$request){
	    if(!empty(Auth::guard('applicant')->user()->id)){
	    $applicant = Applicant::findOrFail(Auth::guard('applicant')->user()->id);
		$applicant->name = !empty($request->applicant_name)?$request->applicant_name:auth()->guard('applicant')->user()->name;
		$applicant->phone = !empty($request->applicant_phone)?$request->applicant_phone:auth()->guard('applicant')->user()->phone;
		$applicant->email = !empty($request->applicant_email)?$request->applicant_email:auth()->guard('applicant')->user()->email;
		$applicant->app_id=$app->id;
		$applicant->app_number=$app->app_number;
		$applicant->update();
		return $applicant;
	    }else{
	    $applicant = Applicant::findOrFail($app->applicant->id);
		$applicant->name = !empty($request->applicant_name)?$request->applicant_name:auth()->guard('applicant')->user()->name;
		$applicant->phone = !empty($request->applicant_phone)?$request->applicant_phone:auth()->guard('applicant')->user()->phone;
		$applicant->email = !empty($request->applicant_email)?$request->applicant_email:auth()->guard('applicant')->user()->email;
		$applicant->update();
		return $applicant; 
	    }
	
	}
	public static function CreateNewApplication($request){
		$application = new Application;
		$application->app_number = (time()+rand(10,1000));
		$application->applicant_id=Auth::guard('applicant')->user()->id;
		$application->app_status="processing";
		$application->app_date='';
		$application->vehicle_type_id='';
		$application->sticker_category=$request->sticker_category;
		if(!empty($request->app_photo)){
			$applicationname = time() . '.' . $request->app_photo->getClientOriginalExtension();
			$name = '/images/application/'.$applicationname;
			$request->app_photo->move(base_path('images/application'), $name);
			$application->app_photo = $name;
		}
		$application->save();
		return $application;
	}
	public static function CreateNewApplicantDetail($request){
		$ApplicantDetail = new ApplicantDetail;
		if(!empty($request->applicant_photo) && !empty($request->applicant_nid_photo)){
			$applicant_photo_fileName = time() . '.' . $request->applicant_photo->getClientOriginalExtension();
			$applicant_photo_name = '/images/applicant_photo/'.$applicant_photo_fileName;
			$request->applicant_photo->move(base_path('images/applicant_photo'), $applicant_photo_name);
			$ApplicantDetail->applicant_photo = $applicant_photo_name;
			$applicant_nid_fileName = time() . '.' . $request->applicant_nid_photo->getClientOriginalExtension();
			$applicant_nid_name ='/images/applicant_nid/'.$applicant_nid_fileName;
			$request->applicant_nid_photo->move(base_path('images/applicant_nid'), $applicant_nid_name);
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
		$ApplicantDetail->applicant_id =Auth::guard('applicant')->user()->id;
		$ApplicantDetail->address = json_encode($applicant_address);
		$ApplicantDetail->nid_number = $request->applicant_nid;
		$ApplicantDetail->profession = $request->profession;
		$ApplicantDetail->designation = $request->designation;
		$ApplicantDetail->company_name = $request->ap_company_name;
		$ApplicantDetail->save();
	}
	public static function UpdateApplication($appId,$request){
		$application = Application::findOrFail($appId);
		$application->sticker_category=$request->sticker_category;
		if(!empty($request->app_photo)){
			$applicationname = time() . '.' . $request->app_photo->getClientOriginalExtension();
			$name = '/images/application/'.$applicationname;
			$request->app_photo->move(base_path('images/application'), $name);
			$application->app_photo = $name;
		}
		$application->update();
		return $application;
	}
	public function UpdateApplicantInfo($application,$request){
		$ApplicantDetail = ApplicantDetail::findOrFail($application->applicant->applicantDetail->id);
		if( !empty($request->applicant_photo) ){
			\File::delete('images/applicant_photo/' . basename($ApplicantDetail->applicant_photo));
			$applicant_photo_fileName = time() . '.' . $request->applicant_photo->getClientOriginalExtension();
			$applicant_photo_name = '/images/applicant_photo/'.$applicant_photo_fileName;
			$request->applicant_photo->move(base_path('images/applicant_photo'), $applicant_photo_name);
			$ApplicantDetail->applicant_photo = $applicant_photo_name;
		}
		if(!empty($request->applicant_nid_photo)){
			\File::delete('images/applicant_nid/' . basename($ApplicantDetail->nid_photo));
			$applicant_nid_fileName = time() . '.' . $request->applicant_nid_photo->getClientOriginalExtension();
			$applicant_nid_name ='/images/applicant_nid/'.$applicant_nid_fileName;
			$request->applicant_nid_photo->move(base_path('images/applicant_nid'), $applicant_nid_name);
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
		if (!empty($request->guardian) && $request->guardian == 1){
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
		$ApplicantDetail->company_name = $request->ap_company_name;
		$ApplicantDetail->Update();
	}
}
