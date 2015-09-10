@extends('Forum::Template.master')
@section('forum-content')

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


</div>

<div class="col-md-12">

    {!! $conversations->render() !!}

</div>


@stop

