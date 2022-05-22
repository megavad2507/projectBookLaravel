@extends('admin.app')

@isset($payment)
    @section('title','Редактировать способ оплаты '.$payment->name)
@else
    @section('title','Создать способ оплаты')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($payment)
            <h1>Редактировать способ оплаты <b>{{ $payment->name }}</b></h1>
        @else
            <h1>Добавить способ оплаты</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($payment)
              action="{{ route('payments.update',$payment) }}"
              @else
              action="{{ route('payments.store') }}"
                @endisset
        >
            <div>
                @csrf
                @isset($payment)
                    @method('PUT')
                @endisset
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ old('name', isset($payment) ? $payment->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Название на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               value="{{ old('name_en', isset($payment) ? $payment->name_en : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72"
                                  rows="7">{{ old('description', isset($payment) ? $payment->description : null) }}</textarea>
                    </div>
                </div>
                <div class="">
                    <label for="description_en" class="col-sm col-form-label">Описание на английском: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description_en'])
                        <textarea name="description_en" id="description_en" cols="72"
                                  rows="7">{{ old('description_en', isset($payment) ? $payment->description_en : null) }}</textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

