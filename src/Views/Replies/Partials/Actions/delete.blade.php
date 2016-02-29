@if(auth()->check() && $reply->user_id == auth()->user()->id)

	    <form action="{{ route('forum.conversation.reply.destroy', [$conversation->slug, $reply->id])}}" method="POST" class="reply-delete">

	        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

	        <input type="hidden" name="reply_id" value="{{ $reply->id }}"/>

	        <button type="submit" class="{{ config('forum.icons.delete') }} delete-reply"></button>

	    </form>

@endif
	