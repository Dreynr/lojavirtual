<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Camisaria Gaúcha - Camisas dos Times do RS</title>
    

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-gray-900">⚽ Camisaria Gaúcha</h1>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    @else
                        <!---------------------->
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a>
                        <!---------------------->
                    @endauth
                </div>
            </div>
        </div>
    </header>


    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 text-center mb-8">Camisas dos Times Gaúchos</h1>
        </div>


        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Filtrar por Time:</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('loja') }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium {{ !$selectedType ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Todos
                </a>
                @foreach($types as $type)
                    <a href="{{ route('loja', ['type_id' => $type->id]) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium {{ $selectedType == $type->id ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        {{ $type->name }}
                    </a>
                @endforeach
            </div>
        </div>


        <div class="flex flex-wrap gap-4 justify-center">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 w-48 flex-shrink-0">

                    <div class="h-48 bg-gray-100 overflow-hidden">
                        @if($product->image && file_exists(public_path('images/products/' . $product->image)))
                            <img src="{{ asset('images/products/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="bg-gradient-to-br from-blue-500 to-red-500 w-full h-full flex items-center justify-center">
                                <span class="text-white text-3xl">👕</span>
                            </div>
                        @endif
                    </div>
                    

                    <div class="p-3">
                        <div class="mb-1">
                            <span class="text-xs font-medium text-blue-600 uppercase tracking-wide">{{ $product->type->name }}</span>
                        </div>
                        
                        <h3 class="text-sm font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        
                        @if($product->description)
                            <p class="text-gray-600 text-xs mb-2">{{ Str::limit($product->description, 40) }}</p>
                        @endif
                        
                        <div class="space-y-1">
                            <div class="text-lg font-bold text-green-600">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                            <div class="text-xs text-gray-500">{{ $product->quantity }} em estoque</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2m13-8V4a1 1 0 00-1-1H7a1 1 0 00-1 1v1m12 0H8" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma camisa disponível</h3>
                        <p class="mt-1 text-sm text-gray-500">Não há produtos em estoque no momento.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>


    <footer class="bg-gray-800 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-300 text-sm">
                © 2025 Camisaria Gaúcha. Todos os direitos reservados.
            </p>
        </div>
    </footer>
</body>
</html>