<article class="item">

    @include('Forum::Partials.avatar', ['user' => $reply->user])

    @include('Forum::Replies.Partials.Bubble.header')

    @include('Forum::Replies.Partials.Bubble.body')

    @include('Forum::Replies.Partials.Bubble.footer')

</article>