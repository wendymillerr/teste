<div class="main-card hover:shadow-lg transition-shadow duration-300">

    {{-- Título --}}
    <a href="{{ route('post.show', $post->id) }}" 
       class="text-2xl font-semibold text-blue-700 hover:text-blue-900 transition">
        {{ $post->title }}
    </a>

    {{-- Info adicional --}}
    <div class="text-sm text-gray-500 mt-2 flex items-center gap-3">
        <span>👍 {{ $post->likes }}</span>
        <span>👎 {{ $post->dislikes }}</span>
        <span>💬 {{ $post->comments_count }}</span>
    </div>

    {{-- Tags --}}
    @if($post->tags)
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach(json_decode($post->tags) as $tag)
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                    #{{ $tag }}
                </span>
            @endforeach
        </div>
    @endif

</div>
