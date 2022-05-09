<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('searchQuery');
        if($query != '') {
            $products = Product::byName($query)->take(5)->get();
            return $products;
        }
    }
}
