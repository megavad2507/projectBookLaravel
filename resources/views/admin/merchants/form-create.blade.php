@extends('admin.app')

@isset($merchant)
    @section('title','Редактировать поставщика '.$merchant->name)
@else
    @section('title','Создать поставщика')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($merchant)
            <h1>Редактировать поставщика <b>{{ $merchant->name }}</b></h1>
        @else
            <h1>Добавить поставщика</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($merchant)
                action="{{ route('merchants.update',$merchant) }}"
              @else
                action="{{ route('merchants.store') }}"
              @endisset
        >
            <div>
                @csrf
                @isset($merchant)
                    @method('PUT')
                @endisset
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Имя: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($merchant) ? $merchant->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="email" class="col-sm col-form-label">Email: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'email'])
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('name', isset($merchant) ? $merchant->email : null) }}">
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

