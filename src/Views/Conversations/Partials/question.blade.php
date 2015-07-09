<article class="item">

    @include('Forum::Partials.avatar', ['user' => $conversation->user])

    <div class="bubble-body">

        <p class="posted_by pull-right">{{ $conversation->created_at->diffForHumans() }}</p>

        {!! $conversation->message !!}

    </div>

</article>

<article class="item">

    <div class="bubble-footer tread-summary">

        <div class="icon">
            <i class="fa fa-comment-o"></i>
        </div>

        <span class="info">
            {{ $conversation->replies->count() }} replies

            @if($conversation->hasCorrectAnswer())

                with 1 correct answer.

            @else

                with no correct answer yet.

            @endif
        </span>

    </div>

</article>