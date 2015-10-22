@if($loggedIn && ($reply->user_id == $currentUser->id || $auth->can('forum-edit-post')))

	<button data-toggle="modal" data-target="#editModal" class="{{ config('forum.icons.edit') }} edit-reply"></button>

	@include('Forum::Replies.Partials.Actions.edit-modal', ['conversation' => $conversation, 'reply' => $reply])

@endif

