@if(config('forum.user.avatar'))

    @if(config('forum.user.profile')) <a href="{{ route(config('forum.user.profile-route'), $user->id) }}"> @endif

        <img class="img-thumbnail img-circle avatar" src="{{ asset($user->{config('forum.user.user-avatar')} ) }}" alt="{{ $user->{config('forum.user.username')} }}"/>

    @if(config('forum.user.profile')) </a> @endif

@endif