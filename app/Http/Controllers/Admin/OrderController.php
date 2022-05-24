<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::orderBy('id','asc')->paginate(10);
        return view('admin.orders.index',compact('orders'));
    }

    public function editOrder(Order $order) {
        $payments = Payment::orderBy('id','asc')->get();
        $statuses = OrderStatus::orderBy('id','asc')->get();
        return view('admin.orders.edit-order',compact(['order','payments','statuses']));
    }

    public function updateOrder(OrderRequest $request, Order $order) {
        $order->update($request->all());
        return redirect(route('orders.index'));
    }

    public function showOrder(Order $order) {
        $skus = $order->skus;
        return view('admin.orders.show',compact('order','skus'));
    }
}
