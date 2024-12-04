<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Keranjang;
use App\Services\MidtransService;


class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $keranjang = Keranjang::where('user_id', $userId)->first();
        $cartItem = CartItem::where('keranjang_id', $keranjang->id)->get();
        $cartCount = $cartItem->count();
        $order = Order::where('user_id', $userId)->latest()->first();
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        return view('user.order.index', compact('cartCount', 'cartItem', 'order', 'orderItems'));
    }


    public function addOrder(Request $request){
        $user_id = auth()->id();

        $todayDate = now()->format('Y-m-d');
        $todayOrderCount = Order::whereDate('created_at', $todayDate)->count();

        // Format order number
        $orderNumber = 'ORD-' . str_pad($todayOrderCount + 1, 2, '0', STR_PAD_LEFT);
        $order = Order::firstOrCreate([
            'user_id' => $user_id,
            'order_number' => $orderNumber,
            'total_price' => 0
        ]);

        $cartItems = CartItem::whereHas('keranjang', function($query) use ($user_id){
            $query->where('user_id', $user_id);
        })->where('status', 'active')->get();

        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            OrderItem::firstOrCreate(
                [
                    'order_id' => $order->id,
                    'produk_id' => $cartItem->produk_id,
                    'kuantitas' => $cartItem->kuantitas,
                    'harga' => $cartItem->harga
                ]
                );
                $totalPrice += $cartItem->harga * $cartItem->kuantitas;


        }
        $order->update([
            'total_price' => $totalPrice
        ]);

        if ($order->status != 'pending') {
            CartItem::whereHas('keranjang', function($query) use ($user_id){
                $query->where('user_id', $user_id);
            })->where('status', 'active')->delete();
        }

        return redirect()->route('order.index')->with('success', 'Order berhasil dibuat');
        }

        public function cancelOrder(Request $request, $id){

            $order = Order::findOrFail($id);
            $order->status = 'cancel';
            $order->save();

            return redirect()->back()->with('success', 'Order berhasil dibatalkan');

        }

        public function payNow(Request $request, MidtransService $midtransService) {
            $order = Order::findOrFail($request->order_id);
            $snapToken = $midtransService->createTransaction($order);

            return response()->json([
                'token' => $snapToken->token,
            ]);
        }

    }

