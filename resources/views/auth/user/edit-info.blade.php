@extends('admin.app')
@section('title','Изменение личных данных')
@section('content')
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data" action="{{ route('person.personal-info-update') }}">
            <div>
                @csrf
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Имя: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Email: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'email'])
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email',$user->email) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Пароль: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'password'])
                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Подтверждения пароля: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'password_confirmation'])
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                    </div>
                </div>
                <br>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

