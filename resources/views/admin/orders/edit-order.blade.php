@extends('admin.app')
@section('title','Редактировать закак № '.$order->id)


@section('content')
    <div class="col-md-12">
        <h1>Редактировать заказ № {{ $order->id }}</h1>

        <form method="POST" enctype="multipart/form-data" action="{{ route('orders.update',$order) }}"
        >
            <div>
                @csrf
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">ФИО: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ old('name', $order->name) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Телефон: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'phone'])
                        <input type="text" class="form-control" name="phone" id="phone"
                               value="{{ old('name_en', $order->phone) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Email: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'email'])
                        <input type="text" class="form-control" name="email" id="sort"
                               value="{{ old('sort', $order->email ) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Сумма заказа: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'sum'])
                        <input type="text" class="form-control" name="sum" id="sum"
                               value="{{ old('sort', $order->sum ) }}">
                    </div>
                </div>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Способ оплаты: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'payment_id'])
                        <select name="payment_id" id="payment_id" class="form-control">
                            @foreach($payments as $payment)
                                <option value="{{ $payment->id }}"
                                    @if($payment->id == $order->payment->id)
                                        selected
                                    @endif
                                >{{ $payment->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name_en" class="col-sm col-form-label">Статус: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'status_id'])
                        <select name="status_id" id="status_id" class="form-control">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}"
                                    @if($status->id == $order->status->id)
                                        selected
                                    @endif
                                >{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="description" class="col-sm col-form-label">Адрес доставки: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'address_delivery'])
                        <textarea name="address_delivery" id="address_delivery" cols="72"
                                  rows="7">{{ old('address_delivery', $order->address_delivery) }}</textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

