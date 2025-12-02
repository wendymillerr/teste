<x-layouts.app-layout :title="'Posts de ' . $user->first_name">

    <h1 class="text-2xl font-bold mb-4">
        Posts de {{ $user->first_name }} {{ $user->last_name }}
    </h1>

    @foreach($posts as $post)
        <x-post-card :post="$post" />
    @endforeach

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

</x-layouts.app-layout>
