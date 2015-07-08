    <div class="forum-header">

        <div class="user">

            @include('Forum::Partials.avatar', ['user' => $conversation->user])
            <h3 class="post-title">{{ $conversation->title }}</h3>
            <h3 class="post-user">{{ $conversation->user->{config('forum.user.username')} }}</h3>

        </div>
    </div>