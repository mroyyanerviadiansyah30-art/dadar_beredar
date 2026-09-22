<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuka {{ $platform['name'] }} - Dadar Beredar {{ $outlet->name }}</title>
    <meta name="description" content="Pesan Dadar Beredar Babe Cabita melalui {{ $platform['name'] }}. Nikmati telur dadar crispy gurih renyah dengan aneka sambal pedas juara.">
    <link rel="icon" type="image/png" href="/images/logo-pan-icon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .font-comic { font-family: 'Fredoka', cursive, sans-serif; }
        .platform-pulse {
            animation: pulse-border 1.8s infinite;
        }
        @keyframes pulse-border {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.2); }
            70% { transform: scale(1.02); box-shadow: 0 0 0 14px rgba(0, 0, 0, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(0, 0, 0, 0); }
        }
    </style>
</head>
<body class="bg-[#FFFDF7] text-[#1E1E24] font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-[#FFB800]"
      x-data="bridgePage()"
      x-init="initBridge()">

    <!-- Header Strip -->
    <header class="bg-white border-b-3 border-[#1E1E24] px-4 py-3 shadow-[0_3px_0px_#1E1E24]">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 hover:opacity-90 transition-opacity">
                <div class="w-10 h-10 rounded-xl bg-[#FFF8DB] border-2 border-[#1E1E24] flex items-center justify-center p-1 shadow-[2px_2px_0px_#1E1E24]">
                    <img src="/images/logo-pan-icon.png" alt="Dadar Beredar" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="font-comic font-bold text-lg text-[#1E1E24] leading-tight block">
                        DADAR <span class="text-[#FFB800]">BEREDAR</span>
                    </span>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider block">
                        Smart Redirect Bridge
                    </span>
                </div>
            </a>

            <a href="{{ route('home') }}" class="comic-btn bg-[#FFF8DB] text-[#1E1E24] text-xs px-3.5 py-1.5 flex items-center gap-1.5">
                <span>← Kembali ke Menu</span>
            </a>
        </div>
    </header>

    <!-- Main Bridge Content Container -->
    <main class="flex-1 max-w-4xl w-full mx-auto px-4 py-8 sm:py-12 flex flex-col items-center justify-center">

        <!-- Top Platform Badges Switcher -->
        <div class="w-full max-w-lg mb-6 flex items-center justify-center gap-2 sm:gap-3">
            @foreach($allPlatforms as $pk => $p)
                <a href="{{ route('bridge.show', ['platform' => $pk, 'outlet' => $outlet->slug]) }}"
                   class="comic-btn text-xs px-3 py-2 flex items-center gap-1.5 transition-all
                          {{ $platformKey === $pk ? 'bg-[#1E1E24] text-white shadow-[3px_3px_0px_' . $p['theme_color'] . '] scale-105' : 'bg-white text-gray-700 hover:bg-[#FFF8DB]' }}">
                    <span class="w-2.5 h-2.5 rounded-full inline-block" style="background-color: {{ $p['theme_color'] }}"></span>
                    <span class="font-comic font-bold">{{ $p['name'] }}</span>
                </a>
            @endforeach
        </div>

        <!-- Central Bridge Box -->
        <div class="w-full max-w-lg bg-white rounded-3xl comic-border comic-shadow-lg overflow-hidden relative">

            <!-- Branded Header with Animated Connection Bridge -->
            <div class="p-6 text-center border-b-3 border-[#1E1E24] relative overflow-hidden"
                 style="background-color: {{ $platform['theme_light'] }};">

                <!-- Decorative Badges -->
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border-2 border-[#1E1E24] shadow-[2px_2px_0px_#1E1E24] text-xs font-comic font-bold text-[#1E1E24] mb-4">
                    <span>🛵</span>
                    <span>Smart Bridge Active</span>
                </div>

                <!-- Animated Connection Line -->
                <div class="flex items-center justify-center gap-4 sm:gap-6 my-2">
                    <!-- Dadar Beredar Icon -->
                    <div class="w-16 h-16 rounded-2xl bg-white border-3 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] flex items-center justify-center p-2 transform -rotate-3">
                        <img src="/images/logo-pan-icon.png" alt="Dadar Beredar" class="w-full h-full object-contain">
                    </div>

                    <!-- Pulsing Arrow / Scooter -->
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex items-center gap-1 text-lg">
                            <span class="animate-bounce">⚡</span>
                            <span class="font-comic font-black text-sm tracking-wider uppercase text-gray-600">MENGHUBUNGKAN</span>
                            <span class="animate-bounce delay-100">⚡</span>
                        </div>
                        <div class="w-28 sm:w-36 h-2 bg-[#1E1E24]/20 rounded-full mt-1 relative overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-300"
                                 style="background-color: {{ $platform['theme_color'] }}; width: 100%;"
                                 :style="'width: ' + progressPercent + '%'"></div>
                        </div>
                    </div>

                    <!-- Platform Logo Avatar -->
                    <div class="w-16 h-16 rounded-2xl text-white border-3 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] flex items-center justify-center font-comic font-black text-xl transform rotate-3"
                         style="background-color: {{ $platform['theme_color'] }}">
                        @if($platformKey === 'shopeefood')
                            <span>🛍️</span>
                        @elseif($platformKey === 'grabfood')
                            <span>🛵</span>
                        @else
                            <span>🍳</span>
                        @endif
                    </div>
                </div>

                <h1 class="font-comic text-2xl sm:text-3xl font-black text-[#1E1E24] mt-3">
                    Membuka {{ $platform['name'] }}
                </h1>
                <p class="text-xs sm:text-sm text-gray-700 font-medium mt-1">
                    {{ $platform['tagline'] }}
                </p>
            </div>

            <!-- Bridge Body -->
            <div class="p-6 space-y-6">

                <!-- Countdown & Status Notice -->
                <div class="bg-[#FFF8DB] p-4 rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] text-center space-y-2">
                    <div class="flex items-center justify-center gap-2">
                        <div class="w-3 h-3 rounded-full animate-ping" style="background-color: {{ $platform['theme_color'] }}"></div>
                        <p class="font-comic font-bold text-sm text-[#1E1E24]">
                            <span x-show="isMobile && countdown > 0">
                                Mengalihkan otomatis ke aplikasi dalam <strong class="text-xl font-black" x-text="countdown">2</strong> detik...
                            </span>
                            <span x-show="isMobile && countdown <= 0">
                                Mengarahkan ke menu {{ $outlet->name }}...
                            </span>
                            <span x-show="!isMobile">
                                Pindai QR Code di bawah dengan HP atau klik tombol buka menu!
                            </span>
                        </p>
                    </div>

                    <!-- Promo Highlight Pill -->
                    <div class="inline-block px-3 py-1 bg-white border-2 border-[#1E1E24] rounded-xl text-[11px] font-comic font-bold text-[#1E1E24]">
                        {{ $platform['promo_badge'] }}
                    </div>
                </div>

                @if($platformKey === 'shopeefood')
                    <!-- ShopeeFood Special App Notice -->
                    <div class="p-3.5 bg-[#FFF3F0] rounded-2xl border-2 border-[#EE4D2D] text-xs text-[#1E1E24] flex items-start gap-2.5">
                        <span class="text-xl shrink-0">🛍️</span>
                        <div>
                            <strong class="font-comic font-bold text-xs text-[#EE4D2D] block">Panduan Pesan ShopeeFood:</strong>
                            <p class="text-[11px] text-gray-700 mt-0.5 leading-relaxed">
                                ShopeeFood beroperasi khusus di aplikasi <strong>Shopee smartphone</strong>. Pindai QR Code di bawah dengan kamera HP Anda untuk langsung membuka aplikasi Shopee di ponsel Anda!
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Outlet Details Card -->
                <div class="p-4 bg-white rounded-2xl border-2 border-[#1E1E24] shadow-[2px_2px_0px_#1E1E24] space-y-2">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-comic font-bold text-base text-[#1E1E24]">
                                    {{ $outlet->name }}
                                </h3>
                                @if($outlet->city === 'Sidoarjo')
                                    <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#FF4D00] text-white">PUSAT</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                📍 {{ $outlet->address }}
                            </p>
                        </div>
                        <div class="text-right shrink-0">
                            <span class="comic-badge text-xs px-2 py-0.5 bg-[#FFB800] text-[#1E1E24]">
                                ⭐ {{ $outlet->rating }}
                            </span>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-dashed border-gray-200 flex items-center justify-between text-xs text-gray-600">
                        <span>🕒 Buka: {{ $outlet->opening_hours }}</span>
                        <!-- Outlet Selector Trigger -->
                        <button type="button" 
                                @click="showOutletModal = true" 
                                class="text-[#FF4D00] font-comic font-bold hover:underline">
                            Ganti Cabang &rarr;
                        </button>
                    </div>
                </div>

                <!-- Desktop Experience: Dynamic QR Code Scanner -->
                <div x-show="!isMobile" class="bg-gray-50 p-4 rounded-2xl border-2 border-[#1E1E24] text-center space-y-3">
                    <div class="flex items-center justify-center gap-1.5 text-xs font-comic font-bold text-gray-700">
                        <span>📱</span>
                        <span>Pindai QR Code Ini Menggunakan Kamera HP Anda:</span>
                    </div>
                    
                    <div class="inline-block p-2 bg-white rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]">
                        <img src="{{ $qrCodeUrl }}" 
                             alt="QR Code Pesan {{ $platform['name'] }} Dadar Beredar" 
                             class="w-44 h-44 object-contain mx-auto rounded-lg">
                    </div>

                    <p class="text-[11px] text-gray-500 leading-snug">
                        Arahkan kamera smartphone Anda ke QR code di atas untuk langsung membuka menu <strong>Dadar Beredar {{ $outlet->city }}</strong> di aplikasi <strong>{{ $platform['name'] }}</strong>!
                    </p>
                </div>

                <!-- Action CTA Buttons -->
                <div class="space-y-2.5 pt-2">
                    <!-- Manual Direct Open Button -->
                    <a :href="isMobile ? (deviceType === 'mobile_android' ? schemeAndroid : schemeIos) : targetUrl" 
                       target="_blank"
                       rel="noopener"
                       id="btn-direct-app"
                       @click="recordDirectClick()"
                       class="comic-btn w-full text-white py-3.5 text-base flex items-center justify-center gap-2 shadow-[4px_4px_0px_#1E1E24]"
                       style="background-color: {{ $platform['theme_color'] }};">
                        <span>🚀 Buka Aplikasi {{ $platform['name'] }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <!-- Web Browser Fallback Button -->
                    <a :href="targetUrl" 
                       target="_blank"
                       rel="noopener"
                       class="comic-btn w-full bg-[#FFFDF7] text-[#1E1E24] py-3 text-xs sm:text-sm flex items-center justify-center gap-2 hover:bg-[#FFF8DB]">
                        <span>🌐 Buka via Web Browser (Tab Baru)</span>
                    </a>

                    <!-- Return to Home -->
                    <div class="text-center pt-2">
                        <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-[#1E1E24] font-medium underline">
                            Batal dan kembali ke menu utama Dadar Beredar
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Security & Authenticity Trust Seal -->
        <div class="mt-8 text-center text-xs text-gray-500 flex items-center justify-center gap-4">
            <span class="flex items-center gap-1">🔒 <strong>100% Link Resmi</strong> {{ $platform['name'] }}</span>
            <span>&bull;</span>
            <span class="flex items-center gap-1">🍳 <strong>Dadar Beredar</strong> Official Verified</span>
        </div>

    </main>

    <!-- Outlet Switcher Modal -->
    <div x-show="showOutletModal" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto" 
         role="dialog">
        <div class="fixed inset-0 bg-[#1E1E24]/60 backdrop-blur-sm" @click="showOutletModal = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-md bg-[#FFFDF7] rounded-3xl comic-border comic-shadow-lg p-6 space-y-4"
                 @click.away="showOutletModal = false">
                
                <div class="flex items-center justify-between border-b-2 border-[#1E1E24] pb-3">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">📍</span>
                        <h3 class="font-comic font-bold text-lg text-[#1E1E24]">Pilih Cabang Dadar Beredar</h3>
                    </div>
                    <button @click="showOutletModal = false" class="p-1 text-gray-500 font-bold hover:text-black">✕</button>
                </div>

                <div class="max-h-72 overflow-y-auto space-y-2 pr-1">
                    @foreach($allOutlets as $o)
                        <a href="{{ route('bridge.show', ['platform' => $platformKey, 'outlet' => $o->slug]) }}"
                           class="block p-3 rounded-xl border-2 border-[#1E1E24] transition-all hover:bg-[#FFF8DB]
                                  {{ $outlet->id === $o->id ? 'bg-[#FFB800] shadow-[2px_2px_0px_#1E1E24]' : 'bg-white' }}">
                            <div class="flex items-center justify-between">
                                <span class="font-comic font-bold text-sm text-[#1E1E24]">{{ $o->name }}</span>
                                <span class="text-xs font-bold text-gray-600">⭐ {{ $o->rating }}</span>
                            </div>
                            <p class="text-xs text-gray-600 mt-0.5 line-clamp-1">{{ $o->address }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t-3 border-[#1E1E24] py-4 px-4 text-center text-xs text-gray-500">
        <p>&copy; {{ date('Y') }} Dadar Beredar Sidoarjo &bull; Sensasi Telur Dadar Krispy Babe Cabita</p>
    </footer>

    <!-- Alpine Controller & Deep-link logic -->
    <script>
        function bridgePage() {
            return {
                platformKey: '{{ $platformKey }}',
                platformName: '{{ $platform['name'] }}',
                deviceType: '{{ $deviceType }}',
                targetUrl: '{{ $targetUrl }}',
                schemeAndroid: '{{ $platform['scheme_android'] }}',
                schemeIos: '{{ $platform['scheme_ios'] }}',
                autoRedirect: {{ $autoRedirect ? 'true' : 'false' }},
                countdown: 2,
                progressPercent: 20,
                showOutletModal: false,

                get isMobile() {
                    return this.deviceType === 'mobile_android' || this.deviceType === 'mobile_ios';
                },

                initBridge() {
                    // Update progress bar
                    const totalDuration = 2000;
                    const intervalMs = 200;
                    let elapsed = 0;

                    const timer = setInterval(() => {
                        elapsed += intervalMs;
                        this.progressPercent = Math.min(100, Math.round((elapsed / totalDuration) * 100));

                        if (elapsed >= 1000 && this.countdown > 1) {
                            this.countdown = 1;
                        }

                        if (elapsed >= totalDuration) {
                            clearInterval(timer);
                            this.countdown = 0;
                            // Only auto-trigger native app intent on mobile
                            if (this.autoRedirect && this.isMobile) {
                                this.triggerMobileAppRedirect();
                            }
                        }
                    }, intervalMs);
                },

                triggerMobileAppRedirect() {
                    const deepScheme = this.deviceType === 'mobile_android' ? this.schemeAndroid : this.schemeIos;
                    const fallbackUrl = this.targetUrl;

                    const start = Date.now();
                    window.location.href = deepScheme;

                    setTimeout(() => {
                        // If still on page after 1.8s, fallback to web
                        if (Date.now() - start < 2200) {
                            window.location.href = fallbackUrl;
                        }
                    }, 1800);
                },

                recordDirectClick() {
                    // direct open button clicked
                }
            };
        }
    </script>
</body>
</html>
