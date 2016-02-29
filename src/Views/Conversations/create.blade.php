<a type="button" href="{{ route('forum') }}" class="btn btn-primary">
    <i class="{{ config('forum.icons.home') }}"></i>
</a>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#start-conversation-modal">
    {{ trans('Forum::messages.new-conversation') }}
</button>

<div class="modal fade" id="start-conversation-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Start a Conversation</h4>
            </div>

            <form action="{{ route('forum.conversation.store') }}" method="POST">

                <div class="modal-body">

                    @include('Forum::Conversations.Partials.form')

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

        </div>
    </div>
</div>
