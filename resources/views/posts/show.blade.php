<x-layouts.app-layout :title="$post->title">

    <div class="main-card mb-6">
        <x-post-card :post="$post" />
    </div>

    <h2 class="title-2 mb-2">Comentários ({{ $post->comments_count }})</h2>

    @foreach($post->comments as $comment)
        <x-comment :comment="$comment" />
    @endforeach

</x-layouts.app-layout>
