<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\VehicleSticker;
use App\Application;
use App\Sms;
use App\SmsApplicant;
use DB;
class ExpiredAppsActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExpiredAppsActive:expireStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Do Issued status to Expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mytime =Carbon::now()->toDateString();
        $fifteen_days = Carbon::now()->addDays(15)->toDateString();

        $stickers=VehicleSticker::all();
        foreach ($stickers as $key => $sticker) {
          if($fifteen_days == $sticker->exp_date && $sticker->sms_exp_warn=='' && $sticker->sms_exp_expired==''){
            $app = Application::findOrFail($sticker->application->id);
            $app->app_status = "warning";
            $app->renew="renew-warned";
            $app->save();
            $stick=VehicleSticker::findOrFail($sticker->id);
            $stick->sms_exp_warn="warned";
            $stick->sms_exp_expired="will be expired";
            $stick->save();
            $sms=Sms::where('type', 'warning')->first();
            $sms_add_reg=str_replace('/reg/',$sticker->reg_number, $sms->sms_text); 
            $sms_final=str_replace('/date/',$sticker->exp_date, $sms_add_reg);



            $post_url = 'http://smsportal.pigeonhost.com/smsapi' ;  
            $post_values = array( 
                'api_key' => '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c25b5',
                'type' => 'text',  // unicode or text
                'senderid' => '8801552146120',
                'contacts' => $sticker->applicant->phone,
                'msg' => $sms_final,
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
                $sms_applicant->application_id =  $app->id;
                $sms_applicant->sms_id = $sms->id;
                $sms_applicant->sms_status = $sms->type;
                $sms_applicant->api_CamID = $res['CamID'];
                $sms_applicant->save();
            }
        }   
        if($mytime > $sticker->exp_date && $sticker->sms_exp_warn=='warned' && $sticker->sms_exp_expired=="will be expired"){
            $app = Application::findOrFail($sticker->application->id);
            $app->app_status = "expired";
            $app->renew="renew-expired";
            $app->save();
            $stick=VehicleSticker::findOrFail($sticker->id);
            $stick->sms_exp_warn="warned";
            $stick->sms_exp_expired="expired";
            $stick->save();            
            $sms=Sms::where('type', 'expired')->first();
            $sms_add_reg=str_replace('/reg/',$sticker->reg_number, $sms->sms_text); 
            $sms_final=str_replace('/date/',$sticker->exp_date, $sms_add_reg);

            $post_url = 'http://smsportal.pigeonhost.com/smsapi' ;  
            $post_values = array( 
                'api_key' => '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c25b5',
                'type' => 'text',  // unicode or text
                'senderid' => '8801552146120',
                'contacts' => $sticker->applicant->phone,
                'msg' => $sms_final,
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
                $sms_applicant->application_id =  $app->id;
                $sms_applicant->sms_id = $sms->id;
                $sms_applicant->sms_status = $sms->type;
                $sms_applicant->api_CamID = $res['CamID'];
                $sms_applicant->save();
            }

        }
    }
    // $temps=DB::table('temporary_passes')->groupBy('application_id')->get(['application_id',DB::raw('MAX(exp_date) as exp_date')]);
    // foreach ($temps as $key => $temp){
    //     if($mytime > $temp->exp_date){
    //         $app = Application::where('id',$temp->application_id)->first();
    //         $app->app_status = "expired";
    //         $app->renew="renew-expired";
    //         $app->save();
    //     }
    // }
}
}
