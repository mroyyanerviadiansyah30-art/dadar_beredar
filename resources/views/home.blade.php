@extends('layouts.app')

@section('title', 'Dadar Beredar - Sensasi Telur Dadar Krispy Babe Cabita | Cabang Sidoarjo')

@section('content')
<div x-data="homePage()" x-init="initHome()">

    <!-- 1. HERO BANNER SECTION -->
    <section class="relative overflow-hidden pt-8 pb-16 md:pt-16 md:pb-24 bg-gradient-to-b from-[#FFF8DB] via-[#FFFDF7] to-[#FFFDF7] border-b-4 border-[#1E1E24]">
        <!-- Halftone decorative background -->
        <div class="absolute inset-0 bg-halftone pointer-events-none"></div>

        <!-- Comic speech bubbles floating in background -->
        <div class="hidden lg:block absolute top-12 left-10 transform -rotate-6 animate-pulse">
            <div class="comic-badge bg-[#FF4D00] text-white text-xs px-3 py-1 shadow-[3px_3px_0px_#1E1E24]">
                💥 DAR-DOR! KRESSS RENYAH!
            </div>
        </div>
        <div class="hidden lg:block absolute top-24 right-14 transform rotate-6">
            <div class="comic-badge bg-[#FFB800] text-[#1E1E24] text-xs px-3 py-1 shadow-[3px_3px_0px_#1E1E24]">
                🌶️ SAMBAL PEDAS GURIH JUARA!
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
                
                <!-- Left Hero Copy -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    
                    <!-- Slogan Badge -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]">
                        <span class="text-base">🍳</span>
                        <span class="font-comic font-bold text-xs uppercase tracking-wider text-[#1E1E24]">
                            Spesialis Telur Dadar Krispy &bull; Khas Almarhum Babe Cabita
                        </span>
                    </div>

                    <!-- Main Animated Comic Headline -->
                    <h1 class="font-comic text-4xl sm:text-5xl lg:text-6xl font-black text-[#1E1E24] leading-[1.08] tracking-tight">
                        Sensasi Telur Dadar <br class="hidden sm:inline">
                        <span class="relative inline-block text-[#FFB800] filter drop-shadow-[2px_2px_0px_#1E1E24]">
                            Krispy Keriting
                            <svg class="absolute -bottom-2 left-0 w-full h-3 text-[#FF4D00]" viewBox="0 0 100 12" preserveAspectRatio="none">
                                <path d="M0,8 Q50,0 100,8" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round"/>
                            </svg>
                        </span> 
                        Tiada Lawan!
                    </h1>

                    <!-- Heartfelt Subheadline -->
                    <p class="text-base sm:text-lg text-gray-700 font-medium leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Dari resep cinta dan tawa sang legenda komedi, <strong>Babe Cabita</strong>. Menikmati sepiring nasi hangat, telur dadar super garing keriting, dan lumuran aneka sambal pedas gurih yang bikin nagih!
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 pt-2">
                        <a href="#menu-section" 
                           class="comic-btn w-full sm:w-auto bg-[#FF4D00] text-white px-7 py-4 text-base sm:text-lg hover:bg-[#E11D48] tracking-wide flex items-center justify-center gap-2">
                            <span>🔥 Pesan DAR-DOR</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <button type="button" 
                                @click="openDeliveryBridgeModal('dadar-beredar-sidoarjo')" 
                                class="comic-btn w-full sm:w-auto bg-[#FFB800] text-[#1E1E24] px-6 py-4 text-base hover:bg-[#FFCA34] flex items-center justify-center gap-2">
                            <span>🛵</span>
                            <span>Pesan via Ojol (Diskon 50%)</span>
                        </button>
                        <button type="button" 
                                @click="openSearchModal()" 
                                class="comic-btn w-full sm:w-auto bg-[#FFFDF7] text-[#1E1E24] px-5 py-4 text-sm hover:bg-[#FFEDAA] flex items-center justify-center gap-2">
                            <span>🔍 Cari Menu</span>
                        </button>
                    </div>

                    <!-- Highlight Badges / Social Proof -->
                    <div class="grid grid-cols-3 gap-3 pt-6 max-w-lg mx-auto lg:mx-0">
                        <div class="comic-box-sm bg-white p-3 rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] text-center">
                            <div class="font-comic font-black text-xl text-[#FF4D00]">4.9 / 5.0</div>
                            <div class="text-[11px] font-bold text-gray-600">⭐ 25.000+ Ulasan</div>
                        </div>
                        <div class="comic-box-sm bg-white p-3 rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] text-center">
                            <div class="font-comic font-black text-xl text-[#FFB800]">8+ Kota</div>
                            <div class="text-[11px] font-bold text-gray-600">📍 Sidoarjo, Sby, Jkt...</div>
                        </div>
                        <div class="comic-box-sm bg-white p-3 rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] text-center">
                            <div class="font-comic font-black text-xl text-emerald-600">100%</div>
                            <div class="text-[11px] font-bold text-gray-600">🍳 Telur Segar Halal</div>
                        </div>
                    </div>
                </div>

                <!-- Right Hero Visual: Caricature of Babe Cabita & Si Dar-Dor Platter -->
                <div class="lg:col-span-5 relative flex items-center justify-center">
                    
                    <!-- Decorative Golden Circle -->
                    <div class="absolute w-72 h-72 sm:w-96 sm:h-96 rounded-full bg-[#FFB800] border-4 border-[#1E1E24] shadow-[8px_8px_0px_#1E1E24] -z-0"></div>

                    <!-- Main Caricature Card -->
                    <div class="relative z-10 comic-card p-3 bg-white max-w-sm sm:max-w-md transform rotate-1 hover:rotate-0 transition-transform duration-300">
                        <img src="/images/king-abdi-babe-cabita.png" 
                             alt="King Abdi & Babe Cabita - Pelopor Telur Dadar Crispy No 1 di Indonesia" 
                             class="w-full h-auto rounded-xl object-cover border-2 border-[#1E1E24]">
                        
                        <!-- Floating Speech Bubble -->
                        <div class="speech-bubble absolute -bottom-6 -left-4 sm:-left-8 p-3 sm:p-3.5 bg-white max-w-[260px] sm:max-w-[280px] z-20 shadow-[3px_3px_0px_#1E1E24]">
                            <p class="font-comic font-black text-xs sm:text-sm text-[#1E1E24] leading-snug">
                                🍳 Pelopor Telur dadar crispy no 1 di indonesia
                            </p>
                        </div>

                        <!-- Logo Badge -->
                        <div class="absolute -top-4 -right-4 w-16 h-16 rounded-full bg-white border-2 border-[#1E1E24] shadow-[2px_2px_0px_#1E1E24] flex items-center justify-center overflow-hidden animate-bounce p-1">
                            <img src="/images/logo-pan-icon.png" alt="Dadar Beredar Logo" class="w-full h-full object-contain">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. STICKY / GLOBAL INSTANT SEARCH PROMO BAR -->
    <section class="bg-[#FFB800] py-4 border-b-4 border-[#1E1E24]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6">
            <div class="bg-white rounded-2xl border-3 border-[#1E1E24] shadow-[4px_4px_0px_#1E1E24] p-2 sm:p-3 flex flex-col sm:flex-row items-center gap-3">
                <div class="flex items-center gap-2 pl-3 text-[#1E1E24] font-comic font-bold text-sm shrink-0">
                    <span class="text-xl">⚡</span>
                    <span>Cari Cepat Menu & Outlet:</span>
                </div>
                <div class="relative flex-1 w-full">
                    <input type="text" 
                           placeholder="Ketik 'Crispy', 'Dadar Lugu', 'Paru', 'Sidoarjo'..." 
                           @click="openSearchModal()" 
                           class="w-full bg-[#FFFDF7] border-2 border-[#1E1E24] rounded-xl px-4 py-2 text-sm font-bold text-[#1E1E24] cursor-pointer hover:bg-[#FFF8DB] transition-colors">
                    <button type="button" @click="openSearchModal()" class="absolute right-2 top-1.5 comic-btn bg-[#FF4D00] text-white text-xs px-3 py-1">
                        Cari
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. ABOUT US & HEARTFELT TRIBUTE TO BABE CABITA -->
    <section id="tribute-babe" class="py-20 bg-white border-b-4 border-[#1E1E24] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Imagery Grid -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="comic-card p-3 bg-[#FFF8DB] rotate-[-2deg]">
                        <img src="/images/crispy-dadar.jpg" alt="Signature Dadar Beredar Platter" class="w-full h-72 object-cover rounded-xl border-2 border-[#1E1E24]">
                        <div class="p-3">
                            <h4 class="font-comic font-bold text-base text-[#1E1E24]">Sajian Hangat Penuh Kenangan</h4>
                            <p class="text-xs text-gray-600">Resep otentik telur dadar kress yang diracik khusus bersama King Abdi.</p>
                        </div>
                    </div>
                </div>

                <!-- Story & Legacy Content -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FFF8DB] border-2 border-[#1E1E24] text-xs font-comic font-bold text-[#1E1E24]">
                        <span>❤️</span>
                        <span>Mengenang Sang Legenda Tawa: Almarhum Babe Cabita</span>
                    </div>

                    <h2 class="font-comic text-3xl sm:text-4xl font-black text-[#1E1E24] leading-tight">
                        "Bikin Orang Kenyang & Tersenyum Adalah Ibadah Paling Sederhana"
                    </h2>

                    <div class="space-y-4 text-sm sm:text-base text-gray-700 leading-relaxed">
                        <p>
                            <strong>Dadar Beredar</strong> lahir dari obrolan hangat dan mimpi sederhana Almarhum <strong>Priya Prayogha Pratama (Babe Cabita)</strong> bersama sahabatnya, <strong>King Abdi</strong> (MasterChef Indonesia). Babe selalu bermimpi memiliki warung makan rakyat yang nikmatnya tiada tara, harganya ramah kantong mahasiswa, dan tempatnya penuh gelak tawa.
                        </p>
                        <p>
                            Mengapa telur dadar? Karena bagi Babe, telur dadar adalah menu sejuta umat Indonesia. Ketika digoreng dengan teknik khusus hingga membentuk renda-renda keemasan yang super renyah (kresss!), lalu disandingkan dengan aneka sambal pedas gurih khas, ia berubah menjadi santapan surga duniawi.
                        </p>
                        <blockquote class="p-4 bg-[#FFF8DB] rounded-2xl border-l-4 border-3 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] font-comic font-bold text-gray-800 text-sm italic">
                            "Meskipun raga Bang Babe telah berpulang kepada Sang Pencipta, senyum hangat dan cita rasa renyahnya akan terus beredar menghangatkan setiap meja makan di seluruh nusantara."
                        </blockquote>
                    </div>

                    <!-- Why Dadar Beredar is Special -->
                    <div class="pt-2">
                        <div class="flex items-start gap-3 p-3.5 bg-[#FFFDF7] rounded-2xl border-2 border-[#1E1E24] shadow-[2px_2px_0px_#1E1E24]">
                            <span class="text-2xl">🔥</span>
                            <div>
                                <h5 class="font-comic font-bold text-sm text-[#1E1E24]">Teknik Renda Krispy Rahasia</h5>
                                <p class="text-xs text-gray-600">Digoreng dadakan saat Anda pesan. Luar garing lacy, tengah lembut gurih.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. MENU HIGHLIGHTS & CATEGORIZED MENU GRID (TABS) -->
    <section id="menu-section" class="py-20 bg-[#FFFDF7] border-b-4 border-[#1E1E24]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-10">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#FFB800] border-2 border-[#1E1E24] text-xs font-comic font-bold text-[#1E1E24]">
                    <span>🍽️</span>
                    <span>DAFTAR MENU RESMI DADAR BEREDAR</span>
                </div>
                <h2 class="font-comic text-3xl sm:text-4xl lg:text-5xl font-black text-[#1E1E24]">
                    Pilih Menu Favorit & Pesan DAR-DOR
                </h2>
                <p class="text-sm sm:text-base text-gray-600">
                    Klik tab kategori atau filter kepedasan untuk menemukan racikan telur dadar, aneka sambal pedas gurih, dan lauk pelengkap paling mantap!
                </p>
            </div>

            <!-- Interactive Category Tabs (Alpine) -->
            <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-8">
                <button type="button" 
                        @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[4px_4px_0px_#1E1E24] translate-y-[-2px]' : 'bg-white border-gray-300 hover:bg-[#FFF8DB]'"
                        class="comic-btn text-xs sm:text-sm px-4 py-2.5">
                    ✨ Semua Menu ({{ $categories->flatMap->products->count() }})
                </button>

                @foreach($categories as $cat)
                    <button type="button" 
                            @click="activeCategory = '{{ $cat->slug }}'"
                            :class="activeCategory === '{{ $cat->slug }}' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[4px_4px_0px_#1E1E24] translate-y-[-2px]' : 'bg-white border-gray-300 hover:bg-[#FFF8DB]'"
                            class="comic-btn text-xs sm:text-sm px-4 py-2.5">
                        <span>{{ $cat->icon }}</span>
                        <span>{{ $cat->name }}</span>
                    </button>
                @endforeach
            </div>

            <!-- Filter Controls: Spiciness & Signature -->
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 bg-white rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] mb-10">
                <!-- Spiciness Filter -->
                <div class="flex items-center gap-2">
                    <span class="text-xs font-bold text-gray-600">Pilihan Rasa:</span>
                    <select x-model="spiceFilter" class="bg-[#FFFDF7] border-2 border-[#1E1E24] rounded-xl px-3 py-1.5 text-xs font-bold focus:outline-none">
                        <option value="all">Semua Menu</option>
                        <option value="gak_pedas">Gak Pedas</option>
                        <option value="pedas">Pedas 🌶️</option>
                    </select>
                </div>

                <!-- Only Crispy / Bestseller Checkboxes -->
                <div class="flex items-center gap-4 text-xs font-bold text-gray-700">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" x-model="onlyBestseller" class="rounded border-2 border-[#1E1E24] text-[#FF4D00] focus:ring-0">
                        <span>Hanya Bestseller ⭐</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" x-model="onlyCrispy" class="rounded border-2 border-[#1E1E24] text-[#FFB800] focus:ring-0">
                        <span>Hanya Telur Crispy 🍳</span>
                    </label>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($categories->flatMap->products as $product)
                    <div x-show="filterProduct('{{ $product->category->slug }}', {{ $product->spiciness_level }}, {{ $product->is_bestseller ? 'true' : 'false' }}, {{ $product->is_crispy ? 'true' : 'false' }})"
                         x-transition:enter="ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="comic-card overflow-hidden flex flex-col justify-between group bg-white">
                        
                        <!-- Product Image & Badges -->
                        <div class="relative h-48 bg-[#FFF8DB] overflow-hidden border-b-3 border-[#1E1E24]">
                            <img src="{{ $product->image_url ?? '/images/crispy-dadar.jpg' }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            <!-- Badges -->
                            <div class="absolute top-2.5 left-2.5 flex flex-col gap-1.5">
                                @if($product->original_price)
                                    <span class="comic-badge text-[10px] px-2 py-0.5 bg-red-600 text-white font-black">🔥 PROMO HEMAT</span>
                                @endif
                                @if($product->is_bestseller)
                                    <span class="comic-badge text-[10px] px-2 py-0.5 bg-[#FF4D00] text-white">⭐ BESTSELLER</span>
                                @endif
                                @if($product->is_crispy)
                                    <span class="comic-badge text-[10px] px-2 py-0.5 bg-[#FFB800] text-[#1E1E24]">🍳 KRESS CRISPY</span>
                                @endif
                            </div>

                            <!-- Spice Indicator Badge -->
                            <div class="absolute top-2.5 right-2.5">
                                {!! $product->spice_rating_html !!}
                            </div>
                        </div>

                        <!-- Product Content -->
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                            <div class="space-y-1.5">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-gray-400">
                                    {{ $product->category->name }}
                                </span>
                                <h3 class="font-comic font-bold text-base text-[#1E1E24] leading-snug line-clamp-2">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs text-gray-600 line-clamp-2 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            </div>

                            <!-- Price & Quick Add Button -->
                            <div class="pt-3 border-t-2 border-dashed border-gray-200 flex items-center justify-between gap-2">
                                <div>
                                    @if($product->original_price)
                                        <div class="flex items-center gap-1.5 leading-none mb-0.5">
                                            <span class="text-xs text-gray-400 line-through font-bold">
                                                {{ $product->formatted_original_price }}
                                            </span>
                                            <span class="text-[9px] px-1 py-0.2 bg-red-100 text-red-600 font-extrabold rounded border border-red-300">
                                                HEMAT
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-[10px] text-gray-500 block">Harga Satuan</span>
                                    @endif
                                    <span class="font-comic font-black text-lg text-[#FF4D00]">
                                        {{ $product->formatted_price }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center gap-1.5">
                                    <!-- Customize Modal Trigger -->
                                    <button type="button" 
                                            @click="openProductModal({{ json_encode($product) }})"
                                            class="p-2 rounded-xl border-2 border-[#1E1E24] bg-[#FFF8DB] hover:bg-[#FFEDAA] text-xs font-bold"
                                            title="Atur Level Pedas">
                                        ⚙️
                                    </button>
                                    <!-- Instant Add to Cart -->
                                    <button type="button" 
                                            @click="quickAddToCart({{ json_encode($product) }})"
                                            class="comic-btn bg-[#FFB800] text-[#1E1E24] text-xs px-3.5 py-2 hover:bg-[#FFCA34]">
                                        + DAR-DOR
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. "DAR-DOR" FOOD DELIVERY EXPRESS SECTION -->
    <section id="dar-dor-express" class="py-20 bg-[#FFB800] border-b-4 border-[#1E1E24] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl comic-border comic-shadow-lg p-6 sm:p-10 lg:p-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left Copy -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FFF8DB] border-2 border-[#1E1E24] text-xs font-comic font-bold text-[#1E1E24]">
                            <span>🛵</span>
                            <span>LAYANAN KILAT DAR-DOR FOOD DELIVERY</span>
                        </div>

                        <h2 class="font-comic text-3xl sm:text-4xl font-black text-[#1E1E24] leading-tight">
                            Lapar Mendadak? Pesan DAR-DOR Saja, 20 Menit Sampai Hangat Kresss!
                        </h2>

                        <p class="text-sm sm:text-base text-gray-700 leading-relaxed">
                            Nikmati kemudahan takeaway atau delivery kilat dari cabang <strong>Dadar Beredar Sidoarjo</strong> maupun cabang terdekat lainnya langsung ke depan pintu rumah atau kantormu. Dikemas dengan box higienis anti-lembek agar kerenyahan renda telurnya tetap maksimal!
                        </p>

                        <!-- 4 Step Process -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                            <div class="comic-box-sm bg-[#FFFDF7] p-3 rounded-2xl border-2 border-[#1E1E24] text-center">
                                <div class="text-2xl mb-1">📱</div>
                                <h5 class="font-comic font-bold text-xs">1. Pilih Menu</h5>
                                <p class="text-[10px] text-gray-500">Atur pedas & lauk</p>
                            </div>
                            <div class="comic-box-sm bg-[#FFFDF7] p-3 rounded-2xl border-2 border-[#1E1E24] text-center">
                                <div class="text-2xl mb-1">🍳</div>
                                <h5 class="font-comic font-bold text-xs">2. Digoreng Fresh</h5>
                                <p class="text-[10px] text-gray-500">Minyak baru panas</p>
                            </div>
                            <div class="comic-box-sm bg-[#FFFDF7] p-3 rounded-2xl border-2 border-[#1E1E24] text-center">
                                <div class="text-2xl mb-1">🛵</div>
                                <h5 class="font-comic font-bold text-xs">3. Kurir Kilat</h5>
                                <p class="text-[10px] text-gray-500">Express delivery</p>
                            </div>
                            <div class="comic-box-sm bg-[#FFFDF7] p-3 rounded-2xl border-2 border-[#1E1E24] text-center">
                                <div class="text-2xl mb-1">😋</div>
                                <h5 class="font-comic font-bold text-xs">4. Nikmati Kresss</h5>
                                <p class="text-[10px] text-gray-500">Kenyang bahagia</p>
                            </div>
                        </div>

                        <!-- CTA to Open Cart & Smart Online Delivery Bridge -->
                        <div class="pt-4 flex flex-col sm:flex-row gap-3">
                            <button type="button" 
                                    @click="toggleCartDrawer()" 
                                    class="comic-btn bg-[#FF4D00] text-white px-7 py-3.5 text-base hover:bg-[#E11D48] flex items-center justify-center gap-2">
                                <span>Buka Keranjang DAR-DOR (<span x-text="cartTotalCount"></span>) &rarr;</span>
                            </button>
                            <button type="button" 
                                    @click="openDeliveryBridgeModal('dadar-beredar-sidoarjo')" 
                                    class="comic-btn bg-[#1E1E24] text-white px-6 py-3.5 text-base hover:bg-black flex items-center justify-center gap-2">
                                <span>🛵 Pesan Shopee / Grab / GoFood</span>
                            </button>
                        </div>

                        <!-- 3 Online Food Delivery Direct Pills -->
                        <div class="pt-2 flex flex-wrap items-center gap-2">
                            <span class="text-xs font-bold text-gray-700">Pesan langsung ke:</span>
                            <a href="{{ route('bridge.show', ['platform' => 'shopeefood', 'outlet' => 'dadar-beredar-sidoarjo']) }}" 
                               target="_blank"
                               class="comic-badge bg-[#EE4D2D] text-white text-[11px] px-3 py-1 hover:opacity-90 flex items-center gap-1">
                                <span>🛍️ ShopeeFood (Diskon 50%)</span>
                            </a>
                            <a href="{{ route('bridge.show', ['platform' => 'grabfood', 'outlet' => 'dadar-beredar-sidoarjo']) }}" 
                               target="_blank"
                               class="comic-badge bg-[#00B14F] text-white text-[11px] px-3 py-1 hover:opacity-90 flex items-center gap-1">
                                <span>🛵 GrabFood (Pesta Kuliner)</span>
                            </a>
                            <a href="{{ route('bridge.show', ['platform' => 'gofood', 'outlet' => 'dadar-beredar-sidoarjo']) }}" 
                               target="_blank"
                               class="comic-badge bg-[#ED2736] text-white text-[11px] px-3 py-1 hover:opacity-90 flex items-center gap-1">
                                <span>🍳 GoFood (Best Seller)</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Delivery Callout -->
                    <div class="lg:col-span-5 flex flex-col items-center justify-center text-center p-6 bg-[#FFF8DB] rounded-3xl border-3 border-[#1E1E24] shadow-[4px_4px_0px_#1E1E24]">
                        <img src="/images/logo-dadar-beredar.png" alt="Dadar Beredar Sidoarjo Delivery" class="w-48 h-auto object-contain mb-4 filter drop-shadow-sm">
                        <h4 class="font-comic font-extrabold text-xl text-[#1E1E24]">"Dadar Beredar Siap Meluncur!"</h4>
                        <p class="text-xs text-gray-600 mt-1 max-w-xs">
                            Kresss di luar, juicy lembut di dalam. Selalu dikirim dalam kondisi fresh hangat langsung dari wajan!
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- 6. INTERACTIVE STORE LOCATOR & LEAFLET MAP -->
    <section id="store-locator" class="py-20 bg-white border-b-4 border-[#1E1E24]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Title -->
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-10">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#FFF8DB] border-2 border-[#1E1E24] text-xs font-comic font-bold text-[#1E1E24]">
                    <span>📍</span>
                    <span>LOKASI CABANG RESMI</span>
                </div>
                <h2 class="font-comic text-3xl sm:text-4xl lg:text-5xl font-black text-[#1E1E24]">
                    Temukan Dadar Beredar Terdekat
                </h2>
                <p class="text-sm sm:text-base text-gray-600">
                    Cek cabang kami di Sidoarjo, Surabaya, Jakarta, Medan, Bandung, dan kota lainnya. Gunakan fitur GPS auto-detect untuk menemukan cabang paling dekat dari posisi Anda saat ini!
                </p>
            </div>

            <!-- GPS Auto-Detect Button & City Filter -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <!-- City Buttons -->
                <div class="flex flex-wrap gap-2">
                    <button type="button" 
                            @click="selectCity('all')"
                            :class="selectedCity === 'all' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                            class="comic-btn text-xs px-3.5 py-2">
                        Semua Kota
                    </button>
                    <button type="button" 
                            @click="selectCity('Sidoarjo')"
                            :class="selectedCity === 'Sidoarjo' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                            class="comic-btn text-xs px-3.5 py-2">
                        ⭐ Sidoarjo (Pusat & Waru)
                    </button>
                    <button type="button" 
                            @click="selectCity('Surabaya')"
                            :class="selectedCity === 'Surabaya' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                            class="comic-btn text-xs px-3.5 py-2">
                        Surabaya
                    </button>
                    <button type="button" 
                            @click="selectCity('Jakarta Selatan')"
                            :class="selectedCity === 'Jakarta Selatan' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                            class="comic-btn text-xs px-3.5 py-2">
                        Jakarta
                    </button>
                    <button type="button" 
                            @click="selectCity('Medan')"
                            :class="selectedCity === 'Medan' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                            class="comic-btn text-xs px-3.5 py-2">
                        Medan (Tanah Babe)
                    </button>
                    <button type="button" 
                            @click="selectCity('Bandung')"
                            :class="selectedCity === 'Bandung' ? 'bg-[#FFB800] border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24]' : 'bg-white border-gray-300'"
                            class="comic-btn text-xs px-3.5 py-2">
                        Bandung
                    </button>
                </div>

                <!-- GPS Location Detector -->
                <button type="button" 
                        @click="detectUserLocation()"
                        :disabled="detectingLocation"
                        class="comic-btn bg-[#25D366] text-white text-xs px-4 py-2 hover:bg-[#1EBE5D] flex items-center gap-2">
                    <span x-show="!detectingLocation">📍 Deteksi Cabang Terdekat Saya (GPS)</span>
                    <span x-show="detectingLocation" class="animate-spin">🔄</span>
                    <span x-show="detectingLocation">Mencari Koordinat...</span>
                </button>
            </div>

            <!-- GPS Result Alert Banner -->
            <div x-show="gpsMessage" 
                 x-cloak 
                 class="mb-6 p-4 rounded-2xl bg-[#FFF8DB] border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] flex items-center justify-between">
                <div class="flex items-center gap-2 text-xs font-comic font-bold text-[#1E1E24]">
                    <span>🎯</span>
                    <span x-text="gpsMessage"></span>
                </div>
                <button @click="gpsMessage = ''" class="text-xs font-bold text-gray-500">✕</button>
            </div>

            <!-- Grid: Leaflet Map & Outlet Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- Leaflet Map Container -->
                <div class="lg:col-span-7 comic-card overflow-hidden h-[450px] relative z-0">
                    <div id="outletMap" class="w-full h-full z-0"></div>
                </div>

                <!-- Outlet Cards List -->
                <div class="lg:col-span-5 space-y-4 max-h-[450px] overflow-y-auto pr-1">
                    @foreach($outlets as $outlet)
                        <div x-show="selectedCity === 'all' || selectedCity === '{{ $outlet->city }}'"
                             @click="focusOutlet({{ $outlet->latitude }}, {{ $outlet->longitude }}, '{{ $outlet->name }}')"
                             class="p-4 bg-[#FFFDF7] rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] hover:bg-[#FFF8DB] cursor-pointer transition-all space-y-2">
                            
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="font-comic font-bold text-base text-[#1E1E24] leading-tight">
                                            {{ $outlet->name }}
                                        </h4>
                                        @if($outlet->slug === 'dadar-beredar-sidoarjo')
                                            <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#FF4D00] text-white">PUSAT</span>
                                        @elseif($outlet->slug === 'dadar-beredar-waru-tropodo')
                                            <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#FFB800] text-[#1E1E24]">WARU TROPODO</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 leading-relaxed">
                                        {{ $outlet->address }}
                                    </p>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="comic-badge text-[11px] px-2 py-0.5 bg-[#FFF8DB] text-[#1E1E24]">
                                        ⭐ {{ $outlet->rating }}
                                    </span>
                                    <span class="block text-[10px] text-gray-400 mt-0.5">{{ number_format($outlet->review_count) }} ulasan</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 text-xs text-gray-600 pt-1">
                                <span>🕒 {{ $outlet->opening_hours }}</span>
                                <template x-if="outletDistances[{{ $outlet->id }}]">
                                    <span class="font-bold text-[#FF4D00]" x-text="'📍 ' + outletDistances[{{ $outlet->id }}] + ' km dari Anda'"></span>
                                </template>
                            </div>

                            <!-- WhatsApp and Maps Buttons -->
                            <div class="pt-2 flex items-center gap-2 border-t border-dashed border-gray-300">
                                <a href="{{ $outlet->whatsapp_link }}" 
                                   target="_blank" 
                                   @click.stop
                                   class="comic-btn flex-1 bg-[#25D366] text-white text-xs py-2 hover:bg-[#1EBE5D] flex items-center justify-center gap-1.5">
                                    <span>WhatsApp Cabang</span>
                                </a>
                                <a href="{{ $outlet->gmaps_url }}" 
                                   target="_blank" 
                                   @click.stop
                                   class="comic-btn flex-1 bg-[#FFFDF7] text-[#1E1E24] text-xs py-2 hover:bg-[#FFEDAA] flex items-center justify-center gap-1.5">
                                    <span>Petunjuk Jalan (Maps)</span>
                                </a>
                            </div>

                            <!-- Smart Redirect Delivery Bridge Platform Buttons -->
                            <div class="pt-1.5 flex items-center gap-1.5">
                                <a href="{{ route('bridge.show', ['platform' => 'shopeefood', 'outlet' => $outlet->slug]) }}" 
                                   target="_blank"
                                   @click.stop
                                   class="comic-btn flex-1 bg-[#EE4D2D] text-white text-[11px] py-1.5 hover:bg-[#D03E1F] flex items-center justify-center gap-1 shadow-[2px_2px_0px_#1E1E24]"
                                   title="Pesan {{ $outlet->name }} via ShopeeFood">
                                    <span>🛍️</span>
                                    <span>Shopee</span>
                                </a>
                                <a href="{{ route('bridge.show', ['platform' => 'grabfood', 'outlet' => $outlet->slug]) }}" 
                                   target="_blank"
                                   @click.stop
                                   class="comic-btn flex-1 bg-[#00B14F] text-white text-[11px] py-1.5 hover:bg-[#008C3E] flex items-center justify-center gap-1 shadow-[2px_2px_0px_#1E1E24]"
                                   title="Pesan {{ $outlet->name }} via GrabFood">
                                    <span>🛵</span>
                                    <span>Grab</span>
                                </a>
                                <a href="{{ route('bridge.show', ['platform' => 'gofood', 'outlet' => $outlet->slug]) }}" 
                                   target="_blank"
                                   @click.stop
                                   class="comic-btn flex-1 bg-[#ED2736] text-white text-[11px] py-1.5 hover:bg-[#C91A28] flex items-center justify-center gap-1 shadow-[2px_2px_0px_#1E1E24]"
                                   title="Pesan {{ $outlet->name }} via GoFood">
                                    <span>🍳</span>
                                    <span>GoFood</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- 7. LIVE GOOGLE MAPS REVIEWS & RATING -->
    <section id="reviews" class="py-20 bg-[#FFFDF7] border-b-4 border-[#1E1E24]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#FFB800] border-2 border-[#1E1E24] text-xs font-comic font-bold text-[#1E1E24]">
                    <span>⭐</span>
                    <span>ULASAN ASLI GOOGLE MAPS &bull; RATING TERTINGGI (5.0)</span>
                </div>
                <h2 class="font-comic text-3xl sm:text-4xl lg:text-5xl font-black text-[#1E1E24]">
                    Kata Mereka Tentang Dadar Beredar Sidoarjo
                </h2>
                <div class="flex items-center justify-center gap-2 text-sm font-bold text-gray-700">
                    <span class="text-amber-500 text-lg tracking-wider">★★★★★</span>
                    <span class="font-black text-[#1E1E24]">4.9 / 5.0</span>
                    <span class="text-gray-500 font-medium">(2.840+ Ulasan Asli di Google Maps Cabang Sidoarjo)</span>
                </div>
            </div>

            <!-- Review Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($reviews as $rev)
                    <div class="comic-card p-6 bg-white flex flex-col justify-between space-y-4 hover:shadow-[6px_6px_0px_#1E1E24] transition-all">
                        <div class="space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="flex items-center gap-1.5">
                                        <h4 class="font-comic font-bold text-sm text-[#1E1E24] leading-tight">{{ $rev->author_name }}</h4>
                                    </div>
                                    <div class="flex items-center gap-1.5 mt-1">
                                        <span class="text-[10px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">Local Guide</span>
                                        <span class="text-[10px] text-gray-400">&bull; {{ $rev->relative_time }}</span>
                                    </div>
                                </div>
                                <span class="comic-badge text-[8px] px-2 py-0.5 bg-emerald-50 text-emerald-700 border-emerald-300 shrink-0">
                                    ✓ GOOGLE MAPS
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-1.5 pt-1">
                                <div class="text-amber-500 text-sm tracking-wider">
                                    ★★★★★
                                </div>
                                <span class="text-xs font-black text-[#1E1E24]">5.0</span>
                            </div>

                            <p class="text-xs sm:text-[13px] text-gray-700 leading-relaxed font-medium">
                                "{{ $rev->comment }}"
                            </p>
                        </div>

                        <div class="pt-3 border-t border-dashed border-gray-200 text-[11px] font-bold text-gray-500 flex items-center justify-between">
                            <span class="flex items-center gap-1 text-gray-600">
                                <span>📍</span>
                                <span>Dadar Beredar Sidoarjo</span>
                            </span>
                            <span class="text-[#FF4D00]">Pusat Jl. Pahlawan</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View on Google Maps Link Button -->
            <div class="text-center mt-12">
                <a href="https://maps.google.com/?q=Dadar+Beredar+Sidoarjo" 
                   target="_blank" 
                   class="comic-btn bg-[#FFB800] text-[#1E1E24] px-7 py-3.5 text-sm font-comic hover:bg-[#FFCA34] inline-flex items-center gap-2.5 shadow-[4px_4px_0px_#1E1E24] hover:scale-105 transition-all">
                    <svg class="w-5 h-5 text-[#1E1E24]" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <span>Lihat Semua 2.800+ Ulasan Asli di Google Maps ↗</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Home Page Alpine Controller & Leaflet Setup -->
<script>
    function homePage() {
        return {
            activeCategory: 'all',
            spiceFilter: 'all',
            onlyBestseller: false,
            onlyCrispy: false,
            
            selectedCity: 'all',
            detectingLocation: false,
            gpsMessage: '',
            outletDistances: {},
            leafletMap: null,
            markers: [],

            outletsData: @json($outlets),

            initHome() {
                this.$nextTick(() => {
                    this.initMap();
                });
            },

            filterProduct(categorySlug, spiciness, isBestseller, isCrispy) {
                // Category Filter
                if (this.activeCategory !== 'all' && this.activeCategory !== categorySlug) {
                    return false;
                }
                // Spiciness Filter
                if (this.spiceFilter === 'gak_pedas' && spiciness > 0) return false;
                if (this.spiceFilter === 'pedas' && spiciness === 0) return false;

                // Flags
                if (this.onlyBestseller && !isBestseller) return false;
                if (this.onlyCrispy && !isCrispy) return false;

                return true;
            },

            initMap() {
                const mapEl = document.getElementById('outletMap');
                if (!mapEl || this.leafletMap) return;

                // Default Center on Sidoarjo / East Java
                this.leafletMap = L.map('outletMap').setView([-7.447812, 112.718321], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a>'
                }).addTo(this.leafletMap);

                // Add Markers for all outlets
                this.outletsData.forEach(outlet => {
                    const customEggIcon = L.divIcon({
                        className: 'custom-egg-pin',
                        html: `<div style="background:#FFB800; border:3px solid #1E1E24; box-shadow:3px 3px 0px #1E1E24; border-radius:9999px; width:36px; height:36px; display:flex; align-items:center; justify-content:center; font-size:18px;">🍳</div>`,
                        iconSize: [36, 36],
                        iconAnchor: [18, 18],
                        popupAnchor: [0, -18]
                    });

                    const marker = L.marker([outlet.latitude, outlet.longitude], { icon: customEggIcon })
                        .addTo(this.leafletMap)
                        .bindPopup(`
                            <div style="font-family:'Fredoka',sans-serif; min-width:200px;">
                                <strong style="font-size:14px; color:#1E1E24;">${outlet.name}</strong><br>
                                <span style="font-size:11px; color:#666;">${outlet.address}</span><br>
                                <span style="font-size:11px; font-weight:bold; color:#FF4D00;">⭐ ${outlet.rating} / 5.0</span><br>
                                <div style="display:flex; gap:4px; margin-top:6px; flex-wrap:wrap;">
                                    <a href="/bridge/shopeefood/${outlet.slug}" target="_blank" style="background:#EE4D2D; color:white; padding:3px 6px; border-radius:6px; text-decoration:none; font-size:10px; font-weight:bold;">Shopee</a>
                                    <a href="/bridge/grabfood/${outlet.slug}" target="_blank" style="background:#00B14F; color:white; padding:3px 6px; border-radius:6px; text-decoration:none; font-size:10px; font-weight:bold;">Grab</a>
                                    <a href="/bridge/gofood/${outlet.slug}" target="_blank" style="background:#ED2736; color:white; padding:3px 6px; border-radius:6px; text-decoration:none; font-size:10px; font-weight:bold;">GoFood</a>
                                    <a href="${outlet.whatsapp_link}" target="_blank" style="background:#25D366; color:white; padding:3px 6px; border-radius:6px; text-decoration:none; font-size:10px; font-weight:bold;">WA</a>
                                </div>
                            </div>
                        `);

                    this.markers.push({ id: outlet.id, city: outlet.city, marker: marker, lat: outlet.latitude, lng: outlet.longitude });
                });
            },

            selectCity(city) {
                this.selectedCity = city;
                if (city === 'all') {
                    this.leafletMap?.setView([-7.447812, 112.718321], 7);
                } else {
                    const found = this.markers.find(m => m.city.toLowerCase() === city.toLowerCase());
                    if (found) {
                        this.leafletMap?.setView([found.lat, found.lng], 13);
                        found.marker.openPopup();
                    }
                }
            },

            focusOutlet(lat, lng, name) {
                this.leafletMap?.setView([lat, lng], 15);
                const found = this.markers.find(m => Math.abs(m.lat - lat) < 0.001);
                if (found) {
                    found.marker.openPopup();
                }
            },

            detectUserLocation() {
                if (!navigator.geolocation) {
                    alert('Browser Anda tidak mendukung geolokasi.');
                    return;
                }

                this.detectingLocation = true;
                navigator.geolocation.getCurrentPosition(
                    async (position) => {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        try {
                            const res = await fetch(`/api/outlets/nearby?lat=${userLat}&lng=${userLng}`);
                            const data = await res.json();
                            
                            if (data.success && data.closest) {
                                const closest = data.closest;
                                this.gpsMessage = `Cabang terdekat Anda: ${closest.name} (${closest.distance_km} km)!`;
                                
                                data.outlets.forEach(o => {
                                    this.outletDistances[o.id] = o.distance_km;
                                });

                                // Center map on user and closest outlet
                                this.leafletMap?.setView([closest.latitude, closest.longitude], 14);
                                const found = this.markers.find(m => m.id === closest.id);
                                if (found) found.marker.openPopup();
                            }
                        } catch(err) {
                            console.error('Error fetching nearby outlets:', err);
                        } finally {
                            this.detectingLocation = false;
                        }
                    },
                    (error) => {
                        this.detectingLocation = false;
                        // Fallback message for demo/local testing
                        this.gpsMessage = 'Lokasi disimulasikan: Dadar Beredar Sidoarjo (Pusat) berjarak 1.2 km dari Anda!';
                        this.selectCity('Sidoarjo');
                    }
                );
            }
        };
    }
</script>
@endsection
