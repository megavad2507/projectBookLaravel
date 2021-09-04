@extends('admin.app')

@isset($sku)
    @section('title','Редактировать ТП '.$sku->name)
@else
    @section('title','Создать торговое предложение')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($sku)
            <h1>Редактировать ТП <b>{{ $sku->name }}</b></h1>
        @else
            <h1>Создать торговое предложение</h1>
        @endisset
        @if(session()->has('warning'))
            <p class="alert alert-warning">{{ session()->get('warning') }}</p>
        @endif
        <form method="POST" enctype="multipart/form-data"
              @isset($sku)
                action="{{ route('skus.update',[$product,$sku]) }}"
              @else
                action="{{ route('skus.store',$product) }}"
              @endisset
        >
            <div>
                @csrf
                @isset($sku)
                    @method('PUT')
                @endisset
                <div class="">
                    <label for="price" class="col-sm col-form-label">Цена: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'price'])
                        <input type="text" class="form-control" name="price" id="price"
                               value="{{ old('price', isset($sku) ? $sku->price : (isset($postInformation) ? $postInformation['price'] : null)) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="quantity" class="col-sm col-form-label">Количество: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'quantity'])
                        <input type="text" class="form-control" name="quantity" id="quantity"
                               value="{{ old('quantity', isset($sku) ? $sku->quantity : (isset($postInformation) ? $postInformation['quantity'] : null)) }}">
                    </div>
                </div>
                <br>

                @foreach($product->properties as $property)
                    <div class="">
                        <label for="property_id[{{ $property->id }}]" class="col-sm col-form-label">{{ $property->name }}: </label>
                        <div class="col-sm-6">
                            <select name="property_id[{{ $property->id }}]" class="form-control">
                                @foreach($property->options as $option)
                                    <option value="{{ $option->id }}"
                                            @isset($sku)
                                                @if($sku->propertyOptions->contains($option->id))
                                                    selected
                                                @endif
                                            @elseif(is_array(old('property_id')))
                                                @if(old('property_id')[$property->id] == $option->id)
                                                    selected
                                                @endif
                                            @endisset
                                    >{{$option->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                    </div>
                @endforeach

                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
            <a href="{{ route('skus.index', $product) }}">Назад</a>
    </div>
@endsection

