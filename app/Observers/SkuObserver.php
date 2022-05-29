<?php

namespace App\Observers;

use App\Models\Sku;
use App\Models\Subscription;

class SkuObserver
{
    public function updating(Sku $sku) {
        $oldQuantity = $sku->getOriginal('quantity');
        if($oldQuantity == 0 && $sku->quantity > 0) {
            Subscription::sendEmailBySubscription($sku);
        }
    }
}
