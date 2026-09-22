<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DadarBeredarTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Dadar Beredar', false);
        $response->assertSee('Babe Cabita', false);
        $response->assertSee('Sidoarjo', false);
    }

    public function test_instant_search_api_returns_products_and_outlets(): void
    {
        $response = $this->getJson('/api/search?q=crispy');
        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $this->assertNotEmpty($response->json('products'));

        $outletSearch = $this->getJson('/api/search?q=sidoarjo');
        $outletSearch->assertStatus(200);
        $this->assertNotEmpty($outletSearch->json('outlets'));
    }

    public function test_nearby_outlets_api_calculates_distance(): void
    {
        // Coordinates for Sidoarjo center
        $response = $this->getJson('/api/outlets/nearby?lat=-7.447812&lng=112.718321');
        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('closest.city', 'Sidoarjo');
        $this->assertEquals(0, $response->json('closest.distance_km'));
    }

    public function test_customer_can_create_order_and_track(): void
    {
        $outlet = Outlet::where('slug', 'dadar-beredar-sidoarjo')->first();
        $product = Product::first();

        $payload = [
            'outlet_id' => $outlet->id,
            'customer_name' => 'Dimas Arya',
            'customer_phone' => '081234567890',
            'customer_email' => 'dimas@example.com',
            'delivery_type' => 'takeaway',
            'delivery_notes' => 'Sambal bakar pedas mantap',
            'payment_method' => 'qris',
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'spice_level' => 3,
                    'notes' => 'Tolong kress banget',
                ]
            ]
        ];

        $response = $this->postJson('/orders', $payload);
        $response->assertStatus(200);
        $response->assertJsonPath('success', true);

        $orderNumber = $response->json('order_number');
        $this->assertNotNull($orderNumber);

        // Verify Order Exists in DB
        $order = Order::where('order_number', $orderNumber)->first();
        $this->assertEquals(2, $order->items->first()->quantity);

        // Verify PPN (10%)
        $expectedTax = round($order->subtotal * 0.10);
        $this->assertEquals($expectedTax, $order->tax_amount);
        $this->assertEquals($order->subtotal + $expectedTax, $order->total_amount);

        // Test Order Tracking Page Loads with Cashier Thermal Receipt
        $trackingResponse = $this->get("/orders/{$orderNumber}");
        $trackingResponse->assertStatus(200);
        $trackingResponse->assertSee($orderNumber);
        $trackingResponse->assertSee('PPN Restoran');
        $trackingResponse->assertSee('CABANG PUSAT SIDOARJO');
        $trackingResponse->assertSee('Struk Kasir Resmi');
    }

    public function test_payment_webhook_updates_order_status(): void
    {
        $outlet = Outlet::first();

        $order = Order::create([
            'order_number' => 'DAR-TEST-WEBHOOK-01',
            'outlet_id' => $outlet->id,
            'customer_name' => 'Tester',
            'customer_phone' => '081234567890',
            'delivery_type' => 'takeaway',
            'subtotal' => 25000,
            'delivery_fee' => 0,
            'total_amount' => 25000,
            'payment_method' => 'qris',
            'payment_status' => 'pending',
            'order_status' => 'received',
            'payment_reference' => 'REF-TEST-01',
        ]);

        $payload = [
            'order_id' => 'DAR-TEST-WEBHOOK-01',
            'transaction_status' => 'settlement',
            'fraud_status' => 'accept',
        ];

        $response = $this->postJson('/api/webhooks/payment', $payload);
        $response->assertStatus(200);
        $response->assertJsonPath('status', 'success');

        $order->refresh();
        $this->assertEquals('paid', $order->payment_status);
        $this->assertEquals('cooking', $order->order_status);
    }

    public function test_new_beverages_and_combo_packages_exist_with_accurate_pricing(): void
    {
        // 1. Check drinks
        $drinks = [
            'es-cendol-dawet' => 13636,
            'es-sweet-greentea' => 10909,
            'es-coklat' => 15000,
            'coklat-hangat' => 15000,
            'es-batu' => 2727,
            'es-strup-cincau' => 10909,
        ];

        foreach ($drinks as $slug => $expectedPrice) {
            $product = Product::where('slug', $slug)->first();
            $this->assertNotNull($product, "Product {$slug} should exist");
            $this->assertEquals($expectedPrice, $product->price, "Price for {$slug} mismatch");
            $this->assertEquals('minuman-segar', $product->category->slug);
        }

        // 2. Check combo packages with discount pricing
        $combos = [
            'paketan-pengedar-1' => [
                'price' => 33636,
                'original_price' => 37727,
            ],
            'pengedar-2' => [
                'price' => 61818,
                'original_price' => 75909,
            ],
            'pengedar-3' => [
                'price' => 248182,
                'original_price' => 272271,
            ],
        ];

        foreach ($combos as $slug => $data) {
            $product = Product::where('slug', $slug)->first();
            $this->assertNotNull($product, "Combo {$slug} should exist");
            $this->assertEquals($data['price'], $product->price, "Price for {$slug} mismatch");
            $this->assertEquals($data['original_price'], $product->original_price, "Original price for {$slug} mismatch");
            $this->assertEquals('paket-pengedar', $product->category->slug);
        }

        // 3. Check home page renders them
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Es Cendol Dawet', false);
        $response->assertSee('Es Sweet Greentea', false);
        $response->assertSee('Es Coklat', false);
        $response->assertSee('Coklat Hangat', false);
        $response->assertSee('Es Batu', false);
        $response->assertSee('Es Strup Cincau', false);
        $response->assertSee('Paketan Pengedar 1', false);
        $response->assertSee('Pengedar 2', false);
        $response->assertSee('Pengedar 3', false);
        $response->assertSee('Paket Pengedar', false);
    }
}
