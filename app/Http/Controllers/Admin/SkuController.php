<?php

namespace App\Http\Controllers\Admin;

use App\Classes\AdminFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SkuController extends Controller
{
    public function index(Product $product,Request $request)
    {
        $itemsPerPage = 10;
        if(count($request->all()) > 0) {
            $adminFilter = new AdminFilter($request->all());
            $skus = $adminFilter->getFilteredItems(Sku::class)->where('product_id',$product->id)->orderBy('id','asc')->paginate($itemsPerPage);
        }
        else {
            $skus = $product->skus()->orderBy('id','asc')->paginate($itemsPerPage);
        }

        return view('admin.skus.index',compact('skus','product'));
    }
    public function create(Product $product)
    {
        return view('admin.skus.form-create',compact('product'));
    }
    public function store(SkuRequest $request, Product $product)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        if(Sku::isNotCurrentSKUExist($params)) {
            $sku = Sku::create($params);
            $sku->propertyOptions()->sync($request->property_id);
            return redirect()->route('skus.index',$product);
        }
        else {
            session()->flash('warning',__('sku.non_unique'));
            $postInformation = $_POST;
            return view('admin.skus.form-create',compact('product','postInformation'));
        }
    }
    public function show(Product $product,Sku $sku)
    {
        return view('admin.skus.show',compact('product','sku'));
    }
    public function edit(Product $product,Sku $sku)
    {
        return view('admin.skus.form-create',compact('product','sku'));

    }
    public function update(SkuRequest $request, Product $product,Sku $sku)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        if(Sku::isNotCurrentSKUExist($params) || $sku->isSKUChanged($params['property_id'])) {
            $sku->update($params);
            $sku->propertyOptions()->sync($request->property_id);
            return redirect()->route('skus.index',$product);
        }
        else {
            session()->flash('warning',__('sku.non_unique'));
            $postInformation = $_POST;
            return view('admin.skus.form-create',compact('product','sku','postInformation'));
        }

    }
    public function destroy(Product $product,Sku $sku)
    {
        $sku->delete();
        return redirect()->route('skus.index',$product);
    }
}
