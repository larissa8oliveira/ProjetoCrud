<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use LaravelLegends\PtBrValidator\Rules\CPF;

class UserController extends Controller
{
    public function index(Request $request)
{
    $nome = $request->input('nome');
    $cpf = $request->input('cpf');
    $periodo = $request->input('periodo');

    $query = User::query();

    if (!empty($nome)) {
        $query->where(function ($query) use ($nome) {
            $query->where('nome', 'LIKE', '%' . $nome . '%')
                ->orWhere('nome', '=', $nome);
        });
    }

    if (!empty($cpf)) {
        $query->where('cpf', $cpf);
    }

    if (!empty($periodo)) {
        $start = Carbon::parse($periodo['start'])->startOfDay();
        $end = Carbon::parse($periodo['end'])->endOfDay();
        $query->whereBetween('created_at', [$start, $end]);
    }

    $users = $query->get();

    return response()->json($users);
}
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required|email|unique:users',
            'cpf' => [
                'required',
                new CPF(),
                'unique:users',
            ],
            'perfil_id' => 'required|exists:profiles,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Erro de validação', 'errors' => $validator->errors()], 422);
        }

        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuário não encontrado'], 404);
    }

    $validator = Validator::make($request->all(), [
        'nome' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'cpf' => 'required|numeric|digits:11|unique:users,cpf,' . $id,
        'perfil_id' => 'required|exists:profiles,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Erro de validação', 'errors' => $validator->errors()], 422);
    }

    $user->update($request->all());

    return response()->json($user);
}

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso']);
    }


}
