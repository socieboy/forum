{{ session()->put('url.intended', route('forum')) }}
<a href="{{ url(config('forum.auth.login-url')) }}" class="btn btn-block btn-success">
    {{ trans('Forum::messages.log-in') }}
</a>

