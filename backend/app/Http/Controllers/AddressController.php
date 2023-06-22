<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();

        return response()->json($addresses);
    }

    public function show($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        return response()->json($address);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Erro de validação', 'errors' => $validator->errors()], 422);
        }

        $address = Address::create($request->all());

        return response()->json($address, 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Erro de validação', 'errors' => $validator->errors()], 422);
        }

        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        $address->update($request->all());

        return response()->json($address);
    }
}
