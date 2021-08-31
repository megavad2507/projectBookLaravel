<?php

namespace App\Models;

use App\Mail\OrderCreated;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    protected $fillable = ['user_id','status','name','phone','email','currency_id','sum'];
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot(['quantity','price'])->withTimestamps()->orderBy('id');
    }

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function calculateOrderPrice() {
        $sum = 0;
        foreach($this->products as $product) {
            $sum += $product->getAmountPrice();
        }
        return $sum;
    }

    public  function getOrderPrice() : float {
        $sum = 0;
        foreach($this->products as $product) {
            $sum += $product->getAmountPrice();
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
        $products = $this->products;
        foreach($products as $productInOrder) {
            $pivot = $this->products()->attach($productInOrder,[
                'quantity' => $productInOrder->quantityInOrder,
                'price' => $productInOrder->price
            ]);
        }
        session()->forget('order');

        return true;
    }

    public function scopeActive($query) {
        return $query->where('status',1)->with('products');
    }
    use HasFactory;
}
