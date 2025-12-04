{{-- 
    View: Posts do Usuário
    Uso: route('users.posts', $user->id)
--}}

<x-layouts.app-layout>
    

    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-8">
                <div class="flex items-center gap-4 mb-4">
                    <a href="{{ route('user.show', $user->id) }}" 
                       class="inline-flex items-center text-gray-500 hover:text-indigo-600 transition-colors">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Voltar ao Perfil
                    </a>
                </div>
                
                <div class="flex items-center gap-4">
                    {{-- Mini Avatar --}}
                    <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                       @if($user->image)
                            <img src="{{ $user->image }}" alt="{{ $user->first_name }}" class="w-full h-full rounded-full object-cover">
                        @else
                            <span class="text-lg font-bold text-indigo-600">
                                {{ strtoupper(substr($user->first_name, 0, 1)) }}
                            </span>
                        @endif

                    </div>
                    <div>
                       <h1 class="text-2xl font-bold text-gray-900">Posts de {{ $user->first_name }} {{ $user->last_name }}</h1>
                        <p class="text-gray-500">{{ $user->posts_count ?? 0 }} posts publicados</p>
                    </div>
                </div>
            </div>
            <x-filter-bar :tags="$tags" :action="route('users.posts', $user->id)" />


            <div class="flex flex-col lg:flex-row gap-8">
                
              
                  


                {{-- Posts Grid --}}
                <main class="flex-1">
                    {{-- Active Filters Display --}}
                    @if(request()->hasAny(['search', 'tag', 'date', 'likes']))
                        <div class="mb-6 flex flex-wrap items-center gap-2">
                            <span class="text-sm text-gray-500">Filtros ativos:</span>
                            @if(request('search'))
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full">
                                    Busca: "{{ request('search') }}"
                                    <a href="{{ request()->fullUrlWithoutQuery('search') }}" class="ml-1 hover:text-indigo-900">×</a>
                                </span>
                            @endif
                            @if(request('tag'))
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full">
                                    Tag: {{ request('tag') }}
                                    <a href="{{ request()->fullUrlWithoutQuery('tag') }}" class="ml-1 hover:text-indigo-900">×</a>
                                </span>
                            @endif
                            @if(request('date'))
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full">
                                    Data: {{ request('date') }}
                                    <a href="{{ request()->fullUrlWithoutQuery('date') }}" class="ml-1 hover:text-indigo-900">×</a>
                                </span>
                            @endif
                            @if(request('likes'))
                                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-sm rounded-full">
                                    Likes: {{ request('likes') == 'most' ? 'Mais curtidos' : 'Menos curtidos' }}
                                    <a href="{{ request()->fullUrlWithoutQuery('likes') }}" class="ml-1 hover:text-indigo-900">×</a>
                                </span>
                            @endif
                        </div>
                    @endif

                    {{-- Posts --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($posts as $post)
                            <x-post-card :post="$post" />
                        @empty
                            <div class="col-span-full bg-white rounded-xl shadow-sm p-12 text-center">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum post encontrado</h3>
                                <p class="text-gray-500">
                                    @if(request()->hasAny(['search', 'tag', 'date', 'likes']))
                                        Tente ajustar os filtros para encontrar posts.
                                    @else
                                        Este usuário ainda não publicou nenhum post.
                                    @endif
                                </p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($posts->hasPages())
                        <div class="mt-8">
                            {{ $posts->withQueryString()->links() }}
                        </div>
                    @endif
                </main>

            </div>
        </div>
    </div>
</x-layouts.app-layout>
