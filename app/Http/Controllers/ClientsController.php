<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ClientResource;
use App\Models\Client;


class ClientsController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return ClientResource::collection($clients);
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return new ClientResource($client);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'email|unique:clients,email',
                'phone' => 'nullable|max:20',
                'address' => 'nullable',
            ]);

            $client = Client::create($validatedData);
            return new ClientResource($client);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $client = Client::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'sometimes|email|unique:clients,email,' . $client->id,
                'phone' => 'nullable|max:20',
                'address' => 'nullable',
            ]);

            $client->update($validatedData);
            return new ClientResource($client);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            
            return response()->json(['message' => 'Cliente apagado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar o cliente: ' . $e->getMessage()], 500);
        }
    }   
}
