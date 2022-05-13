<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversion;
use Barryvdh\Debugbar\Facade as DebugBar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Sku extends Model
{
    protected $fillable = ['product_id', 'quantity', 'price'];

    protected $visible = ['id', 'quantity', 'price', 'product_name'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function propertyOptions()
    {
        return $this->belongsToMany(PropertyOption::class,
            'sku_property_option')->withTimestamps();
    }

    public function properties()
    {
        return $this->hasManyThrough('App\Models\Property',
            'App\Models\PropertyOption', 'property_id', 'id');
    }

    public function scopeGetProperties($query)
    {
        return $query
            ->with('product')
            ->with('propertyOptions');
    }
    //принимает массив $data - где ключи - id свойств, а значения - id значений свойств
    public function scopeGetByProperties($query,$data) {;
//        if(!is_array($data)) {
//            $data = (array)$data;
//        }
//        $valuesIds = array_values($data);
//        $propIds = array_keys($data);
//        $query->whereHas('propertyOptions',function ($query) use ($propIds,$valuesIds) {
//            $query->whereIn('property_options.id',$valuesIds)->whereIn('property_id',$propIds);
////                $query->where('property_options.id',$value_id)->where('property_id',$prop_id);
//            });
//
//        return $query;
        foreach($data as $prop_id => $value_id) {
            $query->whereHas('propertyOptions',function ($query) use ($prop_id,$value_id) {
                $query->where('property_options.id',$value_id)->where('property_id',$prop_id);
            });
        }
        return $query;
    }

    public function scopeGetAvailable($query) {
        return $query->where('quantity', '>' ,0);
    }

    protected static function getOptionsSkus($productId)
    {
        $skus = self::where('product_id', $productId)->get();
        $resultArray = [];
        foreach ($skus as $sku) {
            foreach ($sku->propertyOptions as $option) {
                $resultArray[$sku->id][$option->property->id] = $option->id;
            }
        }
        return $resultArray;
    }
//    возвращает массив, где ключ - id свойства, а ключ - id значения свойства СКУ
    public function getCurrentProperties()
    {
        return  $this->propertyOptions()->orderBy('id','asc')->get()->mapWithKeys(function($item){
            return [$item['property_id'] => $item['id']];
        })->sortKeys()->toArray();
    }

    public function isCurrentSku($options) {
        $currentSkuOptions = $this->getCurrentProperties();
        return $currentSkuOptions[$options['prop_id']] == $options['value'];
    }

    public function getSkuIdByOptions($options) {
        $currentSkuOptions = $this->getCurrentProperties();
        $currentSkuOptions[$options['prop_id']] = $options['value'];
        foreach($this->product->skus as $sku) {
            if($this->id != $sku->id) {
                if(empty(array_diff($sku->getCurrentProperties(),$currentSkuOptions))) {
                    return $sku->id;
                }
            }

        }
    }

    public static function isNotCurrentSKUExist($options): bool
    {
        $existsOptionsSku = self::getOptionsSkus($options['product_id']);
        foreach ($existsOptionsSku as $sku) {
            if (empty(array_diff($options['property_id'], $sku))) {
                return false;
            }
        }
        return true;

    }

    public function isSKUChanged($optionsIds)
    {
        $tmpArray = array();
        foreach ($this->propertyOptions as $option) {
            $tmpArray[$option->property_id] = $option->id;
        }
        return empty(array_diff($tmpArray, $optionsIds));
    }

    public function isAvailable()
    {
        return $this->quantity > 0 && !$this->product->trashed();
    }

    public function getAmountPrice()
    {
        return $this->price * $this->quantityInOrder;
    }

    public function orderMoreItems()
    {
        return !($this->quantityInOrder == $this->quantity);
    }

    public function getPriceAttribute($value)
    {
        return round(CurrencyConversion::convert($value), 2);
    }

    public function getOrderPrice()
    {
        return $this->pivot->price * $this->pivot->quantity;
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function leadProductPageForm(array $propertiesArray)
    {
        $propArray = array();
//        $propIds = array_keys($propertiesArray);
        for($i = 0;$i < $this->propertyOptions->count();$i++) {
            $option = $this->propertyOptions()->where('property_id',$this->product->properties[$i]->id)->first();
            $tmp = $propertiesArray;
//            unset($tmp[$this->product->properties[$i]->id]);
            $tmp[$this->product->properties[$i]->id] = $option->id;
            $skuQuery = Sku::query();
            $sku = $skuQuery->where('product_id',$this->product->id)->getByProperties($tmp)->first();
            $current = false;//флаг, что проверяемые свойства являются выбранными пользователем на детальной странице товара
            $propId  = $this->product->properties[$i]->id;
            if(array_key_exists($propId,$propertiesArray))  {
                if($option->id == $propertiesArray[$this->product->properties[$i]->id]) {
                    $current = true;
                }
            }
            $propArray[$this->product->properties[$i]->code] = [
                'prop_id' => $this->product->properties[$i]->id,
                'name' => $this->product->properties[$i]->__('name'),
                'values' => [
                    'id' => $option->id,
                    'name' => $option->__('name'),
                    'available' => $sku->isAvailable(),
                    'current' => $current
                ]
            ];


        }
        return [
            'product_id' => $this->product->id,
            'properties' => $propArray
        ];
    }

    use HasFactory;
}
