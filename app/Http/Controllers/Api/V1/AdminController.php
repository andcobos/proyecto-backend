<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
   
    public function listUsers()
    {
        if (!Gate::allows('is-admin')) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        $users = User::with('seller')->get();

        return response()->json($users);
    }

   
    public function pendingSellers()
    {
        if (!Gate::allows('is-admin')) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        $pending = Seller::where('verified', false)->with('user')->get();

        return response()->json($pending);
    }

    
    public function updateUserRole(Request $request, $userId)
    {
        if (!Gate::allows('is-admin')) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        $user = User::findOrFail($userId);
        $newRole = $request->input('rol');

        if (!in_array($newRole, ['admin', 'seller', 'user'])) {
            return response()->json(['message' => 'Rol inválido.'], 422);
        }

        $user->update(['rol' => $newRole]);

        return response()->json([
            'message' => 'Rol actualizado correctamente.',
            'user' => $user
        ]);
    }
}
