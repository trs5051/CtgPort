<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sms;
use Auth;
class SmsController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
  public function smsPanel(){
  $all_sms=Sms::where('type','manual')->get();
  return view('layouts.sms-panel',compact('all_sms'));
}
  public function smsAdd(Request $req){
       $this->validate($req,[
            'sms_template_name' => 'required|unique:sms',
            'sms_subject' => 'required|min:4',
            'sms_text' => 'required|min:4'
    ]);
   	$sms = new Sms;
   	$sms->sms_template_name=$req->sms_template_name;
   	$sms->type='manual';
   	$sms->sms_subject=$req->sms_subject;
   	$sms->sms_text=$req->sms_text;
   	$sms->creator=auth()->user()->name;
   	$sms->updater='';
   	$sms->save();	
   	$data ="SMS has been added successfully.";
    return array($data,$sms);
   } 
    public function smsUpdate(Request $req,$id){
    $sms =Sms::findOrFail($id);
    if($sms->sms_template_name!=$req->sms_template_name){
    $sms->sms_template_name=$req->sms_template_name;
    }
    $sms->sms_subject=$req->sms_subject;
    $sms->sms_text=$req->sms_text;
    $sms->updater=Auth::user()->name;
    $sms->update(); 
    $data ="SMS has been updated successfully.";
    return array($data,$sms);
   }   
    public function smsDelete(Request $req){
    $sms =Sms::findOrFail($req->id);
    $sms->delete(); 
    $data ="SMS has been deleted successfully!";
    return array($data);
   }   
   

}
