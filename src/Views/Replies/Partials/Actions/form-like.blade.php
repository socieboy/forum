    <form action="{{ route('forum.conversation.reply.like', $conversation->slug) }}" method="POST">

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

        <input type="hidden" name="reply_id" value="{{ $reply->id }}"/>

        <button type="submit" class="{{ config('forum.icons.like') }}"></button>

        @if($reply->likes()->count())

            <div class="text-like-count">
                {{ $reply->likes()->count() }}
                {{ trans('Forum::messages.text-like') }}
            </div>

        @endif

    </form>
