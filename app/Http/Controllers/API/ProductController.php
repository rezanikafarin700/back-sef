<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Procuct\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(4);
//        $productss =  Product::all();
        return response()->json($products,200);
    }



    public function create()
    {
        //
    }
    public function store(\App\Http\Requests\Product\StoreRequest $request)
    {
        $product = Product::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
            'discount' => $request->discount,
        ]);
        return response($product,201);

    }



    public function show($id)
    {
        try {
            $product =  Product::findOrFail($id);
            $data = [
                'id' => $product->id,
                'user_id' => $product->user_id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'discount' => $product->discount,
                'products' => $product->user,
            ];
            return response()->json($data,200);
        }
        catch (\Exception $e){
            return response(['message' => $e->getMessage()],404);
        }
    }


    public function edit($id)
    {
        //
    }
    public function update(\App\Http\Requests\Product\UpdateRequest $request, $id)
    {
        $product =  Product::findOrFail($id);
        $data = $request->only(['name','image','price','discount']);
        $product->update($data);
        return response($product,202);
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response(null,204);
    }

}
