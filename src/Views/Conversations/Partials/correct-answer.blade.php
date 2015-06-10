@if($conversation->hasCorrectAnswer())

   <article class="item is-correct">

        @include('Forum::Partials.avatar', ['user' => $conversation->correctAnswer()->user])

        <div class="bubble-header">
            @include('Forum::Partials.avatar', ['user' => $conversation->correctAnswer()->user])
            <div class="username">
                {{ $conversation->correctAnswer()->user->{config('forum.user.username')} }}
            </div>
        </div>

        <div class="bubble-body">

            <p class="posted_by pull-right">{{ $conversation->correctAnswer()->created_at->diffForHumans() }}</p>

            <p class="posted_by">Posted by @include('Forum::Partials.user-name', ['user' => $conversation->correctAnswer()->user])</p>

            {!! $conversation->correctAnswer()->message !!}
        </div>

            <div class="bubble-footer">

                <div class="container">


                @if(!$conversation->correctAnswer()->userLiked())

                    @include('Forum::Replies.Partials.Actions.form-like', ['reply' => $conversation->correctAnswer()])

                @else

                    @include('Forum::Replies.Partials.Actions.form-unlike', ['reply' => $conversation->correctAnswer()])

                @endif

                </div>

            </div>

    </article>

@endif
