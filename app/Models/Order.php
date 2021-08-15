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

    public function getOrderPrice() {
        $sum = 0;
        foreach($this->products as $product) {
            $sum += $product->getAmountPrice();
        }
        return $sum;
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

    use HasFactory;
}
