<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sku;
use Illuminate\Http\Request;

class SkusController extends Controller
{
    public function getSkus() {
        return response()->json(Sku::with('product')->available()->get()->append('product_name'));
    }
}
