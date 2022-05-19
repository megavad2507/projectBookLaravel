<?php

namespace App\Http\Controllers\Admin;

use App\Classes\AdminFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = 10;
        if(count($request->all()) > 0) {
            $adminFilter = new AdminFilter($request->all());
            $coupons = $adminFilter->getFilteredItems(Coupon::class)->orderBy('id','asc')->paginate($itemsPerPage);
        }
        else {
            $coupons = Coupon::orderBy('id','asc')->paginate($itemsPerPage);
        }
        return view('admin.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function create()
    {
        return view('admin.coupons.form-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CouponRequest  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector
     */
    public function store(CouponRequest $request)
    {
        $params = $request->all();
        if(!$request->has('type')) {
            $params['currency_id'] = null;
        }
        Coupon::create($params);
        return redirect(route('coupons.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Coupon  $coupon
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Response
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show',compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Coupon  $coupon
     *
     * @return Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.form-create',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CouponRequest  $request
     * @param  Coupon  $coupon
     *
     * @return Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $params = $request->all();
        if(!$request->has('type')) {
            $params['currency_id'] = null;
        }
        foreach (['type','only_once'] as $attributeName) {
            if(!isset($params[$attributeName])) {
                $params[$attributeName] = 0;
            }
        }
        $coupon->update($params);
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Coupon  $coupon
     *
     * @return Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect(route('coupons.index'));
    }
}
