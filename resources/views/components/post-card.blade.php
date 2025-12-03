{{-- resources/views/components/post-card.blade.php --}}
@props(['post', 'class' => ''])

<article {{ $attributes->merge(['class' => "bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden $class"]) }}>
    
    {{-- Imagem do Post (opcional) --}}
    @if(!empty($post->image))
        <div class="aspect-video overflow-hidden">
            <img 
                src="{{ $post->image }}" 
                alt="{{ $post->title }}" 
                class="w-full h-full object-cover"
                loading="lazy"
            >
        </div>
    @endif

    <div class="p-5 flex flex-col justify-between h-full">

        {{-- Tags principais --}}
        @if(!empty($post->tags) && count($post->tags) > 0)
            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700 mb-2">
                {{ $post->tags[0] }}
            </span>
        @endif

        {{-- Título --}}
        <a href="{{ route('post.show', $post->id) }}" class="block group mb-2">
            <h2 class="text-lg font-bold text-indigo-600 group-hover:text-indigo-800 line-clamp-2">
                {{ $post->title }}
            </h2>
        </a>

        {{-- Preview do corpo --}}
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
            {{ Str::limit($post->body, 120) }}
        </p>

        {{-- Autor --}}
        @if(isset($post->user))
            <div class="flex items-center gap-2 mb-4">
                <img 
                    src="{{ $post->user->image ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}" 
                    alt="{{ $post->user->name }}" 
                    class="w-8 h-8 rounded-full border-2 border-white object-cover"
                >
                <span class="text-sm text-gray-500">{{ $post->user->first_name ?? 'Autor' }}</span>
            </div>
        @endif

        {{-- Reactions e comentários --}}
        <div class="flex items-center justify-between border-t border-gray-100 pt-3 mt-auto">
            
            <div class="flex items-center gap-4 text-sm text-gray-600">
                <span>👍 {{ $post->likes ?? 0 }}</span>
                <span>👎 {{ $post->dislikes ?? 0 }}</span>
                <span>💬 {{ $post->comments_count ?? 0 }}</span>
            </div>

           
        </div>

        {{-- Tags secundárias --}}
        @if(!empty($post->tags))
            <div class="flex flex-wrap gap-2 mt-3">
                @foreach($post->tags as $tag)
                    <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full border border-gray-300 text-gray-600 hover:border-indigo-400 hover:text-indigo-600 transition-colors cursor-pointer">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>
        @endif

    </div>
</article>
