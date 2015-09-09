 <a href="
    @if(config('forum.user.profile'))
        {{ route(config('forum.user.profile-route'), $user->id) }}
    @else
        #
    @endif
">

    {{ $user->{config('forum.user.username')} }}

@if(config('forum.user.profile'))
    </a>
@endif