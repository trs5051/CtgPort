<?php

namespace App;
use App\Applicant;
use Illuminate\Database\Eloquent\Model;

class ApplicantDetail extends Model
{
    public function applicant(){
    	return $this->belongsTo(Applicant::class);
    }
}
