@foreach(config('forum.topics') as $key => $value)
    <ul>
        <a href=""><li>{{ $value }}</li></a>
    </ul>
@endforeach