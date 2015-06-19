@if( ! $reply->isCorrect())

    <article class="item">

        @include('Forum::Partials.avatar', ['user' => $reply->user])

        @include('Forum::Replies.Partials.Bubble.header')

        @include('Forum::Replies.Partials.Bubble.body')

        @if(auth()->check())

            @include('Forum::Replies.Partials.Bubble.footer')

        @endif

    </article>

@endif