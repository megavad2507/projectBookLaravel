<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = ['email','name','product_id','status'];

    public function scopeActiveByProductId($query,$productId) {
        return $query->where('status',0)->where('product_id',$productId);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public static function sendEmailBySubscription(Product $product) {
        $subscriptions = self::activeByProductId($product->id)->get();
        foreach($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionMessage($product,$subscription->name));
            $subscription->status = 1;
            $subscription->save();
        }
    }
    use HasFactory;
}
