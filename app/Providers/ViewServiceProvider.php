<?php

namespace App\Providers;

use App\Classes\Basket;
use App\Models\Sku;
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
        View::composer(['modals.basket_add'],function($view){
            $basketOrder = (new Basket())->getOrder();
            if(!is_object($basketOrder)) {
                $basketAmount = 0;
            }
            else {
                $basketAmount = $basketOrder->skus->sum(function($sku){return $sku->price;});
            }
            $view->with('basketAmount',$basketAmount);
        });
        View::composer(['layouts.quantity_product_block'],function($view) {
            $basketObject = (new Basket());
            $basketOrder = $basketObject->getOrder();
            if(is_object($basketOrder)) {
                $view->with(['basketOrder' => $basketOrder,'basketObject' => $basketObject]);
            }
        });

    }
}
