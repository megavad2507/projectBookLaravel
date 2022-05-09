<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $merchants = Merchant::orderBy('id','asc')->paginate(10);
        return view('admin.merchants.index',compact('merchants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.merchants.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Merchant::create($request->all());
        return redirect()->route('merchants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Merchant  $merchant
     *
     * @return Response
     */
    public function show(Merchant $merchant)
    {
        return view('admin.merchants.show',compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Merchant  $merchant
     *
     * @return Response
     */
    public function edit(Merchant $merchant)
    {
        return view('admin.merchants.form-create',compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Merchant  $merchant
     *
     * @return Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        $merchant->update($request->all());
        return redirect()->route('merchants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Merchant  $merchant
     *
     * @return Response
     */
    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return redirect()->route('merchants.index');
    }


    public function updateToken(Merchant $merchant) {
        $merchant->updateToken();
        return redirect()->route('merchants.index');
    }
}
