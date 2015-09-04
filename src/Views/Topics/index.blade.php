
<ul>

    <li>
        <span>
            <i class="glyphicon glyphicon-tags"></i>
            {{ trans('Forum::messages.all') }}
        </span>
    </li>

    @foreach( config('forum.topics') as $key => $topic)

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

    @endforeach

</ul>

