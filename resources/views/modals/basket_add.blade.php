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
                            <img src="{{ Storage::url($product->picture) }}" alt="{{ $product->__('name') }}">
                        </div>
                        <div class="col-md-6 mb-2 mb-md-0">
                            <h4 class="product-name">{{ $product->__('name') }}</h4>
                            <h5 class="price"> <span class="price-value">{{ $product->skus->first()->price }}</span> {{ $currencySymbol }}</h5>
                            <div class="product-properties">
                                @foreach($product->skus_properties as $prop_name => $property)
                                    <div class="product-size d-flex align-items-center mt-30">
                                        <h6 class="title">
                                            <select name="{{ $prop_name }}" id="{{ $property['prop_id'] }}">
                                                @foreach($property['values'] as $value)
                                                    <option value="{{ $value['id'] }}" {{ $value['available'] === true ? '' : 'disabled' }}>{{ $value['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </h6>
                                    </div>
                                @endforeach
                            </div>
                            <h6 class="quantity"><strong>@lang('main.quantity'):</strong>&nbsp;1</h6>
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
                            <form class="add-to-basket" action="{{ route('basketAdd',$product->skus->first()->id) }}" method="POST">
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
        $('.product-properties select').change(function() {
            let prepareData = {};
            $('.product-properties select').each(function() {
                prepareData[$(this).attr('id')] = $(this).val();
            })
            axios.get('/basket/modal/get-sku',{
                params: {
                    data: prepareData,
                    product_id: {{ $product->id }}
                }
            })
            .then((response) => {
                $('h5 .price-value').html(response.data.SKU.price);
                let actionHref = $('.add-to-basket').attr('action');
                $('.add-to-basket').attr('action',actionHref.replaceAll(/(\d)+$/g,response.data.SKU.id));
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
        })
    </script>
@endisset
