<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all(['id', 'name', 'surname', 'phone', 'description']);
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => 'The given data was invalid.'], 402);
        }

        $client = Client::create($validator->validate());

        return response()->json([
            'message' => 'Client created successfully!',
            'client' => $client
        ]);
    }

    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }
        return response()->json($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
 * Update the specified resource in storage.
 */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'error' => 'Client not found'
            ], 404);
        }

        $client->fill($request->post())->save();
        return response()->json([
            'message' => 'Client updated successfully!',
            'client' => $client
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'error' => 'Client not found'
            ], 404);
        }
        $client->delete();
        return response()->json([
            'message' => 'Client deleted successfully!'
        ]);
    }
}
