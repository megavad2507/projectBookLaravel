@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="/styles/cart.css">
    <link rel="stylesheet" type="text/css" href="/styles/cart_responsive.css">
@endpush
@section('title','Корзина')

@section('content')
    <!-- Home -->
<div class="home">
    <div class="home_container">
        <div class="home_background" style="background-image:url(/images/cart.jpg)"></div>
        <div class="home_content_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="categories.html">Categories</a></li>
                                    <li>Shopping Cart</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart Info -->

<div class="cart_info">
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Column Titles -->
                <div class="cart_info_columns clearfix">
                    <div class="cart_info_col cart_info_col_product">Product</div>
                    <div class="cart_info_col cart_info_col_price">Price</div>
                    <div class="cart_info_col cart_info_col_quantity">Quantity</div>
                    <div class="cart_info_col cart_info_col_total">Total</div>
                </div>
            </div>
        </div>
        <div class="row cart_items_row">
            <div class="col">
                @foreach($order->skus as $sku)
                    <!-- Cart Item -->
                    <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                        <!-- Name -->
                        <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                            <div class="cart_item_image">
                                <div>
                                    <img src="{{ Storage::url($sku->product->picture) }}" alt="">
                                </div>

                            </div>
                            <div class="cart_item_name_container">
                                <div class="cart_item_name"><a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">{{ $sku->product->__('name') }}</a></div>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="cart_item_price">{{ $sku->price }} {{ $currencySymbol }}</div>
                        <!-- Quantity -->
                        <div class="cart_item_quantity">
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <span>Кол-во</span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="{{ $sku->quantityInOrder }}">
                                    <div class="quantity_buttons">
                                        <form action="{{ route('basketAdd',$sku->id) }}" method="POST">
                                            @csrf
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control">
                                                <button type="submit" @if(!$sku->orderMoreItems()) class="disabled" disabled title="На нашем складе только {{ $sku->quantity." ".$sku->product->__('name') }}"  @endif><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                        <form action="{{ route('basketRemove',$sku) }}" method="POST">
                                            @csrf
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control">
                                                <button type="submit"><i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total -->
                        <div class="cart_item_total">{{ $sku->getAmountPrice() }} {{ $currencySymbol }}</div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="row row_cart_buttons">
            <div class="col">
                <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                    <div class="button continue_shopping_button"><a href="{{ route('categories') }}">Continue shopping</a></div>
                    <div class="cart_buttons_right ml-lg-auto">
                        <div class="button clear_cart_button"><a href="#">Clear cart</a></div>
                        <div class="button update_cart_button"><a href="#">Update cart</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row_extra">
            <div class="col-lg-4">
                <!-- Coupon Code -->
                <div class="coupon">
                    <div class="section_title">Купон</div>
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    @if(!$order->hasCoupon())
                        @if(session()->has('delete_coupon'))
                            <p class="alert alert-danger">{{ session()->get('delete_coupon') }}</p>
                        @endif
                        <div class="section_subtitle">Введите код купона</div>
                        <div class="coupon_form_container">
                            @include('layouts.error', ['fieldName' => 'coupon'])
                            <form method="POST" action="{{ route('setCoupon') }}" id="coupon_form" class="coupon_form">
                                @csrf
                                <input type="text" name="coupon" class="coupon_input">
                                <button type="submit" class="button coupon_button"><span>Применить</span></button>
                            </form>
                        </div>

                    @else
                        @if(session()->has('success'))
                            <p class="alert alert-success">{{ session()->get('success') }}</p>
                        @endif
                        <form method="POST" action="{{ route('deleteCoupon',$order->coupon) }}" id="coupon_form" class="coupon_form">
                            @csrf
                            <button type="submit" class="btn btn-danger"><span>Удалить купон</span></button>
                        </form>
                        <div class="alert alert-success">Вы испльзуете купон {{ $order->coupon->code }}</div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 offset-lg-2">
                <div class="cart_total">
                    <div class="section_title">Cart total</div>
                    <div class="section_subtitle">Final info</div>
                    <div class="cart_total_container">
                        <ul>
                            @foreach($order->skus as $sku)
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">{{ $sku->product->__('name') }} x {{ $sku->quantityInOrder }}</div>
                                    <div class="cart_total_value ml-auto">{{ $sku->getAmountPrice() }} {{ $currencySymbol }}</div>
                                </li>
                            @endforeach
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Конечная стоимость</div>
                                @if($order->hasCoupon())
                                    <div class="cart_total_value ml-auto old-price">{{ $order->calculateOrderPrice() }} {{ $currencySymbol }}</div>
                                    <div class="cart_total_value ml-auto">{{ $order->calculateOrderPrice(true) }} {{ $currencySymbol }}</div>
                                @else
                                    <div class="cart_total_value ml-auto">{{ $order->calculateOrderPrice() }} {{ $currencySymbol }}</div>

                                @endif
                            </li>
                        </ul>
                    </div>
                    <div class="button checkout_button"><a href="{{ route('checkout') }}">Оформить заказ</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="/js/cart.js"></script>
@endpush
