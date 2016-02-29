@extends('Forum::Template.master')
@section('forum-content')

<div class="col-md-12">


    <div class="row items">

                @include('Forum::Conversations.Partials.question')

                <div class="divsor">
                        {{
                            trans('Forum::messages.replies-counter', [
                                'replies' => $conversation->replies->count(),
                                'best-answer' => 0
                            ])
                        }}
                </div>

                @include('Forum::Conversations.Partials.correct-answer')

                @foreach($replies as $reply)

                    @include('Forum::Replies.show')

                @endforeach

                <div class="col-md-12">
                    {!! $replies->render() !!}
                </div>

                @if(auth()->check())

                    @include('Forum::Replies.form')

                @endif

            </div>


</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

@stop