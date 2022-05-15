<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(__('main.home'), route('index'));
});

Breadcrumbs::register('login',function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('main.login_page'),route('login'));
});

Breadcrumbs::register('register',function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('main.register_page'),route('register'));
});

Breadcrumbs::register('basket', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('cart.title'), route('basket'));
});

Breadcrumbs::register('checkout', function ($breadcrumbs) {
    $breadcrumbs->parent('basket');
    $breadcrumbs->push(__('main.checkout'), route('checkout'));
});

Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category->__('name'), route('category', [
        'category' => $category->code
    ]));
});
Breadcrumbs::register('product', function ($breadcrumbs, $category, $product,$sku) {
    $breadcrumbs->parent('category', $category);
    $breadcrumbs->push($product->__('name'), route('sku', [
        'category' => $category->code,
        'product' => $product->code,
        'sku' => $sku->id
    ]));
});
