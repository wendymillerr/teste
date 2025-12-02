<div class="main-card p-4 mt-4">

    <p class="text-zinc-700 text-sm">
        {{ $comment->body }}
    </p>

    <p class="text-xs text-zinc-500 mt-2">
        — {{ $comment->user->username ?? 'Anônimo' }}
    </p>

</div>
