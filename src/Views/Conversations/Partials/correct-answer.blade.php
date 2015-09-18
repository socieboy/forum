@if($conversation->hasCorrectAnswer())


    <div class="col-md-12 item">


            <div class="bubble">

                <div class="body">

                    @include('Forum::Partials.avatar', ['user' => $conversation->correctAnswer()->user])


                    <span class="name">
                        {{ $conversation->correctAnswer()->user->{config('forum.user.username')} }}
                        <span><i class="{{ config('forum.icons.correct-answer') }}"></i> {{ trans('Forum::messages.best-answer-asker-choise') }}</span>
                    </span>

                    <span class="hidden-xs time">
                        {{ $conversation->correctAnswer()->created_at->diffForHumans() }}
                    </span>

                    <div class="content">

                        {!! nl2br($conversation->correctAnswer()->message) !!}

                    </div>


                </div>


                @include('Forum::Replies.Partials.footer', ['reply' => $conversation->correctAnswer()])

            </div>

        </div>

@endif
