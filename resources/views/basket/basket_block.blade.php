<div class="container grid-wraper">
    <div class="row">
        <div class="col-12">
            <h3 class="title pb-25 text-center text-md-start">@lang('cart.your_cart_items')</h3>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col">@lang('cart.product_image')</th>
                        <th class="text-center" scope="col">@lang('cart.product_name')</th>
                        <th class="text-center" scope="col">@lang('cart.price')</th>
                        <th class="text-center" scope="col">@lang('cart.qty')</th>
                        <th class="text-center" scope="col">@lang('cart.total')</th>
                        <th class="text-center" scope="col">@lang('cart.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->skus as $sku)
                        <tr>
                            <th class="text-center" scope="row">
                                <a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">
                                    <img src="
                                        @if(Storage::exists($sku->product->picture))
                                            {{ Storage::url($sku->product->picture) }}
                                        @else
                                            {{ Storage::url('no_photo.jpeg') }}
                                        @endif
                                            "
                                    alt="{{ $sku->product->__('name') }}">
                                </a>
                            </th>
                            <td class="text-center">
                                <a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">
                                    <span class="whish-title">{{ $sku->product->__('name') }}</span>
                                </a>
                                <div class="props_block">
                                    @foreach($sku->product->properties as $property)
                                        <div class="prop_block">
                                            <span class="property-name">{{ $property->__('name') }}:</span>
                                            <span class="property-option">{{ $sku->propertyOptions->where('property_id',$property->id)->first()->__('name') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="whish-list-price">
                                    {{ $sku->price }} {{ $currencySymbol }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="product-count style">
                                    <div class="count d-flex justify-content-center">
                                        <input class="set-quantity" sku-id="{{ $sku->id }}" type="number" min="1" max="{{ $sku->quantity }}" step="1" value="{{ $sku->quantityInOrder }}">
                                        <div class="button-group">
                                            <form action="{{ route('basketAdd',[$sku->id,1]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="count-btn increment" @if(!$sku->orderMoreItems()) class="disabled" disabled @endif><i
                                                        class="fas fa-chevron-up"></i></button>
                                            </form>
                                            <form action="{{ route('basketRemove',$sku) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="count-btn decrement"><i
                                                        class="fas fa-chevron-down"></i></button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                    <span class="wish-list-price">
                                        {{ $sku->getAmountPrice() }} {{ $currencySymbol }}
                                    </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('basketDeleteSku',$sku) }}" class="delete-from-basket"> <span class="trash"><i class="fas fa-trash-alt"></i> </span></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            @if(session()->has('warning'))
                                <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                            @endif
                            @if(!$order->hasCoupon())
                                @if(session()->has('delete_coupon'))
                                    <p class="alert alert-danger">{{ session()->get('delete_coupon') }}</p>
                                @endif
                                <div class="row coupon_form_container">
                                    <div class="col-12">
                                        @include('layouts.error', ['fieldName' => 'coupon'])
                                        <form method="POST" action="{{ route('setCoupon') }}" id="coupon_form" class="coupon_form position-relative">
                                            @csrf
                                            <input name="coupon" class="form-control" type="text" placeholder="@lang('cart.enter_coupon')">
                                            <button class="btn coupon-set-button text-uppercase" type="submit">
                                                @lang('cart.apply_coupon')
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                @if(session()->has('success'))
                                    <p class="alert alert-success">{{ session()->get('success') }}</p>
                                @endif
                                <div class="row coupon_form_container">
                                    <div class="col-12">
                                        @include('layouts.error', ['fieldName' => 'coupon'])
                                        <form method="POST" action="{{ route('deleteCoupon',$order->coupon) }}" id="coupon_form" class="coupon_form position-relative">
                                            @csrf
                                            <button type="submit" class="btn btn-danger mb-20"><span>@lang('cart.delete_coupon')</span></button>
                                        </form>
                                    </div>
                                </div>

                                <div class="alert alert-success">@lang('cart.applied_coupon',['code' => $order->coupon->code])</div>
                            @endif
                        </td>
                        <td class="text-right" colspan="4">
                            @lang('cart.cart_total')
                            <span class="wish-list-price">
                                    @if($order->hasCoupon())
                                    <span class="wish-list-price old-price">
                                            {{ $order->calculateOrderPrice() }} {{ $currencySymbol }}
                                        </span>
                                    <span class="wish-list-price">
                                            {{ $order->calculateOrderPrice(true) }} {{ $currencySymbol }}
                                        </span>
                                @else
                                    <span class="wish-list-price">
                                            {{ $order->calculateOrderPrice() }} {{ $currencySymbol }}
                                        </span>
                                @endif
                                </span>

                        </td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="6">
                            <a href="{{ route('checkout') }}" class="btn theme-btn--dark1 btn--xl text-uppercase">@lang('cart.go_to_checkout')</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
