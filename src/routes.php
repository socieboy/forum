<?php

Route::group(['prefix' => 'forum'], function ()
{
  Route::get('/', ['as' => 'forum', 'uses' => 'Socieboy\Forum\Controllers\ForumController@index']);
  
  Route::get('/conversation/create', ['as' => 'forum.conversation.create', 'uses' => 'Socieboy\Forum\Controllers\ConversationController@create']);
  
  Route::post('/conversation', ['as' => 'forum.conversation.store', 'uses' => 'Socieboy\Forum\Controllers\ConversationController@store']);
  
  Route::get('/conversation/{slug}', ['as' => 'forum.conversation.show', 'uses' => 'Socieboy\Forum\Controllers\ConversationController@show']);
  
  Route::post('/conversation/{slug}/reply', ['as' => 'forum.conversation.reply.store', 'uses' => 'Socieboy\Forum\Controllers\RepliesController@store']);
  
  Route::post('/conversation/{slug}/reply/like', ['as' => 'forum.conversation.reply.like', 'uses' => 'Socieboy\Forum\Controllers\LikesController@like']);
  
  Route::post('/conversation/{slug}/reply/unlike', ['as' => 'forum.conversation.reply.unlike', 'uses' => 'Socieboy\Forum\Controllers\LikesController@unlike']);
  
  Route::post('/conversation/{slug}/reply/{conversation_user_id}/best-answer', ['as' => 'forum.conversation.reply.best-answer', 'uses' => 'Socieboy\Forum\Controllers\RepliesController@correctAnswer']);
  
  Route::get('/{id}/profile', ['as' => 'forum.user.profile', 'uses' => 'Socieboy\Forum\Controllers\ProfileController@show']);
});
