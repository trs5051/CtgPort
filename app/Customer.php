<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomerResetPasswordNotification;

use App\Application;
use App\VehicleSticker;
class Customer extends Authenticatable
{

    use Notifiable;
    protected $guard = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }



    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function vehiclestickers()
    {
        return $this->hasmany(VehicleSticker::class);
    }
}
