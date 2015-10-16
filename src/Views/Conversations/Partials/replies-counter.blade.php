<div class="replies-counter">

    <h1>{{ $conversation->replies->count() }}</h1>
    <p>
        {{ trans_choice('Forum::messages.replies', $conversation->replies->count()) }}
    </p>

</div>