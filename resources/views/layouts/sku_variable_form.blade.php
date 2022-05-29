@foreach($product->skus_properties as $sku_prop)
        <div class="product-size d-flex align-items-center mt-30">
            <h3 class="title">{{ $sku_prop['name'] }}</h3>
            <select name="{{ $sku_prop['prop_id'] }}" class="detail-set-sku">
                @foreach($sku_prop['values'] as $prop)
                        <option value="{{ $prop['id'] }}"
                            @if($sku->propertyOptions()->with('property')->where('property_id',$sku_prop['prop_id'])->first()->id == $prop['id'])
                                selected
                            @endif
                            >{{ $prop['name'] }}
                        </option>
                @endforeach
            </select>
        </div>
@endforeach
