<?php

Route::group(['prefix' => 'forum', 'namespace' => 'Socieboy\Forum\Controllers'], function ()
{
  Route::get('/', ['as' => 'forum', 'uses' => 'ForumController@index']);
  
  Route::get('/conversation/create', ['as' => 'forum.conversation.create', 'uses' => 'ConversationController@create']);
  
  Route::post('/conversation', ['as' => 'forum.conversation.store', 'uses' => 'ConversationController@store']);
  
  Route::get('/conversation/{slug}', ['as' => 'forum.conversation.show', 'uses' => 'ConversationController@show']);
  
  Route::post('/conversation/{slug}/reply', ['as' => 'forum.conversation.reply.store', 'uses' => 'RepliesController@store']);
  
  Route::post('/conversation/{slug}/reply/like', ['as' => 'forum.conversation.reply.like', 'uses' => 'LikesController@like']);
  
  Route::post('/conversation/{slug}/reply/unlike', ['as' => 'forum.conversation.reply.unlike', 'uses' => 'LikesController@unlike']);
  
  Route::post('/conversation/{slug}/reply/{conversation_user_id}/correct-answer', ['as' => 'forum.conversation.reply.correct-answer', 'uses' => 'RepliesController@correctAnswer']);
  
  Route::get('/{id}/profile', ['as' => 'forum.user.profile', 'uses' => 'ProfileController@show']);
});
