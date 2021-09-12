<?php

namespace App\Models;

use App\Services\CurrencyConversion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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


    public function isAbsolute() {
        return $this->type === 1;
    }


    public function isOnlyOnce() {
        return $this->only_once == 1;
    }

    public function isAvailableForUse() {
        $this->refresh();
        if(!is_null($this->expired_at)) {
            return $this->expired_at->gte(Carbon::now());
        }
        else {
            if($this->isOnlyOnce()) {
                if($this->orders()->where('user_id',Auth::id())->count() === 0) {
                    return true;
                }
                return false;
            }
            return true;
        }
    }

    public function applyCost($price) {
        if($this->isAbsolute()) {
            return round($price - CurrencyConversion::convert($this->value,$this->currency->code,session('currency')),2);
        }
        else {
            return $price - ($price * $this->value / 100);
        }
    }

    use HasFactory;
}
