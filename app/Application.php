<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Applicant;
use App\DriverInfo;
use App\VehicleInfo;
use App\VehicleType;
use App\StickerCategory;
use App\VehicleSticker;
use App\Invoice;
use App\SmsApplicant;
use App\HelperInfo;
use App\TemporaryPass;
use App\ApplicationNotify;
class Application extends Model
{

    public function driverinfoes()
    {
        return $this->hasMany(DriverInfo::class);
    }
    public function helperinfoes()
    {
        return $this->hasMany(HelperInfo::class);
    }
    public function vehicleowner()
    {
        return $this->hasOne(VehicleOwner::class);
    }
    public function vehicleSticker()
    {
        return $this->hasOne(VehicleSticker::class);
    }
    public function vehicleinfo()
    {
        return $this->hasOne(VehicleInfo::class);
    }
    
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }
    public function stickerCategory()
    {
        return $this->hasOne(StickerCategory::class);
    }  
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function temporaryPasses()
    {
        return $this->hasMany(TemporaryPass::class);
    } 
    public function applicationNotify()
    {
        return $this->hasOne(ApplicationNotify::class);
    } 
    
    public function smsApplicants()
    {
        return $this->hasMany(SmsApplicant::class);
    }
    public function followups()
    {
        return $this->hasMany(FollowUp::class);
    }
    

}
