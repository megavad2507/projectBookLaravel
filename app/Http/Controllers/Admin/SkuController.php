<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Product $product)
    {
        $skus = $product->skus()->orderBy('id','asc')->paginate(10);
        return view('admin.skus.index',compact('skus','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Product $product)
    {
        return view('admin.skus.form-create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Display the specified resource.
     *
     * @param  Sku  $sku
     *
     * @return Response
     */
    public function show(Product $product,Sku $sku)
    {
        return view('admin.skus.show',compact('product','sku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Sku  $sku
     *
     * @return Response
     */
    public function edit(Product $product,Sku $sku)
    {
        return view('admin.skus.form-create',compact('product','sku'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Sku  $sku
     *
     * @return Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Sku  $sku
     *
     * @return Response
     */
    public function destroy(Product $product,Sku $sku)
    {
        $sku->delete();
        return redirect()->route('skus.index',$product);
    }
}
