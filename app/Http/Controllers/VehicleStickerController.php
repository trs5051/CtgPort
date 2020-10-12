<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VehicleSticker;
use App\Application;
use Carbon\Carbon;
class VehicleStickerController extends Controller
{
    public function renewRequest($id){
    	 $allocated_sticker=VehicleSticker::find($id);
    	 $renew_app=Application::findOrFail($allocated_sticker->application_id);
    	 $now = Carbon::now()->addDays(15)->toDateString();
    	 if($now >=$allocated_sticker->exp_date){
 			return view('layouts.renew',compact('renew_app'));
 			 }
    }
}
