 @if(auth()->check())

    <div class="footer">

        @include('Forum::Conversations.Partials.Actions.edit')

    </div>

@endif