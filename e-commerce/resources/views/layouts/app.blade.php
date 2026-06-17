<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #f5f5f5;
        }

        .shopee-orange {
            background: linear-gradient(to right, #ee4d2d, #ff7337);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            transition: 0.2s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="shopee-orange text-white px-8 py-4 flex justify-between items-center sticky top-0 z-50 shadow-md">

        <div class="text-2xl font-bold">
            TOKO EXCLUSIVE
        </div>

        <div class="flex gap-6 items-center">
            @if(auth()->check() && auth()->user()->role === 'admin')
                <!-- Admin Menu -->
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('admin.orders') }}" class="hover:underline">Daftar Pesanan</a>
                <a href="{{ route('products.index') }}" class="hover:underline">Manajemen Produk</a>
            @else
                <!-- Customer Menu -->
                <a href="{{ route('customer.products') }}" class="hover:underline">Katalog Produk</a>
                <a href="{{ route('customer.history') }}" class="hover:underline">Riwayat Belanja</a>
                <a href="{{ route('profile.edit') }}" class="hover:underline">Profile</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-white text-orange-500 px-4 py-2 rounded-lg font-semibold">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto py-8 px-4">
        @yield('content')
    </div>

</body>
</html>