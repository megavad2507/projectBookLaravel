<?php


namespace App\Classes;


use App\Mail\OrderCreated;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Sku;
use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    /**
     * Basket constructor.
     *
     * @param  bool  $createOrder
     */
    public function __construct($createOrder = false)
    {
        $order = session('order');

        if(is_null($order) && $createOrder) {
            $data = [];
            if(Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;
            $this->order = new Order($data);
            session(['order' => $this->order]);
        }
        else {
            $this->order = $order;
        }
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function quantityAvailable($updateCount = false) {
        $skus = collect([]);
        foreach ($this->order->skus as $orderSku) {
            $sku = Sku::findOrFail($orderSku->id);
            if($orderSku->quantityInOrder > $sku->quantity) {
                return false;
            }
            if($updateCount) {
                $sku->quantity -= $orderSku->quantityInOrder;
                $skus->push($sku);
            }
        }
        if($updateCount) {
            $skus->map->save();
        }
        return true;
    }


    public function saveOrder($name,$phone,$email,$payment,$address) {
        if(!$this->quantityAvailable(true)) {
            return false;
        }
        $this->order->saveOrder($name,$phone,$email,$payment,$address);
        Mail::to($email)->send(new OrderCreated($name,$this->getOrder()));
        return true;
    }

    protected function getOrderSku(Sku $sku) {
        return $this->order->skus->where('id',$sku->id)->first();
    }

    public function getSkuQuantityInBasket(Sku $sku) {
        return $this->getOrderSku($sku)->quantityInOrder;
    }

    public function addSku(Sku $sku,$quantity) {
        if($this->order->skus->contains($sku->id)) {
            $orderSku = $this->getOrderSku($sku);
            $newQuantity = $orderSku->quantityInOrder + $quantity;
            if($orderSku->quantityInOrder > $sku->quantity || $newQuantity > $sku->quantity) {
                return false;
            }
            $orderSku->quantityInOrder = $newQuantity;
        }
        else {
            if($sku->quantity == 0 || $sku->quantity < $quantity) {
                return false;
            }
            $sku->quantityInOrder = $quantity;
            $this->order->skus->push($sku);
        }
    }

    public function removeSku(Sku $sku) {
        if($this->order->skus->contains($sku)) {
            $orderSku = $this->getOrderSku($sku);
            if($orderSku->quantityInOrder > 1) {
                $orderSku->quantityInOrder--;
            }
            else {
                $this->order->skus = $this->order->skus->reject(function($value,$key) use ($sku) {
                    return $sku->id == $value->id;
                });
            }
        }
    }

    public function removeSkuFromBasket(Sku $sku) {
        if($this->order->skus->contains($sku)) {
            $this->order->skus = $this->order->skus->reject(function($value,$key) use ($sku) {
                return $sku->id == $value->id;
            });
            return true;
        }
        return false;
    }

    public function setQuantity(Sku $sku,$quantity) {
        if($sku->quantity >= $quantity) {
            $orderSku = $this->getOrderSku($sku);
            $orderSku->quantityInOrder = $quantity;
            return true;
        }
        else {
            return false;
        }
    }

    public function setCoupon(Coupon $coupon) {
        $this->order->coupon()->associate($coupon);
    }

    public function deleteCoupon(Coupon $coupon) {
        $this->order->coupon()->disassociate();
    }



}
