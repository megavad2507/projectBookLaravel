@php
    $isDisabled = $sku->quantity == 0 ? true : false;
@endphp
<button

    @if($isDisabled)
        disabled
        class="btn theme-btn--dark2 btn--xl mt-30 mt-sm-0 detail-add-to-cart"
    @else
        class="btn theme-btn--dark3 btn--xl mt-30 mt-sm-0 detail-add-to-cart"
    @endif
    data-product-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#add-to-cart"
>
    <span class="me-2"><i class="ion-bag"></i></span>
    @if($isDisabled)
        @lang('main.out_of_stock')
    @else
        @lang('main.add_to_basket')
    @endif
</button>
