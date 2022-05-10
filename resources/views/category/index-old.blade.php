@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="/styles/category.css">
    <link rel="stylesheet" type="text/css" href="/styles/category_responsive.css">
@endpush
@section('title',$category->__('name'))
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
                                <div class="home_title">{{ $category->__('name') }}<span>.</span></div>
                                <div class="home_text"><p>{{ $category->__('description') }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products" id="products_list">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Показано <span>{{ $skus->count() }}</span> товара</div>
                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Sort by</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "stars" }'><span>Name</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.products_filter')
            <div class="row">
                <div class="col">
                    @if($skus->count() == 0)
                        @if(request()->has('price_from'))
                            По вашему запросу не найдено ни одного товара
                        @else
                            В данной категории нет товаров
                        @endif
                    @endif
                    <div class="product_grid">
                        @foreach($skus as $sku)
                            @include('layouts.card_sku',['category' => $category,'sku' => $sku])
                        @endforeach
                    </div>
                    {{ $skus->links('layouts.pagination',['category' => $category]) }}

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="/js/category.js"></script>
@ednpush
