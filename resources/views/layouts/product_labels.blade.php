<div class="product_labels">
    @if(isset($sku))
        @if($sku->product->isNew())
        <span class="badge badge-danger top-left {{ isset($isDetail) ? 'detail-page' : '' }}">
            New
        </span>
        @endif
        @if($sku->product->isSale())
        <span class="badge badge-success top-left {{ isset($isDetail) ? 'detail-page' : '' }}">
            Sale
        </span>
        @endif
        @if($sku->product->isHot())
        <span class="badge badge-hot top-left {{ isset($isDetail) ? 'detail-page' : '' }}">
            Hot
        </span>
        @endif
    @else
        @if($product->isNew())
            <span class="badge badge-success">
            New
        </span>
        @endif
        @if($product->isSale())
            <span class="badge badge-warning">
            Sale
        </span>
        @endif
        @if($product->isHot())
            <span class="badge badge-danger">
            Hot
        </span>
        @endif
    @endif
</div>
