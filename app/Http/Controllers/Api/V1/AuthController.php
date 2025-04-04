<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LogoutRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'rol_id' => $request->rol_id,
        ]);

        // Asignar rol por ID
        if ($request->rol_id == 1) {
            $user->assignRole('admin');
        } elseif ($request->rol_id == 2) {
            $user->assignRole('seller');
        } else {
            $user->assignRole('client');
        }

        // Crear token
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Login user and create a token.
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Las credenciales proporcionadas son incorrectas'
            ], 401);
        }

        $user->tokens()->delete(); // eliminar tokens anteriores
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    /**
     * Logout user (revoke token).
     */
    public function logout(LogoutRequest $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Cierre de sesión exitoso.'
        ]);
    }
}
