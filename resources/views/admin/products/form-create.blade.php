@extends('admin.app')

@isset($product)
    @section('title','Редактировать товар '.$product->name)
@else
    @section('title','Создать товар')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($product)
              action="{{ route('products.update',$product) }}"
              @else
              action="{{ route('products.store') }}"
                @endisset
        >
            <div>
                @csrf
                @isset($product)
                    @method('PUT')
                @endisset
                <div class="">
                    <label for="code" class="col-sm col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code"
                               value="{{ old('code', isset($product) ? $product->code : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ old('name', isset($product) ? $product->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               value="{{ old('name', isset($product) ? $product->name_en : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72"
                                  rows="7">{{ old('description', isset($product) ? $product->description : null) }}</textarea>
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Описание на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description_en'])
                        <textarea name="description_en" id="description_en" cols="72"
                                  rows="7">{{ old('description', isset($product) ? $product->description_en : null) }}</textarea>
                    </div>
                </div>
                <div class="">
                    <label for="category-name" class="col-sm col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        <select name="category_id" id="category_id" class="form-control">

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @isset($product)
                                        @if($product->category_id == $category->id)
                                        selected
                                        @endif
                                        @elseif(old('category_id') == $category->id)
                                        selected
                                        @endisset
                                >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="picture" class="col-sm col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label for="picture" class="btn btn-secondary">
                            Загрузить <input type="file" style="display: none" name="picture" id="picture">
                        </label>
                    </div>
                </div>
                <br>
                @foreach(['hot' => 'Горячее предложение','new' => 'Новинка','sale' => 'Распродажа'] as $attribute => $name)
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="code" class="col-sm col-form-label">{{ $name }}: </label>
                        </div>
                        <div class="col-sm-6">
                            @include('layouts.error', ['fieldName' => $attribute])
                        <input type="checkbox" class="form-control" name="{{ $attribute }}" id="{{ $attribute }}"
                            @if(isset($product) && $product->$attribute === 1)
                                checked="checked"
                            @endif
                        >
                        </div>
                    </div>
                    <br>
                @endforeach
                <br>
                <div class="">
                    <label for="category-name" class="col-sm col-form-label">Свойства: </label>
                    <div class="col-sm-6">
                        <select name="property_id[]" id="property_id" class="form-control" multiple>

                            @foreach($properties as $property)
                                <option value="{{ $property->id }}"
                                        @isset($product)
                                            @if($product->properties->contains($property->id))
                                                selected
                                            @elseif($product->properties->contains(old('property_id')))
                                                selected
                                            @endif
                                        @endisset
                                >{{$property->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

