<?php

namespace App\Models;

use App\Mail\OrderCreated;
use App\Models\Sku;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    protected $fillable = ['user_id','status','name','phone','email','currency_id','sum','coupon_id'];

    public function skus() {
        return $this->belongsToMany(Sku::class)->withPivot(['quantity','price'])->withTimestamps()->orderBy('id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function calculateOrderPrice() {
        $sum = 0;
        foreach($this->skus as $sku) {
            $sum += $sku->getAmountPrice();
        }
        return $sum;
    }

    public  function getOrderPrice() : float {
        $sum = 0;
        foreach($this->skus as $sku) {
            $sum += $sku->getAmountPrice();
        }
        return $sum;
    }

    public static function eraseOrderPrice() {
        session()->forget('full_order_sum');
    }
    public function getUser() {
        return $this->belongsTo(User::class);
    }

    public function saveOrder($name,$phone,$email) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->status = 1;
        $this->user_id = Auth::user()->id;
        $this->currency_id = CurrencyConversion::getCurrentCurrencyFromSession()->id;
        $this->sum = $this->getOrderPrice();
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
    use HasFactory;
}
