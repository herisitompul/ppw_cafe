<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Create a new order from cart items
     */
    public function createOrderFromCart()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Get the user's cart items
            $cartItems = CartItem::where('keranjang_id', Auth::user()->keranjang->id)
                ->where('status', 'active')
                ->get();

            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending'
            ]);

            // Create order items from cart items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'produk_judul' => $cartItem->produk->judul,
                    'produk_deskripsi' => $cartItem->produk->deskripsi,
                    'kuantitas' => $cartItem->kuantitas,
                    'total_harga' => $cartItem->kuantitas * $cartItem->harga
                ]);
            }

            // Clear or mark cart items as processed
            $cartItems->each(function($item) {
                $item->update(['status' => 'inactive']);
            });

            // Commit the transaction
            DB::commit();

            // Load order with its items for the response
            $order->load('orderItems');

            return response()->json([
                'message' => 'Order created successfully',
                'order' => $order,
                'total_price' => $order->total_price
            ], 201);

        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollBack();

            return response()->json([
                'error' => 'Failed to create order',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user's orders
     */
    public function getUserOrders()
    {
        $orders = Order::with('orderItems')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Menambahkan total_price ke setiap order
        $orders->transform(function($order) {
            $order->total_price = $order->total_price;
            return $order;
        });

        return response()->json($orders);
    }

    /**
     * Get specific order details
     */
    public function getOrderDetails($orderId)
    {
        $order = Order::with('orderItems')
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        // Menambahkan total_price ke order
        $order->total_price = $order->total_price;

        return response()->json($order);
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($orderId);

        // Optional: Add authorization check
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $order->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Order status updated',
            'order' => $order,
            'total_price' => $order->total_price
        ]);
    }
}
