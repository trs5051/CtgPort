<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Applicant;
use App\DriverInfo;
use App\HelperInfo;
use App\FollowUp;
use Carbon\Carbon;
use App\ApplicantDetail;
use App\Notifications\ApplicationNotification;
use App\User;
class DriverInfoController extends Controller
{
	public function storeDriverDetails(Request $request){
		$existent_drivers=DriverInfo::where('application_id',auth()->guard('applicant')->user()->app_id)->get();

		if(!empty($request->drivers) && count($existent_drivers)<1){
		// return $request->all();
			foreach ($request->drivers as $k1=>$driver){
				if(!empty($driver['self_driven']) && $driver['self_driven']=='1'){
					$DriverInfo = new DriverInfo;
					$DriverInfo->application_id=auth()->guard('applicant')->user()->app_id;
					$DriverInfo->app_number =auth()->guard('applicant')->user()->app_number;
					if(!empty($driver['licence_photo'])) {
						$driver_licence_filename =$k1. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
						$driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
						$driver['licence_photo']->move(base_path('images/driver_licence'), $driver_licence_name);
						$DriverInfo->licence_photo = $driver_licence_name;
					}
					if(!empty($driver['org_id_photo'])){
						$driver_org_id_fileName =$k1. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
						$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
						$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
						$DriverInfo->org_id_photo = $driver_org_id_name;
					}
					$DriverInfo->driver_is_owner =1;
					$DriverInfo->licence_validity =$driver['licence_validity'];
					$DriverInfo->save();
				}else{
					$DriverInfo = new DriverInfo;
					$DriverInfo->application_id=auth()->guard('applicant')->user()->app_id;
					$DriverInfo->app_number =auth()->guard('applicant')->user()->app_number;
					$DriverInfo->name =$driver['name'];
					$DriverInfo->nid_number = $driver['nid_number'];
					$DriverInfo->org_name = $driver['org_name'];
					$present_address = array(
						"house" => $driver['dri_pre_house'],
						"road" => $driver['dri_pre_road'],
						"block" => $driver['dri_pre_block'],
						"area" => $driver['dri_pre_area'],
					);
					$permanent_address = array(
						"p_house" => $driver['dri_per_house'],
						"p_road" => $driver['dri_per_road'],
						"p_block" => $driver['dri_per_block'],
						"p_area" => $driver['dri_per_area'],
					);
					$driver_address =array(
						"present" => $present_address,
						"permanent" => $permanent_address,
					);
					$DriverInfo->address =json_encode($driver_address);
					$DriverInfo->licence_validity =$driver['licence_validity'];
					if(!empty($driver['licence_photo'])){
						$driver_licence_filename = $k1. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
						$driver_licence_name ='/images/driver_licence/'.$driver_licence_filename;
						$driver['licence_photo']->move(base_path('images/driver_licence'),$driver_licence_name);
						$DriverInfo->licence_photo = $driver_licence_name;
					}
					if(!empty($driver['photo'])){
						$driver_photo_fileName =$k1. time() . '.' . $driver['photo']->getClientOriginalExtension();
						$driver_photo_name = '/images/driver_photo/'.$driver_photo_fileName;
						$driver['photo']->move(base_path('images/driver_photo'), $driver_photo_name);
						$DriverInfo->photo = $driver_photo_name;               
					}            
					if(!empty($driver['nid_photo'])){
						$driver_nid_fileName =$k1. time() . '.' . $driver['nid_photo']->getClientOriginalExtension();
						$driver_nid_name = '/images/driver_nid/'.$driver_nid_fileName;
						$driver['nid_photo']->move(base_path('images/driver_nid'), $driver_nid_name);
						$DriverInfo->nid_photo = $driver_nid_name;               
					}             
					if(!empty($driver['org_id_photo'])){
						$driver_org_id_fileName =$k1. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
						$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
						$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
						$DriverInfo->org_id_photo = $driver_org_id_name;
						$DriverInfo->driver_is_owner = null;
					}
					$DriverInfo->save();
				}
				
			}
		}
		elseif(!empty($existent_drivers)){
			foreach ($request->drivers as $key => $driver){
				foreach ($existent_drivers as $key2 => $existent_driver){
					if($key==$existent_driver->id){
						if (!empty($driver['self_driven']) && $driver['self_driven'] == '1')
						{
							$DriverInfo = DriverInfo::findOrFail($existent_driver->id);
							if($DriverInfo->driver_is_owner!='1'){
								\File::delete('images/driver_nid/' . basename($DriverInfo->nid_photo));
								$DriverInfo->nid_photo='';
								\File::delete('images/driver_photo/' . basename($DriverInfo->photo));
								$DriverInfo->photo='';
								if(!empty($driver['licence_photo'])) {
									\File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
									$driver_licence_filename =$key. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
									$driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
									$driver['licence_photo']->move(base_path('images/driver_licence'), $driver_licence_name);
									$DriverInfo->licence_photo = $driver_licence_name;
								}
								if(!empty($driver['org_id_photo'])){
									\File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));
									$driver_org_id_fileName =$key. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
									$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
									$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
									$DriverInfo->org_id_photo = $driver_org_id_name;
								}
								$DriverInfo->licence_validity =$driver['licence_validity'];
								$DriverInfo->name ='';
								$DriverInfo->nid_number =null;
								$DriverInfo->org_name =null;
								$DriverInfo->address ='';
								$DriverInfo->driver_is_owner='1';
								$DriverInfo->update();
							}else{
								$DriverInfo = DriverInfo::findOrFail($existent_driver->id);
								if(!empty($driver['licence_photo'])) {
									\File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
									$driver_licence_filename =$key. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
									$driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
									$driver['licence_photo']->move(base_path('images/driver_licence'), $driver_licence_name);
									$DriverInfo->licence_photo = $driver_licence_name;
								}
								if(!empty($driver['org_id_photo'])){
									\File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));
									$driver_org_id_fileName =$key. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
									$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
									$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
									$DriverInfo->org_id_photo = $driver_org_id_name;
								}
								$DriverInfo->licence_validity =$driver['licence_validity'];
								$DriverInfo->update();
							}
						}
						elseif(empty($driver['self_driven'])){
							$DriverInfo = DriverInfo::findOrFail($existent_driver->id);
							if($DriverInfo->driver_is_owner=='1'){
								$DriverInfo->driver_is_owner=null;
							}
							if(!empty($driver['licence_photo'])) {
								\File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
								$driver_licence_filename = $key. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
								$driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
								$driver['licence_photo']->move(base_path('images/driver_licence'), $driver_licence_name);
								$DriverInfo->licence_photo = $driver_licence_name;
							}
							if(!empty($driver['org_id_photo'])){
								\File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));
								$driver_org_id_fileName = $key.time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
								$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
								$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
								$DriverInfo->org_id_photo = $driver_org_id_name;
							}
							$DriverInfo->name =$driver['name'];
							$DriverInfo->nid_number = $driver['nid_number'];
							$DriverInfo->org_name = $driver['org_name'];
							$DriverInfo->licence_validity =$driver['licence_validity'];
							$present_address = array(
								"house" => $driver['dri_pre_house'],
								"road" => $driver['dri_pre_road'],
								"block" => $driver['dri_pre_block'],
								"area" => $driver['dri_pre_area'],
							);
							$permanent_address = array(
								"p_house" => $driver['dri_per_house'],
								"p_road" => $driver['dri_per_road'],
								"p_block" => $driver['dri_per_block'],
								"p_area" => $driver['dri_per_area'],
							);
							$driver_address =array(
								"present" => $present_address,
								"permanent" => $permanent_address,
							);
							$DriverInfo->address =json_encode($driver_address);
							if( !empty($driver['nid_photo'])){
								\File::delete('images/driver_nid/' . basename($DriverInfo->nid_photo));
								$driver_nid_fileName = $key.time() . '.' . $driver['nid_photo']->getClientOriginalExtension();
								$driver_nid_name = '/images/driver_nid/' . $driver_nid_fileName;
								$driver['nid_photo']->move(base_path('images/driver_nid'), $driver_nid_name);
								$DriverInfo->nid_photo = $driver_nid_name;
							}
							if(!empty($driver['photo'])) {
								\File::delete('images/driver_photo/' . basename($DriverInfo->photo));
								$driver_photo_fileName = $key. time() . '.' . $driver['photo']->getClientOriginalExtension();
								$driver_photo_name = '/images/driver_photo/' . $driver_photo_fileName;
								$driver['photo']->move(base_path('images/driver_photo'), $driver_photo_name);
								$DriverInfo->photo = $driver_photo_name;
							}
							$DriverInfo->update();
				}//elseif
			}//matching id IF
			}//foreach
			}//foreach
			if(!empty($request->newdrivers)){
				foreach ($request->newdrivers as $k10=>$driver){
					$DriverInfo = new DriverInfo;
					$DriverInfo->application_id=auth()->guard('applicant')->user()->app_id;
					$DriverInfo->app_number =auth()->guard('applicant')->user()->app_number;
					$DriverInfo->name =$driver['name'];
					$DriverInfo->nid_number = $driver['nid_number'];
					$DriverInfo->org_name = $driver['org_name'];
					$present_address = array(
						"house" => $driver['dri_pre_house'],
						"road" => $driver['dri_pre_road'],
						"block" => $driver['dri_pre_block'],
						"area" => $driver['dri_pre_area'],
					);
					$permanent_address = array(
						"p_house" => $driver['dri_per_house'],
						"p_road" => $driver['dri_per_road'],
						"p_block" => $driver['dri_per_block'],
						"p_area" => $driver['dri_per_area'],
					);
					$driver_address =array(
						"present" => $present_address,
						"permanent" => $permanent_address,
					);
					$DriverInfo->address =json_encode($driver_address);
					$DriverInfo->licence_validity =$driver['licence_validity'];
					if(!empty($driver['licence_photo'])){
						$driver_licence_filename = $k10. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
						$driver_licence_name ='/images/driver_licence/'.$driver_licence_filename;
						$driver['licence_photo']->move(base_path('images/driver_licence'),$driver_licence_name);
						$DriverInfo->licence_photo = $driver_licence_name;
					}
					if(!empty($driver['photo'])){
						$driver_photo_fileName =$k10. time() . '.' . $driver['photo']->getClientOriginalExtension();
						$driver_photo_name = '/images/driver_photo/'.$driver_photo_fileName;
						$driver['photo']->move(base_path('images/driver_photo'), $driver_photo_name);
						$DriverInfo->photo = $driver_photo_name;               
					}            
					if(!empty($driver['nid_photo'])){
						$driver_nid_fileName =$k10. time() . '.' . $driver['nid_photo']->getClientOriginalExtension();
						$driver_nid_name = '/images/driver_nid/'.$driver_nid_fileName;
						$driver['nid_photo']->move(base_path('images/driver_nid'), $driver_nid_name);
						$DriverInfo->nid_photo = $driver_nid_name;               
					}             
					if(!empty($driver['org_id_photo'])){
						$driver_org_id_fileName =$k10. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
						$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
						$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
						$DriverInfo->org_id_photo = $driver_org_id_name;
						$DriverInfo->driver_is_owner = null;
					}
					$DriverInfo->save();
				}
			}
			
		}
		
		$appStatusUp = Application::findOrFail(auth()->guard('applicant')->user()->app_id);
		if($appStatusUp->sticker_category!='F'){
			return $this->finalStageAppSubmit($appStatusUp->id, (object) $request->all());
		}
	}





	public function storeHelperDetails(Request $request){
		if(!empty($request->helpers)){
			foreach ($request->helpers as $k=>$helper){
				$HelperInfo = new HelperInfo;
				$HelperInfo->application_id=auth()->guard('applicant')->user()->app_id;
				$HelperInfo->app_number =auth()->guard('applicant')->user()->app_number;
				$HelperInfo->helper_name =$helper['helper_name'];
				$HelperInfo->helper_nid_number = $helper['helper_nid_number'];
				$present_address = array(
					"house" => $helper['helper_pre_house'],
					"road" => $helper['helper_pre_road'],
					"block" => $helper['helper_pre_block'],
					"area" => $helper['helper_pre_area'],
				);
				$permanent_address = array(
					"p_house" => $helper['helper_per_house'],
					"p_road" => $helper['helper_per_road'],
					"p_block" => $helper['helper_per_block'],
					"p_area" => $helper['helper_per_area'],
				);
				$helper_address =array(
					"present" => $present_address,
					"permanent" => $permanent_address,
				);
				$HelperInfo->helper_address =json_encode($helper_address);
				if(!empty($helper['helper_photo'])){
					$helper_photo_fileName = $k.time() . '.' . $helper['helper_photo']->getClientOriginalExtension();
					$helper_photo_name = '/images/helper_photo/'.$helper_photo_fileName;
					$helper['helper_photo']->move(base_path('images/helper_photo'), $helper_photo_name);
					$HelperInfo->helper_photo = $helper_photo_name;               
				}            
				if(!empty($helper['helper_nid_photo'])){
					$helper_nid_fileName = $k.time() . '.' . $helper['helper_nid_photo']->getClientOriginalExtension();
					$helper_nid_name = '/images/helper_nid/'.$helper_nid_fileName;
					$helper['helper_nid_photo']->move(base_path('images/helper_nid'), $helper_nid_name);
					$HelperInfo->helper_nid_photo = $helper_nid_name;               
				}             
				if(!empty($helper['helper_org_id_photo'])){
					$helper_org_id_fileName = $k.time() . '.' . $helper['helper_org_id_photo']->getClientOriginalExtension();
					$helper_org_id_name ='/images/helper_org_id/'.$helper_org_id_fileName;
					$helper['helper_org_id_photo']->move(base_path('images/helper_org_id'), $helper_org_id_name);
					$HelperInfo->helper_org_id_photo = $helper_org_id_name;
				}
				$HelperInfo->save();
			}
		}
		$appStatusUp = Application::findOrFail(auth()->guard('applicant')->user()->app_id);
		return $this->finalStageAppSubmit($appStatusUp->id, (object) $request->all());
	} 
	public function driverInfoUpdate($app_id, Request $request){
		$application = Application::findOrFail($app_id);
		$this->UpdateDriverInfo($application->driverinfoes,(object) $request->all(),$application);
		$updateStatus="updated driver detail";
		User::notifyUserForUpdate($application->app_number,$updateStatus);
		$follow_up_status="Driver Info Updated";
		FollowUp::createFollowUp($application,'','',$follow_up_status,'');
		$flag ="success";
		$data ="Driver Detail Updated Successfully!";
		return (array($data, $flag));
	}
	public function updateHelperInfo($app_id, Request $request){
		// return $request->all();
		$application = Application::findOrFail($app_id);
		if(!empty($application->helperinfoes)){
			foreach ($request->helpers as $key => $helper){
				foreach ($application->helperinfoes as $key2 => $existent_helper){
					if($key==$existent_helper->id){
						 // return  $helper['helper_nid_number'];
						$HelperInfo = HelperInfo::findOrFail($existent_helper->id);
						$HelperInfo->helper_name =$helper['helper_name'];
						$HelperInfo->helper_nid_number = $helper['helper_nid_number'];
						$present_address = array(
							"house" => $helper['helper_pre_house'],
							"road" => $helper['helper_pre_road'],
							"block" => $helper['helper_pre_block'],
							"area" => $helper['helper_pre_area'],
						);
						$permanent_address = array(
							"p_house" => $helper['helper_per_house'],
							"p_road" => $helper['helper_per_road'],
							"p_block" => $helper['helper_per_block'],
							"p_area" => $helper['helper_per_area'],
						);
						$helper_address =array(
							"present" => $present_address,
							"permanent" => $permanent_address,
						);
						$HelperInfo->helper_address =json_encode($helper_address);
						if(!empty($driver['org_id_photo'])){
							$driver_org_id_fileName =$k10. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
							$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
							$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
							$DriverInfo->org_id_photo = $driver_org_id_name;
							$DriverInfo->driver_is_owner = null;
						}

						if(!empty($helper['helper_photo'])){
							\File::delete('images/helper_photo/' . basename($HelperInfo->helper_photo));
							$helper_photo_fileName =$key. time() . '.' . $helper['helper_photo']->getClientOriginalExtension();
							$helper_photo_name = '/images/helper_photo/'.$helper_photo_fileName;
							$helper['helper_photo']->move(base_path('images/helper_photo'), $helper_photo_name);
							$HelperInfo->helper_photo = $helper_photo_name;               
						}            
						if(!empty($helper['helper_nid_photo'])){
							\File::delete('images/helper_nid/' . basename($HelperInfo->helper_nid_photo));
							$helper_nid_fileName =$key. time() . '.' . $helper['helper_nid_photo']->getClientOriginalExtension();
							$helper_nid_name = '/images/helper_nid/'.$helper_nid_fileName;
							$helper['helper_nid_photo']->move(base_path('images/helper_nid'), $helper_nid_name);
							$HelperInfo->helper_nid_photo = $helper_nid_name;               
						}             
						if(!empty($helper['helper_org_id_photo'])){
							\File::delete('images/helper_org_id/' . basename($HelperInfo->helper_org_id_photo));
							$helper_org_id_fileName =$key. time() . '.' . $helper['helper_org_id_photo']->getClientOriginalExtension();
							$helper_org_id_name ='/images/helper_org_id/'.$helper_org_id_fileName;
							$helper['helper_org_id_photo']->move(base_path('images/helper_org_id'), $helper_org_id_name);
							$HelperInfo->helper_org_id_photo = $helper_org_id_name;
						}
						$HelperInfo->update();
					}
				}
			}
		}			
		if(!empty($request->newhelpers)){
			foreach ($request->newhelpers as $k=>$helper){
				$HelperInfo = new HelperInfo;
				$HelperInfo->application_id=$application->id;
				$HelperInfo->app_number =$application->app_number;
				$HelperInfo->helper_name =$helper['helper_name'];
				$HelperInfo->helper_nid_number = $helper['helper_nid_number'];
				$present_address = array(
					"house" => $helper['helper_pre_house'],
					"road" => $helper['helper_pre_road'],
					"block" => $helper['helper_pre_block'],
					"area" => $helper['helper_pre_area'],
				);
				$permanent_address = array(
					"p_house" => $helper['helper_per_house'],
					"p_road" => $helper['helper_per_road'],
					"p_block" => $helper['helper_per_block'],
					"p_area" => $helper['helper_per_area'],
				);
				$helper_address =array(
					"present" => $present_address,
					"permanent" => $permanent_address,
				);
				$HelperInfo->helper_address =json_encode($helper_address);
				if(!empty($helper['helper_photo'])){
					$helper_photo_fileName = $k.time() . '.' . $helper['helper_photo']->getClientOriginalExtension();
					$helper_photo_name = '/images/helper_photo/'.$helper_photo_fileName;
					$helper['helper_photo']->move(base_path('images/helper_photo'), $helper_photo_name);
					$HelperInfo->helper_photo = $helper_photo_name;               
				}            
				if(!empty($helper['helper_nid_photo'])){
					$helper_nid_fileName = $k.time() . '.' . $helper['helper_nid_photo']->getClientOriginalExtension();
					$helper_nid_name = '/images/helper_nid/'.$helper_nid_fileName;
					$helper['helper_nid_photo']->move(base_path('images/helper_nid'), $helper_nid_name);
					$HelperInfo->helper_nid_photo = $helper_nid_name;               
				}             
				if(!empty($helper['helper_org_id_photo'])){
					$helper_org_id_fileName = $k.time() . '.' . $helper['helper_org_id_photo']->getClientOriginalExtension();
					$helper_org_id_name ='/images/helper_org_id/'.$helper_org_id_fileName;
					$helper['helper_org_id_photo']->move(base_path('images/helper_org_id'), $helper_org_id_name);
					$HelperInfo->helper_org_id_photo = $helper_org_id_name;
				}
				$HelperInfo->save();
			}
		}
		$updateStatus="updated helper detail";
		User::notifyUserForUpdate($application->app_number,$updateStatus);
		$follow_up_status="Helper Info Updated";
		FollowUp::createFollowUp($application,'','',$follow_up_status,'');
		$follow_up=new FollowUp;
		$flag ="success";
		$data ="Helper Info Updated Successfully!";
		return (array($data, $flag));

	}
	public function UpdateDriverInfo($existent_drivers, $request,$application){
		if(!empty($existent_drivers)){
			foreach ($request->drivers as $key => $driver){
				foreach ($existent_drivers as $key2 => $existent_driver){
					if($key==$existent_driver->id){
						if (!empty($driver['self_driven']) && $driver['self_driven'] == '1')
						{
							$DriverInfo = DriverInfo::findOrFail($existent_driver->id);
							if($DriverInfo->driver_is_owner!='1'){
								$DriverInfo = DriverInfo::findOrFail($existent_driver->id);
								\File::delete('images/driver_nid/' . basename($DriverInfo->nid_photo));
								$DriverInfo->nid_photo='';
								\File::delete('images/driver_photo/' . basename($DriverInfo->photo));
								$DriverInfo->photo='';
								if(!empty($driver['licence_photo'])) {
									\File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
									$driver_licence_filename =$key. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
									$driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
									$driver['licence_photo']->move(base_path('images/driver_licence'), $driver_licence_name);
									$DriverInfo->licence_photo = $driver_licence_name;
								}
								if(!empty($driver['org_id_photo'])){
									\File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));
									$driver_org_id_fileName =$key. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
									$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
									$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
									$DriverInfo->org_id_photo = $driver_org_id_name;
								}
								$DriverInfo->licence_validity =$driver['licence_validity'];
								$DriverInfo->name ='';
								$DriverInfo->nid_number =null;
								$DriverInfo->org_name =null;
								$DriverInfo->address ='';
								$DriverInfo->driver_is_owner='1';
								$DriverInfo->update();
							}else{
								$DriverInfo = DriverInfo::findOrFail($existent_driver->id);
								if(!empty($driver['licence_photo'])) {
									\File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
									$driver_licence_filename =$key. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
									$driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
									$driver['licence_photo']->move(base_path('images/driver_licence'), $driver_licence_name);
									$DriverInfo->licence_photo = $driver_licence_name;
								}
								if(!empty($driver['org_id_photo'])){
									\File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));
									$driver_org_id_fileName =$key. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
									$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
									$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
									$DriverInfo->org_id_photo = $driver_org_id_name;
								}
								$DriverInfo->licence_validity =$driver['licence_validity'];
								$DriverInfo->org_name =$driver['org_name'];
								$DriverInfo->update();
							}
						}
						elseif(empty($driver['self_driven'])){
							$DriverInfo = DriverInfo::findOrFail($existent_driver->id);
							if($DriverInfo->driver_is_owner=='1'){
								$DriverInfo->driver_is_owner=null;
							}
							if(!empty($driver['licence_photo'])) {
								\File::delete('images/driver_licence/' . basename($DriverInfo->licence_photo));
								$driver_licence_filename = $key. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
								$driver_licence_name = '/images/driver_licence/' . $driver_licence_filename;
								$driver['licence_photo']->move(base_path('images/driver_licence'), $driver_licence_name);
								$DriverInfo->licence_photo = $driver_licence_name;
							}
							if(!empty($driver['org_id_photo'])){
								\File::delete('images/driver_org_id/' . basename($DriverInfo->org_id_photo));
								$driver_org_id_fileName = $key.time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
								$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
								$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
								$DriverInfo->org_id_photo = $driver_org_id_name;
							}
							$DriverInfo->name =$driver['name'];
							$DriverInfo->nid_number = $driver['nid_number'];
							$DriverInfo->org_name = $driver['org_name'];
							$DriverInfo->licence_validity =$driver['licence_validity'];
							$present_address = array(
								"house" => $driver['dri_pre_house'],
								"road" => $driver['dri_pre_road'],
								"block" => $driver['dri_pre_block'],
								"area" => $driver['dri_pre_area'],
							);
							$permanent_address = array(
								"p_house" => $driver['dri_per_house'],
								"p_road" => $driver['dri_per_road'],
								"p_block" => $driver['dri_per_block'],
								"p_area" => $driver['dri_per_area'],
							);
							$driver_address =array(
								"present" => $present_address,
								"permanent" => $permanent_address,
							);
							$DriverInfo->address =json_encode($driver_address);
							if( !empty($driver['nid_photo'])){
								\File::delete('images/driver_nid/' . basename($DriverInfo->nid_photo));
								$driver_nid_fileName = $key.time() . '.' . $driver['nid_photo']->getClientOriginalExtension();
								$driver_nid_name = '/images/driver_nid/' . $driver_nid_fileName;
								$driver['nid_photo']->move(base_path('images/driver_nid'), $driver_nid_name);
								$DriverInfo->nid_photo = $driver_nid_name;
							}
							if(!empty($driver['photo'])) {
								\File::delete('images/driver_photo/' . basename($DriverInfo->photo));
								$driver_photo_fileName = $key. time() . '.' . $driver['photo']->getClientOriginalExtension();
								$driver_photo_name = '/images/driver_photo/' . $driver_photo_fileName;
								$driver['photo']->move(base_path('images/driver_photo'), $driver_photo_name);
								$DriverInfo->photo = $driver_photo_name;
							}
							$DriverInfo->update();
				}//elseif
			}//matching id IF
			}//foreach
			}//foreach
			if(!empty($request->newdrivers)){
				foreach ($request->newdrivers as $k10=>$driver){
					$DriverInfo = new DriverInfo;
					$DriverInfo->application_id=$application->id;
					$DriverInfo->app_number =$application->app_number;
					$DriverInfo->name =$driver['name'];
					$DriverInfo->nid_number = $driver['nid_number'];
					$present_address = array(
						"house" => $driver['dri_pre_house'],
						"road" => $driver['dri_pre_road'],
						"block" => $driver['dri_pre_block'],
						"area" => $driver['dri_pre_area'],
					);
					$permanent_address = array(
						"p_house" => $driver['dri_per_house'],
						"p_road" => $driver['dri_per_road'],
						"p_block" => $driver['dri_per_block'],
						"p_area" => $driver['dri_per_area'],
					);
					$driver_address =array(
						"present" => $present_address,
						"permanent" => $permanent_address,
					);
					$DriverInfo->address =json_encode($driver_address);
					$DriverInfo->licence_validity =$driver['licence_validity'];
					$DriverInfo->org_name =$driver['org_name'];
					if(!empty($driver['licence_photo'])){
						$driver_licence_filename = $k10. time() . '.' . $driver['licence_photo']->getClientOriginalExtension();
						$driver_licence_name ='/images/driver_licence/'.$driver_licence_filename;
						$driver['licence_photo']->move(base_path('images/driver_licence'),$driver_licence_name);
						$DriverInfo->licence_photo = $driver_licence_name;
					}
					if(!empty($driver['photo'])){
						$driver_photo_fileName =$k10. time() . '.' . $driver['photo']->getClientOriginalExtension();
						$driver_photo_name = '/images/driver_photo/'.$driver_photo_fileName;
						$driver['photo']->move(base_path('images/driver_photo'), $driver_photo_name);
						$DriverInfo->photo = $driver_photo_name;               
					}            
					if(!empty($driver['nid_photo'])){
						$driver_nid_fileName =$k10. time() . '.' . $driver['nid_photo']->getClientOriginalExtension();
						$driver_nid_name = '/images/driver_nid/'.$driver_nid_fileName;
						$driver['nid_photo']->move(base_path('images/driver_nid'), $driver_nid_name);
						$DriverInfo->nid_photo = $driver_nid_name;               
					}             
					if(!empty($driver['org_id_photo'])){
						$driver_org_id_fileName =$k10. time() . '.' . $driver['org_id_photo']->getClientOriginalExtension();
						$driver_org_id_name ='/images/driver_org_id/'.$driver_org_id_fileName;
						$driver['org_id_photo']->move(base_path('images/driver_org_id'), $driver_org_id_name);
						$DriverInfo->org_id_photo = $driver_org_id_name;
						$DriverInfo->driver_is_owner = null;
					}
					$DriverInfo->save();
				}
			}
			
		}

	}
	public function finalStageAppSubmit($appId,$request){
		$appStatusUp = Application::findOrFail($appId);
		$appStatusUp->app_status = "pending";
		$appStatusUp->app_date=Carbon::now();
		$appStatusUp->update();
		$applicantUp=Applicant::findOrFail($appStatusUp->applicant_id);
		$applicantUp->app_number='';
		$applicantUp->app_id='';
		$applicantUp->update(); 
		$follow_up=new FollowUp;
		$follow_up->application_id=$appStatusUp->id;
		$follow_up->app_status=$appStatusUp->app_status;
		$follow_up->status="Application requested";
		$follow_up->updater_role='customer';
		$follow_up->updated_by=auth()->guard('applicant')->user()->name;
		$follow_up->created_date=Carbon::now();
		$follow_up->save();
		if(!empty($request->renew_app)&&$request->renew_app=="yes"){
			$old_app = Application::findOrFail($request->app_id);
			$old_app->renew = 'renew-applied. New appId:'.$appStatusUp->id;
			$old_app->save();
			$data ="Application Submitted for Renew Successfully!!";
			$renew_flag ="success for renew";
		}else{
			$data ="New Application Submitted Successfully!!";
			$renew_flag ="success renew";	
		}
		return (array($data, $renew_flag, $appStatusUp->id));
	}
	public function removeDriver($driverId){
		// return $driverId;
		$driver=DriverInfo::findOrFail($driverId);
		if(count($driver->application->driverinfoes)>1){
			\File::delete('images/driver_photo/' . basename($driver->photo));
			\File::delete('images/driver_nid/' . basename($driver->nid_photo));
			\File::delete('images/driver_licence/' . basename($driver->licence_photo));
			\File::delete('images/driver_org_id/' . basename($driver->org_id_photo));
			$driver->delete();
			$success_flag ="success";
			$data ="Requested Driver Info Deleted Successfully!!";
		}else{
			$success_flag ="not-success";
			$data ="Application Not Valid Without Any Driver. Thank you";
		}
		return (array($data, $success_flag,$driverId));
	}
	public function removeHelper($helperId){
		// return $helperId;
		$helper=HelperInfo::findOrFail($helperId);
		if(count($helper->application->helperinfoes)>1){
			\File::delete('images/helper_photo/' . basename($helper->photo));
			\File::delete('images/helper_nid/' . basename($helper->nid_photo));
			\File::delete('images/helper_org_id/' . basename($helper->org_id_photo));
			$helper->delete();
			$success_flag ="success";
			$data ="Requested Helper Info Deleted Successfully!!";
		}else{
			$success_flag ="not-success";
			$data ="Application Not Valid Without Any Helper. Thank you";
		}
		return (array($data, $success_flag,$helperId));
	}

}
