<div class="bubble-header">
    @include('Forum::Partials.avatar', ['user' => $reply->user])
    <div class="username">
        {{ $reply->user->{config('forum.user.username')} }}
    </div>
</div>