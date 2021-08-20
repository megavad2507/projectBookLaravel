<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request) {
        $products = Product::with('category')->get();
        return view('index.index',compact('products'));
    }
    public function categories() {
        $categories = Category::get();
        return view('categories.index',compact('categories'));
    }
    public function category($code, ProductFilterRequest $request) {
        $category = Category::where('code',$code)->first();
        $productsQuery = Product::with('category');
        $productsQuery->where('category_id',$category->id);
        if($request->filled('price_from')) {
            $productsQuery->where('price','>=',$request->price_from);
        }
        if($request->filled('price_to')) {
            $productsQuery->where('price','<=',$request->price_to);
        }
        foreach(['hot','new','sale'] as $attribute) {
            if($request->has($attribute)) {
                $productsQuery->where($attribute,1);
            }
        }
        $products = $productsQuery->paginate(3)->withPath('?' . $request->getQueryString());
        return view('category.index',compact(['category','products']));
    }
    public function product($category,$code = null) {
        $product = Product::where('code',$code)->first();
        return view('layouts.product',compact('product'));
    }


}
