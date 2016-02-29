<div class="col-md-12 item">

    <div class="bubble">

        <div class="header question">

            @include('Forum::Partials.avatar', ['user' => $conversation->user])

            <h3>{{ $conversation->title }}</h3>

        </div>

        <div class="body">

            <span class="name">{{ $conversation->ownerName }}</span>
            <span class="hidden-xs time">{{ $conversation->created_at->diffForHumans() }}</span>

            <hr/>


            <div class="content">
                {!! nl2br($commonMark->convertToHtml($conversation->message)) !!}
            </div>

        </div>

    </div>

</div>
