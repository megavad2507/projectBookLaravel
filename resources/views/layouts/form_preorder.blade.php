<form action="{{ route('subscribe',$sku) }}" method="POST" class="form-pre-order">
    @if(session('success_subscribe'))
        <div class="alert alert-success mt-20">{{ session('success_subscribe') }}</div>
    @endif
    @include('layouts.error', ['fieldName' => 'email'])
    @csrf
    <div class="form-group row">
        <label for="email" class="col-md-3 col-xs-12 col-form-label">Email*</label>
        <div class="col-md-6 col-xs-12">
            <input required name="email" type="email" id="email" class="form-control" value="{{ Auth::check() ? Auth::user()->email : ''}}">
        </div>
        <div class="col-md-2 col-xs-12">
            <button class="btn theme-btn--dark1 btn--md" type="submit">Сообщить мне о поступлении товара</button>
        </div>
    </div>
</form>
