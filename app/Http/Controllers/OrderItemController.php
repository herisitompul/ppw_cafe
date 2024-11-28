<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    /**
     * Get details of a specific order item
     */
    public function getOrderItemDetails($orderItemId)
    {
        $orderItem = OrderItem::with('order')
            ->findOrFail($orderItemId);

        // Optional: Add authorization check
        if ($orderItem->order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($orderItem);
    }
}
