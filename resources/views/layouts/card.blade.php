<div class="product">
    <div class="product_image"><img src="{{ Storage::url($product->picture) }}" alt="{{ $product->name }}"></div>
    <div class="product_content">
        <form action="{{ route('basketAdd',$product) }}" method="POST">
            @csrf
            <div class="product_title"><a href="{{ route('product',[$product->category->code,$product->code]) }}">{{ $product->name }}</a></div>
            <div class="add_to_basket">
                <button type="submit">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </button>
            </div>
            <div class="product_price">{{ $product->price }} р.</div>
        </form>
    </div>
</div>
