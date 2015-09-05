<div class="col-md-12 item">

    @include('Forum::Partials.avatar', ['user' => $conversation->user])

    <div class="bubble question">

        <div class="header">

            <h3>{{ $conversation->title }}</h3>

        </div>

        <div class="body">

            <span class="name">{{ $conversation->ownerName }}</span>

            <span class="hidden-xs time">{{ $conversation->created_at->diffForHumans() }}</span>

            <div class="content">
                {!! nl2br($conversation->message) !!}
            </div>

        </div>

    </div>

</div>
