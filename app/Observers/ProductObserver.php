<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subscription;

class ProductObserver
{
    public function updating(Product $product) {
        $oldQuantity = $product->getOriginal('quantity');
        if($oldQuantity == 0 && $product->quantity > 0) {
            Subscription::sendEmailBySubscription($product);
        }
    }

}
