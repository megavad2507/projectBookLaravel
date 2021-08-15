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
        <div class="home_background" style="background-image:url(images/cart.jpg)"></div>
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
                @foreach($order->products as $product)
                    <!-- Cart Item -->
                    <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                        <!-- Name -->
                        <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                            <div class="cart_item_image">
                                <div><img src="{{ Storage::url($product->picture) }}" alt=""></div>
                            </div>
                            <div class="cart_item_name_container">
                                <div class="cart_item_name"><a href="{{ route('product',[$product->category->code,$product->code]) }}">{{ $product->name }}</a></div>
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="cart_item_price">{{ $product->price }} руб.</div>
                        <!-- Quantity -->
                        <div class="cart_item_quantity">
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <span>Кол-во</span>
                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="{{ $product->pivot->quantity }}">
                                    <div class="quantity_buttons">
                                        <form action="{{ route('basketAdd',$product->id) }}" method="POST">
                                            @csrf
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control">
                                                <button type="submit"><i class="fa fa-chevron-up" aria-hidden="true"></i></button>
                                            </div>
                                        </form>
                                        <form action="{{ route('basketRemove',$product) }}" method="POST">
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
                        <div class="cart_item_total">{{ $product->getAmountPrice() }} руб.</div>
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
                    <div class="section_title">Coupon code</div>
                    <div class="section_subtitle">Enter your coupon code</div>
                    <div class="coupon_form_container">
                        <form action="#" id="coupon_form" class="coupon_form">
                            <input type="text" class="coupon_input" required="required">
                            <button class="button coupon_button"><span>Apply</span></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 offset-lg-2">
                <div class="cart_total">
                    <div class="section_title">Cart total</div>
                    <div class="section_subtitle">Final info</div>
                    <div class="cart_total_container">
                        <ul>
                            @foreach($order->products as $product)
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">{{ $product->name }} x {{ $product->pivot->quantity }}</div>
                                    <div class="cart_total_value ml-auto">{{ $product->getAmountPrice() }}</div>
                                </li>
                            @endforeach
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Конечная стоимость</div>
                                <div class="cart_total_value ml-auto">{{ $order->getOrderPrice() }} руб.</div>
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
    <script src="js/cart.js"></script>
@endpush