<div class="modal-content">
    <div class="modal-header justify-content-center bg-dark">
        <h5 class="modal-title" id="add-to-cartCenterTitle">
            @isset($product)
                <span class="ion-checkmark-round"></span>
                @lang('main.basket_add_choose_SKU')
            @else
                @lang('main.basket_add_unauthorized_title')
            @endisset
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            @isset($product)
                <div class="col-lg-5 divide-right">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="
                                @if(Storage::exists($sku->product->picture))
                                    {{ Storage::url($sku->product->picture) }}
                                @else
                                    {{ Storage::url('no_photo.jpeg') }}
                                @endif
                                    "
                                 alt="{{ $sku->product->__('name') }}">
                        </div>
                        <div class="col-md-6 mb-2 mb-md-0">
                            <h4 class="product-name">{{ $product->__('name') }}</h4>
                            <h5 class="price"> <span class="price-value">{{ $sku->price }}</span> {{ $currencySymbol }}</h5>
                            <div class="product-properties">
                                @foreach($product->skus_properties as $prop_name => $property)
                                    <div class="product-size d-flex align-items-center mt-30">
                                        <h6 class="title">
                                            <select name="{{ $prop_name }}" id="{{ $property['prop_id'] }}">
                                                @foreach($property['values'] as $value)
                                                    <option {{ $value['current'] === true ? 'selected' : '' }} value="{{ $value['id'] }}" {{ $value['available'] === true ? '' : 'disabled' }}>{{ $value['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </h6>
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-count style">
                                <h6 class="quantity mb-20"><strong>@lang('main.quantity'):</strong></h6>
                                @php
                                    $buttonId = 'set-quantity-modal'
                                @endphp
                                @include('layouts.quantity_product_block',compact('buttonId'))
{{--                                <div class="count d-flex">--}}
{{--                                    <input id="set-quantity-modal" type="number" min="1" max="{{ $sku->quantity }}" step="1" value="{{ $quantity > $sku->quantity ? $sku->quantity : $quantity }}">--}}
{{--                                    <div class="button-group">--}}
{{--                                        <button class="count-btn increment"><i class="fas fa-chevron-up"></i></button>--}}
{{--                                        <button class="count-btn decrement"><i class="fas fa-chevron-down"></i></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="modal-cart-content">
                        <p class="cart-products-count">@lang('main.basket_quantity',['quantity' => $quantityInBasket])</p>
                        <p>@lang('main.basket_amount',['price' => $basketAmount . " " . $currencySymbol])</p>
                        <div class="cart-content-btn">
                            <button type="button" class="btn theme-btn--dark1 btn--md mt-4"
                                    data-bs-dismiss="modal">@lang('main.basket_continue_shopping')</button>
                            <form class="add-to-basket" action="{{ route('basketAdd',[$sku->id,$quantity]) }}" method="POST">
                                @csrf
                                <button class="btn theme-btn--dark1 btn--md mt-4"><i
                                            class="ion-checkmark-round" type="submit"></i>@lang('main.basket_add_to_cart')</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-sb-12 col-md-12">
                    @lang('main.basket_add_unauthorized',['link' => route('register')])
                </div>
            @endisset
        </div>
    </div>
</div>
@isset($product)
    <script>
        if(typeof setAxiosPreloader !== "function") {
            function setAxiosPreloader() {
                axios.interceptors.request.use((config) => {
                    $('#preloader').show();
                    $('#status').show();
                    return config;
                });
            }
        }
        $('.product-properties select').change(function() {
            let prepareData = {};
            $('.product-properties select').each(function() {
                prepareData[$(this).attr('id')] = $(this).val();
            })
            setAxiosPreloader();
            axios.get('/basket/modal/get-sku',{
                params: {
                    data: prepareData,
                    product_id: {{ $product->id }},
                    quantity: $('#set-quantity-modal').val()
                }
            })
            .then((response) => {
                console.log(response.data.SKU)
                $('h5 .price-value').html(response.data.SKU.price);
                let actionHref = $('.add-to-basket').attr('action');
                $('.add-to-basket').attr('action',actionHref.replaceAll(/(\d)+$/g,response.data.SKU.id));
                let quantityInput = $('#set-quantity-modal');
                if(response.data.SKU.quantity < quantityInput.val()) {
                    quantityInput.val(response.data.SKU.quantity);
                }
                $('.add-to-basket').prop('action',response.data.HREF);
                quantityInput.attr('max',response.data.SKU.quantity);
                let productData = response.data.PRODUCT;
                Object.keys(productData).forEach(function(key) {
                    let item = productData[key];
                    let select = $('select[id=' + item["prop_id"] + ']')
                    Object.keys(item["values"]).forEach(function(keyValue) {
                        let prop = item["values"][keyValue];
                        let option = select.find('option[value=' + prop.id + ']');
                        if(prop['available'] && option.attr('disabled')) {
                            option.removeAttr('disabled');
                        }
                        else if(!prop['available'] && !option.attr('disabled')) {
                            option.attr('disabled','disabled');
                        }
                    });
                });
            })
            .finally(() => {
                // $('#preloader').hide();
                $('#status').fadeOut();
                $('#preloader').delay(350).fadeOut('slow');
            });
        })
    </script>
    <script>
        if(typeof addToBasketChangeQuantity !== "function") {
            function addToBasketChangeQuantity(value) {
                const addToBasketButton = $('.add-to-basket');
                const addToBasketHref = addToBasketButton.prop('action');
                const newHref = addToBasketHref.replace(/\d+$/,value);
                addToBasketButton.prop('action',newHref);
            }
        }
    </script>
    <script>
        function addQuantityInputModal() {
            $('.product-count .button-group .count-btn.increment').click(function () {
                let inputQuantity;
                if ($(this).parents('.modal-body').length !== 0) {
                    inputQuantity = $('#set-quantity-modal');
                    const quantityVal = parseInt(inputQuantity.val());

                    const maxQuantity = parseInt(inputQuantity.attr('max'));
                    if (quantityVal < maxQuantity) {
                        inputQuantity.val(quantityVal + 1);
                    }
                    addToBasketChangeQuantity(inputQuantity.val());
                }
            });
        }

        function removeQuantityInputModal() {
            $('.product-count .button-group .count-btn.decrement').click(function () {
                let inputQuantity;
                if ($(this).parents('.modal-body').length !== 0) {
                    inputQuantity = $('#set-quantity-modal');
                    const quantityVal = parseInt(inputQuantity.val());
                    const minQuantity = parseInt(inputQuantity.attr('min'));
                    if (quantityVal > minQuantity) {
                        inputQuantity.val(quantityVal - 1);
                    }
                }
                addToBasketChangeQuantity(inputQuantity.val());
            });
        }
        addQuantityInputModal();
        removeQuantityInputModal();
    </script>
@endisset
