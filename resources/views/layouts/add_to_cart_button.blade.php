@if($sku->isAvailable())
    <button class="btn theme-btn--dark3 btn--xl mt-30 mt-sm-0 detail-add-to-cart" data-product-id="{{ $product->id }}"
            data-bs-toggle="modal" data-bs-target="#add-to-cart">
        @lang('main.add_to_basket')
    </button>
@else
    <button class="btn theme-btn--dark2 btn--xl mt-30 mt-sm-0 detail-add-to-cart" disabled
            data-product-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#add-to-cart"
    >
        @lang('main.out_of_stock')
    </button>
    @include('layouts.form_preorder')

@endif
