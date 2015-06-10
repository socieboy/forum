    <div class="bubble-footer">

        <div class="container">


        {{-- LIKE BUTTON --}}
        
        @if(!$reply->userLiked())

            @include('Forum::Replies.Partials.Actions.form-like')

        @else

            @include('Forum::Replies.Partials.Actions.form-unlike')

        @endif


        {{-- CORRECT ANSWER BUTTON

        @if(!$conversation->hasCorrectAnswer())

            @if($reply->isCorrect())


            @endif

        @else

           @include('Forum::Replies.Partials.Actions.form-correct-answer')

        @endif --}}



        </div>

    </div>