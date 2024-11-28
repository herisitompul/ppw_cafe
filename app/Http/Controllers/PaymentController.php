<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data pembayaran
        $transactionDetails = [
            'order_id' => uniqid(), // ID pesanan unik
            'gross_amount' => $request->subtotal, // Total pembayaran
        ];

        // Data pelanggan
        $customerDetails = [
            'first_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ];

        // Parameter Snap
        $snapParams = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($snapParams);
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkoutWithQuantity(Request $request)
{
    // Validasi input
    $request->validate([
        'amount' => 'required|numeric',        // Total pembayaran (dihitung di frontend)
        'product_id' => 'required|integer',   // ID produk
        'product_name' => 'required|string',  // Nama produk
        'price' => 'required|numeric',        // Harga satuan
        'quantity' => 'required|integer|min:1', // Kuantitas
    ]);

    // Konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    // Data pembayaran
    $transactionDetails = [
        'order_id' => uniqid(), // ID pesanan unik
        'gross_amount' => $request->amount, // Total pembayaran dihitung di frontend
    ];

    // Data pelanggan
    $customerDetails = [
        'first_name' => auth()->user()->name,
        'email' => auth()->user()->email,
    ];

    // Data item untuk rincian di Midtrans
    $itemDetails = [
        [
            'id' => $request->product_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'name' => $request->product_name,
        ],
    ];

    // Parameter Snap
    $snapParams = [
        'transaction_details' => $transactionDetails,
        'customer_details' => $customerDetails,
        'item_details' => $itemDetails,
    ];

    try {
        $snapToken = Snap::getSnapToken($snapParams);
        return response()->json(['snapToken' => $snapToken]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



}
