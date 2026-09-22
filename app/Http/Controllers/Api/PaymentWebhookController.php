<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    /**
     * Handle Mock Midtrans / Xendit Webhook Notifications
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        // Support standard Midtrans fields or custom simulator payload
        $orderNumber = $payload['order_id'] ?? $payload['external_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? $payload['status'] ?? 'settlement';
        $fraudStatus = $payload['fraud_status'] ?? 'accept';

        if (!$orderNumber) {
            return response()->json([
                'status' => 'error',
                'message' => 'Missing order_id or external_id in webhook payload'
            ], 400);
        }

        $order = Order::where('order_number', $orderNumber)
            ->orWhere('payment_reference', $orderNumber)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => "Order {$orderNumber} not found"
            ], 404);
        }

        // Midtrans status evaluation
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement' || $transactionStatus == 'PAID' || $transactionStatus == 'COMPLETED') {
            if ($fraudStatus == 'accept') {
                $order->update([
                    'payment_status' => 'paid',
                    'order_status' => 'cooking',
                ]);
            }
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'FAILED') {
            $order->update([
                'payment_status' => 'failed',
                'order_status' => 'cancelled',
            ]);
        } else if ($transactionStatus == 'pending') {
            $order->update([
                'payment_status' => 'pending',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Webhook successfully processed',
            'order_number' => $order->order_number,
            'payment_status' => $order->payment_status,
            'order_status' => $order->order_status,
        ]);
    }
}
