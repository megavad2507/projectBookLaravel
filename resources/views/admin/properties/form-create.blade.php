@extends('admin.app')

@isset($property)
    @section('title','Редактировать свойство '.$property->name)
@else
    @section('title','Создать свойство')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($property)
            <h1>Редактировать свойство <b>{{ $property->name }}</b></h1>
        @else
            <h1>Добавить свойство</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($property)
                action="{{ route('properties.update',$property) }}"
              @else
                action="{{ route('properties.store') }}"
              @endisset
        >
            <div>
                @csrf
                @isset($property)
                    @method('PUT')
                @endisset
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($property) ? $property->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name_en" value="{{ old('name', isset($property) ? $property->name_en : null) }}">
                    </div>
                </div>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code" value="{{ old('name', isset($property) ? $property->code : null) }}">
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

