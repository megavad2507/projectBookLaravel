@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="/styles/register.css">
@endpush
@section('content')
    <div class="container" style="margin-top: 110px">
        <div class="row">
            <div class="form-box">
                <h1>Form <span>Registration</span></h1>
                <form role="form" id="contact-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- name field -->
                    <div class="form-group">
                        <div id="nameError" class="sr-only" role="alert"></div>
                        <label for="form-name-field" class="sr-only">Имя</label>
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" id="form-name-field" value="" placeholder="Имя">
                        </div>
                    </div>
                    <!-- email field -->
                    <div class="form-group">
                        <div id="emailError" class="sr-only" role="alert"></div>
                        <label for="form-email-field" class="sr-only">Email</label>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" id="form-email-field" value="" placeholder="Email">
                        </div>
                    </div>
                    <!-- password field -->
                    <div class="form-group">
                        <div id="emailError" class="sr-only" role="alert"></div>
                        <label for="form-email-field" class="sr-only">Пароль</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="form-password-field" value="" placeholder="Пароль">
                        </div>
                    </div>
                    <!-- password confirm field -->
                    <div class="form-group">
                        <div id="emailError" class="sr-only" role="alert"></div>
                        <label for="form-email-field" class="sr-only">Подтвердите пароль</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control" id="form-password-confirm-field" value="" placeholder="Подтвердите пароль">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-success">Зарегистрироваться</button>
                </form>

            </div>
        </div>
    </div>
@endsection
