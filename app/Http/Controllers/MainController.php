<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $products = Product::orderBy('id','asc')->get();
        return view('index.index',compact('products'));
    }
    public function categories() {
        $categories = Category::get();
        return view('categories.index',compact('categories'));
    }
    public function category($code) {
        $category = Category::where('code',$code)->first();
        return view('category.index',compact('category'));
    }
    public function product($category,$code = null) {
        $product = Product::where('code',$code)->first();
        return view('layouts.product',compact('product'));
    }


}
