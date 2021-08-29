<?php

namespace App\Models;

use App\Mail\OrderCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    protected $fillable = ['user_id','status','name','phone','email'];
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
        session(['full_order_sum' => self::getOrderPrice() + floatval($changeValue)]);
    }

    public static function getOrderPrice() : float {
        return $sum = session('full_order_sum',0);
    }

    public static function eraseOrderPrice() {
        session()->forget('full_order_sum');
    }
    public function getUser() {
        return $this->belongsTo(User::class);
    }

    public function saveOrder($name,$phone,$email) {
        if($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->email = $email;
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
