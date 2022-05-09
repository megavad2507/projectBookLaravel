<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->active()->paginate(10);
        return view('auth.orders.index',compact('orders'));
    }

    public function showOrder($orderId) {
        if(!Auth::user()->orders->contains($orderId)) {
            return back();
        }
        $order = Order::find($orderId);
        return view('auth.orders.show',compact('order'));
    }
}
