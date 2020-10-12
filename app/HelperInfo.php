<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Application;

class HelperInfo extends Model
{
	public function application()
	{
		return $this->belongsTo(Application::class);
	} 
}
