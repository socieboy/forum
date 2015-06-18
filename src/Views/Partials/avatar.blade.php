@if(config('forum.user.avatar'))
    
    @if(config('forum.user.profile')) <a href="{{ route(config('forum.user.profile-route'), $user->id) }}"> @endif

        @if(config('forum.user.gravatar'))

            <img class="img-thumbnail img-circle avatar" src="{{ sprintf('https://www.gravatar.com/avatar/%s?size=%d', md5($user->email), '200') }}" alt="{{ $user->{config('forum.user.username')} }}"/>

        @else

            @if(config('forum.user.avatar'))

                <img class="img-thumbnail img-circle avatar" src="{{ asset($user->{config('forum.user.user-avatar')} ) }}" alt="{{ $user->{config('forum.user.username')} }}"/>

            @endif

        @endif
	
	
    @if(config('forum.user.profile')) </a> @endif

@endif
