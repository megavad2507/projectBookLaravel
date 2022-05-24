@extends('layouts.main_layout')
@section('content')
 {{ Breadcrumbs::render('login') }}
 <!-- product tab start -->
 <div class="my-account pb-70">
     <div class="container grid-wraper">
         <div class="row">
             <div class="col-12">
                 <h3 class="title text-capitalize pb-30">@lang('auth.login_to_account')</h3>
                 @error('userNotFound')
                    <div class="alert alert-danger mb-20">{{ $message }}</div>
                 @enderror
                 <form class="log-in-form" method="POST" action="{{ route('login') }}">
                     @csrf
                     <div class="form-group row">
                         <label for="staticEmail" class="col-md-3 col-form-label">@lang('auth.email_field')</label>
                         <div class="col-md-6">
                             <input type="email" class="form-control" id="staticEmail" name="email" value="{{ old('email') }}">
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="inputPassword" class="col-md-3 col-form-label">@lang('auth.password_field')</label>
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
                     <div class="form-group row pb-3 text-center">
                         <div class="col-md-6 offset-md-3">
                             <div class="login-form-links">
                                 <div class="sign-btn">
                                     <button class="btn theme-btn--dark1 btn--md" type="submit">@lang('auth.sign_in')</button>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="form-group row text-center mb-0">
                         <div class="col-12">
                             <div class="border-top">
                                 <a href="{{ route('register') }}" class="no-account">@lang('auth.register')</a>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- product tab end -->
@endsection
