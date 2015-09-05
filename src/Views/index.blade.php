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

            <div class="hidden-xs hidden-sm col-md-3 topics">

                 @include('Forum::Topics.index')

            </div>

            <div class="col-md-9 conversations">

                <ul>

                    @forelse($conversations as $conversation)

                        @include('Forum::Conversations.Partials.conversation')

                    @empty

                        @include('Forum::Partials.no-conversations')

                    @endforelse

                </ul>

                {!! $conversations->render() !!}

            </div>


        </div>

    </div>

@stop

