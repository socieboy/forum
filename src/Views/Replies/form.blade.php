<div class="form-reply">

        @include('Forum::Partials.avatar', ['user' => Auth::User()])
        <div class="form-post">
            <form action="{{ route('forum.conversation.reply.store', $conversation->slug) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}"/>

                <div class="form-group @if($errors->has('message')) has-error @endif">
                    <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                    @if($errors->has('message')) <p class="help-block">{{ $errors->first('message') }}</p> @endif
                </div>

                <a class="btn btn-default" href="{{ route('forum') }}">Back</a>
                <button type="submit" class="btn btn-primary pull-right">Post your reply</button>

            </form>
        </div>
</div>