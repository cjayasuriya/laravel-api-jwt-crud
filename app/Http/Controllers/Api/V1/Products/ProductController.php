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

        $auid = $request->user()->id;

        $prices = array(
            "unit" => !empty($request->unitPrice) ? (double)$request->unitPrice : 0,
            "selling" => !empty($request->sellingPrice) ? (double)$request->sellingPrice : 0,
            "lowest" => !empty($request->lowestPrice) ? (double)$request->lowestPrice : 0,
        );

        $sizes = array(
            "length" => !empty($request->length) ? (double)$request->length : 0,
            "width" => !empty($request->width) ? (double)$request->width : 0,
            "height" => !empty($request->height) ? (double)$request->height : 0,
        );

        $product = new Product();
        $product->sku = $request->sku;
        $product->name = $request->brand;
        $product->model = !empty($request->model) ? $request->model : '';
        $product->uom = !empty($request->uom) ? $request->uom : '';
        $product->prices = json_encode($prices);
        $product->weight = !empty($request->weight) ? (double)$request->weight : 0;
        $product->weightUnit = !empty($request->weightUnit) ? $request->weightUnit : '';
        $product->sizes = json_encode($sizes);
        $product->sizeUnit = !empty($request->sizeUnit) ? $request->sizeUnit : '';
        $product->description = !empty($request->description) ? $request->description : '';
        $product->cuid = $auid;
        $product->uuid = $auid;
        $product->save();

        return response()->json($product, 200);

    }


    /**
     * Edit
     */
    public function edit(Request $request){

        $auid = $request->user()->id;

        $product = Product::findorfail($request->productID);

        $prices = array(
            "unit" => !empty($request->unitPrice) ? (double)$request->unitPrice : 0,
            "selling" => !empty($request->sellingPrice) ? (double)$request->sellingPrice : 0,
            "lowest" => !empty($request->lowestPrice) ? (double)$request->lowestPrice : 0,
        );

        $sizes = array(
            "length" => !empty($request->length) ? (double)$request->length : 0,
            "width" => !empty($request->width) ? (double)$request->width : 0,
            "height" => !empty($request->height) ? (double)$request->height : 0,
        );

        $product->sku = $request->sku;
        $product->name = $request->brand;
        $product->model = !empty($request->model) ? $request->model : '';
        $product->uom = !empty($request->uom) ? $request->uom : '';
        $product->prices = json_encode($prices);
        $product->weight = !empty($request->weight) ? (double)$request->weight : 0;
        $product->weightUnit = !empty($request->weightUnit) ? $request->weightUnit : '';
        $product->sizes = json_encode($sizes);
        $product->sizeUnit = !empty($request->sizeUnit) ? $request->sizeUnit : '';
        $product->description = !empty($request->description) ? $request->description : '';
        $product->uuid = $auid;
        $product->update();

        return response()->json($product, 200);

    }

}
