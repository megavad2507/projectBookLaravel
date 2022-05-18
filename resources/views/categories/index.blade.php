@extends('layouts.main_layout')
@section('title','Категории')
@section('content')
    {{ Breadcrumbs::render() }}
    <div class="categories">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-md-4 col-xs-12">
                        <div class="category_image"><img src="{{ Storage::url($category->picture) }}" alt="" style="width: 300px;height: 300px"></div>
                        <div class="category_content">
                            <div class="category_title"><a href="{{ route('category',$category->code) }}">{{ $category->__('name') }}</a></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
