<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(Request $request) {
        $skusQuery = Sku::query();
        $skus = $skusQuery->paginate(8);
        return view('index.index',compact('skus'));
    }
    public function categories() {
        return view('categories.index');
    }
    public function category($code, ProductFilterRequest $request) {
        $category = Category::where('code',$code)->first();
        $skusQuery = Sku::with(['product','product.category']);
        if($request->filled('price_from')) {
            $skusQuery->where('price','>=',$request->price_from);
        }
        if($request->filled('price_to')) {
            $skusQuery->where('price','<=',$request->price_to);
        }
        foreach(['hot','new','sale'] as $attribute) {
            if($request->has($attribute)) {
                $skusQuery->whereHas(
                    'product', function ($query) use ($attribute) {
                    $query->$attribute();
                });//scope - дополненеи нашего запроса к бд, дежит в модели продукта называется scopeHit..
            }
        }
        $skus = $skusQuery->paginate(8)->withPath('?' . $request->getQueryString());
        return view('category.index',compact(['category','skus']));
    }
    public function sku($categoryCode,$productCode,Sku $sku) {
        $product = $sku->product;
        if($product->code != $productCode || $product->category->code != $categoryCode) {
            abort(404);
        }
        return view('layouts.product',compact('sku'));
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


}
