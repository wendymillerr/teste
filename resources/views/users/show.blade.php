<x-layouts.app-layout :title="$user->first_name">

    <h1 class="text-2xl font-bold mb-4">
        {{ $user->first_name }} {{ $user->last_name }}
    </h1>

    <p>Email: {{ $user->email }}</p>
    <p>Phone: {{ $user->phone }}</p>

    <a href="{{ route('user.posts', $user->id) }}" class="text-blue-600 underline block mt-4">
        Ver posts deste usuário →
    </a>

</x-layouts.app-layout>
