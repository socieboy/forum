@extends($template)
@section($content)

<div class="container text-center">
    @include('Forum::Partials.avatar')
    <h3>{{ $user->{config('forum.user.username')} }}</h3>
    <p>Member since {{ $user->created_at->diffForHumans() }}</p>
    <a href="{{ route('forum') }}">Back to the forum</a>
</div>
@stop