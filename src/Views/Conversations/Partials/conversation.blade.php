<a href="{{ route('forum.conversation.show', $conversation->slug) }}">

    <li>

        <div class="hidden-xs col-sm-2 text-center">

            @include('Forum::Partials.avatar', ['user' => $conversation->user])

        </div>

        <div class="col-sm-8">

            <div class="hidden-xs topic">

                <i  class="{{ $conversation->topicIcon }}"
                    style="background: {{ $conversation->topicColor }}">
                </i>

                {{--{{ $conversation->topic}}--}}

            </div>

            <h3>{{ $conversation->title }}</h3>


            @include('Forum::Conversations.Partials.timing-information')


        </div>

        <div class="hidden-xs col-sm-2">

                @include('Forum::Conversations.Partials.replies-counter')

        </div>


    </li>

</a>
