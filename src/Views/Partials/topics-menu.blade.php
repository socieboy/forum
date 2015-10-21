@foreach($categories as $category)
    <ul>
        <a href=""><li>{{ $category->slug }}</li></a>
    </ul>
@endforeach