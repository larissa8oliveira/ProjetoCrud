<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();

        return response()->json($profiles);
    }

    public function show($id)
    {
        $profile = Profile::find($id);

        if (!$profile) {
            return response()->json(['message' => 'Perfil não encontrado'], 404);
        }

        return response()->json($profile);
    }

    public function store(Request $request)
    {
        $profile = Profile::create($request->all());

        return response()->json($profile, 201);
    }
}
