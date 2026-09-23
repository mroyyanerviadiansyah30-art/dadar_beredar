<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dadar Beredar - Sensasi Telur Dadar Krispy Tiada Lawan | Babe Cabita')</title>
    <meta name="description" content="@yield('meta_description', 'Dadar Beredar resmi dari Almarhum Babe Cabita. Nikmati telur dadar crispy keriting garing, aneka sambal pedas gurih, dan lauk serundeng juara. Pesan online DAR-DOR sekarang!')">
    <meta name="keywords" content="Dadar Beredar, Dadar Beredar Sidoarjo, Babe Cabita, Telur Dadar Crispy, Kuliner Sidoarjo, Kuliner Surabaya, Pesan Makan Online">
    
    <!-- Open Graph / SEO -->
    <meta property="og:title" content="Dadar Beredar - Telur Dadar Krispy Babe Cabita">
    <meta property="og:description" content="Sensasi Telur Dadar Krispy Tiada Lawan. Gurih renyah dengan aneka sambal pedas juara.">
    <meta property="og:image" content="/images/logo-dadar-beredar.png">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/logo-pan-icon.png">

    <!-- Google Fonts: Fredoka for comic headings, Plus Jakarta Sans for clean typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Leaflet Map CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Alpine.js (via CDN for reliable instant hydration or local) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        .font-comic { font-family: 'Fredoka', cursive, sans-serif; }
    </style>
    @livewireStyles
</head>
<body class="bg-[#FFFDF7] text-[#1E1E24] font-sans antialiased selection:bg-[#FFB800] selection:text-[#1E1E24] min-h-screen flex flex-col"
      x-data="dadarBeredarApp()"
      x-init="initApp()"
      @cart-cleared.window="cartItems = []"
      @keydown.window.ctrl.k.prevent="openSearchModal()"
      @keydown.window.cmd.k.prevent="openSearchModal()">

    <!-- Top Announcement Bar -->
    <div class="bg-[#1E1E24] text-[#FFB800] py-2 px-4 text-center text-xs sm:text-sm font-medium flex items-center justify-center gap-2 border-b-2 border-[#FFB800] overflow-hidden">
        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-[#FFB800] text-[#1E1E24] text-[11px] font-bold uppercase tracking-wider animate-pulse">🔥 PROMO DAR-DOR</span>
        <span>Cabang Sidoarjo (<strong>Pusat Jl. Pahlawan & Waru Tropodo</strong>) kini melayani Takeaway Kilat & Delivery! Diskon 15% via web.</span>
        <a href="#menu-section" class="underline hover:text-white font-bold ml-1 hidden sm:inline">Pesan Sekarang &rarr;</a>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b-3 border-[#1E1E24] shadow-[0_4px_0_rgba(30,30,36,0.08)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group focus:outline-none">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white border-3 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] flex items-center justify-center p-1 overflow-hidden transform group-hover:rotate-6 transition-transform shrink-0">
                    <img src="/images/logo-pan-icon.png" alt="Dadar Beredar Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-comic text-2xl sm:text-3xl font-extrabold tracking-tight text-[#1E1E24] leading-none">
                            DADAR <span class="text-[#FFB800] inline-block filter drop-shadow-[1px_1px_0px_#1E1E24]">BEREDAR</span>
                        </span>
                        <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#FF4D00] text-white">SIDOARJO</span>
                    </div>
                    <p class="text-[11px] font-bold text-gray-500 tracking-wide uppercase">
                        By Babe Cabita &bull; Sensasi Telur Juara
                    </p>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden lg:flex items-center gap-6 font-comic text-base font-bold text-[#1E1E24]">
                <a href="#menu-section" class="hover:text-[#FF6B00] transition-colors">Menu Favorit</a>
                <a href="#dar-dor-express" class="hover:text-[#FF6B00] transition-colors flex items-center gap-1">
                    <span class="inline-block w-2 h-2 rounded-full bg-[#FF4D00] animate-ping"></span>
                    DAR-DOR Kilat
                </a>
                <a href="#tribute-babe" class="hover:text-[#FF6B00] transition-colors text-[#FF6B00]">Tribute Babe Cabita</a>
                <a href="#store-locator" class="hover:text-[#FF6B00] transition-colors">Outlet & Peta</a>
                <a href="#reviews" class="hover:text-[#FF6B00] transition-colors">Testimoni (4.9 ⭐)</a>
            </nav>

            <!-- Actions: Search & Cart Button -->
            <div class="flex items-center gap-3">
                <!-- Smart Delivery Bridge Trigger Button -->
                <button type="button" 
                        @click="openDeliveryBridgeModal()" 
                        class="comic-btn bg-[#FF4D00] text-white px-3 sm:px-3.5 py-2 text-xs sm:text-sm flex items-center gap-1.5 hover:bg-[#E11D48] shadow-[2px_2px_0px_#1E1E24]"
                        title="Pesan via ShopeeFood, GrabFood, GoFood">
                    <span class="text-base">🛵</span>
                    <span class="hidden sm:inline font-comic tracking-wide">Pesan Online</span>
                    <span class="comic-badge text-[9px] px-1 py-0.2 bg-white text-[#1E1E24] font-black">OJOL</span>
                </button>

                <!-- Search Trigger -->
                <button type="button" 
                        @click="openSearchModal()" 
                        class="comic-btn bg-[#FFF8DB] text-[#1E1E24] px-3.5 py-2 text-sm flex items-center gap-2 hover:bg-[#FFEDAA]"
                        title="Cari Menu atau Cabang (Ctrl+K)">
                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span class="hidden md:inline text-xs text-gray-600">Cari Menu / Outlet...</span>
                    <kbd class="hidden md:inline-block px-1.5 py-0.5 text-[10px] bg-white border border-[#1E1E24] rounded-md font-mono text-gray-500">⌘K</kbd>
                </button>

                <!-- Cart / DAR-DOR Drawer Button -->
                <button type="button" 
                        @click="toggleCartDrawer()" 
                        class="comic-btn bg-[#FFB800] text-[#1E1E24] px-4 py-2 text-sm flex items-center gap-2.5 relative group hover:bg-[#FFCA34]">
                    <div class="relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span x-show="cartTotalCount > 0" 
                              x-text="cartTotalCount"
                              class="absolute -top-2 -right-2.5 bg-[#FF4D00] text-white text-[11px] font-extrabold w-5 h-5 rounded-full border-2 border-[#1E1E24] flex items-center justify-center animate-bounce">
                        </span>
                    </div>
                    <span class="hidden sm:inline font-comic tracking-wide">DAR-DOR</span>
                    <span class="text-xs font-extrabold bg-[#1E1E24] text-[#FFB800] px-2 py-0.5 rounded-lg ml-0.5" x-text="formatRupiah(cartTotalWithTax)"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Global Instant Search Modal -->
    <div x-show="searchOpen" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-[#1E1E24]/70 backdrop-blur-sm transition-opacity" 
             @click="searchOpen = false"></div>

        <div class="flex min-h-full items-start justify-center p-4 sm:p-6 sm:pt-16">
            <div class="relative w-full max-w-2xl bg-[#FFFDF7] rounded-3xl comic-border comic-shadow-lg overflow-hidden"
                 @click.away="searchOpen = false"
                 x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">
                
                <!-- Search Input Bar -->
                <div class="p-4 sm:p-5 border-b-3 border-[#1E1E24] bg-[#FFF8DB] flex items-center gap-3">
                    <svg class="w-6 h-6 text-[#1E1E24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" 
                           x-ref="searchInput"
                           x-model="searchQuery" 
                           @input.debounce.250ms="performSearch()"
                           placeholder="Ketik nama makanan, sambal pedas, atau kota outlet..." 
                           class="w-full bg-transparent font-comic text-lg sm:text-xl font-bold text-[#1E1E24] placeholder-gray-400 focus:outline-none"
                           autofocus>
                    <button @click="searchOpen = false" class="p-1 rounded-xl hover:bg-black/10 text-gray-700">
                        <kbd class="text-xs font-mono px-2 py-1 bg-white border border-[#1E1E24] rounded-md">ESC</kbd>
                    </button>
                </div>

                <!-- Live Search Results Content -->
                <div class="max-h-[65vh] overflow-y-auto p-4 sm:p-6 space-y-6">
                    <!-- Quick Suggestions if query is empty -->
                    <div x-show="searchQuery.trim().length === 0" class="space-y-4">
                        <p class="text-xs font-bold uppercase text-gray-500 tracking-wider">Pencarian Populer Hari Ini:</p>
                        <div class="flex flex-wrap gap-2">
                            <button @click="searchQuery = 'crispy'; performSearch()" class="comic-badge bg-white text-xs px-3 py-1.5 hover:bg-[#FFB800]">🍳 Telur Dadar Crispy</button>
                            <button @click="searchQuery = 'sambal'; performSearch()" class="comic-badge bg-white text-xs px-3 py-1.5 hover:bg-[#FFB800]">🌶️ Sambal Pedas Juara</button>
                            <button @click="searchQuery = 'paru'; performSearch()" class="comic-badge bg-white text-xs px-3 py-1.5 hover:bg-[#FFB800]">🥩 Paru Kress</button>
                            <button @click="searchQuery = 'sidoarjo'; performSearch()" class="comic-badge bg-white text-xs px-3 py-1.5 hover:bg-[#FFB800]">📍 Outlet Sidoarjo</button>
                            <button @click="searchQuery = 'badak'; performSearch()" class="comic-badge bg-white text-xs px-3 py-1.5 hover:bg-[#FFB800]">🥤 Es Badak Medan</button>
                        </div>
                    </div>

                    <!-- Loading State -->
                    <div x-show="searchLoading" class="text-center py-8">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-[#1E1E24] border-t-[#FFB800]"></div>
                        <p class="mt-2 text-sm font-comic font-bold text-gray-600">Mencari sajian terlezat...</p>
                    </div>

                    <!-- Results: Products -->
                    <div x-show="!searchLoading && searchResults.products.length > 0" class="space-y-3">
                        <h4 class="text-xs font-bold uppercase text-gray-500 tracking-wider flex items-center gap-1.5">
                            <span>🍳 Menu Sajian</span>
                            <span class="bg-[#FFB800] text-[#1E1E24] px-2 py-0.5 rounded-full text-[10px]" x-text="searchResults.products.length"></span>
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <template x-for="product in searchResults.products" :key="product.id">
                                <div class="comic-box-sm bg-white p-3 rounded-2xl border-2 border-[#1E1E24] flex items-center justify-between gap-3 hover:bg-[#FFFDF5] cursor-pointer"
                                     @click="openProductModal(product); searchOpen = false">
                                    <div class="flex items-center gap-3">
                                        <template x-if="product.image_url">
                                            <img :src="product.image_url" :alt="product.name" class="w-12 h-12 rounded-xl object-cover border border-[#1E1E24]">
                                        </template>
                                        <template x-if="!product.image_url">
                                            <div class="w-12 h-12 rounded-xl bg-[#FFF8DB] border border-[#1E1E24] flex items-center justify-center text-xl shrink-0">
                                                <span x-text="product.slug && (product.slug.includes('saos') || product.slug.includes('bbq')) ? '🥫' : (product.slug && (product.slug.includes('kotak') || product.slug.includes('takeaway')) ? '📦' : (product.slug && product.slug.includes('kerupuk') ? '🍘' : '🍳'))"></span>
                                            </div>
                                        </template>
                                        <div>
                                            <h5 class="font-comic font-bold text-sm text-[#1E1E24] line-clamp-1" x-text="product.name"></h5>
                                            <div class="flex items-center gap-1.5">
                                                <p class="text-xs font-extrabold text-[#FF4D00]" x-text="product.formatted_price"></p>
                                                <template x-if="product.original_price">
                                                    <span class="text-[10px] text-gray-400 line-through font-bold" x-text="product.formatted_original_price || formatRupiah(product.original_price)"></span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="comic-btn bg-[#FFB800] text-xs px-2.5 py-1.5">Pilih</button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Results: Outlets -->
                    <div x-show="!searchLoading && searchResults.outlets.length > 0" class="space-y-3">
                        <h4 class="text-xs font-bold uppercase text-gray-500 tracking-wider flex items-center gap-1.5">
                            <span>📍 Cabang Outlet Terdekat</span>
                            <span class="bg-[#FF4D00] text-white px-2 py-0.5 rounded-full text-[10px]" x-text="searchResults.outlets.length"></span>
                        </h4>
                        <div class="space-y-2">
                            <template x-for="outlet in searchResults.outlets" :key="outlet.id">
                                <div class="p-3 bg-white rounded-2xl border-2 border-[#1E1E24] flex items-center justify-between gap-4">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-comic font-bold text-sm text-[#1E1E24]" x-text="outlet.name"></span>
                                            <span class="text-xs bg-[#FFF8DB] border border-[#1E1E24] px-1.5 py-0.5 rounded-md font-bold text-[#1E1E24]" x-text="'⭐ ' + outlet.rating"></span>
                                        </div>
                                        <p class="text-xs text-gray-600 mt-0.5 line-clamp-1" x-text="outlet.address"></p>
                                    </div>
                                    <a :href="outlet.whatsapp_link" target="_blank" class="comic-btn bg-[#25D366] text-white text-xs px-3 py-1.5 shrink-0 flex items-center gap-1">
                                        <span>WA Outlet</span>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- No Results -->
                    <div x-show="!searchLoading && searchQuery.trim().length >= 2 && searchResults.products.length === 0 && searchResults.outlets.length === 0" 
                         class="text-center py-10">
                        <div class="text-4xl mb-2">🍳🤔</div>
                        <p class="font-comic font-bold text-base text-[#1E1E24]">Menu atau cabang tidak ditemukan</p>
                        <p class="text-xs text-gray-500 mt-1">Coba cari dengan kata kunci "crispy", "sambal", "sidoarjo", atau "es teh".</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DAR-DOR Express Cart Slide-over Drawer -->
    <div x-show="cartDrawerOpen" 
         x-cloak
         class="fixed inset-0 z-50 overflow-hidden"
         role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-[#1E1E24]/60 backdrop-blur-sm transition-opacity" 
             @click="cartDrawerOpen = false"></div>

        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div class="w-screen max-w-md bg-[#FFFDF7] border-l-4 border-[#1E1E24] shadow-2xl flex flex-col"
                 x-transition:enter="transform transition ease-in-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full">
                
                <!-- Drawer Header -->
                <div class="p-5 bg-[#FFB800] border-b-3 border-[#1E1E24] flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white border-2 border-[#1E1E24] flex items-center justify-center font-comic font-bold text-xl shadow-[2px_2px_0px_#1E1E24]">
                            🍳
                        </div>
                        <div>
                            <h3 class="font-comic font-extrabold text-xl text-[#1E1E24] leading-tight">Keranjang DAR-DOR</h3>
                            <p class="text-xs font-bold text-gray-800">Pesan Kilat &bull; Langsung Digoreng!</p>
                        </div>
                    </div>
                    <button @click="cartDrawerOpen = false" class="p-2 rounded-xl bg-white border-2 border-[#1E1E24] hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-[#1E1E24]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Drawer Body: Order Items & Checkout Form -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6">
                    
                    <!-- Empty Cart Message -->
                    <div x-show="cartItems.length === 0" class="text-center py-12 space-y-4">
                        <div class="w-24 h-24 mx-auto rounded-full bg-[#FFF8DB] border-3 border-[#1E1E24] flex items-center justify-center text-4xl shadow-[3px_3px_0px_#1E1E24]">
                            🍳
                        </div>
                        <h4 class="font-comic font-bold text-lg text-[#1E1E24]">Keranjang Masih Kosong Nih!</h4>
                        <p class="text-xs text-gray-600 max-w-xs mx-auto">Yuk pilih Telur Dadar Crispy dan Lauk favoritmu sekarang sebelum kehabisan!</p>
                        <button @click="cartDrawerOpen = false" class="comic-btn bg-[#FFB800] text-sm px-6 py-2.5">
                            Cari Menu Enak &rarr;
                        </button>
                    </div>

                    <!-- Cart Item List -->
                    <div x-show="cartItems.length > 0" class="space-y-3">
                        <div class="flex items-center justify-between text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <span>Daftar Menu (<span x-text="cartTotalCount"></span>)</span>
                            <button @click="clearCart()" class="text-red-600 hover:underline">Hapus Semua</button>
                        </div>

                        <template x-for="(item, index) in cartItems" :key="index">
                            <div class="p-3.5 bg-white rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] space-y-2.5">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <template x-if="item.image_url">
                                            <img :src="item.image_url" :alt="item.name" class="w-12 h-12 rounded-xl object-cover border border-[#1E1E24]">
                                        </template>
                                        <template x-if="!item.image_url">
                                            <div class="w-12 h-12 rounded-xl bg-[#FFF8DB] border border-[#1E1E24] flex items-center justify-center text-xl shrink-0">
                                                <span x-text="(item.slug || item.name.toLowerCase()).includes('saos') || (item.slug || item.name.toLowerCase()).includes('bbq') ? '🥫' : ((item.slug || item.name.toLowerCase()).includes('kotak') || (item.slug || item.name.toLowerCase()).includes('takeaway') ? '📦' : ((item.slug || item.name.toLowerCase()).includes('kerupuk') ? '🍘' : '🍳'))"></span>
                                            </div>
                                        </template>
                                        <div>
                                            <h5 class="font-comic font-bold text-sm text-[#1E1E24] leading-snug" x-text="item.name"></h5>
                                            <p class="text-xs font-extrabold text-[#FF4D00]" x-text="formatRupiah(item.price)"></p>
                                        </div>
                                    </div>
                                    <button @click="removeItem(index)" class="text-gray-400 hover:text-red-600 p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Customization Badges & Notes -->
                                <div class="flex items-center gap-2 text-xs">
                                    <span class="comic-badge bg-red-100 text-red-700 text-[10px] px-2 py-0.5" x-show="item.spice_level > 0 && !item.name.toLowerCase().includes('teriyaki')" x-text="'🌶️ Pedas'"></span>
                                    <span class="comic-badge bg-emerald-100 text-emerald-800 text-[10px] px-2 py-0.5" x-show="item.spice_level === 0 && !item.name.toLowerCase().includes('teriyaki') && !['air mineral', 'es teh', 'teh ', 'jeruk', 'kopi', 'squash'].some(d => item.name.toLowerCase().includes(d))" x-text="'🟢 Gak Pedas'"></span>
                                    <span class="text-gray-500 italic text-[11px] truncate" x-show="item.notes" x-text="'Catatan: ' + item.notes"></span>
                                </div>

                                <!-- Quantity Controls & Subtotal -->
                                <div class="flex items-center justify-between pt-1 border-t border-dashed border-gray-200">
                                    <div class="flex items-center gap-2 bg-[#FFF8DB] border-2 border-[#1E1E24] rounded-xl px-2 py-1">
                                        <button @click="updateQty(index, -1)" class="w-6 h-6 rounded-lg bg-white border border-[#1E1E24] flex items-center justify-center font-extrabold text-xs hover:bg-[#FFB800]">-</button>
                                        <span class="font-comic font-bold text-sm px-1.5" x-text="item.quantity"></span>
                                        <button @click="updateQty(index, 1)" class="w-6 h-6 rounded-lg bg-white border border-[#1E1E24] flex items-center justify-center font-extrabold text-xs hover:bg-[#FFB800]">+</button>
                                    </div>
                                    <span class="font-comic font-bold text-sm text-[#1E1E24]" x-text="formatRupiah(item.price * item.quantity)"></span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Checkout Form (if cart has items) -->
                    <form x-show="cartItems.length > 0" 
                          id="checkoutForm" 
                          action="{{ route('orders.store') }}" 
                          method="POST" 
                          class="space-y-4 pt-4 border-t-3 border-[#1E1E24]">
                        @csrf

                        <!-- Hidden items payload for POST -->
                        <template x-for="(item, index) in cartItems" :key="index">
                            <div>
                                <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.id">
                                <input type="hidden" :name="'items['+index+'][quantity]'" :value="item.quantity">
                                <input type="hidden" :name="'items['+index+'][spice_level]'" :value="item.spice_level">
                                <input type="hidden" :name="'items['+index+'][notes]'" :value="item.notes">
                            </div>
                        </template>

                        <!-- Delivery Mode Toggle -->
                        <div class="space-y-2">
                            <label class="block font-comic font-bold text-sm text-[#1E1E24]">Jenis Layanan:</label>
                            <div class="grid grid-cols-3 gap-2">
                                <label class="cursor-pointer">
                                    <input type="radio" name="delivery_type" value="takeaway" x-model="deliveryType" class="sr-only">
                                    <div :class="deliveryType === 'takeaway' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[2px_2px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                                         class="border-2 rounded-xl p-2 text-center transition-all">
                                        <span class="block text-base">🥡</span>
                                        <span class="font-comic font-bold text-[11px] block mt-0.5">Takeaway</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="delivery_type" value="express_delivery" x-model="deliveryType" class="sr-only">
                                    <div :class="deliveryType === 'express_delivery' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[2px_2px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                                         class="border-2 rounded-xl p-2 text-center transition-all">
                                        <span class="block text-base">🛵</span>
                                        <span class="font-comic font-bold text-[11px] block mt-0.5">Delivery</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="delivery_type" value="dine_in" x-model="deliveryType" class="sr-only">
                                    <div :class="deliveryType === 'dine_in' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[2px_2px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                                         class="border-2 rounded-xl p-2 text-center transition-all">
                                        <span class="block text-base">🍽️</span>
                                        <span class="font-comic font-bold text-[11px] block mt-0.5">Dine-In</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Outlet Selection -->
                        <div class="space-y-1.5">
                            <label class="block font-comic font-bold text-xs text-[#1E1E24]">Pilih Cabang Outlet:</label>
                            <select name="outlet_id" x-model="selectedOutletId" 
                                    class="w-full bg-white border-2 border-[#1E1E24] rounded-xl px-3 py-2 text-xs font-bold focus:outline-none focus:ring-2 focus:ring-[#FFB800]">
                                @foreach($globalOutlets ?? \App\Models\Outlet::where('is_active', true)->get() as $outlet)
                                    <option value="{{ $outlet->id }}">
                                        {{ $outlet->name }} ({{ $outlet->city }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Customer Details -->
                        <div class="space-y-3 bg-[#FFF8DB] p-3.5 rounded-2xl border-2 border-[#1E1E24]">
                            <h5 class="font-comic font-bold text-xs uppercase text-[#1E1E24] tracking-wider">Data Pemesan (DAR-DOR)</h5>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-700">Nama Lengkap *</label>
                                <input type="text" name="customer_name" required placeholder="Contoh: Mas Budi Sidoarjo" 
                                       class="w-full bg-white border-2 border-[#1E1E24] rounded-xl px-3 py-1.5 text-xs font-medium focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-700">Nomor WhatsApp *</label>
                                <input type="tel" name="customer_phone" required placeholder="Contoh: 081234567890" 
                                       class="w-full bg-white border-2 border-[#1E1E24] rounded-xl px-3 py-1.5 text-xs font-medium focus:outline-none">
                            </div>
                            <div x-show="deliveryType === 'express_delivery'">
                                <label class="block text-[11px] font-bold text-gray-700">Alamat Lengkap Pengiriman *</label>
                                <textarea name="delivery_address" rows="2" placeholder="Nama jalan, nomor rumah, RT/RW, patokan..." 
                                          class="w-full bg-white border-2 border-[#1E1E24] rounded-xl px-3 py-1.5 text-xs font-medium focus:outline-none"></textarea>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-700">Catatan Khusus (Opsional)</label>
                                <input type="text" name="delivery_notes" placeholder="Contoh: Sambal dipisah, minta sendok..." 
                                       class="w-full bg-white border-2 border-[#1E1E24] rounded-xl px-3 py-1.5 text-xs font-medium focus:outline-none">
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="space-y-2">
                            <label class="block font-comic font-bold text-xs text-[#1E1E24]">Metode Pembayaran (Midtrans / QRIS):</label>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="qris" checked class="peer sr-only">
                                    <div class="p-2.5 bg-white border-2 border-gray-300 rounded-xl peer-checked:border-[#1E1E24] peer-checked:bg-[#FFB800] peer-checked:shadow-[2px_2px_0px_#1E1E24] font-bold flex items-center gap-2">
                                        <span>📱</span>
                                        <span>QRIS Instan</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="midtrans_gopay" class="peer sr-only">
                                    <div class="p-2.5 bg-white border-2 border-gray-300 rounded-xl peer-checked:border-[#1E1E24] peer-checked:bg-[#FFB800] peer-checked:shadow-[2px_2px_0px_#1E1E24] font-bold flex items-center gap-2">
                                        <span>🟢</span>
                                        <span>GoPay</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="midtrans_bca" class="peer sr-only">
                                    <div class="p-2.5 bg-white border-2 border-gray-300 rounded-xl peer-checked:border-[#1E1E24] peer-checked:bg-[#FFB800] peer-checked:shadow-[2px_2px_0px_#1E1E24] font-bold flex items-center gap-2">
                                        <span>🏦</span>
                                        <span>BCA VA</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="cod" class="peer sr-only">
                                    <div class="p-2.5 bg-white border-2 border-gray-300 rounded-xl peer-checked:border-[#1E1E24] peer-checked:bg-[#FFB800] peer-checked:shadow-[2px_2px_0px_#1E1E24] font-bold flex items-center gap-2">
                                        <span>💵</span>
                                        <span>Bayar di Kasir</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Summary Billing -->
                        <div class="bg-white p-3.5 rounded-2xl border-2 border-[#1E1E24] space-y-2 text-xs">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal Menu:</span>
                                <span class="font-bold text-[#1E1E24]" x-text="formatRupiah(cartSubtotal)"></span>
                            </div>
                            <div class="flex justify-between text-gray-600 items-center">
                                <span class="flex items-center gap-1">
                                    <span>PPN Restoran:</span>
                                    <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#FFB800] text-[#1E1E24]">10%</span>
                                </span>
                                <span class="font-bold text-[#1E1E24]" x-text="formatRupiah(taxAmount)"></span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Biaya Pengiriman:</span>
                                <span class="font-bold text-[#1E1E24]" x-text="formatRupiah(deliveryFee)"></span>
                            </div>
                            <div class="pt-2 border-t-2 border-dashed border-gray-300 flex justify-between font-comic font-extrabold text-base text-[#1E1E24]">
                                <span>Total Pembayaran:</span>
                                <span class="text-[#FF4D00]" x-text="formatRupiah(cartTotalWithTax)"></span>
                            </div>
                        </div>

                        <!-- Submit Order Button -->
                        <button type="submit" 
                                class="comic-btn w-full bg-[#FF4D00] text-white py-3.5 text-base hover:bg-[#E11D48] tracking-wide">
                            🔥 Konfirmasi & Pesan DAR-DOR!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Customization Detail Modal -->
    <div x-show="modalProduct !== null" 
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-[#1E1E24]/70 backdrop-blur-sm" @click="modalProduct = null"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-lg bg-[#FFFDF7] rounded-3xl comic-border comic-shadow-lg overflow-hidden"
                 x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">
                
                <template x-if="modalProduct">
                    <div>
                        <!-- Modal Image & Close -->
                        <div class="relative bg-[#FFF8DB] border-b-3 border-[#1E1E24] overflow-hidden" :class="modalProduct.image_url ? 'h-56' : 'h-40'">
                            <template x-if="modalProduct.image_url">
                                <img :src="modalProduct.image_url" :alt="modalProduct.name" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!modalProduct.image_url">
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-[#FFF9E6] to-[#FFE8A3] p-4 text-center select-none">
                                    <div class="w-14 h-14 rounded-2xl bg-white border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] flex items-center justify-center text-3xl mb-1.5">
                                        <span x-text="(modalProduct.slug || modalProduct.name.toLowerCase()).includes('saos') || (modalProduct.slug || modalProduct.name.toLowerCase()).includes('bbq') ? '🥫' : ((modalProduct.slug || modalProduct.name.toLowerCase()).includes('kotak') || (modalProduct.slug || modalProduct.name.toLowerCase()).includes('takeaway') ? '📦' : ((modalProduct.slug || modalProduct.name.toLowerCase()).includes('kerupuk') ? '🍘' : '🍳'))"></span>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-wider text-gray-500">Menu Tambahan (Tanpa Foto)</span>
                                </div>
                            </template>
                            <button @click="modalProduct = null" class="absolute top-3 right-3 w-9 h-9 rounded-full bg-white/90 border-2 border-[#1E1E24] flex items-center justify-center font-bold hover:bg-white z-10">
                                ✕
                            </button>
                            <div class="absolute bottom-3 left-3 flex gap-2">
                                <span x-show="modalProduct.original_price" class="comic-badge bg-red-600 text-white text-[10px] px-2.5 py-1">🔥 PROMO HEMAT</span>
                                <span x-show="modalProduct.is_crispy" class="comic-badge bg-[#FFB800] text-[#1E1E24] text-[10px] px-2.5 py-1">🍳 CRISPY JUARA</span>
                                <span x-show="modalProduct.is_bestseller" class="comic-badge bg-[#FF4D00] text-white text-[10px] px-2.5 py-1">⭐ BESTSELLER</span>
                            </div>
                        </div>

                        <!-- Modal Info & Options -->
                        <div class="p-5 sm:p-6 space-y-4">
                            <div>
                                <h3 class="font-comic font-extrabold text-2xl text-[#1E1E24] leading-tight" x-text="modalProduct.name"></h3>
                                <p class="text-xs text-gray-600 mt-1 leading-relaxed" x-text="modalProduct.description"></p>
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="font-comic font-extrabold text-xl text-[#FF4D00]" x-text="formatRupiah(modalProduct.price)"></span>
                                    <template x-if="modalProduct.original_price">
                                        <div class="flex items-center gap-1.5">
                                            <span class="text-xs text-gray-400 line-through font-bold" x-text="modalProduct.formatted_original_price || formatRupiah(modalProduct.original_price)"></span>
                                            <span class="text-[9px] px-1.5 py-0.5 bg-red-100 text-red-600 font-extrabold rounded border border-red-300">HEMAT</span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Spice Choice Selector (for applicable food items) -->
                            <div x-show="(modalProduct.type === 'food' || modalProduct.type === 'side' || modalProduct.type === 'combo') && !modalProduct.name.toLowerCase().includes('teriyaki') && !modalProduct.name.toLowerCase().includes('kids meal') && !['kerupuk', 'nasi putih', 'kotak takeaway', 'es batu'].some(w => modalProduct.name.toLowerCase().includes(w))" class="space-y-1.5">
                                <label class="block font-comic font-bold text-xs text-[#1E1E24]">Pilihan Rasa:</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <button type="button" 
                                            @click="modalSpiceLevel = 0"
                                            :class="modalSpiceLevel === 0 ? 'bg-[#FFB800] border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] translate-y-[-1px]' : 'bg-white border-gray-300 hover:bg-[#FFF8DB]'"
                                            class="comic-btn p-2.5 text-center font-comic font-bold text-xs flex items-center justify-center gap-1.5">
                                        <span>🟢</span>
                                        <span>Gak Pedas</span>
                                    </button>
                                    <button type="button" 
                                            @click="modalSpiceLevel = 2"
                                            :class="modalSpiceLevel > 0 ? 'bg-[#FF4D00] text-white border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] translate-y-[-1px]' : 'bg-white border-gray-300 hover:bg-[#FFF8DB]'"
                                            class="comic-btn p-2.5 text-center font-comic font-bold text-xs flex items-center justify-center gap-1.5">
                                        <span>🌶️</span>
                                        <span>Pedas</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Special Notes -->
                            <div class="space-y-1">
                                <label class="block font-comic font-bold text-xs text-[#1E1E24]">Catatan Porsi (Opsional):</label>
                                <input type="text" x-model="modalNotes" placeholder="Misal: Sambal dipisah, kuah ekstra..." 
                                       class="w-full bg-white border-2 border-[#1E1E24] rounded-xl px-3 py-2 text-xs focus:outline-none">
                            </div>

                            <!-- Quantity & Add to Cart -->
                            <div class="flex items-center gap-3 pt-2">
                                <div class="flex items-center gap-2 bg-[#FFF8DB] border-2 border-[#1E1E24] rounded-xl px-3 py-1.5">
                                    <button @click="modalQty = Math.max(1, modalQty - 1)" class="w-7 h-7 rounded-lg bg-white border border-[#1E1E24] font-bold text-sm hover:bg-[#FFB800]">-</button>
                                    <span class="font-comic font-bold text-base px-2" x-text="modalQty"></span>
                                    <button @click="modalQty++" class="w-7 h-7 rounded-lg bg-white border border-[#1E1E24] font-bold text-sm hover:bg-[#FFB800]">+</button>
                                </div>
                                <button type="button" 
                                        @click="addModalItemToCart()" 
                                        class="comic-btn flex-1 bg-[#FFB800] text-[#1E1E24] py-3 text-base hover:bg-[#FFCA34]">
                                    + Tambah ke DAR-DOR (<span x-text="formatRupiah(modalProduct.price * modalQty)"></span>)
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Floating Toast Notification -->
    <div x-show="toastMessage" 
         x-cloak
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-6 right-6 z-50 bg-[#1E1E24] text-white px-5 py-3.5 rounded-2xl border-3 border-[#FFB800] shadow-[4px_4px_0px_#FFB800] flex items-center gap-3">
        <span class="text-xl">🍳</span>
        <span class="font-comic font-bold text-sm" x-text="toastMessage"></span>
    </div>

    <!-- Smart Delivery Bridge Modal Component -->
    @include('components.smart-delivery-modal')

    <!-- Floating Action Pill for Smart Delivery Bridge (Desktop & Tablet) -->
    <div class="fixed bottom-6 left-6 z-40 hidden sm:block no-print">
        <button type="button" 
                @click="openDeliveryBridgeModal()" 
                class="comic-btn bg-[#1E1E24] text-white px-4 py-3 rounded-2xl border-3 border-[#FFB800] shadow-[4px_4px_0px_#FFB800] hover:scale-105 transition-all flex items-center gap-3 group">
            <div class="flex -space-x-1.5 overflow-hidden">
                <span class="w-6 h-6 rounded-full bg-[#EE4D2D] text-white flex items-center justify-center text-[10px] border border-white font-bold">S</span>
                <span class="w-6 h-6 rounded-full bg-[#00B14F] text-white flex items-center justify-center text-[10px] border border-white font-bold">G</span>
                <span class="w-6 h-6 rounded-full bg-[#ED2736] text-white flex items-center justify-center text-[10px] border border-white font-bold">G</span>
            </div>
            <div class="text-left">
                <span class="font-comic font-bold text-xs block text-[#FFB800] leading-tight">Pesan Shopee / Grab / GoFood</span>
                <span class="text-[10px] text-gray-300 block">Smart Bridge &bull; Diskon s.d 50%</span>
            </div>
        </button>
    </div>

    <!-- Mobile Floating Bridge Pill -->
    <div class="fixed bottom-4 left-4 z-40 sm:hidden no-print">
        <button type="button" 
                @click="openDeliveryBridgeModal()" 
                class="comic-btn bg-[#FF4D00] text-white px-3.5 py-2.5 rounded-full border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] flex items-center gap-1.5">
            <span>🛵</span>
            <span class="font-comic font-bold text-xs">Pesan Online</span>
        </button>
    </div>

    <!-- Footer -->
    <footer class="bg-[#1E1E24] text-white border-t-4 border-[#FFB800] mt-20 pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-12 border-b border-gray-800">
                <!-- Brand Info -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-white border-2 border-white flex items-center justify-center p-1 overflow-hidden shrink-0">
                            <img src="/images/logo-pan-icon.png" alt="Dadar Beredar Logo" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h3 class="font-comic text-2xl font-black text-[#FFB800] leading-none">DADAR BEREDAR</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Sensasi Telur Dadar Krispy Tiada Lawan &bull; By Babe Cabita</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-300 leading-relaxed max-w-md">
                        Didirikan oleh Almarhum Babe Cabita dengan visi menghadirkan sajian telur dadar keriting gurih renyah dengan harga merakyat yang bisa dinikmati anak kos, mahasiswa, hingga keluarga tercinta di seluruh Indonesia.
                    </p>
                    <div class="flex items-center gap-2 pt-1">
                        <span class="comic-badge text-[10px] px-2.5 py-1 bg-[#25D366] text-[#1E1E24]">100% HALAL MUI</span>
                        <span class="comic-badge text-[10px] px-2.5 py-1 bg-[#FFB800] text-[#1E1E24]">TELUR SEGAR SETIAP HARI</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="space-y-3">
                    <h4 class="font-comic font-bold text-sm text-[#FFB800] uppercase tracking-wider">Navigasi Cepat</h4>
                    <ul class="space-y-2 text-xs text-gray-300">
                        <li><a href="#menu-section" class="hover:text-[#FFB800] transition-colors">&bull; Menu Favorit</a></li>
                        <li><a href="#dar-dor-express" class="hover:text-[#FFB800] transition-colors">&bull; DAR-DOR Food Delivery</a></li>
                        <li><a href="#store-locator" class="hover:text-[#FFB800] transition-colors">&bull; Cabang Sidoarjo & Lainnya</a></li>
                        <li><a href="#tribute-babe" class="hover:text-[#FFB800] transition-colors">&bull; Tribute Almarhum Babe Cabita</a></li>
                        <li><a href="#reviews" class="hover:text-[#FFB800] transition-colors">&bull; Ulasan & Testimoni</a></li>
                    </ul>
                </div>

                <!-- Headquarters & Contact (Dynamic DB Data) -->
                <div class="space-y-3">
                    <h4 class="font-comic font-bold text-sm text-[#FFB800] uppercase tracking-wider">Kantor & Cabang Sidoarjo</h4>
                    <p class="text-xs text-gray-300 leading-relaxed">
                        {{ $primaryOutlet->address ?? 'Jl. Pahlawan No. 45, Sidokumpul, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61213' }}
                    </p>
                    <div class="pt-1 text-xs space-y-1 text-gray-300">
                        <p><strong>Jam Buka:</strong> {{ $primaryOutlet->opening_hours ?? '10:00 - 22:30 WIB' }}</p>
                        <p><strong>WhatsApp Hotline:</strong> {{ $primaryOutlet->phone ?? '+62 812-3456-7890' }}</p>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} Dadar Beredar Indonesia. Didedikasikan penuh cinta untuk mengenang Babe Cabita.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-[#FFB800]">Instagram</a>
                    <a href="#" class="hover:text-[#FFB800]">TikTok</a>
                    <a href="#" class="hover:text-[#FFB800]">YouTube</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Alpine.js Main Store Script -->
    <script>
        function dadarBeredarApp() {
            return {
                searchOpen: false,
                searchQuery: '',
                searchResults: { products: [], outlets: [] },
                searchLoading: false,

                deliveryModalOpen: false,
                bridgeSelectedOutletSlug: 'dadar-beredar-sidoarjo',
                
                cartDrawerOpen: false,
                cartItems: [],
                deliveryType: 'takeaway',
                selectedOutletId: {{ \App\Models\Outlet::where('slug', 'dadar-beredar-sidoarjo')->first()->id ?? 1 }},
                
                modalProduct: null,
                modalQty: 1,
                modalSpiceLevel: 3,
                modalNotes: '',
                
                toastMessage: '',
                toastTimeout: null,

                initApp() {
                    const savedCart = localStorage.getItem('dadar_cart');
                    if (savedCart) {
                        try {
                            this.cartItems = JSON.parse(savedCart);
                        } catch(e) {
                            this.cartItems = [];
                        }
                    }
                },

                saveCart() {
                    localStorage.setItem('dadar_cart', JSON.stringify(this.cartItems));
                },

                get cartTotalCount() {
                    return this.cartItems.reduce((total, item) => total + item.quantity, 0);
                },

                get cartSubtotal() {
                    return this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
                },

                get taxAmount() {
                    return Math.round(this.cartSubtotal * 0.10);
                },

                get deliveryFee() {
                    return this.deliveryType === 'express_delivery' ? 12000 : 0;
                },

                get cartTotalWithTax() {
                    return this.cartSubtotal + this.taxAmount + this.deliveryFee;
                },

                openSearchModal() {
                    this.searchOpen = true;
                    this.$nextTick(() => {
                        this.$refs.searchInput?.focus();
                    });
                },

                openDeliveryBridgeModal(outletSlug = null) {
                    if (outletSlug) {
                        this.bridgeSelectedOutletSlug = outletSlug;
                    }
                    this.deliveryModalOpen = true;
                },

                async performSearch() {
                    if (this.searchQuery.trim().length < 2) {
                        this.searchResults = { products: [], outlets: [] };
                        return;
                    }
                    this.searchLoading = true;
                    try {
                        const res = await fetch(`/api/search?q=${encodeURIComponent(this.searchQuery)}`);
                        const data = await res.json();
                        this.searchResults = data;
                    } catch(err) {
                        console.error('Search error:', err);
                    } finally {
                        this.searchLoading = false;
                    }
                },

                toggleCartDrawer() {
                    this.cartDrawerOpen = !this.cartDrawerOpen;
                },

                openProductModal(product) {
                    this.modalProduct = product;
                    this.modalQty = 1;
                    this.modalSpiceLevel = product.spiciness_level || 0;
                    this.modalNotes = '';
                },

                addModalItemToCart() {
                    if (!this.modalProduct) return;

                    const existingIndex = this.cartItems.findIndex(i => 
                        i.id === this.modalProduct.id && 
                        i.spice_level === this.modalSpiceLevel && 
                        i.notes === this.modalNotes
                    );

                    if (existingIndex > -1) {
                        this.cartItems[existingIndex].quantity += this.modalQty;
                    } else {
                        this.cartItems.push({
                            id: this.modalProduct.id,
                            name: this.modalProduct.name,
                            slug: this.modalProduct.slug,
                            price: this.modalProduct.price,
                            image_url: this.modalProduct.image_url,
                            quantity: this.modalQty,
                            spice_level: this.modalSpiceLevel,
                            notes: this.modalNotes,
                        });
                    }

                    this.saveCart();
                    this.showToast(`${this.modalProduct.name} ditambahkan ke keranjang!`);
                    this.modalProduct = null;
                },

                quickAddToCart(product) {
                    const existingIndex = this.cartItems.findIndex(i => i.id === product.id && i.spice_level === (product.spiciness_level || 0));
                    if (existingIndex > -1) {
                        this.cartItems[existingIndex].quantity += 1;
                    } else {
                        this.cartItems.push({
                            id: product.id,
                            name: product.name,
                            slug: product.slug,
                            price: product.price,
                            image_url: product.image_url,
                            quantity: 1,
                            spice_level: product.spiciness_level || 0,
                            notes: '',
                        });
                    }
                    this.saveCart();
                    this.showToast(`${product.name} masuk ke keranjang DAR-DOR!`);
                },

                updateQty(index, delta) {
                    this.cartItems[index].quantity += delta;
                    if (this.cartItems[index].quantity <= 0) {
                        this.cartItems.splice(index, 1);
                    }
                    this.saveCart();
                },

                removeItem(index) {
                    this.cartItems.splice(index, 1);
                    this.saveCart();
                    this.showToast('Menu dihapus dari keranjang.');
                },

                clearCart() {
                    this.cartItems = [];
                    this.saveCart();
                },

                showToast(msg) {
                    this.toastMessage = msg;
                    clearTimeout(this.toastTimeout);
                    this.toastTimeout = setTimeout(() => {
                        this.toastMessage = '';
                    }, 3000);
                },

                formatRupiah(num) {
                    return 'Rp ' + Number(num || 0).toLocaleString('id-ID');
                }
            };
        }
    </script>
    @livewireScripts
</body>
</html>
