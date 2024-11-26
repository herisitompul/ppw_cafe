<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function payment(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        // Buat pesanan
        $order = Order::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
            'quantity' => $request->quantity,
            'total_price' => $produk->harga * $request->quantity,
            'status' => 'pending',
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'item_details' => [
                [
                    'id' => $produk->id,
                    'price' => $produk->harga,
                    'quantity' => $order->quantity,
                    'name' => $produk->judul,
                ],
            ],
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('order.payment', compact('snapToken', 'order', 'produk'));
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $order = Order::findOrFail($request->order_id);
            $order->update(['status' => $request->transaction_status]);

            // Tambahkan logika tambahan jika dibutuhkan, seperti notifikasi admin.
        }
    }
}


