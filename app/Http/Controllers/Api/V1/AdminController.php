<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Requests\UpdateUserRoleRequest;
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

    
    public function updateUserRole(UpdateUserRoleRequest $request, $userId)
    {
        if (!Gate::allows('is-admin')) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }
    
        $user = User::findOrFail($userId);
        $user->update([
            'rol' => $request->rol
        ]);
    
        return response()->json([
            'message' => 'Rol actualizado correctamente.',
            'user' => $user
        ]);
    }
}