@if($sku->quantity > 0)
    <div class="count d-flex">
        <input name="quantity" id="{{ $buttonId }}" type="number" min="1"
               @isset($basketOrder)
                   @if($basketOrder->skus->contains('id',$sku->id))
                       max="{{ $sku->quantity - $basketObject->getSkuQuantityInBasket($sku) }}"
               @else
                   max="{{ $sku->quantity }}"
               @endif
               @else
                   max="{{ $sku->quantity }}"
               @endisset

               step="1"
               @isset($quantity)
                   value="{{ $quantity > $sku->quantity ? $sku->quantity : $quantity }}"
               @else
                   value="1"
               @endif
        >
        <div class="button-group">
            <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>
            <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>
        </div>
    </div>
@endif
