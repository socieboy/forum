@extends($template)
@section($content)


    <div class="forum">

        <div class="forum-header">
            <h1>Forum</h1>

            @include('Forum::Conversations.create')

        </div>

        <div class="forum-topics">

             @include('Forum::Topics.index')

        </div>

        <div class="forum-body">

            <ul class="list-group">

                @foreach($conversations as $conversation)

                    @include('Forum::Conversations.Partials.conversation')

                @endforeach

            </ul>

            {!! $conversations->render() !!}

        </div>

    </div>

@stop