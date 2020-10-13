<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Products::all();
    }

    public function store(ProductRequest $request)
    {
        $product = Products::create($request->only('name', 'price'));
        return $product;
    }

    public function show($id)
    {
        $product = Products::find($id);
        return $product;
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Products::find($id);
        $product->update($request->only('name', 'price'));
        return $product;
    }

    public function destroy($id)
    {
        Products::find($id)->delete();
    }
}
