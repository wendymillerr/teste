<div class="main-card max-w-3xl mx-auto p-4 flex gap-3">

   <img src="{{ $comment->user_image ?? 'https://via.placeholder.com/40' }}"
     class="w-10 h-10 rounded-full object-cover border">

    <div>
        <p class="text-gray-800 text-sm">
            {{ $comment->body }}
        </p>

        <p class="text-xs text-gray-500 mt-1">
            — {{ $comment->user_name }}
        </p>
    </div>

</div>




