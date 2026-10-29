<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk UMKM - Benchmark Server</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Header -->
    <header class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold">Katalog Produk UMKM Mandiri</h1>
                <p class="text-indigo-200 text-sm">Server Testbed: Mini PC vs VPS Benchmark</p>
            </div>
            <!-- Search Bar -->
            <form action="{{ route('products.index') }}" method="GET" class="w-full md:w-96 flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk UMKM..." 
                       class="w-full px-4 py-2 rounded-l-lg text-gray-900 focus:outline-none">
                <button type="submit" class="bg-indigo-800 px-5 py-2 rounded-r-lg font-semibold hover:bg-indigo-900 transition">Cari</button>
            </form>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Sidebar Kategori -->
        <aside class="md:col-span-1 bg-white p-5 rounded-lg shadow-sm h-fit">
            <h2 class="font-bold text-lg mb-4 pb-2 border-b">Kategori UMKM</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded {{ !request('category') ? 'bg-indigo-50 font-bold text-indigo-600' : 'hover:bg-gray-100' }}">
                        Semua Kategori
                    </a>
                </li>
                @foreach ($categories as $cat)
                    <li>
                        <a href="{{ route('products.index', ['category' => $cat->slug]) }}" 
                           class="flex justify-between items-center px-3 py-2 rounded {{ request('category') == $cat->slug ? 'bg-indigo-50 font-bold text-indigo-600' : 'hover:bg-gray-100' }}">
                            <span>{{ $cat->name }}</span>
                            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-0.5 rounded-full">{{ $cat->products_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- Daftar Produk -->
        <main class="md:col-span-3">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $prod)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                        <div class="p-4">
                            <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-1 rounded">
                                {{ $prod->category->name }}
                            </span>
                            <h3 class="font-bold text-lg mt-2 line-clamp-1">
                                <a href="{{ route('products.show', $prod->slug) }}" class="hover:text-indigo-600">
                                    {{ $prod->name }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-500 mb-2">{{ $prod->umkm_seller }}</p>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $prod->description }}</p>
                        </div>
                        <div class="p-4 border-t bg-gray-50 flex items-center justify-between">
                            <span class="font-bold text-lg text-emerald-600">
                                Rp {{ number_format($prod->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('products.show', $prod->slug) }}" class="text-sm font-semibold bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-700 transition">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500">
                        Tidak ada produk yang ditemukan.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </main>
    </div>
</body>
</html>