<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(CheckoutRequest $request)
    {
        $validated = $request->validated();

        $order = DB::transaction(function () use ($validated) {
            $subtotal = 0;
            $itemsData = [];

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'spice_level' => $item['spice_level'] ?? 0,
                    'notes' => $item['notes'] ?? null,
                    'subtotal' => $itemSubtotal,
                ];
            }

            $deliveryFee = match ($validated['delivery_type']) {
                'express_delivery' => 12000,
                default => 0,
            };

            $taxAmount = round($subtotal * 0.10);
            $totalAmount = $subtotal + $taxAmount + $deliveryFee;

            $orderNumber = 'DAR-' . date('Ymd') . '-' . strtoupper(Str::random(5));

            $order = Order::create([
                'order_number' => $orderNumber,
                'outlet_id' => $validated['outlet_id'],
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'delivery_type' => $validated['delivery_type'],
                'delivery_address' => $validated['delivery_address'] ?? null,
                'delivery_notes' => $validated['delivery_notes'] ?? null,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'cod' ? 'pending' : 'pending',
                'order_status' => 'received',
                'payment_reference' => 'REF-' . strtoupper(Str::random(10)),
                'snap_token' => 'SNAP-' . Str::uuid(),
            ]);

            foreach ($itemsData as $itemData) {
                $order->items()->create($itemData);
            }

            return $order;
        });

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'order_number' => $order->order_number,
                'redirect_url' => route('orders.show', $order->order_number),
            ]);
        }

        return redirect()->route('orders.show', $order->order_number);
    }

    public function show(string $orderNumber)
    {
        $order = Order::with(['outlet', 'items.product'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('order-tracking', compact('order'));
    }

    /**
     * Interactive Mock Payment Simulator for Instant Demo
     */
    public function simulatePayment(Request $request, string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        $status = $request->input('status', 'paid'); // paid, failed

        if ($status === 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'order_status' => 'cooking',
            ]);
            $msg = 'Simulasi Midtrans Sukses: Pembayaran QRIS berhasil! Pesanan langsung masuk antrean penggorengan kresss!';
        } else {
            $order->update([
                'payment_status' => 'failed',
            ]);
            $msg = 'Simulasi Midtrans: Pembayaran ditolak/gagal.';
        }

        return redirect()->route('orders.show', $order->order_number)->with('simulation_alert', $msg);
    }

    /**
     * Interactive Kitchen Status Simulator for Demo
     */
    public function simulateStatus(Request $request, string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        $nextStatus = $request->input('order_status', 'ready');

        $order->update(['order_status' => $nextStatus]);

        $statusMsg = match ($nextStatus) {
            'cooking' => 'Dapur: Telur dadar sedang digoreng garing renyah!',
            'ready' => 'Dapur: Pesanan siap diambil / siap diantar kurir!',
            'delivered' => 'Pesanan telah diterima customer. Selamat menikmati!',
            default => 'Status pesanan diperbarui.'
        };

        return redirect()->route('orders.show', $order->order_number)->with('simulation_alert', $statusMsg);
    }
}
