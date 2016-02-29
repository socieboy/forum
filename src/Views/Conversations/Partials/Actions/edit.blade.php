@if(auth()->check() && $conversation->user_id == auth()->user()->id)

    <a href="{{ route('forum.conversation.edit', [$conversation->slug])}}" data-toggle="modal" data-target="#edit-modal">
        <i class="{{ config('forum.icons.edit') }} edit-conversation"></i>
    </a>

@endif