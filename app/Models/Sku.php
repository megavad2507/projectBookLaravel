<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    protected $fillable = ['product_id','quantity','price'];

    protected $visible = ['id','quantity','price','product_name'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function scopeAvailable($query) {
        return $query->where('quantity','>',0);
    }

    public function propertyOptions() {
        return $this->belongsToMany(PropertyOption::class,'sku_property_option')->withTimestamps();
    }

    public function property() {
        return $this->hasManyThrough('App\Models\Property','App\Models\PropertyOption','property_id','id');
    }

    protected static function getOptionsSkus($productId) {
        $skus = self::where('product_id',$productId)->get();
        $resultArray = [];
        foreach($skus as $sku) {
            foreach($sku->propertyOptions as $option) {
                $resultArray[$sku->id][$option->property->id] = $option->id;
            }
        }
        return $resultArray;
    }
    public static function isNotCurrentSKUExist($options): bool
    {
        $existsOptionsSku = self::getOptionsSkus($options['product_id']);
        foreach($existsOptionsSku as $sku) {
            if(empty(array_diff($options['property_id'],$sku))) return false;
        }
        return true;

    }
    public function isSKUChanged($optionsIds) {
        $tmpArray = array();
        foreach($this->propertyOptions as $option) {
            $tmpArray[$option->property_id] = $option->id;
        }
        return empty(array_diff($tmpArray,$optionsIds));
    }
    public function isAvailable() {
        return $this->quantity > 0 && !$this->product->trashed();
    }
    public function getAmountPrice() {
        return $this->price * $this->quantityInOrder;
    }
    public function orderMoreItems() {
        return !($this->quantityInOrder == $this->quantity);
    }
    public function getPriceAttribute($value) {
        return round(CurrencyConversion::convert($value),2);
    }
    public function getOrderPrice() {
        return $this->pivot->price * $this->pivot->quantity;
    }

    public function getProductNameAttribute() {
        return $this->product->name;
    }

    use HasFactory;
}
