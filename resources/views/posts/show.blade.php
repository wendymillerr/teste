<x-layouts.app-layout :title="$post->title">

    <div class="max-w-4xl mx-auto space-y-6 p-4">

        {{-- Post principal --}}
        <article class="bg-white rounded-xl shadow-md p-6 space-y-4">

            {{-- Título --}}
            <h1 class="text-3xl font-bold text-indigo-600">{{ $post->title }}</h1>

            {{-- Autor --}}
            @if(isset($post->user))
                <div class="flex items-center gap-3 text-gray-500">
                    <a href="{{ route('users.profile', $post->user->id) }}" class="flex items-center gap-3 hover:underline">
                        <img 
                            src="{{ $post->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->first_name) }}" 
                            alt="{{ $post->user->first_name }}" 
                            class="w-10 h-10 rounded-full object-cover border"
                        >
                        <span class="font-medium">{{ $post->user->first_name }} {{ $post->user->last_name }}</span>
                    </a>
                    <span class="text-sm ml-auto">{{ $post->created_at->format('d/m/Y H:i') }}</span>
                </div>
            @endif


            {{-- Imagem do post --}}
            @if(!empty($post->image))
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-auto rounded-md mt-2">
            @endif

            {{-- Corpo do post --}}
            <div class="text-gray-700 leading-relaxed">
                {{ $post->body }}
            </div>

            {{-- Reactions e comentários --}}
            <div class="flex items-center gap-4 text-sm text-gray-600 mt-2">
                <span>👍 {{ $post->likes ?? 0 }}</span>
                <span>👎 {{ $post->dislikes ?? 0 }}</span>
               
            </div>

            {{-- Tags --}}
            @if(!empty($post->tags))
                <div class="flex flex-wrap gap-2 mt-4">
                    @foreach($post->tags as $tag)
                        <span class="px-3 py-1 text-xs font-medium rounded-full border border-gray-300 text-gray-600 hover:border-indigo-400 hover:text-indigo-600 transition-colors cursor-pointer">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
            @endif

        </article>

        {{-- Comentários --}}
        <section class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Comentários ({{ $post->comments_count }})</h2>

            @forelse($post->comments as $comment)
                <x-comment :comment="$comment" />
            @empty
                <p class="text-gray-500">Nenhum comentário ainda.</p>
            @endforelse
        </section>

    </div>

</x-layouts.app-layout>
