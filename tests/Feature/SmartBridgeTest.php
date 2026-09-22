<?php

namespace Tests\Feature;

use App\Models\BridgeRedirectLog;
use App\Models\Outlet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmartBridgeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_shopeefood_bridge_page_renders_successfully(): void
    {
        $response = $this->get('/bridge/shopeefood/dadar-beredar-sidoarjo');

        $response->assertStatus(200);
        $response->assertSee('ShopeeFood', false);
        $response->assertSee('Dadar Beredar Sidoarjo', false);
        $response->assertSee('Smart Bridge Active', false);

        // Verify log was recorded
        $this->assertDatabaseHas('bridge_redirect_logs', [
            'platform' => 'shopeefood',
        ]);
    }

    public function test_grabfood_bridge_page_renders_successfully(): void
    {
        $response = $this->get('/bridge/grabfood/dadar-beredar-sidoarjo');

        $response->assertStatus(200);
        $response->assertSee('GrabFood', false);
        $response->assertSee('Dadar Beredar Sidoarjo', false);

        $this->assertDatabaseHas('bridge_redirect_logs', [
            'platform' => 'grabfood',
        ]);
    }

    public function test_gofood_bridge_page_renders_successfully(): void
    {
        $response = $this->get('/bridge/gofood/dadar-beredar-sidoarjo');

        $response->assertStatus(200);
        $response->assertSee('GoFood', false);
        $response->assertSee('Dadar Beredar Sidoarjo', false);

        $this->assertDatabaseHas('bridge_redirect_logs', [
            'platform' => 'gofood',
        ]);
    }

    public function test_pesan_alias_route_works(): void
    {
        $response = $this->get('/pesan/gofood/dadar-beredar-sidoarjo');

        $response->assertStatus(200);
        $response->assertSee('GoFood', false);
    }

    public function test_bridge_direct_redirect_logs_and_redirects(): void
    {
        $outlet = Outlet::where('slug', 'dadar-beredar-sidoarjo')->first();
        $response = $this->get('/bridge-go/gofood/dadar-beredar-sidoarjo');

        $response->assertRedirect($outlet->gofood_url);

        $this->assertDatabaseHas('bridge_redirect_logs', [
            'platform' => 'gofood',
            'outlet_id' => $outlet->id,
        ]);
    }

    public function test_waru_tropodo_outlet_exists_and_bridge_works(): void
    {
        $outlet = Outlet::where('slug', 'dadar-beredar-waru-tropodo')->first();

        $this->assertNotNull($outlet, 'Outlet Dadar Beredar Waru Tropodo should exist in database');
        $this->assertEquals('Sidoarjo', $outlet->city);
        $this->assertStringContainsString('Tropodo', $outlet->address);

        // Test GoFood bridge page for Waru Tropodo
        $response = $this->get('/bridge/gofood/dadar-beredar-waru-tropodo');
        $response->assertStatus(200);
        $response->assertSee('Dadar Beredar Waru Tropodo', false);

        // Test ShopeeFood bridge page for Waru Tropodo
        $responseShopee = $this->get('/bridge/shopeefood/dadar-beredar-waru-tropodo');
        $responseShopee->assertStatus(200);
        $responseShopee->assertSee('Dadar Beredar Waru Tropodo', false);
    }

    public function test_bridge_urls_and_deep_links_are_direct_to_restaurant_without_search_query(): void
    {
        $outlet = Outlet::where('slug', 'dadar-beredar-sidoarjo')->first();

        // 1. Verify outlet delivery URLs do NOT contain search keywords
        $this->assertStringNotContainsString('search?keyword=', $outlet->getDeliveryUrl('shopeefood'));
        $this->assertStringNotContainsString('restaurants?search=', $outlet->getDeliveryUrl('grabfood'));
        $this->assertStringNotContainsString('?q=', $outlet->getDeliveryUrl('gofood'));

        // 2. Verify direct store links in URLs
        $this->assertStringContainsString('now-food/shop', $outlet->getDeliveryUrl('shopeefood'));
        $this->assertStringContainsString('restaurant/dadar-beredar', $outlet->getDeliveryUrl('grabfood'));
        $this->assertStringContainsString('restaurant/dadar-beredar', $outlet->getDeliveryUrl('gofood'));

        // 3. Verify ShopeeFood bridge response contains direct intent & universal link
        $shopeeResponse = $this->get('/bridge/shopeefood/dadar-beredar-sidoarjo');
        $shopeeResponse->assertStatus(200);
        $shopeeResponse->assertDontSee('search?keyword=', false);
        $shopeeResponse->assertSee('intent://shopee.co.id/universal-link/now-food/shop', false);

        // 4. Verify GrabFood bridge response contains direct intent & restaurant ID
        $grabResponse = $this->get('/bridge/grabfood/dadar-beredar-sidoarjo');
        $grabResponse->assertStatus(200);
        $grabResponse->assertDontSee('restaurants?search=', false);
        $grabResponse->assertSee('intent://food.grab.com/id/id/restaurant', false);
    }
}
