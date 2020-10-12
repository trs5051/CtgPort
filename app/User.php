<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ApplicationNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public static function notifyUserForUpdate($app_number,$updatedStatus){
        $users= User::all();
        foreach ($users as $user) {
            $app_dtail = array(
                "app_number" => $app_number,
                "applicant_name" => !empty(auth()->guard('applicant')->user()->name)?auth()->guard('applicant')->user()->name:auth()->user()->name,
                "action" => $updatedStatus,
            );
            $user->notify(new ApplicationNotification($app_dtail));
            
        }
    }

}
