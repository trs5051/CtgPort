<?php

namespace App;
use App\Application;
use App\Sticker;
use Illuminate\Database\Eloquent\Model;

class StickerCategory extends Model
{
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function invoices()
    {
        return $this->hasMany(Sticker::class);
    }
}
