<?php

namespace App\Http\Controllers;

use App\Models\BridgeRedirectLog;
use App\Models\Outlet;
use Illuminate\Http\Request;

class SmartBridgeController extends Controller
{
    protected array $platformConfigs = [
        'shopeefood' => [
            'key' => 'shopeefood',
            'name' => 'ShopeeFood',
            'company' => 'Shopee',
            'theme_color' => '#EE4D2D',
            'theme_accent' => '#D03E1F',
            'theme_light' => '#FFF3F0',
            'tagline' => 'Gratis Ongkir Seharian & Diskon s.d 50%!',
            'promo_badge' => '🔥 DISKON S.D 50% + GRATIS ONGKIR',
            'voucher_code' => 'SHOPEEDADAR50',
            'scheme_android' => 'intent://shopee.co.id/search?keyword=Dadar+Beredar#Intent;package=com.shopee.id;scheme=shopeeid;end',
            'scheme_ios' => 'shopeeid://search?keyword=Dadar%20Beredar',
            'package_name' => 'com.shopee.id',
            'store_url_android' => 'https://play.google.com/store/apps/details?id=com.shopee.id',
            'store_url_ios' => 'https://apps.apple.com/id/app/shopee-panen-berkah/id959841449',
        ],
        'grabfood' => [
            'key' => 'grabfood',
            'name' => 'GrabFood',
            'company' => 'Grab',
            'theme_color' => '#00B14F',
            'theme_accent' => '#008C3E',
            'theme_light' => '#EEFBF4',
            'tagline' => 'Pesta Kuliner Hemat & Pengantaran Ekstra Cepat!',
            'promo_badge' => '🛵 PROMO PESTA KULINER S.D 40%',
            'voucher_code' => 'GRABDADARHEMAT',
            'scheme_android' => 'intent://food.grab.com/#Intent;package=com.grabtaxi.passenger;scheme=grab;end',
            'scheme_ios' => 'grab://open?screenType=GRABFOOD',
            'package_name' => 'com.grabtaxi.passenger',
            'store_url_android' => 'https://play.google.com/store/apps/details?id=com.grabtaxi.passenger',
            'store_url_ios' => 'https://apps.apple.com/id/app/grab-superapp/id647268330',
        ],
        'gofood' => [
            'key' => 'gofood',
            'name' => 'GoFood',
            'company' => 'Gojek',
            'theme_color' => '#ED2736',
            'theme_accent' => '#00880C',
            'theme_light' => '#FFF0F1',
            'tagline' => 'Sensasi Telur Dadar Juara No. 1 di GoFood!',
            'promo_badge' => '⭐ BEST SELLER + CASHBACK GOPAY COINS',
            'voucher_code' => 'GOFOODBEREDAR',
            'scheme_android' => 'intent://gofood.link/#Intent;package=com.gojek.app;scheme=gojek;end',
            'scheme_ios' => 'gojek://gofood',
            'package_name' => 'com.gojek.app',
            'store_url_android' => 'https://play.google.com/store/apps/details?id=com.gojek.app',
            'store_url_ios' => 'https://apps.apple.com/id/app/gojek/id944875099',
        ],
    ];

    public function show(Request $request, string $platform, ?string $outletSlug = null)
    {
        $platformKey = $this->normalizePlatform($platform);
        $config = $this->platformConfigs[$platformKey];

        // Resolve Outlet
        $outlet = null;
        if ($outletSlug) {
            $outlet = Outlet::where('slug', $outletSlug)->where('is_active', true)->first();
        }

        if (!$outlet) {
            $outlet = Outlet::where('slug', 'dadar-beredar-sidoarjo')->first() 
                ?? Outlet::where('is_active', true)->first();
        }

        $allOutlets = Outlet::where('is_active', true)->orderBy('city')->get();
        $targetUrl = $outlet->getDeliveryUrl($platformKey);

        // Detect device
        $deviceType = $this->detectDevice($request);

        // Log redirect attempt
        $this->logRedirect($request, $platformKey, $outlet->id, $deviceType);

        // Dynamic QR code endpoint for desktop
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=260x260&margin=10&data=' . urlencode($targetUrl);

        return view('bridge.redirect', [
            'platform' => $config,
            'platformKey' => $platformKey,
            'allPlatforms' => $this->platformConfigs,
            'outlet' => $outlet,
            'allOutlets' => $allOutlets,
            'targetUrl' => $targetUrl,
            'deviceType' => $deviceType,
            'qrCodeUrl' => $qrCodeUrl,
            'autoRedirect' => $request->boolean('auto', true),
        ]);
    }

    public function redirect(Request $request, string $platform, ?string $outletSlug = null)
    {
        $platformKey = $this->normalizePlatform($platform);

        $outlet = null;
        if ($outletSlug) {
            $outlet = Outlet::where('slug', $outletSlug)->first();
        }
        if (!$outlet) {
            $outlet = Outlet::where('slug', 'dadar-beredar-sidoarjo')->first() ?? Outlet::first();
        }

        $deviceType = $this->detectDevice($request);
        $this->logRedirect($request, $platformKey, $outlet?->id, $deviceType);

        $targetUrl = $outlet ? $outlet->getDeliveryUrl($platformKey) : url('/');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'platform' => $platformKey,
                'outlet' => $outlet?->name,
                'target_url' => $targetUrl,
            ]);
        }

        return redirect()->away($targetUrl);
    }

    public function stats(Request $request)
    {
        $totalClicks = BridgeRedirectLog::count();
        $byPlatform = BridgeRedirectLog::selectRaw('platform, count(*) as total')
            ->groupBy('platform')
            ->pluck('total', 'platform')
            ->toArray();

        $byDevice = BridgeRedirectLog::selectRaw('device_type, count(*) as total')
            ->groupBy('device_type')
            ->pluck('total', 'device_type')
            ->toArray();

        $byOutlet = BridgeRedirectLog::with('outlet:id,name,city')
            ->selectRaw('outlet_id, count(*) as total')
            ->groupBy('outlet_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $recentLogs = BridgeRedirectLog::with('outlet:id,name')
            ->latest()
            ->limit(20)
            ->get();

        return response()->json([
            'success' => true,
            'total_redirects' => $totalClicks,
            'by_platform' => $byPlatform,
            'by_device' => $byDevice,
            'by_outlet' => $byOutlet,
            'recent' => $recentLogs,
        ]);
    }

    protected function normalizePlatform(string $platform): string
    {
        $platform = strtolower(trim($platform));
        if (in_array($platform, ['shopee', 'shopeefood', 'spf'])) {
            return 'shopeefood';
        }
        if (in_array($platform, ['grab', 'grabfood', 'gf'])) {
            return 'grabfood';
        }
        return 'gofood';
    }

    protected function detectDevice(Request $request): string
    {
        $userAgent = strtolower($request->header('User-Agent', ''));

        if (str_contains($userAgent, 'android')) {
            return 'mobile_android';
        }
        if (str_contains($userAgent, 'iphone') || str_contains($userAgent, 'ipad') || str_contains($userAgent, 'ipod')) {
            return 'mobile_ios';
        }

        return 'desktop';
    }

    protected function logRedirect(Request $request, string $platform, ?int $outletId, string $deviceType): void
    {
        try {
            BridgeRedirectLog::create([
                'platform' => $platform,
                'outlet_id' => $outletId,
                'device_type' => $deviceType,
                'user_agent' => substr((string) $request->header('User-Agent'), 0, 500),
                'ip_address' => $request->ip(),
                'referrer' => substr((string) $request->header('referer'), 0, 500),
            ]);
        } catch (\Throwable $e) {
            // Silently log or ignore to not disrupt user experience
            logger()->error('Failed to log bridge redirect: ' . $e->getMessage());
        }
    }
}
