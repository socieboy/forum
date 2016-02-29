<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Edit your question</h4>
</div>

<form action="{{ route('forum.conversation.edit', [$conversation->slug]) }}" method="POST">

  <div class="modal-body">

      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

      <input type="hidden" name="slug" value="{{ $conversation->slug }}"/>

      <div class="form-group @if($errors->has('title')) has-error @endif">

        <label for="title">{{ trans('Forum::messages.title') }}</label>

        <input type="text" name="title" class="form-control" value="{{ $conversation->title }}" />

        @if($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif

      </div>

      <div class="form-group @if($errors->has('message')) has-error @endif">

        <label for="message">{{ trans('Forum::messages.message') }}</label>

        <textarea name="message" class="form-control" cols="30" rows="10">{{ $conversation->message }}</textarea>

        @if($errors->has('message'))
          <p class="help-block">
            {{ $errors->first('message') }}
          </p>
        @endif

      </div>

  </div>

  <div class="modal-footer">

    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
      {{ trans('Forum::messages.cancel') }}
    </button>

    <button type="submit"  class="btn btn-success">
      {{ trans('Forum::messages.post-conversation') }}
    </button>

  </div>

</form>