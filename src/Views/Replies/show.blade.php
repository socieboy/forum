@if( ! $reply->isCorrect())

    <div class="col-md-12 item">

        <div class="bubble reply">

            <div class="header">
                <span class="hidden-xs time">{{ $reply->created_at->diffForHumans() }}</span>
                @include('Forum::Partials.avatar', ['user' => $reply->user])
                <h3 class="name">{{ $reply->user->{config('forum.user.username')} }}</h3>

            </div>

            <div class="body">


                <div class="content">

                    {!! nl2br($commonMark->convertToHtml($reply->message)) !!}

                </div>


            </div>

            @include('Forum::Replies.Partials.footer')

        </div>

    </div>

@endif