<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Property;
use App\Models\Sku;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(Request $request) {
        $products = Product::with('category')->with('skus')->orderBy('id')->paginate(8);
        $products->map(function($item) {
            return $item->getRangePrices();
        });
        return view('index.index',compact('products'));
    }
    public function categories() {
        return view('categories.index');
    }
    public function category($code, ProductFilterRequest $request) {
        $category = Category::where('code',$code)->first();
        $productQuery = Product::with(['category','skus']);
        $productQuery->where('category_id',$category->id);
        if($request->filled('price_from')) {
            $priceFrom = $request->price_from;
//            $productQuery->where('skus.price','>=',$request->price_from);
            $productQuery->whereHas('skus',function ($query) use($priceFrom){
                $query->where('price','>=',$priceFrom);
            });
        }
//        $skusQuery = Sku::with(['product','product.category']);
//        if($request->filled('price_from')) {
//            $skusQuery->where('price','>=',$request->price_from);
//        }
//        if($request->filled('price_to')) {
//            $skusQuery->where('price','<=',$request->price_to);
//        }
        if($request->filled('price_to')) {
            $priceTo = $request->price_to;
            $productQuery->whereHas('skus',function ($query) use($priceTo){
                $query->where('price','<=',$priceTo);
            });
        }
        foreach(['hot','new','sale'] as $attribute) {
            if($request->has($attribute)) {
                $productQuery->$attribute();
//                $skusQuery->whereHas(
//                    'product', function ($query) use ($attribute) {
//                    $query->$attribute();
//                });//scope - дополненеи нашего запроса к бд, дежит в модели продукта называется scopeHit..
            }
        }
//        $skus = $skusQuery->paginate(8)->withPath('?' . $request->getQueryString());
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
                            //                            $skuIds[] = $option->skus->map(function($sku){return $sku->id;});
                        }
                    }
                    if ($i > 0) {
                        $skuIds = array_intersect($skuIds,$tmpSkuIdsArray);
//                        foreach ($skuIds as $key => $id) {
//                            if (!in_array($id, $tmpSkuIdsArray)) {
//                                unset($skuIds[$key]);
//                            }
//                        }
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
        $productQuery->whereHas('skus')->exists();
        $products = $productQuery->paginate(9);
        $products->map(function($item) {
            return $item->getRangePrices();
        });
        $maxPrice = 0;
        foreach($products as $product) {
            if(!isset($minPrice))
                $minPrice = $product->min_price;
            else
                $minPrice = $product->min_price < $minPrice ? $product->min_price : $minPrice;
            $maxPrice = $product->max_price > $maxPrice ? $product->max_price : $maxPrice;
        }

//        dd($properties);
        return view('category.index',compact(['category','products','properties','filterValues']));
    }
    public function product($categoryCode,$productCode) {
        $product = Product::getSkus()->byCode($productCode)->first()->groupSku();
//        dd($product);
//        if($product->code != $productCode || $product->category->code != $categoryCode) {
//            abort(404);
//        }

        return view('layouts.product',compact('product'));
    }
    public function sku($categoryCode,$productCode,Sku $sku) {
        $product = $sku->product->groupSku($sku->getCurrentProperties());
        if($product->code != $productCode || $product->category->code != $categoryCode) {
            abort(404);
        }
        $sku->prop = $sku->getCurrentProperties();
//        $sku->otherSkus = $sku->getOtherIdSkus($sku->getCurrentProperties());
        return view('layouts.sku',compact('sku','product'));
    }
    public function subscribe(SubscriptionRequest $request, Sku $sku) {
        $name = Auth::check() ? Auth::user()->name : '';
        Subscription::create([
            "email" => $request->email,
            "name" => $name,
            "sku_id" => $sku->id
        ]);
        return redirect()->back();
    }

    public function changeLocale($locale) {
        $availableLocales = array_keys(config('app.locales'));
        if(!in_array($locale,$availableLocales)) {
            $locale = config('app.locale');
        }
        App::setLocale($locale);
        session(['locale' => $locale]);

        return redirect()->back();
    }

    public function changeCurrency($currencyCode) {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }

    public function getSkuByProperties($productId,$data) {
        $data = json_decode($data,true);
        foreach($data as $key => $val) {
            if(is_null($val)) {
                unset($data[$key]);
            }
        }
        $sku = Sku::where('product_id',$productId)->getByProperties($data)->first();
        $product = $sku->product->groupSku($sku->getCurrentProperties());
        $sku->prop = $sku->getCurrentProperties();
        $htmlProductFooter = view('layouts.product_footer',compact('product','sku'))->render()
            . '<script src="'.asset("js/vendor/app.js").'"></script>';
        ;
//        $htmlForm = view('layouts.sku_variable_form',compact('product','sku'))->render();
//        $htmlCartButton = view('layouts.add_to_cart_button',compact('product','sku'))->render();
        return array("price" => $sku->price,"quantity" => $sku->quantity,"htmlProductFooter" => $htmlProductFooter);
    }


}
