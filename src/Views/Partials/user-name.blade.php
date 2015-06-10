@if(config('forum.user.profile')) <a href="{{ route(config('forum.user.profile-route'), $user->id) }}"> @endif

{{ $user->{config('forum.user.username')} }}

@if(config('forum.user.profile')) </a> @endif