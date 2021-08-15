<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    public function getCategory() {
//        return $category = Category::find($this->category_id);
//    }

    protected $fillable = ['code','name','description','picture','price','category_id'];
    public function category() {
        return $this->belongsTo(Category::class)->orderBy('id','asc');
    }

    public function getAmountPrice() {
        if(!is_null($this->pivot)) {
            return $this->price*$this->pivot->quantity;
        }
        return $this->price;
    }
     use HasFactory;
}