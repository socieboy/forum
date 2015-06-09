<div class="bubble-body">

    <!--p class="reply-actions">

        @include('Forum::Replies.Partials.Actions.edit')

        @include('Forum::Replies.Partials.Actions.delete')

    </p-->

    <p class="posted_by pull-right">{{ $reply->created_at->diffForHumans() }}</p>

    <p class="posted_by">Posted by <a href="#">{{ $reply->user->{config('forum.user.username')} }}</a></p>

    {!! $reply->message !!}
</div>