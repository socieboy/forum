@if( ! $reply->isCorrect())

    <div class="col-md-12 item">

        @include('Forum::Partials.avatar', ['user' => $reply->user])

        <div class="bubble">


            <div class="body">

                <span class="name">{{ $reply->user->{config('forum.user.username')} }}</span>

                <span class="hidden-xs time">{{ $reply->created_at->diffForHumans() }}</span>

                <div class="content">

                    {!! nl2br($reply->message) !!}

                </div>


            </div>

            @include('Forum::Replies.Partials.footer')

        </div>

    </div>

@endif