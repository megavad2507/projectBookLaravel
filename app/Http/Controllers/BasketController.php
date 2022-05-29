<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\SetCouponRequest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Payment;
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
        $payments = Payment::orderBy('id','asc')->get();
        return view('basket.checkout',compact('order','user','payments'));
    }

    public function confirmOrder(Request $request) {
        if((new Basket())->saveOrder($request->name,$request->phone,$request->email,$request->payment_id,$request->address_delivery)) {
            session()->flash('success','Ваш заказ принят в обработку!');
        }
        else {
            session()->flash('warning','Во время заказа заказа произошла ошибка');
        }

//        Order::eraseOrderPrice();
        return redirect()->route('index');
    }

    public function basketAdd(Sku $sku,$quantity = 0){
        (new Basket(true))->addSku($sku,$quantity);
        return redirect()->route('basket');

    }

    public function basketAddModal($productId,$quantity = 0,$serializeFormData = null) {
        $product = Product::where('id',$productId)->first();
        if($serializeFormData != null) {
            $jsonData = (json_decode($serializeFormData,true));
            $propData = array();
            foreach($jsonData as $data) {
                $propData[$data['name']] = $data['value'];
            }
            $sku = Sku::where('product_id',$productId)->getByProperties($propData)->getAvailable()->orderBy('id','asc')->first();
        }
        else {
            $sku = Sku::where('product_id',$productId)->getAvailable()->orderBy('id','asc')->first();
        }
        $product->groupSku($sku->getCurrentProperties());
        return view('modals.basket_add',compact('product','sku','quantity'));
    }

    public function basketUnauthorizedModal() {
        return view('modals.basket_add');
    }

    public function searchSku(Request $request) {
        $data = json_decode($request->get('data'));
        $productId = $request->get('product_id');
        $quantity = $request->get('quantity');
        $product = Product::where('id',$productId)->first();
        $sku = self::searchSkuMethod($data,$productId);
        $product->groupSku($sku->getCurrentProperties());
        $href = route('basketAdd',[$sku->id,$quantity]);
        $html = view('modals.basket_add',compact(['product','sku','quantity']))->render();

        return array("PRODUCT" => $product->skus_properties,"SKU" => $sku,"HREF" => $href,"HTML" => $html);
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

    public function setQuantity(Sku $sku, $quantity) {
        $basket = (new Basket());
        $order = $basket->getOrder();
        $isSuccessful = $basket->setQuantity($sku,$quantity);
        if($isSuccessful) {
            return ["success" => true,
                "html" => view('basket.basket_block',compact('order'))->render() .
                    '<script src="'.asset("js/vendor/app.js").'"></script>'
            ];
        }
        return ["success" => false];
    }

    public function deleteSkuFromBasket(Sku $sku) {
        $basket = (new Basket());
        $order = $basket->getOrder();
        $isSuccessful = $basket->removeSkuFromBasket($sku);
        if($isSuccessful) {
            return ["success" => true,
                "html" => view('basket.basket_block',compact('order'))->render() .
                    '<script src="'.asset("js/vendor/app.js").'"></script>'
            ];
        }
        return ["success" => false];
    }

    public function setCoupon(SetCouponRequest $request) {
        $coupon = Coupon::where('code',$request->coupon)->first();
        if($coupon->isAvailableForUse()) {
            (new Basket())->setCoupon($coupon);
            session()->flash('success',__('cart.success_add_coupon',['coupon' => $coupon->code]));
        }
        else {
            session()->flash('warning',__('cart.cant_use_coupon',['coupon' => $coupon->code]));
        }
        return redirect()->route('basket');
    }

    public function deleteCoupon(Coupon $coupon) {
        (new Basket())->deleteCoupon($coupon);
        session()->flash('success','Вы успешно удалили купон ' . $coupon->code);
        return redirect()->route('basket');
    }

}
