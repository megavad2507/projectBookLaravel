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

    public function skus() {
        return $this->hasMany(Sku::class)->getProperties();
    }

    public function properties() {
        return $this->belongsToMany(Property::class,'property_product')->withTimestamps();
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

    public function scopeGetSkus($query)
    {
        return $query->with('skus');
    }

    public function groupSku() {
        $properties = $this->properties;
        $tmp = array();
        $tmpPickedIds = array();
        foreach($this->skus->map->leadProductPageForm() as $sku) {
            foreach($sku['properties'] as $code => $prop) {
                if(!in_array($code,array_keys($tmp))) {
                    $tmpPickedIds[] = $prop['values']['id'];
                    $prop['values'] = array($prop['values']);
                    $tmp[$code] = $prop;
                }
                elseif(!in_array($prop['values']['id'],$tmpPickedIds)) {
                    $tmpPickedIds[] = $prop['values']['id'];
                    $tmp[$code]['values'][] = $prop['values'];
                }
            }

        }
        $this->skus_properties = $tmp;
        return collect($this);
    }

    use HasFactory;
}
