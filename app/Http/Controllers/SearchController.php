<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyOption;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(ProductFilterRequest $request) {
        $query = $request->input('searchQuery');
        if($query != '') {
            $queryWords = explode(' ',$query);
            $productQuery = Product::byName($queryWords)->with(['category','skus','properties']);
            if($request->filled('price_from')) {
                $priceFrom = $request->price_from;
                $productQuery->whereHas('skus',function ($query) use($priceFrom){
                    $query->where('price','>=',$priceFrom);
                });
            }
            if($request->filled('price_to')) {
                $priceTo = $request->price_to;
                $productQuery->whereHas('skus',function ($query) use($priceTo){
                    $query->where('price','<=',$priceTo);
                });
            }
            foreach(['hot','new','sale'] as $attribute) {
                if($request->has($attribute)) {
                    $productQuery->$attribute();
                }
            }
            $skuIds = array();
            $filterValues = array();
            $properties = Property::with('options')->get();
            $i = 0;//счетчик какое свойство подряд проверяется
            $isFilter = false;
            foreach($properties as $property) {
                if($request->filled($property->code)) {
                    $propCode = $property->code;
                    if($request->$propCode[0] != null) {
                        $isFilter = true;
                        $propValues = explode(',', $request->$propCode[0]);
                        $tmpSkuIdsArray = array();//массив, чтобы убрать СКУ, которых нет в двух свойствах сразу
                        foreach ($property->options as $option) {
                            if ($propCode == $property->code && in_array($option->code, $propValues)) {
                                $filterValues[$property->code][] = $option->code;
                                foreach ($option->skus as $sku) {
                                    if ($i == 0) {
                                        if (!in_array($sku->id, $skuIds)) {
                                            $skuIds[] = $sku->id;
                                        }
                                    }
                                    else {
                                        if (!in_array($sku->id, $tmpSkuIdsArray)) {
                                            $tmpSkuIdsArray[] = $sku->id;
                                        }
                                    }
                                }
                            }
                        }
                        if ($i > 0) {
                            $skuIds = array_intersect($skuIds,$tmpSkuIdsArray);
                        }
                        $i++;
                    }

                }
            }
            if($isFilter) {
                $productQuery->whereHas('skus',function($query) use ($skuIds) {
                    $query->whereIn("id",$skuIds);
                });
            }
            $propOptions = PropertyOption::get();
            $queryWords = array_map(function($item){return mb_strtolower($item);},$queryWords);
            $productQuery->whereHas('skus')->exists();
            $products = $productQuery->get();
            $products->map(function($item) {
                return $item->getRangePrices();
            });
            $products = $products->filter(function($item,$key) use($queryWords,$propOptions) {
                $propQuery = PropertyOption::where(__('name'),'ilike','%' . $queryWords[0] .'%');
                for($i = 1; $i < count($queryWords);$i++) {
                    $propQuery->orWhere(__('name'),'ilike','%' . $queryWords[$i] .'%');
                }
                $propOptions = $propQuery->get();
                if($propOptions->count() == 0)
                    return true;
                foreach($item->skus as $sku) {
                    $i = 0;//колиество найденных таких же свойств, что и в запросе
                    foreach ($propOptions as $option) {
                        if ($sku->propertyOptions->contains($option->id)) {
                            $i++;
                            if($i == $propOptions->count()) {
                                return true;
                            }
                        }
                    }
                }
            });
            return view('layouts.search_page',compact(['products','properties','filterValues','query']));
        }
    }
}
