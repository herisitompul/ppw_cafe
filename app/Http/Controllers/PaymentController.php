<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function createSnapToken(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data Transaksi
        $params = [
            'transaction_details' => [
                'order_id' => uniqid('order-'),
                'gross_amount' => $request->amount, // Total harga
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'item_details' => [
                [
                    'id' => $request->product_id,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'name' => $request->product_name,
                ],
            ],
        ];

        // Membuat Snap Token
        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }

    public function storeTransaction(Request $request)
    {
        // Validasi data dari frontend
        $validatedData = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        // Simpan data transaksi ke tabel orders
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(), // ID pengguna yang sedang login
            'produk_id' => $validatedData['produk_id'],
            'quantity' => $validatedData['quantity'],
            'total_price' => $validatedData['total_price'],
            'status' => $validatedData['status'], // Misalnya: "success", "pending", atau "failed"
        ]);

        return response()->json(['message' => 'Pesanan berhasil disimpan', 'order' => $order]);
    }


}
