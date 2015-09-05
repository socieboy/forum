<p class="no-conversations">

        {{ trans('Forum::messages.no-conversations') }}

        <br/>
        <br/>

        <small>
            @if(auth()->check())
                <a data-toggle="modal" data-target="#start-conversation-modal">
                    {{ trans('Forum::messages.new-conversation') }}
                </a>
            @else
                <a href="{{ url(config('forum.auth.login-url')) }}">{{ trans('Forum::messages.log-in') }}</a>
            @endif
        </small>

</p>