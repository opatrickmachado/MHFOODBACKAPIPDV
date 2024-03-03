<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'description' => 'nullable',
                'price' => 'required|numeric',
                'stock' => 'integer',
            ]);

            $product = Product::create($validatedData);
            return new ProductResource($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o produto: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'max:255',
                'description' => 'nullable',
                'price' => 'numeric',
                'stock' => 'integer',
            ]);

            $product->update($validatedData);
            return new ProductResource($product);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o produto: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            
            return response()->json(['message' => 'Produto apagado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o produto: ' . $e->getMessage()], 500);
        }
    }   
}
