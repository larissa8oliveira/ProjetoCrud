<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

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
        $request->validate([
            'street' => 'required',
            'city' => 'required',
            'state' => 'required',
        ]);

        $address = new Address();
        $address->street = $request->input('street');
        $address->city = $request->input('city');
        $address->state = $request->input('state');
        $address->save();

        return response()->json($address, 201);
    }
}

