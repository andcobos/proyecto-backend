<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\SellerStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SellerController extends Controller
{
    
    public function store(Request $request)
    {
        $user = $request->user();

        if ($user->seller) {
            return response()->json(['message' => 'Ya tienes una solicitud de vendedor.'], 403);
        }

        $seller = $user->seller()->create([
            'verified' => false
        ]);

        return response()->json([
            'message' => 'Solicitud enviada. Espera aprobación del administrador.',
            'seller' => $seller
        ], 201);
    }

    
    public function approveSeller($sellerId)
    {
        if (!Gate::allows('is-admin')) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        $seller = Seller::findOrFail($sellerId);
        $seller->update(['verified' => true]);

        return response()->json([
            'message' => 'Vendedor aprobado exitosamente.',
            'seller' => $seller
        ]);
    }

    
    public function updateStatus(Request $request, $sellerId)
    {
        if (!Gate::allows('is-admin')) {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        $seller = Seller::findOrFail($sellerId);

        $status = $request->input('status'); // por ejemplo: 'active', 'suspended', etc.
        $statusId = SellerStatus::where('seller_status', $status)->value('id');

        if (!$statusId) {
            return response()->json(['message' => 'Estado inválido.'], 422);
        }

        $seller->update(['seller_status_id' => $statusId]);

        return response()->json([
            'message' => 'Estado del vendedor actualizado correctamente.',
            'seller' => $seller
        ]);
    }
}
