<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use App\Observers\SkuObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('routeActive', function($routeName) {
            return "<?php echo Route::currentRouteNamed($routeName) ? 'active' : ''?>";
        });

        Blade::if('ifAdmin',function () {
            return Auth::check() && Auth::user()->isAdmin();
        });

        Paginator::useBootstrap();

//        Product::observe(ProductObserver::class);
        Sku::observe(SkuObserver::class);
    }
}
