<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket() {
//        session(['orderId' => 11]);
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        return view('basket.index',compact('order'));
    }
    public function checkout() {
        $orderId = session('orderId');
        $order = Order::find($orderId);
        return view('basket.checkout',compact('order'));
    }

    public function confirmOrder(Request $request) {
        $orderId = session('orderId');
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name,$request->phone);
        if($success) {
            session()->flash('success','Ваш заказ принят в обработку!');
        }
        else {
            session()->flash('warning','Во время заказа заказа произошла ошибка');
        }

        Order::eraseOrderPrice();
        return redirect()->route('index');
    }

    public function basketAdd($productId){
        $orderId = session('orderId');
        if(is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        }
        else {
            $order = Order::find($orderId);
        }
        if($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id',$productId)->first()->pivot;
            $pivotRow->quantity++;
            $pivotRow->update();
        }
        else {
            $order->products()->attach($productId);
        }
        if(Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }
        $product = Product::find($productId);
        Order::changeOrderPrice($product->price);
        return redirect()->route('basket');

    }

    public function basketRemove($productId) {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);
        if($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id',$productId)->first()->pivot;
            if($pivotRow->quantity > 1) {
                $pivotRow->quantity--;
                $pivotRow->update();
            }
            else {
                $order->products()->detach($productId);;
            }
        }
        $product = Product::find($productId);
        Order::changeOrderPrice(-$product->price);
        return redirect()->route('basket');
    }

}
