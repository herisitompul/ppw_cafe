<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService {
    public function __construct() {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Membuat transaksi menggunakan Snap
     *
     * @param $order (object) Data order
     * @return object Snap response
     */
    public function createTransaction($order) {
        return Snap::createTransaction([
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
        ]);
    }
}
