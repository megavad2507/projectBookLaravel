<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $order = session('order');
        if(!is_null($order) && $order->getOrderPrice() > 0) {
            return $next($request);

        }
        session()->forget('order');
        return redirect()->route('index');

    }
}
