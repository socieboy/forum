@if(auth()->check())

	@if($reply->conversation->user->id == auth()->user()->id)

	    <form action="{{ route('forum.conversation.reply.correct-answer', [$conversation->slug, $conversation->user->id])}}" method="POST">

	        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

	        <input type="hidden" name="reply_id" value="{{ $reply->id }}"/>

	        <button type="submit" class="{{ config('forum.icons.correct-answer') }} best-answer"></button>

	    </form>

	@endif

@endif
	