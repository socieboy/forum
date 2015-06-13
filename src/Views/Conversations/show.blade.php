@extends($template)
@section($content)

<div class="forum">

    {{-- Display the header of the conversation --}}
    @include('Forum::Conversations.Partials.header')


    <div class="forum-body">

        <div class="container conversation-container">

            {{-- Display the question of the conversation --}}
            @include('Forum::Conversations.Partials.question')


            @include('Forum::Conversations.Partials.correct-answer')


            {{-- Display each reply on this conversation --}}
            @foreach($replies as $reply)

                    @include('Forum::Replies.show')

            @endforeach


        
            {{-- Paginate replies --}}
            <div class="forum-pagination">

                {!! $replies->render() !!}

            </div>

            @if(Auth::check())
                {{-- Post a new reply form --}}
                @include('Forum::Replies.form')
            @endif        
       </div>

    </div>

</div>

@stop