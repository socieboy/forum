@extends($template)
@section($content)

<div class="forum">

    <div class="body">

        <div class="row items">

            @include('Forum::Conversations.Partials.question')

            <div class="divsor">
                    {{
                        trans('Forum::messages.replies-counter', [
                            'replies' => $conversation->replies->count(),
                            'best-answer' => 0
                        ])
                    }}
            </div>

            @include('Forum::Conversations.Partials.correct-answer')

            @foreach($replies as $reply)

                @include('Forum::Replies.show')

            @endforeach

            <div class="text-center">
                {!! $replies->render() !!}
            </div>

            @if(auth()->check())

                @include('Forum::Replies.form')

            @endif

        </div>

    </div>










</div>

@stop