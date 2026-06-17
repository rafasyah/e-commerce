<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Welcome Hero Section --}}
            <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl shadow-lg text-white">
                <div class="p-8 md:p-12">
                    <div class="md:flex items-center justify-between">
                        <div class="mb-6 md:mb-0">
                            <h1 class="text-3xl md:text-4xl font-bold mb-4">
                                Selamat Datang di TOKO EXCLUSIVE!
                            </h1>
                            <p class="text-lg opacity-90 mb-6">
                                Temukan produk berkualitas dengan harga terbaik. Mulai berbelanja sekarang!
                            </p>
                            <a href="#products" class="inline-block bg-white text-orange-500 px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">
                                Mulai Berbelanja
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div class="text-8xl">🛍️</div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $allProducts = \App\Models\Products::all();
                $recommendedProducts = $allProducts->where('stok', '>', 5)->take(6);
                $recentProducts = $allProducts->sortByDesc('created_at')->take(8);
            @endphp

            @if($allProducts->count() === 0)
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum ada produk tersedia</h3>
                <p class="text-gray-500">Produk akan segera ditambahkan oleh admin. Silakan kembali lagi nanti!</p>
            </div>
            @else

            {{-- Recommended Products Section --}}
            @if($recommendedProducts->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        🏆 Produk Rekomendasi
                    </h2>
                    <a href="{{ route('customer.products') }}" class="text-orange-500 hover:text-orange-600 font-semibold">
                        Lihat Semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recommendedProducts as $product)
                    <div class="bg-gray-50 rounded-xl overflow-hidden shadow hover:shadow-lg transition card-hover">
                        <div class="relative">
                            <img
                                src="{{ asset('storage/' . $product->gambar) }}"
                                alt="{{ $product->nama_barang }}"
                                class="w-full h-48 object-cover"
                            >
                            <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                Stok: {{ $product->stok }}
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2 line-clamp-2">
                                {{ $product->nama_barang }}
                            </h3>
                            <p class="text-orange-500 font-bold text-xl mb-3">
                                Rp {{ number_format($product->harga) }}
                            </p>
                            <a
                                href="{{ route('customer.product.show', $product->id) }}"
                                class="block bg-orange-500 text-white text-center py-2 rounded-lg hover:bg-orange-600 transition"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Recent Products Section --}}
            @if($recentProducts->count() > 0)
            <div id="products" class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        🆕 Produk Terbaru
                    </h2>
                    <a href="{{ route('customer.products') }}" class="text-orange-500 hover:text-orange-600 font-semibold">
                        Lihat Semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($recentProducts as $product)
                    <div class="bg-gray-50 rounded-xl overflow-hidden shadow hover:shadow-lg transition card-hover">
                        <img
                            src="{{ asset('storage/' . $product->gambar) }}"
                            alt="{{ $product->nama_barang }}"
                            class="w-full h-40 object-cover"
                        >

                        <div class="p-4">
                            <h3 class="font-semibold text-base mb-1 line-clamp-2">
                                {{ $product->nama_barang }}
                            </h3>
                            <p class="text-orange-500 font-bold text-lg">
                                Rp {{ number_format($product->harga) }}
                            </p>
                            <p class="text-gray-500 text-sm mb-3">
                                Stok: {{ $product->stok }}
                            </p>
                            <a
                                href="{{ route('customer.product.show', $product->id) }}"
                                class="block bg-orange-500 text-white text-center py-2 rounded-lg hover:bg-orange-600 transition text-sm"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

                {{-- Call to Action Section --}}
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-lg text-white text-center p-8">
                    <h3 class="text-2xl font-bold mb-4">
                        Belum menemukan yang dicari?
                    </h3>
                    <p class="text-lg opacity-90 mb-6">
                        Jelajahi katalog lengkap kami dengan berbagai macam produk menarik
                    </p>
                    <a href="{{ route('customer.products') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">
                        Jelajahi Katalog Lengkap
                    </a>
                </div>
            @endif

        </div>
    </div>

    <style>
        .card-hover:hover {
            transform: translateY(-4px);
            transition: 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>
