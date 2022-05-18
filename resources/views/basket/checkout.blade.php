@extends('layouts.main_layout')
@section('title',__('checkout.title'))
@section('content')
    {{ Breadcrumbs::render('checkout') }}
    <section class="check-out-section pb-40">
        <div class="container grid-wraper">
            <div class="row">
                <div class="col-lg-8 mb-30">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingProducts">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#productsCollapse"
                                            aria-expanded="true" aria-controls="productsCollapse">
                                        @lang('checkout.title_products_step')
                                    </button>
                                </h5>
                            </div>
                            <div id="productsCollapse" class="collapse show" aria-labelledby="headingProducts"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" style="width:25%" scope="col-md-3">@lang('cart.product_image')</th>
                                                <th class="text-center" style="width:25%" scope="col-md-3">@lang('cart.product_name')</th>
                                                <th class="text-center" style="width:16%" scope="col-md-2">@lang('cart.price')</th>
                                                <th class="text-center" style="width:16%" scope="col-md-2">@lang('cart.qty')</th>
                                                <th class="text-center" style="width:16%" scope="col-md-2">@lang('cart.total')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->skus as $sku)
                                                <tr>
                                                    <th class="text-center" scope="row">
                                                        <a href="{{ route('sku',[$sku->product->category->code,$sku->product->code,$sku]) }}">
                                                            <img src="{{ Storage::url($sku->product->picture) }}" alt="{{ $sku->product->__('name') }}">
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
                                                                <span>{{ $sku->quantityInOrder }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="whish-list-price">
                                                            {{ $sku->getAmountPrice() }} {{ $currencySymbol }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                        @lang('checkout.personal_info')
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <form action="{{ route('confirmOrder') }}" id="checkout-form" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-3 col-form-label">@lang('checkout.full_name')*</label>
                                            <div class="col-md-6">
                                                <input required name="name" type="text" id="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-3 col-form-label">Email*</label>
                                            <div class="col-md-6">
                                                <input required name="email" type="email" id="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-md-3 col-form-label">@lang('checkout.telephone')*</label>
                                            <div class="col-md-6">
                                                <input required name="phone" type="tel" id="email" class="form-control">
                                            </div>
                                        </div>
                                        <button id="submit-checkout-form" class="btn theme-btn--dark1 btn--md hidden" type="submit"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="sign-btn text-end">
                                    <button class="btn theme-btn--dark1 btn--md proceed-checkout-button" type="submit">@lang('checkout.proceed')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-30">
                    <ul class="list-group cart-summary rounded-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <ul class="items">
                                <li>
                                    @lang('checkout.total_items')
                                    {{ $order->skus->count() }}
                                </li>
                            </ul>
                            <ul class="amount">
                                <li>{{ $order->calculateOrderPrice(true) }} {{ $currencySymbol }}</li>
                            </ul>
                        </li>
                        <li class="list-group-item text-center">
                            <button class="btn theme-btn--dark1 btn--md proceed-checkout-button" type="submit">@lang('checkout.proceed')</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
