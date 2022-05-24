<?php

namespace App\Models;

use App\Mail\OrderCreated;
use App\Mail\OrderStatusEdited;
use App\Models\Sku;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    protected $fillable = ['user_id','status','name','phone','email','currency_id','sum','coupon_id','payment_id','address_delivery','status_id'];

    public function skus() {
        return $this->belongsToMany(Sku::class)->withPivot(['quantity','price'])->withTimestamps()->orderBy('id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function status() {
        return $this->belongsTo(OrderStatus::class);
    }

    public function calculateOrderPrice($withCoupon = false) {
        $sum = 0;
        foreach($this->skus as $sku) {
            $sum += $sku->getAmountPrice();
        }

        if($withCoupon && $this->hasCoupon()) {
            $sum = $this->coupon->applyCost($sum);
        }

        return $sum;
    }

    public function getUser() {
        return $this->belongsTo(User::class);
    }

    public function saveOrder($name,$phone,$email,$payment,$address) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->status_id = 1;
        $this->user_id = Auth::user()->id;
        $this->currency_id = CurrencyConversion::getCurrentCurrencyFromSession()->id;
        $this->sum = $this->calculateOrderPrice(true);
        $this->payment_id = $payment;
        $this->address_delivery = $address;
        $this->save();
        $skus = $this->skus;
        foreach($skus as $skuInOrder) {
            $pivot = $this->skus()->attach($skuInOrder,[
                'quantity' => $skuInOrder->quantityInOrder,
                'price' => $skuInOrder->price
            ]);
        }
        session()->forget('order');

        return true;
    }

    public function scopeActive($query) {
        return $query->where('status',1)->with('skus');
    }

    public function hasCoupon() {
        return isset($this->coupon);
    }

    public function hasAvailableCoupon() {
        return isset($this->coupon) && $this->coupon->isAvailableForUse();
    }

    public function sendEmailAfterStatusEdit() {
        Mail::to($this->email)->send(new OrderStatusEdited($this));
    }
    use HasFactory;
}
