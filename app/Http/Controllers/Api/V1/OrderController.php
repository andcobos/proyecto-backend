<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderStatusRequest;

class OrderController extends Controller
{
   
    public function index(Request $request)
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('products') 
            ->paginate($request->input('per_page', 10));

        return response()->json($orders);
    }

    
    public function show($id)
    {
        $order = Order::with('products')->find($id);

        if (!$order || $order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized or not found'], 404);
        }

        return response()->json($order);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        $productData = [];

        foreach ($validated['products'] as $item) {
            $product = Product::find($item['id']);

            if (!$product || $product->stock < $item['quantity']) {
                return response()->json(['message' => "Product {$product->product_name} out of stock"], 400);
            }

            $product->stock -= $item['quantity'];
            $product->save();

            $productData[$product->id] = ['quantity' => $item['quantity']];
            $total += $product->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        $order->products()->attach($productData);

        $order->load('products');

        return response()->json($order, 201);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validated(); // Ya está validado por el Form Request

        $order->status = $validated['status'];
        $order->save();

        return response()->json($order);
    }
}
