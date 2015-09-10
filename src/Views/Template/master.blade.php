@extends($template)
@section($content)


    <div class="forum" id="socieboy">

        <div class="row header">

            <div class="col-md-3">

                @if(auth()->check())

                    @include('Forum::Conversations.create')

                @else

                    @include('Forum::Partials.login-button')

                @endif

            </div>

            <div class="col-md-9">

                @include('Forum::Partials.top-bar')

            </div>

        </div>


        <div class="row body">

            @yield('forum-content')

        </div>

    </div>

@stop
