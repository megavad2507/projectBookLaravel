<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code','value','type','currency_id','only_once','expired_at','description'];

    protected $dates = ['expired_at'];

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function setTypeAttribute($value) {
        $this->attributes['type'] = $value === 'on' ? 1 : 0;
    }

    public function setOnlyOnceAttribute($value) {
        $this->attributes['only_once'] = $value === 'on' ? 1 : 0;
    }
    public function getTypeAttribute($value) {
        return $value == 0 ? '%' : 'Абсолютный';
    }


    public function isAbsolute() {
        return $this->type == 1;
    }

    public function isOnlyOnce() {
        return $this->only_once == 1;
    }

    use HasFactory;
}
