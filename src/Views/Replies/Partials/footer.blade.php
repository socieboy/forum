 @if(auth()->check())

    <div class="footer">

        {{-- LIKE BUTTONS --}}
        @if(!$reply->userLiked())

            @include('Forum::Replies.Partials.Actions.form-like')

        @else

            @include('Forum::Replies.Partials.Actions.form-unlike')

        @endif


        {{--  CHECK CORRECT ANSWER --}}
        @if( ! $conversation->hasCorrectAnswer())

            @include('Forum::Replies.Partials.Actions.form-correct-answer')

        @endif


{{--        @include('Forum::Replies.Partials.Actions.edit')--}}

        @include('Forum::Replies.Partials.Actions.delete')

    </div>

@endif