<?php

namespace App\Models;

use App\Classes\Basket;
use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
//    public function getCategory() {
//        return $category = Category::find($this->category_id);
//    }

    use SoftDeletes, Translatable;
    protected $fillable = ['code','name','description','picture','price','category_id','new','hot','sale','quantity',
                           'name_en', 'description_en'];
    public function category() {
        return $this->belongsTo(Category::class)->orderBy('id','asc');
    }

    public function getAmountPrice() {
        return $this->price * $this->quantityInOrder;
    }

    public function getOrderPrice() {
        return $this->pivot->price * $this->pivot->quantity;
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
    public function scopeByCode($query,$code) {
        return $query->where('code',$code);
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

    public function isAvailable() {
        return $this->quantity > 0 && !$this->trashed();
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
    public function orderMoreItems() {
        return !($this->quantityInOrder == $this->quantity);
    }
    public function getPriceAttribute($value) {
        return round(CurrencyConversion::convert($value),2);
    }
    use HasFactory;
}
