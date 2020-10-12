<?php

namespace App\Http\Controllers;
use App\StickerCategory;

use Illuminate\Http\Request;
use App\VehicleType;
class ApplicantController extends Controller
{
	 public function __construct()
    {
        $this->middleware('applicant');
    }

      public function applyForm(){
      	$stickers=StickerCategory::all();
      	$vehicleTypes=VehicleType::all();
    	return view('applyForm',compact('stickers','vehicleTypes'));
    }   
      public function showAppliedForms(){
    	return view('layouts.applied-forms');
    }
}
