<?php

namespace App\ViewComposers;

use App\Models\Product;
use Illuminate\View\View;

class NewProductsComposer
{
    public function compose(View $view) {
        $newProducts = Product::with('category')->with('skus')->new()->get()->sortByDesc('id');
        $newProducts->map(function($item) {
            return $item->getRangePrices();
        });
        $view->with('newProducts',$newProducts);
    }
}
