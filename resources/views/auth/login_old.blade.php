@extends('layouts.app')
@push('css')

    <link rel="stylesheet" type="text/css" href="/styles/register.css">
@endpush
@section('content')
    <div class="container" style="margin-top: 110px">
        <div class="row">
            <div class="form-box">
                <h1>Form <span>Auth</span></h1>
                <form role="form" id="contact-form" method="POST" action="{{ route('login') }}">
                    @csrf

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
                        <div id="nameError" class="sr-only" role="alert"></div>
                        <label for="form-name-field" class="sr-only">Имя</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="form-name-field" value="" placeholder="Пароль">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-success">Войти</button>
                </form>

            </div>
        </div>
    </div>
@endsection
