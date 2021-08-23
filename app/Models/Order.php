<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity')->withTimestamps()->orderBy('id');
    }

    public function calculateOrderPrice() {
        $sum = 0;
        foreach($this->products as $product) {
            $sum += $product->getAmountPrice();
        }
        return $sum;
    }

    public static function changeOrderPrice($changeValue) {
        session(['full_order_sum' => self::getOrderPrice() + $changeValue]);
    }

    public static function getOrderPrice() {
        return $sum = session('full_order_sum',0);
    }

    public static function eraseOrderPrice() {
        session()->forget('full_order_sum');
    }
    public function getUser() {
        return $this->belongsTo(User::class);
    }

    public function saveOrder($name,$phone) {
        if($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->user_id = Auth::user()->id;
            $this->save();
            session()->forget('orderId');
            return true;
        }
        else {
            return false;
        }
    }

    public function scopeActive($query) {
        return $query->where('status',1)->with('products');
    }
    use HasFactory;
}
