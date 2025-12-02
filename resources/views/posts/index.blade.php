<x-layouts.app-layout title="Posts">

    <h1 class="title-1 mb-4">Últimos Posts</h1>

    <div class="grid gap-6">
        @foreach ($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>

</x-layouts.app-layout>
