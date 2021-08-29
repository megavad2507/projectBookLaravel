@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
@endpush

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/categories.jpg)"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{ $product->category->__('name') }}<span>.</span></div>
                                <div class="home_text"><p>{{ $product->category->__('description') }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details -->

    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="details_image">
                        <div class="details_image_large"><img src="{{ Storage::url($product->picture) }}" alt="">
                            @include('layouts.product_labels')
                        </div>
                        <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                            <div class="details_image_thumbnail active" data-image="{{ Storage::url($product->picture) }}"><img src="{{ Storage::url($product->picture) }}" alt=""></div>
                        </div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name">{{ $product->__('name') }}</div>
                        <div class="details_price">{{ $product->price }} {{ App\Services\CurrencyConversion::getCurrencySymbol() }}</div>

                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Наличие:</div>
                            @if($product->isAvailable())
                                <span>В наличии</span>
                            @else
                                <span class="unavailable">Не в наличии</span>
                            @endif
                        </div>
                        <div class="details_text">
                            <p>{{ $product->__('description') }}</p>
                        </div>

                        <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span>Кол-во</span>
                                <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                <div class="quantity_buttons">
                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            @if($product->isAvailable())
                                <div class="button cart_button">
                                    <form action="{{ route('basketAdd',$product) }}" method="POST">
                                        @csrf
                                        <button type="submit">Добавить в корзину</button>
                                    </form>
                                </div>
                            @else
                                <div class="button cart_button @if(!$product->isAvailable()) disabled @endif">
                                    <button type="submit" @if(!$product->isAvailable()) title="Товар не доступен для покупки" disabled @endif>Добавить в корзину</button>
                                </div>
                                <form action="{{ route('subscribe',$product) }}" method="POST" class="form-pre-order">
                                    @include('layouts.error', ['fieldName' => 'email'])
                                    @csrf
                                    <input type="text" name="email" class="checkout_input product_quantity clearfix pd-l-0" placeholder="Введите email" value="{{ Auth::check() ? Auth::user()->email : ''}}">
                                    <div class="button cart_button"><button type="submit">Сообщить мне о поступлении товара</button></div>

                                </form>

                            @endif
                        </div>

                        <!-- Share -->
                        <div class="details_share">
                            <span>Share:</span>
                            <ul>
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        <div class="description_title">Description</div>
                        <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div>
                    </div>
                    <div class="description_text">
                        <p>{{ $product->__('description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/js/product.js"></script>
@endpush
