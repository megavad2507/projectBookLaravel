<?php

namespace App\Classes;

use App\Models\Sku;

class AdminFilter {

    public function __construct($request) {
        $this->request = array_filter($request,'strlen');
        $this->fieldLike = ['name','code','email'];
        $this->fieldSkus = ['property_option'];
        $this->fieldSelect = ['category_id','type','currency_id'];
        $this->fieldEquals = ['id'];
    }

    //filter = ключ - поле,value = значение
    public function getFilteredItems($model) {

        $itemQuery = $model::query();
        foreach($this->request as $field => $value) {
            if(in_array($field,$this->fieldLike))
                $itemQuery->where($field,'ilike','%'.$value.'%');
            elseif($model === Sku::class && $field == 'property_option') {
                $itemQuery->whereHas('propertyOptions', function ($query) use ($value) {
                    return $query->where('property_options.id',$value);
                });
            }
            elseif($field == 'expired_at')
                $itemQuery->where($field,'>=',$value);
            elseif(in_array($field,$this->fieldSelect))
                $itemQuery->where($field,$value);
            elseif(in_array($field,$this->fieldEquals))
                $itemQuery->where($field,$value);
        }
        return $itemQuery;
    }

}
