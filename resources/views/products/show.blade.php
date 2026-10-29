<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Katalog UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-indigo-600 text-white shadow-md py-4">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="font-bold text-lg hover:underline">&larr; Kembali ke Katalog</a>
            <span class="text-xs bg-indigo-800 px-3 py-1 rounded-full">Server Benchmark Testbed</span>
        </div>
    </header>

    <div class="max-w-5xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm border p-6 md:p-8">
            <span class="text-xs font-semibold uppercase text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded">
                {{ $product->category->name }}
            </span>
            <h1 class="text-3xl font-bold mt-3">{{ $product->name }}</h1>
            <p class="text-gray-500 text-sm mt-1">Diproduksi oleh: <span class="font-medium text-gray-700">{{ $product->umkm_seller }}</span></p>

            <div class="mt-6 border-t pt-4">
                <div class="text-3xl font-bold text-emerald-600 mb-4">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-600 mb-6">
                    <span class="font-semibold">Stok Tersedia:</span> {{ $product->stock }} unit
                </div>
                <h3 class="font-bold text-lg mb-2">Deskripsi Produk:</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>
        </div>

        <!-- Produk Terkait -->
        @if ($relatedProducts->count())
            <div class="mt-10">
                <h2 class="text-xl font-bold mb-4">Produk Terkait Lainnya</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($relatedProducts as $rel)
                        <div class="bg-white p-4 rounded-lg border shadow-sm flex flex-col justify-between">
                            <div>
                                <h4 class="font-bold text-sm line-clamp-1">{{ $rel->name }}</h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $rel->umkm_seller }}</p>
                            </div>
                            <div class="mt-4 pt-2 border-t flex justify-between items-center">
                                <span class="text-sm font-bold text-emerald-600">Rp {{ number_format($rel->price, 0, ',', '.') }}</span>
                                <a href="{{ route('products.show', $rel->slug) }}" class="text-xs bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded">Lihat</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>
</html>