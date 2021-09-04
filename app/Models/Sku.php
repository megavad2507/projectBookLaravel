<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = ['product_id','quantity','price'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function propertyOptions() {
        return $this->belongsToMany(PropertyOption::class,'sku_property_option')->withTimestamps();
    }
    protected static function getOptionsSkus() {
        $skus = self::get();
        $resultArray = [];
        foreach($skus as $sku) {
            foreach($sku->propertyOptions as $option) {
                $resultArray[$sku->id][$option->property->id] = $option->id;
            }
        }
        return $resultArray;
    }
    public static function isNotCurrentSKUExist($optionsIds): bool
    {
        $existsOptionsSku = self::getOptionsSkus();
        foreach($existsOptionsSku as $sku) {
            if(empty(array_diff($optionsIds,$sku))) return false;
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

    use HasFactory;
}
