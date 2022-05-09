@extends('layouts.main_layout')
@section('content')
    {{ Breadcrumbs::render('register') }}
    <!-- product tab start -->
    <div class="register pb-70">
        <div class="container grid-wraper">
            <div class="row">
                <div class="col-12">
                    <h3 class="title text-capitalize mb-30 pb-25">@lang('auth.create_account')</h3>
                    <div class="log-in-form">
                        @foreach($errors->all() as $message)
                            <div class="alert alert-danger mb-20">{{ $message }}</div>
                        @endforeach
                        <form method="POST" action="{{ route('register') }}" class="personal-information">
                            @csrf
                            <div class="order-asguest theme1 mb-3">
                                <span>@lang('auth.already_have_account')</span>
                                <a class="text-muted hover-color" href="{{ route('login') }}">@lang('auth.login_instead')</a>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="col-md-3 col-form-label">@lang('auth.name_field')</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label">@lang('auth.email_field')</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Password" class="col-md-3 col-form-label">@lang('auth.password_field')</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-2 me-sm-2">
                                        <input type="password" class="form-control" id="inputPassword" name="password">
                                        <div class="input-group-prepend">
                                            <button type="button"
                                                    class="change-password-visibility-state input-group-text  theme-btn--dark1 btn--md show-password">@lang('auth.show')</button>
                                            <button type="button"
                                                    class="change-password-visibility-state hidden input-group-text  theme-btn--dark1 btn--md hide-password">@lang('auth.hide')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Password" class="col-md-3 col-form-label">@lang('auth.password_field')</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-2 me-sm-2">
                                        <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation">
                                        <div class="input-group-prepend">
                                            <button type="button"
                                                    class="change-password-visibility-state input-group-text  theme-btn--dark1 btn--md show-password">@lang('auth.show')</button>
                                            <button type="button"
                                                    class="change-password-visibility-state hidden input-group-text  theme-btn--dark1 btn--md hide-password">@lang('auth.hide')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-12">
                                    <div class="sign-btn text-end">
                                        <button class="btn theme-btn--dark1 btn--md" type="submit">@lang('auth.register_button')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product tab end -->
@endsection
