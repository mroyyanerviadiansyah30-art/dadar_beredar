<!-- Smart Delivery Bridge Modal Component (ShopeeFood, GrabFood, GoFood) -->
<div x-show="deliveryModalOpen" 
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="delivery-modal-title" role="dialog" aria-modal="true">
    
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-[#1E1E24]/75 backdrop-blur-sm transition-opacity" 
         @click="deliveryModalOpen = false"></div>

    <div class="flex min-h-full items-center justify-center p-4 sm:p-6">
        <div class="relative w-full max-w-xl bg-[#FFFDF7] rounded-3xl comic-border comic-shadow-lg overflow-hidden"
             @click.away="deliveryModalOpen = false"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">

            <!-- Modal Header -->
            <div class="p-5 sm:p-6 bg-[#FFB800] border-b-3 border-[#1E1E24] flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white border-2 border-[#1E1E24] flex items-center justify-center text-2xl shadow-[2px_2px_0px_#1E1E24]">
                        🛵
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-comic font-black text-xl sm:text-2xl text-[#1E1E24] leading-tight" id="delivery-modal-title">
                                Pesan via Online Food
                            </h3>
                            <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#FF4D00] text-white">SMART BRIDGE</span>
                        </div>
                        <p class="text-xs font-bold text-gray-800 mt-0.5">
                            Pilih platform pesan-antar favoritmu & nikmati promo kresss!
                        </p>
                    </div>
                </div>
                <button @click="deliveryModalOpen = false" 
                        class="p-2 rounded-xl bg-white border-2 border-[#1E1E24] hover:bg-gray-100 transition-colors shadow-[2px_2px_0px_#1E1E24]">
                    <svg class="w-5 h-5 text-[#1E1E24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-5 sm:p-6 space-y-5 max-h-[75vh] overflow-y-auto">

                <!-- Outlet Selection Picker -->
                <div class="bg-[#FFF8DB] p-3.5 rounded-2xl border-2 border-[#1E1E24] space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="font-comic font-bold text-xs text-[#1E1E24] flex items-center gap-1.5">
                            <span>📍</span>
                            <span>Cabang Dadar Beredar yang Dipilih:</span>
                        </label>
                        <span class="text-[11px] font-bold text-[#FF4D00]">Sidoarjo &bull; Surabaya &bull; DLL</span>
                    </div>
                    <select x-model="bridgeSelectedOutletSlug" 
                            class="w-full bg-white border-2 border-[#1E1E24] rounded-xl px-3 py-2 text-xs font-bold text-[#1E1E24] focus:outline-none focus:ring-2 focus:ring-[#FFB800]">
                        @foreach(\App\Models\Outlet::where('is_active', true)->orderBy('city')->get() as $outlet)
                            <option value="{{ $outlet->slug }}">
                                {{ $outlet->name }} ({{ $outlet->city }}) - ⭐ {{ $outlet->rating }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 3 Platform Delivery Cards -->
                <div class="space-y-3">
                    
                    <!-- 1. ShopeeFood Card -->
                    <a :href="'/bridge/shopeefood/' + bridgeSelectedOutletSlug" 
                       target="_blank"
                       class="block p-4 rounded-2xl border-3 border-[#1E1E24] bg-white hover:bg-[#FFF3F0] transition-all transform hover:-translate-y-1 shadow-[4px_4px_0px_#EE4D2D] group">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#EE4D2D] border-2 border-[#1E1E24] text-white flex items-center justify-center text-2xl shadow-[2px_2px_0px_#1E1E24] shrink-0 group-hover:scale-105 transition-transform">
                                    🛍️
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-comic font-black text-lg text-[#1E1E24] group-hover:text-[#EE4D2D] transition-colors leading-none">
                                            ShopeeFood
                                        </h4>
                                        <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#EE4D2D] text-white">PROMO JUMBO</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 font-medium">
                                        Diskon s.d. 50% & Gratis Ongkir Seharian
                                    </p>
                                </div>
                            </div>
                            <div class="comic-btn bg-[#EE4D2D] text-white text-xs px-3.5 py-2 shrink-0 group-hover:bg-[#D03E1F] flex items-center gap-1">
                                <span>Buka</span>
                                <span class="text-sm">&rarr;</span>
                            </div>
                        </div>
                    </a>

                    <!-- 2. GrabFood Card -->
                    <a :href="'/bridge/grabfood/' + bridgeSelectedOutletSlug" 
                       target="_blank"
                       class="block p-4 rounded-2xl border-3 border-[#1E1E24] bg-white hover:bg-[#EEFBF4] transition-all transform hover:-translate-y-1 shadow-[4px_4px_0px_#00B14F] group">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#00B14F] border-2 border-[#1E1E24] text-white flex items-center justify-center text-2xl shadow-[2px_2px_0px_#1E1E24] shrink-0 group-hover:scale-105 transition-transform">
                                    🛵
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-comic font-black text-lg text-[#1E1E24] group-hover:text-[#00B14F] transition-colors leading-none">
                                            GrabFood
                                        </h4>
                                        <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#00B14F] text-white">HEMAT KULINER</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 font-medium">
                                        Pesta Kuliner Grab & Pengantaran Ekstra Cepat
                                    </p>
                                </div>
                            </div>
                            <div class="comic-btn bg-[#00B14F] text-white text-xs px-3.5 py-2 shrink-0 group-hover:bg-[#008C3E] flex items-center gap-1">
                                <span>Buka</span>
                                <span class="text-sm">&rarr;</span>
                            </div>
                        </div>
                    </a>

                    <!-- 3. GoFood Card -->
                    <a :href="'/bridge/gofood/' + bridgeSelectedOutletSlug" 
                       target="_blank"
                       class="block p-4 rounded-2xl border-3 border-[#1E1E24] bg-white hover:bg-[#FFF0F1] transition-all transform hover:-translate-y-1 shadow-[4px_4px_0px_#ED2736] group">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3.5">
                                <div class="w-12 h-12 rounded-2xl bg-[#ED2736] border-2 border-[#1E1E24] text-white flex items-center justify-center text-2xl shadow-[2px_2px_0px_#1E1E24] shrink-0 group-hover:scale-105 transition-transform">
                                    🍳
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-comic font-black text-lg text-[#1E1E24] group-hover:text-[#ED2736] transition-colors leading-none">
                                            GoFood
                                        </h4>
                                        <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#ED2736] text-white">BEST SELLER</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 font-medium">
                                        Pelopor Telur Dadar Crispy No. 1 + GoPay Coins
                                    </p>
                                </div>
                            </div>
                            <div class="comic-btn bg-[#ED2736] text-white text-xs px-3.5 py-2 shrink-0 group-hover:bg-[#C91A28] flex items-center gap-1">
                                <span>Buka</span>
                                <span class="text-sm">&rarr;</span>
                            </div>
                        </div>
                    </a>

                </div>

                <!-- Footer Guarantee Tip -->
                <div class="p-3 bg-[#FFFDF7] rounded-xl border border-[#1E1E24] text-center text-[11px] text-gray-600 space-y-1">
                    <p>⚡ <strong>100% Direct Store Link:</strong> <em>Terhubung langsung ke halaman resto resmi Dadar Beredar tanpa perlu mencari di kolom penelusuran aplikasi!</em></p>
                </div>

            </div>
        </div>
    </div>
</div>
