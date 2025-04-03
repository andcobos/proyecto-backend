<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product', [
            'except' => ['index', 'show']
        ]);
    }

   
    public function index(Request $request)
    {
        $query = Product::with(['category', 'seller', 'stockStatus']);

        if ($request->has('search') && !empty($request->search)) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate($request->input('per_page', 10));

        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    
    public function show(Product $product)
    {
        $product->load(['category', 'seller', 'stockStatus']);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    
    public function store(ProductRequest $request)
    {
        $user = Auth::user();

        if (!$user->isSeller() || !$user->seller) {
            return response()->json([
                'status' => 'error',
                'message' => 'Solo los vendedores pueden crear productos'
            ], 403);
        }

        $product = Product::create([
            'product_name' => $request->product_name,
            'sku' => $request->sku,
            'price' => $request->price,
            'stock' => $request->stock,
            'stock_status_id' => $request->stock_status_id,
            'seller_id' => $user->seller->id,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto creado exitosamente',
            'data' => $product
        ], 201);
    }

    
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Producto actualizado exitosamente',
            'data' => $product
        ]);
    }

    
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado exitosamente'
        ]);
    }
}
