<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Keranjang;


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

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('user.order.index', compact('cartCount', 'cartItem', 'order', 'orderItems', 'snapToken'));
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

        // \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => $order->id,
        //         'gross_amount' => 10000,
        //     ),
        //     // 'customer_details' => array(
        //     //     'first_name' => $user->name,
        //     //     'email' => $user->email,
        //     // ),
        // );

        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        return redirect()->route('order.index')->with('success', 'Order berhasil dibuat');
        // return view('user.order.index', compact('snapToken', 'order'));
        }

        public function cancelOrder(Request $request, $id){

            $order = Order::findOrFail($id);
            $order->status = 'cancel';
            $order->save();

            return redirect()->back()->with('success', 'Order berhasil dibatalkan');

        }

        // public function payNow(Request $request, MidtransService $midtransService) {
        //     $order = Order::findOrFail($request->order_id);
        //     $snapToken = $midtransService->createTransaction($order);

        //     return response()->json([
        //         'token' => $snapToken->token,
        //     ]);
        // }

        // public function callback(Request $request){
        //     $serverKey = config('midtrans.server_key');
        //     $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        //     if ($hashed == $request->signature_key) {
        //         if($request->transaction_status == 'capture') {
        //             $order = Order::findOrFail($request->order_id);
        //             $order->update(['status' => 'complete']);
        //         }
        //     }

        // }

        public function callback(Request $request){
            dd($request->all());
            $serverKey = config('midtrans.server_key');
            $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
            if ($hashed == $request->signature_key) {
                if(in_array($request->transaction_status, ['capture', 'settlement'])) {
                    $order = Order::find($request->order_id);
                    if($order){
                     $order->status = "complete";
                     $order->save();                    }
                }
            }

        }

        // public function callback(Request $request)
        // {
        //     $serverKey = config('midtrans.server_key');
        //     $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        //     if ($hashed == $request->signature_key) {
        //         // Temukan order berdasarkan order_number (ubah jika menggunakan primary key)
        //         $order = Order::where('order_number', $request->order_id)->firstOrFail();

        //         // Daftar status sukses dari Midtrans
        //         $successStatuses = ['capture', 'settlement', 'success'];

        //         if (in_array($request->transaction_status, $successStatuses)) {
        //             // Ubah status menjadi complete
        //             $order->update(['status' => 'complete']);

        //             // Log untuk debugging
        //             \Log::info('Order #' . $order->order_number . ' has been marked as complete.');
        //         } elseif ($request->transaction_status == 'pending') {
        //             // Log status pending
        //             \Log::info('Order #' . $order->order_number . ' is still pending.');
        //         } elseif (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
        //             // Tangani status gagal jika diperlukan
        //             $order->update(['status' => 'cancel']);
        //             \Log::warning('Order #' . $order->order_number . ' was cancelled or expired.');
        //         }

        //         return response()->json(['status' => 'success'], 200);
        //     }

        //     // Jika signature tidak valid
        //     return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
        // }


        public function invoice($id){
            // $userId = auth()->id();
            // $order = Order::where('user_id', $userId)->latest()->first();
            // $orderItems = OrderItem::where('order_id', $order->id)->get();
            $userId = auth()->id();
            $keranjang = Keranjang::where('user_id', $userId)->first();
            $cartItem = CartItem::where('keranjang_id', $keranjang->id)->get();
            $orders = Order::where('user_id', $userId)->get();
            $orderIds = $orders->pluck('id');
            $orderItems = OrderItem::whereIn('order_id', $orderIds)->get();
            $cartCount = $cartItem->count();


            $order = Order::find($id);
            $order->status = "complete";
            $order->save();
            return view('invoice', compact('orders', 'orderItems', 'cartCount'));
        }

    }

