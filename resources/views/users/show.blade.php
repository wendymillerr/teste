{{-- 
    View: Perfil do Usuário
    Uso: route('users.profile', $user->id)
--}}

<x-layouts.app-layout>
    @section('title', $user->first_name . ' ' . $user->last_name . ' - Profile')



    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Profile Header Card --}}
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                {{-- Cover/Banner --}}
                <div class="h-32 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
                
                {{-- Profile Info --}}
                <div class="relative px-6 pb-6">
                    {{-- Avatar --}}
                    <div class="absolute -top-28 left-6">
                        <div class="w-24 h-24 rounded-full border-4 border-white bg-indigo-100 flex items-center justify-center shadow-lg">
                            @if($user->image)
                                <img src="{{ $user->image }}" alt="{{ $user->first_name }}" class="w-full h-full rounded-full object-cover">
                            @else
                                <span class="text-3xl font-bold text-indigo-600">
                                    {{ strtoupper(substr($user->first_name, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                    </div>

                

                    {{-- Name & Info --}}
                    <div class="mt-20">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->first_name . $user->last_name }}</h1>
                        <p class="text-gray-500 mt-1">{{ '@' . Str::slug($user->first_name) }}</p>
                        
                       

                        {{-- Meta Info --}}
                        <div class="flex flex-wrap items-center gap-4 mt-4 text-sm text-gray-500">
                            
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Membro desde {{ $user->created_at->format('M Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- Stats --}}
                    <div class="flex gap-6 mt-6 pt-6 border-t border-gray-100">
                        <div class="text-center">
                            <span class="block text-2xl font-bold text-gray-900">{{ $user->posts_count ?? 0 }}</span>
                            <span class="text-sm text-gray-500">Posts</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-2xl font-bold text-gray-900">{{ $user->followers_count ?? 0 }}</span>
                            <span class="text-sm text-gray-500">Seguidores</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-2xl font-bold text-gray-900">{{ $user->following_count ?? 0 }}</span>
                            <span class="text-sm text-gray-500">Seguindo</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs Navigation --}}
            <div class="bg-white rounded-xl shadow-sm mb-6">
                <nav class="flex border-b border-gray-200">
                    <a href="{{ route('users.profile', $user->id) }}" 
                       class="px-6 py-4 text-sm font-medium text-indigo-600 border-b-2 border-indigo-600">
                        Posts
                    </a>
                   
                    <a href="{{ route('users.likes', $user->id) }}" 
                       class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                        Curtidas
                    </a>
                </nav>
            </div>

            {{-- User Posts --}}
            <div class="space-y-6">
                @forelse($posts as $post)
                    <x-post-card :post="$post" />
                @empty
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum post ainda</h3>
                        <p class="text-gray-500">Este usuário ainda não publicou nenhum post.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($posts->hasPages())
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            @endif

        </div>
    </div>
</x-layouts.app-layout>
