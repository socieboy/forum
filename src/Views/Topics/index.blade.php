
<ul>
    <a href="{{ url('forum') }}">
    <li>
        <span>
            <i class="{{ config('forum.icons.tags') }}"></i>
            {{ trans('Forum::messages.all') }}
        </span>
    </li>
    </a>

    @foreach(config('forum.topics') as $key => $topic)
        <a href="{{ route('forum.topic', $key) }}">
            <li>
                <span>
                    <i  class="{{ $topic['icon'] }}"
                        @if(isset($topic['color']))
                            style="background: {{ $topic['color'] }}"
                        @endif >
                    </i>
                    {{ $topic['name'] }}
                </span>
            </li>
        </a>
    @endforeach

</ul>

