@extends('admin.app')

@isset($user)
    @section('title','Пользователь '.$user->name)
@else
    @section('title','Добавить нового пользователя')
@endisset
@section('content')
    <div class="col-md-12">
        @isset($user)
            <h1>Пользователь <b>{{ $user->name }}</b></h1>
        @else
            <h1>Добавить нового пользователя</h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($user)
                action="{{ route('users.update',$user) }}"
              @else
                action="{{ route('users.store') }}"
              @endisset
        >
            <div>
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Имя: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', isset($user) ? $user->name : null) }}">
                    </div>
                </div>
                <br>
                <div class="">
                    <label for="name" class="col-sm col-form-label">Email: </label>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'email'])
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email', isset($user) ? $user->email : null) }}">
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
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label for="code" class="col-sm col-form-label">Является администратором: </label>
                    </div>
                    <div class="col-sm-6">
                        @include('layouts.error', ['fieldName' => 'is_admin'])
                        <input type="checkbox" class="form-control" name="is_admin" id="is_admin"
                               @if(isset($user) && $user->is_admin === 1)
                                   checked="checked"
                            @endif
                        >
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Сохранить</button>
            </div>

        </form>
    </div>
@endsection

