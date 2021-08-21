<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    public function getCategory() {
//        return $category = Category::find($this->category_id);
//    }

    protected $fillable = ['code','name','description','picture','price','category_id','new','hot','sale'];
    public function category() {
        return $this->belongsTo(Category::class)->orderBy('id','asc');
    }

    public function getAmountPrice() {
        if(!is_null($this->pivot)) {
            return $this->price*$this->pivot->quantity;
        }
        return $this->price;
    }

    public function scopeHot($query) {
        return $query->where('hot',1);
    }
    public function scopeNew($query) {
        return $query->where('new',1);
    }
    public function scopeSale($query) {
        return $query->where('sale',1);
    }

    public function setNewAttribute($value) {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setHotAttribute($value) {
        $this->attributes['hot'] = $value === 'on' ? 1 : 0;
    }

    public function setSaleAttribute($value) {
        $this->attributes['sale'] = $value === 'on' ? 1 : 0;
    }
    public function isHot() {
        return $this->hot === 1;
    }

    public function isNew() {
        return $this->new === 1;
    }
    public function isSale() {
        return $this->sale === 1;
    }
     use HasFactory;
}
