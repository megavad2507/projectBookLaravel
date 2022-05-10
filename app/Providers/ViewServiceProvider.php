<?php

namespace App\Providers;

use App\Classes\Basket;
use App\Services\CurrencyConversion;
use App\ViewComposers\BestProductsComposer;
use App\ViewComposers\CategoriesComposer;
use App\ViewComposers\CurrenciesComposer;
use App\ViewComposers\NewProductsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.main_layout','layouts.app','categories.index','category.index'],CategoriesComposer::class);
        View::composer(['layouts.main_layout','layouts.app','admin.coupons.form-create'],CurrenciesComposer::class);
//        View::composer('*',BestProductsComposer::class);
        View::composer('*',function($view) {
            $currencySymbol = CurrencyConversion::getCurrencySymbol();
            $view->with('currencySymbol',$currencySymbol);
        });
        View::composer(['layouts.new_products'],NewProductsComposer::class);
        View::composer('*',function($view){
            $basketOrder = (new Basket())->getOrder();
            if(!is_object($basketOrder)) {
                $quantityInBasket = 0;
            }
            else {
                $quantityInBasket = $basketOrder->skus->count();

            }
            $view->with('quantityInBasket',$quantityInBasket);
        });

    }
}
