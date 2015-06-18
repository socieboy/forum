@if(Auth::check())

	@if($reply->conversation->user->id == Auth::User()->id)

	    <form action="{{ route('forum.conversation.reply.best-answer', [$conversation->slug, $conversation->user->id])}}" method="POST">

	        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
	        <input type="hidden" name="reply_id" value="{{ $reply->id }}"/>
	        <button type="submit" class="glyphicon glyphicon-ok best_answer"></button>

	    </form>

	@endif
@endif
	