@extends('admin.app')

@isset($propertyOption)
    @section('title','Редактировать вариант свойства '.$property->name)
@else
    @section('title','Добавить вариант свойства ' .$property->name)
@endisset
@section('content')
    <div class="col-md-12">
        @isset($propertyOption)
            <h1>Редактировать вариант свойства <b>{{ $property->name }}</b></h1>
        @else
            <h1>Добавить вариант свойства {{ $property->name }}</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($propertyOption)
                action="{{ route('property_options.update',[$property,$propertyOption]) }}"
              @else
                action="{{ route('property_options.store',$property) }}"
              @endisset
        >
            <div>
                @csrf
                @isset($propertyOption)
                    @method('PUT')
                @endisset
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($propertyOption) ? $propertyOption->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name_en" value="{{ old('name', isset($propertyOption) ? $propertyOption->name_en : null) }}">
                    </div>
                </div>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code" value="{{ old('name', isset($propertyOption) ? $propertyOption->code : null) }}">
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

