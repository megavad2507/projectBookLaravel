<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket() {
//        session(['orderId' => 11]);
        $order = (new Basket(true))->getOrder();
        return view('basket.index',compact('order'));
    }
    public function checkout() {
        $order = (new Basket())->getOrder();
        $user = Auth::user();
        return view('basket.checkout',compact('order','user'));
    }

    public function confirmOrder(Request $request) {
        if((new Basket())->saveOrder($request->name,$request->phone,$request->email)) {
            session()->flash('success','Ваш заказ принят в обработку!');
        }
        else {
            session()->flash('warning','Во время заказа заказа произошла ошибка');
        }

//        Order::eraseOrderPrice();
        return redirect()->route('index');
    }

    public function basketAdd(Sku $sku){
        (new Basket(true))->addSku($sku);
        return redirect()->route('basket');

    }

    public function basketRemove(Sku $sku) {
        (new Basket())->removeSku($sku);
        return redirect()->route('basket');
    }

}
