 @if(auth()->check())

    <div class="footer">

        @if(!$reply->userLiked())

            @include('Forum::Replies.Partials.Actions.form-like')

        @else

            @include('Forum::Replies.Partials.Actions.form-unlike')

        @endif


        @if(!$conversation->hasCorrectAnswer())

            @include('Forum::Replies.Partials.Actions.form-correct-answer')

        @endif

    </div>

@endif