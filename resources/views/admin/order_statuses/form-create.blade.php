@extends('admin.app')

@isset($orderStatus)
    @section('title','Редактировать статут заказа '.$orderStatus->name)
@else
    @section('title','Создать статут заказа')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($orderStatus)
            <h1>Редактировать статут заказа <b>{{ $orderStatus->name }}</b></h1>
        @else
            <h1>Добавить статут заказа</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($orderStatus)
              action="{{ route('order_statuses.update',$orderStatus) }}"
              @else
              action="{{ route('order_statuses.store') }}"
                @endisset
        >
            <div>
                @csrf
                @isset($orderStatus)
                    @method('PUT')
                @endisset
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ old('name', isset($orderStatus) ? $orderStatus->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Название на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               value="{{ old('name_en', isset($orderStatus) ? $orderStatus->name_en : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Сортировка: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'sort'])
                        <input type="text" class="form-control" name="sort" id="sort"
                               value="{{ old('sort', isset($orderStatus) ? $orderStatus->sort : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72"
                                  rows="7">{{ old('description', isset($orderStatus) ? $orderStatus->description : null) }}</textarea>
                    </div>
                </div>
                <div class="">
                    <label for="description_en" class="col-sm col-form-label">Описание на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description_en'])
                        <textarea name="description_en" id="description_en" cols="72"
                                  rows="7">{{ old('description_en', isset($orderStatus) ? $orderStatus->description_en : null) }}</textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

