@if($conversation->hasCorrectAnswer())


    <div class="col-md-12 item">


            <div class="bubble">

                <div class="best-answer">
                    <i class="glyphicon glyphicon-ok"></i>
                </div>

                <div class="body">

                    @include('Forum::Partials.avatar', ['user' => $conversation->correctAnswer()->user])


                    <span class="name">
                        {{ $conversation->correctAnswer()->user->{config('forum.user.username')} }}
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
