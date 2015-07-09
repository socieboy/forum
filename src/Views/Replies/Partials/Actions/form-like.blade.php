
    <form action="{{ route('forum.conversation.reply.like', $conversation->slug) }}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

        <input type="hidden" name="reply_id" value="{{ $reply->id }}"/>

        <button type="submit" class="fa fa-thumbs-o-up @if($reply->userLiked()) liked @endif"></button>

        @if($reply->likes()->count())
            <span class="like_legend">{{ $reply->likes()->count() }} likes</span>
        @endif

    </form>
