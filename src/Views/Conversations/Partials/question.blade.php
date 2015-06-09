<article class="item">

    @include('Forum::Partials.avatar', ['user' => $conversation->user])

    <div class="bubble-body">

        {!! $conversation->message !!}

    </div>

</article>


<article class="item">

    <div class="bubble-footer tread-summary">

    {{ $conversation->replies->count() }} replies with no correct answer yet.

    </div>

</article>