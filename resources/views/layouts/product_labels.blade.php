<div class="product_labels">    @if($product->isNew())    <span class="badge badge-success">        New    </span>    @endif    @if($product->isSale())    <span class="badge badge-warning">        Sale    </span>    @endif    @if($product->isHot())    <span class="badge badge-danger">        Hot    </span>    @endif</div>