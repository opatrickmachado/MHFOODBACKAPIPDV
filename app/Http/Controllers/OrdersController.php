<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Models\Order;


class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return new OrderResource($order);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'client_id' => 'required|integer',
                'product_id' => 'required|integer',
                'order_number' => 'required|unique:orders,order_number',
                'quantity' => 'integer',
                'total_price' => 'required|numeric',
                'status' => 'required|string|max:255',
            ]);

            $order = Order::create($validatedData);
            return new OrderResource($order);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o pedido: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);

            $validatedData = $request->validate([
                'client_id' => 'integer',
                'product_id' => 'integer',
                'order_number' => 'unique:orders,order_number',
                'quantity' => 'integer',
                'total_price' => 'numeric',
                'status' => 'string|max:255',
            ]);

            $order->update($validatedData);
            return new OrderResource($order);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o pedido: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            
            return response()->json(['message' => 'Pedido apagado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o pedido: ' . $e->getMessage()], 500);
        }
    }   
}
