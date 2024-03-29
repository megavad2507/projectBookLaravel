<form action="/{{ Request::path() }}#products_list" method="GET">
    <div class="filters row">
        <div class="col-sm-6 col-md-3">
            <label for="price_from">@lang('main.properties.price_from')
                <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from }}">
            </label>
            <label for="price_to">@lang('main.properties.price_to')
                <input type="text" name="price_to" id="price_to" size="6" value="{{ request()->price_to }}">
            </label>
        </div>
        @foreach(['hot' => __('main.properties.hot'),'new' => __('main.properties.new'),'sale' => __('main.properties.sale')] as $attribute => $name)
            <div class="col-sm-2 col-md-2">
                <label for="{{ $attribute }}">
                    <input type="checkbox" name="{{ $attribute }}" id="filter_{{ $attribute }}" @if(request()->has($attribute)) checked @endif><span>{{ $name }}</span>
                </label>
            </div>
        @endforeach
        <div class="col-sm-6 col-md-3">
            <button class="btn btn-primary" type="submit">@lang('main.filter_find')</button>
            <a href="/{{ Request::path() }}#products_list" class="btn btn-warning">@lang('main.filter_reset')</a>
        </div>
    </div>
</form>
