<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Log;

class ProductController extends Controller
{
    public function index()
    {
        return $products = Products::all();
    }
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            Log::info($validator->errors());
            return response()->json([
                'success' => false,
                'message' => 'Please fill in the blank fields',
                'data' => $validator->errors(),
            ],400);
        } else {
            Products::create($request->all());
        }
    }
    public function edit($id)
    {
        return Products::whereId($id)->first();
    }
    public function update($id, Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in the blank fields',
                'data' => $validator->errors(),
            ], 400);
        } else {
            $updateProduct = Products::whereId($id)->update([
                'name' => $request->name,
                'price' => $request->price
            ]);
            return $updateProduct;
        }
    }
    public function destroy($id)
    {
        $product = Products::find($id)->delete();
    }
}
