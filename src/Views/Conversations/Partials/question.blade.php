<div class="col-md-12 item">

    @include('Forum::Partials.avatar', ['user' => $conversation->user])

    <div class="bubble question">

        <div class="header">

            <h3>{{ $conversation->title }}</h3>

        </div>

        <div class="body">

            <p class="owner">{{ $conversation->ownerName }}</p>

            {!! nl2br($conversation->message) !!}

        </div>

    </div>

</div>





            {{--<div class="bubble">--}}

                {{--<div class="header">--}}

                    {{--<h3>{{ $conversation->title }}</h3>--}}
                    {{--<p class="owner">{{ $conversation->user->{config('forum.user.username')} }}</p>--}}

                {{--</div>--}}

                {{--<div class="body">--}}

                    {{--{!! nl2br($conversation->message) !!}--}}

                {{--</div>--}}

            {{--</div>--}}



{{--<div class="item">--}}

    {{--<div class="bubble-footer tread-summary">--}}

        {{----}}

        {{--<span class="info">--}}
            {{--{{ $conversation->replies->count() }} replies--}}

            {{--@if($conversation->hasCorrectAnswer())--}}

                {{--with 1 correct answer.--}}

            {{--@else--}}

                {{--with no correct answer yet.--}}

            {{--@endif--}}
        {{--</span>--}}

    {{--</div>--}}

{{--</div>--}}