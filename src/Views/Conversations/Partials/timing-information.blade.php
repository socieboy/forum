<span>

        @if($conversation->replies()->count() > 0)

             Updated {{ $conversation->replies->first()->created_at->diffForHumans() }}

             by

             @include('Forum::Partials.user-name', ['user' => $conversation->replies->first()->user])

        @else

            Posted {{ $conversation->created_at->diffForHumans() }}

            by

             @include('Forum::Partials.user-name', ['user' => $conversation->user])

        @endif

    </span>