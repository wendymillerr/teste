{{-- 
    View: Posts Index (Página Inicial do Blog)
    Variável esperada: $posts (coleção paginada de posts)
    Uso: return view('posts.index', ['posts' => $posts]);
--}}

<x-layouts.app-layout>
    {{-- Meta tags para SEO --}}
    @section('title', 'Blog Posts ')
    @section('description', 'Explore os últimos posts do nosso blog. Encontre artigos sobre diversos temas.')

    <div class="min-h-screen bg-gray-50">
        {{-- Container Principal --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
         

            {{-- Barra de Filtros --}}
            {{-- <x-filter-bar /> --}}
            <x-filter-bar :tags="$tags" />

            {{-- Grid de Posts --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($posts as $post)
                    <x-post-card :post="$post" />
                @empty
                    {{-- Estado vazio --}}
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum post encontrado</h3>
                        <p class="mt-1 text-sm text-gray-500">Tente ajustar os filtros de busca.</p>
                    </div>
                @endforelse
            </div>

            {{-- Paginação --}}
            @if($posts->hasPages())
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        {{-- Links de paginação do Laravel --}}
                        {{ $posts->links() }}
                    </nav>
                </div>
            @endif

            {{-- Paginação Customizada (Alternativa estilizada) --}}
            {{-- 
            <div class="mt-8 flex justify-center">
                <nav class="inline-flex items-center space-x-1 bg-white rounded-lg shadow-sm px-2 py-2">
                    @if($posts->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="px-3 py-2 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                    @endif

                    @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        @if($page == $posts->currentPage())
                            <span class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="px-3 py-2 text-gray-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
            --}}

        </div>
    </div>
</x-layouts.app-layout>