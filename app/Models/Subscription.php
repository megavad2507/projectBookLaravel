<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = ['email','name','sku_id','status'];

    public function scopeActiveBySkuId($query,$skuId) {
        return $query->where('status',0)->where('sku_id',$skuId);
    }
    public function sku() {
        return $this->belongsTo(Sku::class);
    }

    public static function sendEmailBySubscription(Sku $sku) {
        $subscriptions = self::activeBySkuId($sku->id)->get();
        foreach($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionMessage($sku,$subscription->name));
            $subscription->status = 1;
            $subscription->save();
        }
    }
    use HasFactory;
}
