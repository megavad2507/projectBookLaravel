@extends('layouts.main_layout')
@section('title',__('cart.title'))
@section('content')
    {{ Breadcrumbs::render('basket') }}
    <section class="whish-list-section theme1 pb-70 basket-block">
        @include('basket.basket_block')
    </section>
@endsection
