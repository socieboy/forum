@if(auth()->check() && $reply->user_id == auth()->user()->id)

    <a href="{{ route('forum.conversation.reply.edit', [$conversation->slug, $reply->id])}}" data-toggle="modal" data-target="#edit-reply-modal">
        <i class="{{ config('forum.icons.edit') }} edit-reply"></i>
    </a>

@endif