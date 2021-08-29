@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="/styles/checkout.css">
    <link rel="stylesheet" type="text/css" href="/styles/checkout_responsive.css">
@endpush
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
                                        <li><a href="cart.html">Shopping Cart</a></li>
                                        <li>Checkout</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout -->

    <div class="checkout">
        <div class="container">
            <div class="row">

                <!-- Billing Info -->
                <div class="col-lg-6">
                    <div class="billing checkout_section">
                        <div class="section_title">Billing Address</div>
                        <div class="section_subtitle">Enter your address info</div>
                        <div class="checkout_form_container">
                            <form action="{{ route('confirmOrder') }}" id="checkout_form" class="checkout_form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <!-- Name -->
                                        <label for="checkout_name">Имя*</label>
                                        <input type="text" name="name" id="checkout_name" class="checkout_input" value="{{ $user->name }}" required="required">
                                    </div>
                                </div>
                                <div>
                                    <!-- Phone no -->
                                    <label for="checkout_phone">Номер телефона*</label>
                                    <input type="tel" name="phone" id="checkout_phone" class="checkout_input" required="required">
                                </div>
                                <div>
                                    <!-- Phone no -->
                                    <label for="checkout_email">Email*</label>
                                    <input type="email" name="email" id="checkout_email" value="{{ $user->email }}" class="checkout_input"  required="required">
                                </div>
                                <div class="button order_button">
                                    <button type="submit">Place Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Order Info -->

                <div class="col-lg-6">
                    <div class="order checkout_section">
                        <div class="section_title">Ваш заказ</div>
                        <div class="section_subtitle">Подробности заказа</div>

                        <!-- Order details -->
                        <div class="order_list_container">
                            <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Товар</div>
                                <div class="order_list_value ml-auto">Стоимость</div>
                            </div>
                            <ul class="order_list">
                                @foreach($order->products as $product)
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="order_list_title">{{ $product->__('name') }} x {{ $product->pivot->quantity }}</div>
                                        <div class="order_list_value ml-auto">{{ $product->getAmountPrice() }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</div>
                                    </li>
                                @endforeach
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="order_list_title">Конечная стоимость</div>
                                    <div class="order_list_value ml-auto">{{ $order->calculateOrderPrice() }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</div>
                                </li>
                            </ul>
                        </div>

                        <!-- Order Text -->
                        <div class="button order_button">
                            <a type="submit" href="#">Place Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/js/checkout.js"></script>
@endpush

