<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\SetCouponRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket() {
//        session(['orderId' => 11]);
        $basket = (new Basket(true));
        $order = $basket->getOrder();
        if($order->hasCoupon()) {
            if(!$order->hasAvailableCoupon()) {
                session()->flash('delete_coupon','Ваш купон '. $order->coupon->code . ' был удален, так как истек срок его действия');
                $basket->deleteCoupon($order->coupon);
            }
        }
        return view('basket.index',compact('order'));
    }
    public function checkout() {
        $basket = new Basket();
        $order = $basket->getOrder();
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

    public function basketAddModal($productId) {
        $product = Product::where('id',$productId)->first();
        $sku = Sku::where('product_id',$productId)->getAvailable()->first();
        $product->groupSku($sku->getCurrentProperties());

        return view('modals.basket_add',compact('product'));
    }

    public function basketUnauthorizedModal() {
        return view('modals.basket_add');
    }

    public function searchSku(Request $request) {
        $data = json_decode($request->get('data'));
        $productId = $request->get('product_id');
        $product = Product::where('id',$productId)->first();
        $sku = self::searchSkuMethod($data,$productId);
        $product->groupSku($sku->getCurrentProperties());

        return array("PRODUCT" => $product->skus_properties,"SKU" => $sku);
    }

    private static function searchSkuMethod($data,$productId) {

        $query = Sku::query()->with('properties')->with('propertyOptions');
        $query->where('product_id',$productId);
        $query->getByProperties($data);
        return $query->first();
    }

    public function basketRemove(Sku $sku) {
        (new Basket())->removeSku($sku);
        return redirect()->route('basket');
    }

    public function setCoupon(SetCouponRequest $request) {
        $coupon = Coupon::where('code',$request->coupon)->first();
        if($coupon->isAvailableForUse()) {
            (new Basket())->setCoupon($coupon);
            session()->flash('success','Вы успешно добавили купон ' . $coupon->code);
        }
        else {
            session()->flash('warning','Вы не можете использовать купон ' . $coupon->code);
        }
        return redirect()->route('basket');
    }

    public function deleteCoupon(Coupon $coupon) {
        (new Basket())->deleteCoupon($coupon);
        session()->flash('success','Вы успешно удалили купон ' . $coupon->code);
        return redirect()->route('basket');
    }

}
