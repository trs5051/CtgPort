<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Application;
use App\VehicleInfo;
use App\VehicleOwner;
use App\FollowUp;
use Auth;
use App\Notifications\ApplicationNotification;
use App\User;
use Carbon\Carbon;
class VehicleInfoController extends Controller
{
	public function storeVehicleDetails(Request $request){
		$exist_stickers = VehicleInfo::where('reg_number',$request->vehicle_reg_no)->get();
		$pending_count=0;
		$approve_count=0; 
		if(!empty($exist_stickers) && count($exist_stickers)>0){
			foreach($exist_stickers as $exist_sticker){
				if($exist_sticker->application->app_status =='pending' ){
					$pending_count++; 
				} 
				if($exist_sticker->application->app_status =='approved' ){
					$approve_count++;
				}
			}
		}
		if($pending_count==0 && $approve_count==0){
			$existentVehicleinfo = VehicleInfo::where('application_id',auth()->guard('applicant')->user()->app_id)->first();
			$existentOwnerinfo = VehicleOwner::where('application_id',auth()->guard('applicant')->user()->app_id)->first();
			if(!empty($existentVehicleinfo) && !empty($existentOwnerinfo)){

				$this->UpdatevehicleInfo($existentVehicleinfo->id,$existentOwnerinfo->id,(object) $request->all());

				$app = Application::findOrFail($existentVehicleinfo->application_id);
				$app->vehicle_type_id = $request->vehicle_type;
				$app->update();

			}else{
				$VehicleInfo = new VehicleInfo;
				$VehicleInfo->application_id=auth()->guard('applicant')->user()->app_id;
				$VehicleInfo->app_number=auth()->guard('applicant')->user()->app_number;   
				$VehicleInfo->insurance_validity=$request->insurance_validity;
				$VehicleInfo->fitness_validity=$request->fitnness_validity;
				$VehicleInfo->tax_token_validity=$request->tax_paid_upto;
				$VehicleInfo->necessity_to_use=$request->necessity_to_use;
				$VehicleInfo->reg_number=$request->vehicle_reg_no;
				$VehicleInfo->chassis_number=$request->vehicle_chassis_no;
				$VehicleInfo->vehicle_type_id=$request->vehicle_type;           
				if($request->hasFile('vehicle_reg_photo')){
					$vehicle_reg_filename = time() . '.' . $request->vehicle_reg_photo->getClientOriginalExtension();
					$vehicle_reg_name ='/images/vehicle_reg/'.$vehicle_reg_filename;
					$request->vehicle_reg_photo->move(base_path('images/vehicle_reg'), $vehicle_reg_name);
					$VehicleInfo->reg_cert_photo = $vehicle_reg_name;
				}
				if(!empty($request->renew_request) && $request->renew_request=='yes' && empty($request->hasFile('vehicle_reg_photo'))){
					$old_app = Application::findOrFail($request->app_id);
					$VehicleInfo->reg_cert_photo=$old_app->vehicleinfo->reg_cert_photo;  
				}
				if($request->hasFile('tax_token_photo')){
					$vehicle_tax_token_filename = time() . '.' . $request->tax_token_photo->getClientOriginalExtension();
					$vehicle_tax_token_name ='/images/vehicle_tax_token/'.$vehicle_tax_token_filename;
					$request->tax_token_photo->move(base_path('images/vehicle_tax_token'), $vehicle_tax_token_name);
					$VehicleInfo->tax_token_photo = $vehicle_tax_token_name;
				}
				if($request->hasFile('insurance_cert_photo')){
					$vehicle_insurance_filename = time() . '.' . $request->insurance_cert_photo->getClientOriginalExtension();
					$vehicle_insurance_name ='/images/vehicle_insurance/'.$vehicle_insurance_filename;
					$request->insurance_cert_photo->move(base_path('images/vehicle_insurance'), $vehicle_insurance_name);
					$VehicleInfo->insurance_cert_photo = $vehicle_insurance_name;
				}
				if($request->hasFile('fitness_cert_photo')){
					$vehicle_fitness_filename = time() . '.' . $request->fitness_cert_photo->getClientOriginalExtension();
					$vehicle_fitness_name = '/images/vehicle_fitness/'.$vehicle_fitness_filename;
					$request->fitness_cert_photo->move(base_path('images/vehicle_fitness'), $vehicle_fitness_name);
					$VehicleInfo->fitness_cert_photo = $vehicle_fitness_name;
				}
				if($request->hasFile('road_permit_photo')){          
					$road_permit_filename = time() . '.' . $request->road_permit_photo->getClientOriginalExtension();
					$road_permit_name = '/images/vehicle_road_permit/'.$road_permit_filename;
					$request->road_permit_photo->move(base_path('images/vehicle_road_permit'), $road_permit_name);
					$VehicleInfo->road_permit_photo = $road_permit_name;
				}
				if($request->hasFile('entry_pass_photo')){ 
					$vehicle_port_entry_pass_filename = time() . '.' . $request->entry_pass_photo->getClientOriginalExtension();
					$vehicle_port_entry_pass_name = '/images/vehicle_port_pass/'.$vehicle_port_entry_pass_filename;
					$request->entry_pass_photo->move(base_path('images/vehicle_port_pass'), $vehicle_port_entry_pass_name);
					$VehicleInfo->port_entry_pass_photo = $vehicle_port_entry_pass_name;
				}
				if($request->hasFile('jt_licence_photo')){
					$vehicle_jt_licence_copy_filename = time() . '.' . $request->jt_licence_photo->getClientOriginalExtension();
					$vehicle_jt_licence_copy_name = '/images/vehicle_jt_licence/'.$vehicle_jt_licence_copy_filename;
					$request->jt_licence_photo->move(base_path('images/vehicle_jt_licence'), $vehicle_jt_licence_copy_name);
					$VehicleInfo->jt_licence_photo = $vehicle_jt_licence_copy_name;
				}
				$VehicleInfo->save();
				$VehicleOwner = new VehicleOwner;
				$VehicleOwner->application_id=auth()->guard('applicant')->user()->app_id;
				$VehicleOwner->nid_number=$request->owner_nid;
				$VehicleOwner->app_number=auth()->guard('applicant')->user()->app_number; 
				$present = array(
					"pre_house" => $request->o_house,
					"pre_road" => $request->o_road,
					"pre_block" => $request->o_block,
					"pre_area" => $request->o_area,
				);
				$permanent = array(
					"per_house" => $request->o_per_house,
					"per_road" => $request->o_per_road,
					"per_block" => $request->o_per_block,
					"per_area" => $request->o_per_area,
				);
				$address = array(
					"present" => $present,
					"permanent" =>$permanent,
				);
				$com_address=array(
					"house" => $request->c_house,
					"road" => $request->c_road,
					"block" => $request->c_block,
					"area" => $request->c_area, 
				);
				if($request->owner_is_company == "1"){
					$VehicleOwner->company_name= $request->company_name;
					$VehicleOwner->company_address=json_encode($com_address);
				}
				$VehicleOwner->owner_name= $request->owner_name;
				$VehicleOwner->owner_address=json_encode($address);
				if($request->hasFile('owner_nid_photo')){
					$vehicle_owner_nid_filename = time() . '.' . $request->owner_nid_photo->getClientOriginalExtension();
					$vehicle_owner_nid_name = '/images/vehicle_owner_nid/'.$vehicle_owner_nid_filename;
					$request->owner_nid_photo->move(base_path('images/vehicle_owner_nid'), $vehicle_owner_nid_name);
					$VehicleOwner->nid_photo = $vehicle_owner_nid_name;
				}
				if(!empty($request->renew_request) && $request->renew_request=='yes' && empty($request->hasFile('owner_nid_photo'))){
					$old_app = Application::findOrFail($request->app_id);
					$VehicleOwner->nid_photo=$old_app->vehicleowner->nid_photo;   
				}
				$VehicleOwner->save();
				$app = Application::findOrFail($VehicleInfo->application_id);
				$app->vehicle_type_id = $request->vehicle_type;
				$app->update();
			}
		}else{
			$data ="You have already applied for this vehicle.";
			$flag ="already-applied";
			return (array($data, $flag));
		}
	}
	public function vehicleInfoUpdate($app_id, Request $request){ 
		$application = Application::findOrFail($app_id);
		
		$this->UpdatevehicleInfo($application->vehicleinfo->id,$application->vehicleowner->id,(object) $request->all());
		$follow_up_status="Vehicle Info Updated";
		FollowUp::createFollowUp($application->id,$follow_up_status);
		$updateStatus="updated vehicle detail";
		User::notifyUserForUpdate($application->app_number,$updateStatus);
		$flag ="success";
		$data ="Vehicle Detail Updated Successfully!";
		return (array($data, $flag));

	}
	public function UpdatevehicleInfo($vehicleInfoId,$ownerInfoId,$request){
		$VehicleInfo =VehicleInfo::findOrFail($vehicleInfoId);
		$VehicleInfo->insurance_validity=$request->insurance_validity;
		$VehicleInfo->fitness_validity=$request->fitnness_validity;
		$VehicleInfo->tax_token_validity=$request->tax_paid_upto;
		$VehicleInfo->necessity_to_use=$request->necessity_to_use;
		$VehicleInfo->reg_number=$request->vehicle_reg_no;
		$VehicleInfo->chassis_number=$request->vehicle_chassis_no;
		$VehicleInfo->vehicle_type_id=$request->vehicle_type;
		if(!empty($request->vehicle_reg_photo)){
			\File::delete('images/vehicle_reg/' . basename($VehicleInfo->reg_cert_photo));
			$vehicle_reg_filename = time() . '.' . $request->vehicle_reg_photo->getClientOriginalExtension();
			$vehicle_reg_name = '/images/vehicle_reg/' . $vehicle_reg_filename;
			$request->vehicle_reg_photo->move(base_path('images/vehicle_reg'), $vehicle_reg_name);
			$VehicleInfo->reg_cert_photo = $vehicle_reg_name;
		}
		if(!empty($request->insurance_cert_photo)) {
			\File::delete('images/vehicle_insurance/' . basename($VehicleInfo->insurance_cert_photo));

			$vehicle_insurance_filename = time() . '.' . $request->insurance_cert_photo->getClientOriginalExtension();
			$vehicle_insurance_name = '/images/vehicle_insurance/' . $vehicle_insurance_filename;
			$request->insurance_cert_photo->move(base_path('images/vehicle_insurance'), $vehicle_insurance_name);
			$VehicleInfo->insurance_cert_photo = $vehicle_insurance_name;
		}
		if(!empty($request->tax_token_photo)) {
			\File::delete('images/vehicle_tax_token/' . basename($VehicleInfo->tax_token_photo));

			$vehicle_tax_token_filename = time() . '.' . $request->tax_token_photo->getClientOriginalExtension();
			$vehicle_tax_token_name = '/images/vehicle_tax_token/' . $vehicle_tax_token_filename;
			$request->tax_token_photo->move(base_path('images/vehicle_tax_token'), $vehicle_tax_token_name);
			$VehicleInfo->tax_token_photo = $vehicle_tax_token_name;
		}
		if(!empty($request->fitness_cert_photo)){
			\File::delete('images/vehicle_fitness/' . basename($VehicleInfo->fitness_cert_photo));

			$vehicle_fitness_filename = time() . '.' . $request->fitness_cert_photo->getClientOriginalExtension();
			$vehicle_fitness_name = '/images/vehicle_fitness/'.$vehicle_fitness_filename;
			$request->fitness_cert_photo->move(base_path('images/vehicle_fitness'), $vehicle_fitness_name);
			$VehicleInfo->fitness_cert_photo = $vehicle_fitness_name;
		}
		if(!empty($request->road_permit_photo)){
			\File::delete('images/vehicle_road_permit/' . basename($VehicleInfo->road_permit_photo));

			$road_permit_filename = time() . '.' . $request->road_permit_photo->getClientOriginalExtension();
			$road_permit_name = '/images/vehicle_road_permit/'.$road_permit_filename;
			$request->road_permit_photo->move(base_path('images/vehicle_road_permit'), $road_permit_name);
			$VehicleInfo->road_permit_photo = $road_permit_name;
		}
		if(!empty($request->entry_pass_photo)){
			\File::delete('images/vehicle_port_pass/' . basename($VehicleInfo->port_entry_pass_photo));

			$vehicle_port_entry_pass_filename = time() . '.' . $request->entry_pass_photo->getClientOriginalExtension();
			$vehicle_port_entry_pass_name = '/images/vehicle_port_pass/'.$vehicle_port_entry_pass_filename;
			$request->entry_pass_photo->move(base_path('images/vehicle_port_pass'), $vehicle_port_entry_pass_name);
			$VehicleInfo->port_entry_pass_photo = $vehicle_port_entry_pass_name;
		}
		if(!empty($request->jt_licence_photo)){
			\File::delete('images/vehicle_jt_licence/' . basename($VehicleInfo->jt_licence_photo));

			$vehicle_jt_licence_copy_filename = time() . '.' . $request->jt_licence_photo->getClientOriginalExtension();
			$vehicle_jt_licence_copy_name = '/images/vehicle_jt_licence/'.$vehicle_jt_licence_copy_filename;
			$request->jt_licence_photo->move(base_path('images/vehicle_jt_licence'), $vehicle_jt_licence_copy_name);
			$VehicleInfo->jt_licence_photo = $vehicle_jt_licence_copy_name;
		}
		$VehicleInfo->update();

		$VehicleOwner =VehicleOwner::findOrFail($ownerInfoId);
		$VehicleOwner->nid_number=$request->owner_nid;
		$present = array(
			"pre_house" => $request->o_house,
			"pre_road" => $request->o_road,
			"pre_block" => $request->o_block,
			"pre_area" => $request->o_area,
		);
		$permanent = array(
			"per_house" => $request->o_per_house,
			"per_road" => $request->o_per_road,
			"per_block" => $request->o_per_block,
			"per_area" => $request->o_per_area,
		);
		$address = array(
			"present" => $present,
			"permanent" =>$permanent,
		);
		$com_address=array(
			"house" => $request->c_house,
			"road" => $request->c_road,
			"block" => $request->c_block,
			"area" => $request->c_area,
		);
		if(!empty($request->owner_is_company) && $request->owner_is_company == "1"){
			$VehicleOwner->company_name= $request->company_name;
			$VehicleOwner->company_address=json_encode($com_address);
		}
		$VehicleOwner->owner_name= $request->owner_name;
		$VehicleOwner->owner_address=json_encode($address);
		if(!empty($request->owner_nid_photo)){
			\File::delete('images/vehicle_owner_nid/' . basename($VehicleOwner->nid_photo));

			$vehicle_owner_nid_filename = time() . '.' . $request->owner_nid_photo->getClientOriginalExtension();
			$vehicle_owner_nid_name = '/images/vehicle_owner_nid/'.$vehicle_owner_nid_filename;
			$request->owner_nid_photo->move(base_path('images/vehicle_owner_nid'), $vehicle_owner_nid_name);
			$VehicleOwner->nid_photo = $vehicle_owner_nid_name;
		}
		$VehicleOwner->update();
	}
}
