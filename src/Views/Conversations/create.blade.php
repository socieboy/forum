
<button type="button" class="btn btn-success start-conversation" data-toggle="modal" data-target="#start-conversation-modal">
    Start a Conversation
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

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit"  class="btn btn-default">Post conversation</button>

                </div>

            </form>

        </div>
    </div>
</div>
