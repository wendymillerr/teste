{{-- 
    Layout Principal: App Layout
    Uso: <x-layouts.app-layout> ... </x-layouts.app-layout>
--}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Home'))</title>
    <meta name="description" content="@yield('description', 'Blog de artigos e posts interessantes')">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        
        {{-- Header/Navbar --}}
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    {{-- Logo --}}
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('posts.index') }}">
                        <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                      </a>
                    </div>

                    
                        
                        @guest
                            
                        @else
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center space-x-2 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors duration-200">
                                    <span>{{ Auth::user()->first_name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        @endguest
                    </nav>
                </div>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-white border-t border-gray-200 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }}  Todos os direitos reservados.
                    </p>
                    
                   
                </div>
            </div>
        </footer>

    </div>
</body>
</html>
