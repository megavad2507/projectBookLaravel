<form id="set-sku-values">
    @include('layouts.sku_variable_form')
</form>

<div class="product-count style d-flex flex-column flex-sm-row mt-30 mb-30">
    @php
        $buttonId = 'set-quantity'
    @endphp
    @include('layouts.quantity_product_block',compact('buttonId'))
    <div id="cart-button-block">
        @include('layouts.add_to_cart_button',compact('sku'))
    </div>
</div>
