
<div class="container">

    <i class="glyphicon glyphicon-tags"></i>
    <ul>
        <li class="active">All</li>
    @foreach( config('forum.topics') as $key => $value)

        <li>{{ $value }}</li>

    @endforeach

    </ul>

</div>