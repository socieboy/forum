<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Edit your reply</h4>
</div>

<form action="{{ route('forum.conversation.reply.edit', [$reply->conversation->slug, $reply->id]) }}" method="POST">

  <div class="modal-body">

      <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

      <input type="hidden" name="id" value="{{ $reply->id }}"/>

      <div class="form-group @if($errors->has('message')) has-error @endif">

        <textarea name="message" class="form-control" cols="30" rows="10">{{ $reply->message }}</textarea>

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
      {{ trans('Forum::messages.post') }}
    </button>

  </div>

</form>