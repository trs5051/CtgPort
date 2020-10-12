<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class FollowUp extends Model
{
	public function application()
	{
		return $this->belongsTo(Application::class);
	}
	public static function createFollowUp($app,$sms_sent_status,$mail_status,$followUpStatus,$sms){
		$follow_up=new FollowUp;
		$follow_up->application_id=$app->id;
		$follow_up->app_status=$app->app_status;
		$follow_up->sms_sent=$sms_sent_status;
		$follow_up->mail_sent=$mail_status;
		$follow_up->updater_role=!empty(auth()->guard('applicant')->user()->name)?'customer':auth()->user()->role;
		$follow_up->status=$followUpStatus;
		$follow_up->created_date=Carbon::now();
		$follow_up->comment=$sms;
		$follow_up->updated_by=!empty(auth()->guard('applicant')->user()->name)?auth()->guard('applicant')->user()->name:auth()->user()->name;
		$follow_up->save();
	}
}
