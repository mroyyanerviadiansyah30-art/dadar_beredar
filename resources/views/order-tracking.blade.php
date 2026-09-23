@extends('layouts.app')

@section('title', 'Status & Struk Pesanan ' . $order->order_number . ' - Dadar Beredar Sidoarjo')

@section('content')
<div class="py-10 md:py-16 bg-[#FFFDF7] min-h-screen" x-data="orderReceiptPage()">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Simulation Alert Notification -->
        @if(session('simulation_alert'))
            <div class="mb-8 p-4 rounded-2xl bg-[#FFF8DB] border-3 border-[#1E1E24] shadow-[4px_4px_0px_#1E1E24] flex items-center gap-3 no-print">
                <span class="text-2xl">⚡</span>
                <p class="font-comic font-bold text-sm text-[#1E1E24]">
                    {{ session('simulation_alert') }}
                </p>
            </div>
        @endif

        <!-- Order Header Card -->
        <div class="comic-card p-6 sm:p-8 bg-white mb-8 no-print">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b-2 border-dashed border-gray-300">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="comic-badge text-xs px-2.5 py-1 bg-[#FFB800] text-[#1E1E24]">
                            DAR-DOR ORDER
                        </span>
                        <span class="text-xs text-gray-500 font-medium">
                            {{ $order->created_at->format('d M Y, H:i') }} WIB
                        </span>
                    </div>
                    <h1 class="font-comic font-black text-2xl sm:text-3xl text-[#1E1E24] mt-1.5">
                        {{ $order->order_number }}
                    </h1>
                </div>

                <!-- Status Badges & Quick Receipt Action -->
                <div class="flex flex-wrap items-center gap-2">
                    @php 
                        $payBadge = $order->getPaymentStatusBadge();
                        $ordBadge = $order->getOrderStatusBadge();
                    @endphp
                    <span class="comic-badge text-xs px-3 py-1 {{ $payBadge['class'] }} border-[#1E1E24]">
                        {{ $payBadge['label'] }}
                    </span>
                    <span class="comic-badge text-xs px-3 py-1 bg-[#FF4D00] text-white">
                        {{ $ordBadge['label'] }}
                    </span>
                    <button type="button" 
                            @click="scrollToReceipt()"
                            class="comic-btn bg-[#FFF8DB] text-[#1E1E24] text-xs px-3 py-1 hover:bg-[#FFEDAA] flex items-center gap-1">
                        <span>🧾 Lihat Struk Kasir</span>
                    </button>
                </div>
            </div>

            <!-- Progress Tracker Steps -->
            <div class="pt-8">
                <h4 class="font-comic font-bold text-xs uppercase tracking-wider text-gray-500 mb-6 text-center">
                    Status Proses Pesanan Anda
                </h4>

                @php 
                    $currentStep = $ordBadge['step'];
                @endphp

                <div class="grid grid-cols-4 gap-2 sm:gap-4 relative">
                    <!-- Step 1 -->
                    <div class="text-center space-y-2">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 mx-auto rounded-full border-3 border-[#1E1E24] flex items-center justify-center font-comic font-black text-base {{ $currentStep >= 1 ? 'bg-[#FFB800] shadow-[2px_2px_0px_#1E1E24]' : 'bg-gray-100 text-gray-400' }}">
                            1
                        </div>
                        <h5 class="font-comic font-bold text-[11px] sm:text-xs text-[#1E1E24]">Diterima</h5>
                        <p class="text-[9px] sm:text-[10px] text-gray-500 hidden sm:block">Masuk sistem</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="text-center space-y-2">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 mx-auto rounded-full border-3 border-[#1E1E24] flex items-center justify-center font-comic font-black text-base {{ $currentStep >= 2 ? 'bg-[#FFB800] shadow-[2px_2px_0px_#1E1E24] animate-pulse' : 'bg-gray-100 text-gray-400' }}">
                            2
                        </div>
                        <h5 class="font-comic font-bold text-[11px] sm:text-xs text-[#1E1E24]">Digoreng</h5>
                        <p class="text-[9px] sm:text-[10px] text-gray-500 hidden sm:block">Fresh di wajan</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="text-center space-y-2">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 mx-auto rounded-full border-3 border-[#1E1E24] flex items-center justify-center font-comic font-black text-base {{ $currentStep >= 3 ? 'bg-[#FFB800] shadow-[2px_2px_0px_#1E1E24]' : 'bg-gray-100 text-gray-400' }}">
                            3
                        </div>
                        <h5 class="font-comic font-bold text-[11px] sm:text-xs text-[#1E1E24]">Siap / Diantar</h5>
                        <p class="text-[9px] sm:text-[10px] text-gray-500 hidden sm:block">Bungkus hangat</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="text-center space-y-2">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 mx-auto rounded-full border-3 border-[#1E1E24] flex items-center justify-center font-comic font-black text-base {{ $currentStep >= 4 ? 'bg-[#25D366] text-white shadow-[2px_2px_0px_#1E1E24]' : 'bg-gray-100 text-gray-400' }}">
                            ✓
                        </div>
                        <h5 class="font-comic font-bold text-[11px] sm:text-xs text-[#1E1E24]">Selesai</h5>
                        <p class="text-[9px] sm:text-[10px] text-gray-500 hidden sm:block">Kenyang bahagia</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Grid: Left Order Info / Right Struk Kasir & Actions -->
        <div class="order-tracking-grid">
            
            <!-- Left Column: Menu Items, Billing with PPN, Outlet Info -->
            <div class="w-full min-w-0 space-y-6 no-print">
                
                <!-- Order Items Card -->
                <div class="comic-card p-6 bg-white space-y-4">
                    <h3 class="font-comic font-bold text-lg text-[#1E1E24] border-b pb-2 flex items-center justify-between gap-2">
                        <span>🍳 Rincian Menu Dipesan</span>
                        <span class="text-xs text-gray-500 font-normal shrink-0">({{ $order->items->count() }} macam item)</span>
                    </h3>

                    <div class="space-y-3 divide-y divide-gray-100">
                        @foreach($order->items as $item)
                            <div class="pt-3 flex items-start justify-between gap-3">
                                <div>
                                    <h4 class="font-comic font-bold text-sm text-[#1E1E24]">
                                        {{ $item->product_name }} &times; {{ $item->quantity }}
                                    </h4>
                                    <div class="flex flex-wrap items-center gap-2 mt-0.5">
                                        @if($item->spice_level > 0)
                                            <span class="text-[10px] font-bold text-red-600 bg-red-50 px-1.5 py-0.5 rounded-md border border-red-200">
                                                🌶️ Level {{ $item->spice_level }}
                                            </span>
                                        @else
                                            <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded-md border border-emerald-200">
                                                🟢 Gak Pedas
                                            </span>
                                        @endif
                                        @if($item->notes)
                                            <span class="text-[11px] text-gray-500 italic">"{{ $item->notes }}"</span>
                                        @endif
                                    </div>
                                </div>
                                <span class="font-comic font-bold text-sm text-[#1E1E24] shrink-0">
                                    {{ $item->formatted_subtotal }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Billing Summary with PPN (10%) -->
                    <div class="pt-4 border-t-2 border-dashed border-gray-300 space-y-2 text-xs">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal Menu:</span>
                            <span class="font-bold text-[#1E1E24]">{{ $order->formatted_subtotal }}</span>
                        </div>
                        
                        <!-- PPN (10%) Row -->
                        <div class="flex justify-between text-gray-600 items-center bg-[#FFF8DB] p-2 rounded-xl border border-[#1E1E24]/20">
                            <span class="flex items-center gap-1.5">
                                <span>PPN Restoran:</span>
                                <span class="comic-badge text-[9px] px-1.5 py-0.5 bg-[#FFB800] text-[#1E1E24]">10%</span>
                            </span>
                            <span class="font-comic font-bold text-sm text-[#1E1E24]">{{ $order->formatted_tax }}</span>
                        </div>

                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Layanan / Ongkir:</span>
                            <span class="font-bold text-[#1E1E24]">{{ $order->formatted_delivery_fee }}</span>
                        </div>

                        <div class="pt-2 border-t-2 border-[#1E1E24] flex justify-between font-comic font-black text-lg text-[#1E1E24]">
                            <span>Total Pembayaran:</span>
                            <span class="text-[#FF4D00]">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>

                <!-- Outlet & Customer Info Card -->
                <div class="comic-card p-6 bg-white space-y-4 text-xs">
                    <h3 class="font-comic font-bold text-base text-[#1E1E24] border-b pb-2 flex items-center gap-2">
                        <span>📍 Cabang Outlet & Info Layanan</span>
                    </h3>
                    
                    <div class="space-y-2 text-gray-700">
                        <p><strong>Cabang Pengolah:</strong> {{ $order->outlet->name }}</p>
                        <p><strong>Alamat Outlet:</strong> {{ $order->outlet->address }}</p>
                        <p><strong>Jenis Layanan:</strong> <span class="font-bold text-[#FF4D00]">{{ $order->delivery_label }}</span></p>
                        <p><strong>Nama Pemesan:</strong> {{ $order->customer_name }} ({{ $order->customer_phone }})</p>
                        @if($order->delivery_address)
                            <p><strong>Alamat Pengiriman:</strong> {{ $order->delivery_address }}</p>
                        @endif
                        @if($order->delivery_notes)
                            <p><strong>Catatan Khusus:</strong> {{ $order->delivery_notes }}</p>
                        @endif
                    </div>
                </div>

                <!-- Midtrans / Simulator Card (Demo Controls) -->
                <div class="comic-card p-5 bg-white space-y-3 border-dashed border-3 border-[#FF4D00]">
                    <div class="flex items-center gap-2">
                        <span class="text-xl">🛠️</span>
                        <div>
                            <h4 class="font-comic font-bold text-xs uppercase text-[#1E1E24]">Simulasi Alur Kasir & Dapur</h4>
                            <p class="text-[10px] text-gray-500">Uji langsung perubahan status pesanan & pembayaran</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @if($order->payment_status !== 'paid')
                            <form action="{{ route('orders.simulate-payment', $order->order_number) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="paid">
                                <button type="submit" class="comic-btn w-full bg-[#25D366] text-white text-xs py-2 hover:bg-[#1EBE5D]">
                                    ⚡ Simulasi Kasir: Lunas (Paid)
                                </button>
                            </form>
                        @endif

                        @if($order->order_status === 'received')
                            <form action="{{ route('orders.simulate-status', $order->order_number) }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_status" value="cooking">
                                <button type="submit" class="comic-btn w-full bg-[#FF4D00] text-white text-xs py-2 hover:bg-[#E11D48]">
                                    🍳 Simulasi Dapur: Mulai Digoreng (Cooking)
                                </button>
                            </form>
                        @elseif($order->order_status === 'cooking')
                            <form action="{{ route('orders.simulate-status', $order->order_number) }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_status" value="ready">
                                <button type="submit" class="comic-btn w-full bg-[#FFB800] text-[#1E1E24] text-xs py-2 hover:bg-[#FFCA34]">
                                    📦 Simulasi Kasir: Pesanan Siap (Ready)
                                </button>
                            </form>
                        @elseif($order->order_status === 'ready')
                            <form action="{{ route('orders.simulate-status', $order->order_number) }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_status" value="delivered">
                                <button type="submit" class="comic-btn w-full bg-emerald-600 text-white text-xs py-2 hover:bg-emerald-700">
                                    🛵 Selesai Diambil / Diterima (Delivered)
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('home') }}" class="block text-center text-xs font-bold text-gray-600 hover:text-[#FF4D00] pt-1">
                            &larr; Pesan Menu Lainnya (Kembali ke Home)
                        </a>
                    </div>
                </div>

            </div>

            <!-- Right Column: Struk Kasir Otentik Dadar Beredar Sidoarjo -->
            <div class="w-full min-w-0 space-y-4" id="receipt-section">
                
                <!-- Action Controls above Receipt -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 bg-white rounded-2xl border-2 border-[#1E1E24] shadow-[3px_3px_0px_#1E1E24] no-print">
                    <div class="flex items-center gap-2.5">
                        <span class="text-xl">🧾</span>
                        <div>
                            <span class="font-comic font-bold text-sm sm:text-base text-[#1E1E24] block leading-tight">Struk Kasir Resmi</span>
                            <span class="text-[10px] text-gray-500">Cabang Pusat Sidoarjo (Thermal Ready)</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <!-- Print Button -->
                        <button type="button" 
                                @click="printReceipt()" 
                                class="comic-btn bg-[#FFB800] text-[#1E1E24] text-xs px-3.5 py-2 hover:bg-[#FFCA34] flex items-center gap-1.5 shadow-[2px_2px_0px_#1E1E24]"
                                title="Cetak struk ke printer thermal atau simpan sebagai PDF">
                            <span>🖨️ Cetak Struk</span>
                        </button>

                        <!-- Copy to WhatsApp Button -->
                        <button type="button" 
                                @click="copyReceiptWhatsApp()" 
                                class="comic-btn bg-[#25D366] text-white text-xs px-3.5 py-2 hover:bg-[#1EBE5D] flex items-center gap-1.5 shadow-[2px_2px_0px_#1E1E24]"
                                title="Salin format struk untuk dikirim via WhatsApp">
                            <span x-text="copiedToast ? '✓ Tersalin!' : '📋 Salin WA'"></span>
                        </button>
                    </div>
                </div>

                <!-- Authentic Thermal Paper Receipt Container -->
                <div id="thermal-receipt-printable" 
                     class="relative bg-white border-3 border-[#1E1E24] shadow-[6px_6px_0px_#1E1E24] rounded-2xl p-6 sm:p-8 font-mono text-gray-900 text-xs overflow-hidden receipt-paper w-full">
                    
                    <!-- Watermark background egg logo -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] pointer-events-none">
                        <img src="/images/logo-pan-icon.png" alt="Dadar Beredar" class="w-72 h-72 object-contain">
                    </div>

                    <!-- Receipt Header -->
                    <div class="text-center space-y-1 pb-4 border-b border-dashed border-gray-400">
                        <div class="w-14 h-14 mx-auto mb-2 rounded-full border border-gray-800 p-1 bg-white">
                            <img src="/images/logo-pan-icon.png" alt="Dadar Beredar" class="w-full h-full object-contain">
                        </div>
                        <h2 class="font-bold text-base tracking-wider text-black">DADAR BEREDAR</h2>
                        <p class="text-[11px] font-bold text-gray-700 uppercase tracking-wide">
                            @if(($order->outlet->slug ?? '') === 'dadar-beredar-sidoarjo')
                                CABANG PUSAT SIDOARJO
                            @else
                                CABANG {{ strtoupper($order->outlet->name ?? 'PUSAT SIDOARJO') }}
                            @endif
                        </p>
                        <p class="text-[10px] text-gray-600 leading-tight">
                            Sensasi Telur Dadar Krispy Tiada Lawan<br>
                            Khas Almarhum Babe Cabita & King Abdi
                        </p>
                        <p class="text-[10px] text-gray-600 mt-1">
                            {{ $order->outlet->address ?? 'Jl. Pahlawan No. 45, Sidokumpul, Sidoarjo 61213' }}<br>
                            Hotline/WA: {{ $order->outlet->phone ?? '+62 812-3456-7890' }}
                        </p>
                    </div>

                    <!-- Receipt Metadata -->
                    <div class="py-3 border-b border-dashed border-gray-400 space-y-1 text-[11px]">
                        <div class="flex justify-between">
                            <span class="text-gray-500">No. Struk:</span>
                            <span class="font-bold text-black">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Waktu:</span>
                            <span>{{ $order->created_at->format('d/m/Y H:i:s') }} WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Kasir:</span>
                            <span>Kasir 01 ({{ $order->outlet->city ?? 'Sidoarjo' }})</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Pelanggan:</span>
                            <span class="font-bold">{{ $order->customer_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">WhatsApp:</span>
                            <span>{{ $order->customer_phone }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Jenis Layanan:</span>
                            <span class="font-bold uppercase tracking-wider text-black">
                                [ {{ $order->delivery_label }} ]
                            </span>
                        </div>
                        @if($order->delivery_address)
                            <div class="pt-1 text-[10px] text-gray-600">
                                <span>Alamat Kirim: {{ $order->delivery_address }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Receipt Table Column Header -->
                    <div class="py-2 border-b border-gray-800 flex justify-between font-bold text-[11px] uppercase tracking-wider">
                        <span>Item Menu</span>
                        <span>Total</span>
                    </div>

                    <!-- Receipt Items -->
                    <div class="py-3 border-b border-dashed border-gray-400 space-y-3">
                        @foreach($order->items as $item)
                            <div class="space-y-0.5">
                                <div class="flex justify-between items-start font-bold text-[11px] gap-2">
                                    <span class="flex-1 break-words">{{ $item->product_name }}</span>
                                    <span class="shrink-0 text-right">{{ $item->formatted_subtotal }}</span>
                                </div>
                                <div class="flex justify-between text-[10px] text-gray-600">
                                    <span>{{ $item->quantity }} &times; {{ $item->formatted_price }}</span>
                                    @if($item->spice_level > 0)
                                        <span class="text-red-600 font-bold">[Pedas Lv.{{ $item->spice_level }}]</span>
                                    @else
                                        <span class="text-emerald-700">[Gak Pedas]</span>
                                    @endif
                                </div>
                                @if($item->notes)
                                    <div class="text-[10px] text-gray-500 italic pl-2 border-l border-gray-300">
                                        Catatan: {{ $item->notes }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Receipt Totals with PPN (10%) -->
                    <div class="py-3 border-b border-dashed border-gray-400 space-y-1.5 text-[11px]">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal Menu ({{ $order->items->sum('quantity') }} porsi)</span>
                            <span>{{ $order->formatted_subtotal }}</span>
                        </div>
                        
                        <!-- PPN (10%) Highlight on Receipt -->
                        <div class="flex justify-between font-bold text-gray-900 bg-gray-100 px-1.5 py-0.5 rounded">
                            <span>PPN Restoran (PB1 10%)</span>
                            <span>{{ $order->formatted_tax }}</span>
                        </div>

                        <div class="flex justify-between text-gray-700">
                            <span>Biaya Pengiriman</span>
                            <span>{{ $order->formatted_delivery_fee }}</span>
                        </div>

                        <div class="pt-2 border-t-2 border-gray-900 flex justify-between font-bold text-sm text-black">
                            <span>TOTAL BAYAR</span>
                            <span class="text-base">{{ $order->formatted_total }}</span>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="py-3 border-b border-dashed border-gray-400 space-y-1 text-[11px]">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Metode Bayar:</span>
                            <span class="font-bold uppercase">{{ $order->payment_method }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Status Pembayaran:</span>
                            @if($order->payment_status === 'paid')
                                <span class="font-bold text-emerald-700 uppercase">LUNAS (PAID)</span>
                            @else
                                <span class="font-bold text-amber-700 uppercase">MENUNGGU PEMBAYARAN</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-[10px] text-gray-500">
                            <span>Ref. Transaksi:</span>
                            <span>{{ $order->payment_reference ?? 'REF-' . strtoupper(substr(md5($order->id), 0, 10)) }}</span>
                        </div>
                    </div>

                    <!-- Barcode Visual Generator (SVG Barcode) -->
                    <div class="py-4 text-center space-y-1">
                        <div class="w-60 max-w-full mx-auto flex items-center justify-center gap-[2px] h-10 overflow-hidden px-4">
                            @foreach(str_split(md5($order->order_number)) as $i => $char)
                                <div class="bg-black h-full" style="width: {{ (ord($char) % 4) + 1 }}px; margin-right: {{ (ord($char) % 3) }}px;"></div>
                            @endforeach
                        </div>
                        <p class="font-mono text-[10px] tracking-widest text-gray-600 uppercase">
                            * {{ $order->order_number }} *
                        </p>
                    </div>

                    <!-- Receipt Footer & Tribute to Babe Cabita -->
                    <div class="text-center space-y-1.5 pt-2 border-t border-dashed border-gray-400 text-[10px] text-gray-600">
                        <p class="font-bold uppercase tracking-wider text-black">
                            *** TERIMA KASIH TELAH BEREDAR ***
                        </p>
                        <p class="italic leading-tight text-gray-700">
                            "Bikin orang kenyang dan tersenyum adalah ibadah paling sederhana."
                        </p>
                        <p class="font-bold text-black">
                            — Didedikasikan Mengenang Almarhum Babe Cabita —
                        </p>
                        <p class="text-[9px] text-gray-500 pt-1">
                            Simpan struk ini sebagai bukti pemesanan yang sah.<br>
                            Follow IG: @dadarberedar | TikTok: @dadarberedar
                        </p>
                    </div>

                </div>

                <!-- Share to Customer WA Link -->
                <div class="pt-1 text-center no-print">
                    <a :href="customerWhatsAppUrl" 
                       target="_blank"
                       class="comic-btn w-full bg-[#25D366] text-white py-3 text-xs flex items-center justify-center gap-2 hover:bg-[#1EBE5D] shadow-[3px_3px_0px_#1E1E24]">
                        <span>💬 Kirim Rincian Struk ke WhatsApp Pelanggan</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Scoped Grid & Print Styles -->
<style>
    .order-tracking-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        align-items: start;
        width: 100%;
    }
    @media (min-width: 1024px) {
        .order-tracking-grid {
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        }
    }

    @media print {
        /* Hide all outer components */
        header, footer, nav, .no-print, .no-print *, .fixed {
            display: none !important;
        }
        body, main, .min-h-screen {
            background: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        #thermal-receipt-printable {
            position: relative !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            max-width: 80mm !important;
            margin: 0 auto !important;
            padding: 8px !important;
            border: 1px solid #333 !important;
            box-shadow: none !important;
            color: #000000 !important;
            font-size: 11px !important;
        }
    }
</style>

<script>
    function orderReceiptPage() {
        return {
            copiedToast: false,

            init() {
                // Clear cart once order is confirmed and tracking page is shown
                try {
                    localStorage.removeItem('dadar_cart');
                    window.dispatchEvent(new CustomEvent('cart-cleared'));
                } catch(e) {}
            },

            get rawReceiptText() {
                return `========================================
       🍳 DADAR BEREDAR 🍳
      @if(($order->outlet->slug ?? '') === 'dadar-beredar-sidoarjo')CABANG PUSAT SIDOARJO@else{{ strtoupper($order->outlet->name ?? 'CABANG PUSAT SIDOARJO') }}@endif

  Sensasi Telur Dadar Krispy Tiada Lawan
       By Almarhum Babe Cabita
  {{ $order->outlet->address ?? 'Jl. Pahlawan No. 45, Sidokumpul' }}
  Telp/WA: {{ $order->outlet->phone ?? '+62 812-3456-7890' }}
========================================
No. Struk : {{ $order->order_number }}
Waktu     : {{ $order->created_at->format('d/m/Y H:i:s') }} WIB
Kasir     : Kasir 01 ({{ $order->outlet->city ?? 'Sidoarjo' }})
Pelanggan : {{ $order->customer_name }}
WhatsApp  : {{ $order->customer_phone }}
Layanan   : [ {{ strtoupper($order->delivery_label) }} ]
----------------------------------------
RINCIAN MENU:
@foreach($order->items as $item)
* {{ $item->quantity }}x {{ $item->product_name }} = {{ $item->formatted_subtotal }}
  @if($item->spice_level > 0) [Pedas Lv.{{ $item->spice_level }}] @else [Gak Pedas] @endif
  @if($item->notes) (Catatan: {{ $item->notes }}) @endif
@endforeach
----------------------------------------
Subtotal Menu        : {{ $order->formatted_subtotal }}
PPN Restoran (10%)   : {{ $order->formatted_tax }}
Biaya Ongkir/Layanan : {{ $order->formatted_delivery_fee }}
========================================
TOTAL BAYAR          : {{ $order->formatted_total }}
========================================
Metode Bayar         : {{ strtoupper($order->payment_method) }}
Status               : {{ strtoupper($order->payment_status === 'paid' ? 'LUNAS (PAID)' : 'MENUNGGU PEMBAYARAN') }}
Ref. Transaksi       : {{ $order->payment_reference ?? 'REF-' . $order->id }}
========================================
    *** TERIMA KASIH SUDAH BEREDAR ***
  "Bikin orang kenyang dan tersenyum
   adalah ibadah paling sederhana."
    — Mengenang Almarhum Babe Cabita —
========================================`;
            },

            get customerWhatsAppUrl() {
                const phone = '{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}';
                const formattedPhone = phone.startsWith('0') ? '62' + phone.slice(1) : (phone.startsWith('62') ? phone : '62' + phone);
                return `https://wa.me/${formattedPhone}?text=${encodeURIComponent(this.rawReceiptText)}`;
            },

            printReceipt() {
                window.print();
            },

            async copyReceiptWhatsApp() {
                try {
                    await navigator.clipboard.writeText(this.rawReceiptText);
                    this.copiedToast = true;
                    setTimeout(() => {
                        this.copiedToast = false;
                    }, 2500);
                } catch(e) {
                    alert('Gagal menyalin struk. Silakan gunakan tombol cetak.');
                }
            },

            scrollToReceipt() {
                const el = document.getElementById('receipt-section');
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    const receiptCard = document.getElementById('thermal-receipt-printable');
                    if (receiptCard) {
                        receiptCard.classList.add('ring-4', 'ring-[#FFB800]');
                        setTimeout(() => {
                            receiptCard.classList.remove('ring-4', 'ring-[#FFB800]');
                        }, 2000);
                    }
                }
            }
        };
    }
</script>
@endsection
