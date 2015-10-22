<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="fa fa-times"></span></button>
                <h4 class="modal-title" id="title">Edit Post</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('forum.conversation.reply.edit', [$conversation->slug, $reply->id])}}" method="POST">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    <input type="hidden" name="reply_id" value="{{ $reply->id }}"/>

                    <label>Message</label>
                    <textarea rows="10" id="message" name="message" class="form-control"></textarea>

                    <input type="submit" class="btn btn-success"/>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Dismiss</button>
            </div>
        </div>
    </div>
</div>