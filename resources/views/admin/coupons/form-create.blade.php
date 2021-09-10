@extends('admin.app')

@isset($coupon)
    @section('title','Редактировать товар '.$coupon->name)
@else
    @section('title','Создать купон')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($coupon)
            <h1>Редактировать товар <b>{{ $coupon->name }}</b></h1>
        @else
            <h1>Добавить купон</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($coupon)
              action="{{ route('coupons.update',$coupon) }}"
              @else
              action="{{ route('coupons.store') }}"
                @endisset
        >
            <div>
                @csrf
                @isset($coupon)
                    @method('PUT')
                @endisset
                <div class="">
                    <label for="code" class="col-sm col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code"
                               value="{{ old('code', isset($coupon) ? $coupon->code : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="value" class="col-sm col-form-label">Номинал: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'value'])
                        <input type="text" class="form-control" name="value" id="value"
                               value="{{ old('value', isset($coupon) ? $coupon->value : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="currency_id" class="col-sm col-form-label">Валюта: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'currency_id'])
                        <select name="currency_id" id="currency_id" class="form-control">
                            <option value="">Без валюты</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}"
                                        @isset($coupon)
                                        @if($coupon->currency_id == $currency->id)
                                        selected
                                        @endif
                                        @elseif(old('currency_id') == $currency->id)
                                        selected
                                        @endisset
                                >{{$currency->symbol}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                @foreach(['type' => 'Абсолютное значение','only_once' => 'Многоразове применение'] as $attribute => $name)
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label for="{{ $attribute }}" class="col-sm col-form-label">{{ $name }}: </label>
                        </div>
                        <div class="col-sm-6">
                            @include('layouts.error', ['fieldName' => $attribute])
                            <input type="checkbox" class="form-control" name="{{ $attribute }}" id="{{ $attribute }}"
                                   @if(isset($coupon) && $coupon->$attribute === 1)
                                   checked="checked"
                                    @endif
                            >
                        </div>
                    </div>
                    <br>
                @endforeach
                <br>
                <div class="">
                    <label for="expired_at" class="col-sm col-form-label">Использовать до: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'expired_at'])
                        <input type="date" class="form-control" name="expired_at" id="expired_at"
                               value="{{ old('expired_at', isset($coupon) ? $coupon->expired_at->format('Y-m-d') : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72"
                                  rows="7">{{ old('description', isset($coupon) ? $coupon->description : null) }}</textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

