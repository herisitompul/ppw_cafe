<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller {
    public function handleCallback(Request $request) {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $signatureKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($signatureKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid Signature'], 403);
        }

        $order = Order::where('order_number', $request->order_id)->first();
        if ($order) {
            $order->update(['status' => $request->transaction_status]);
        }

        return response()->json(['message' => 'Callback processed']);
    }
}

