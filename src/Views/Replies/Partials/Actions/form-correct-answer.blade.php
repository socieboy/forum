@if(Auth::check())

	@if($reply->conversation->user->id == Auth::User()->id)

	    <form action="{{ route('forum.conversation.reply.correct-answer', [$conversation->slug, $conversation->user->id])}}" method="POST">

	        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	        <input type="hidden" name="reply_id" value="{{ $reply->id }}"/>
	        <button type="submit" class="fa fa-check best_answer"></button>

	    </form>

	@endif

@endif
	