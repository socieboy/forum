
<ul>
    <a href="{{ url('forum') }}">
    <li>
        <span>
            <i class="{{ config('forum.icons.tags') }}"></i>
            {{ trans('Forum::messages.all') }}
        </span>
    </li>
    </a>

    @foreach($categories as $category)
        <a href="{{ route('forum.topic', $category->slug) }}">
            <li>
                <span>
                    <i  class="{{ $category->icon }}"
                        @if(isset($category->color))
                            style="background: {{ $category->color }}"
                        @endif >
                    </i>
                    {{ $category->name }}
                </span>
            </li>
        </a>
    @endforeach

</ul>

