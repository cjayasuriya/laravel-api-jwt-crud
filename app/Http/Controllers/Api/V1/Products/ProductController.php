<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use App\Models\Models\Products\Product;
use Illuminate\Http\Request;

use Auth;
use App\User;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Index
     */
    public function index(Request $request)
    {
        $devices = Product::where('statusID', 1)->get();
        return response()->json($devices, 200);
    }


    /**
     * SHOW
     */
    public function show(Request $request)
    {
        $device = Product::findorfail($request->productID);
        return response()->json($device, 200);
    }


    /**
     * Create
     */
    public function create(Request $request){

    }

}
