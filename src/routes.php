<?php

Route::group(
    ['prefix' => 'forum', 'namespace' => 'Socieboy\Forum\Controllers'],
    function () {
        /**
         * Route GET for the main page
         */
        get(
            '/',
            [
                'as' => 'forum',
                'uses' => 'ForumController@index'
            ]
        );

        /**
         * Route GET to filter conversations by topic
         */
        get(
            '/topic/{topic}',
            [
                'as' => 'forum.topic',
                'uses' => 'ForumController@topic'
            ]
        );

        /**
         * Route POST to search or filter conversations
         */
        post(
            '/search',
            [
                'as' => 'forum.search',
                'uses' => 'ForumController@search'
            ]
        );

        /**
         * Route POST to store a new conversation
         */
        post(
            '/conversation',
            [
                'as' => 'forum.conversation.store',
                'uses' => 'ConversationController@store'
            ]
        );

        /**
         * Route GET to show a conversation
         */
        get(
            '/conversation/{slug}',
            [
                'as' => 'forum.conversation.show',
                'uses' => 'ConversationController@show'
            ]
        );

        /**
         * Route GET to edit a conversation
         */
        get('/conversation/{slug}/edit', [
            'as' => 'forum.conversation.edit',
            'uses' => 'ConversationController@edit'
        ]);

        /**
         * Route POST to edit a conversation
         */
        post('/conversation/{slug}/edit', [
            'as' => 'forum.conversation.edit',
            'uses' => 'ConversationController@update'
        ]);

        /**
         * Route POST to store a new reply
         */
        post(
            '/conversation/{slug}/reply',
            [
                'as' => 'forum.conversation.reply.store',
                'uses' => 'RepliesController@store'
            ]
        );

        /**
         * Route POST to do like a reply
         */
        post(
            '/conversation/{slug}/reply/like',
            [
                'as' => 'forum.conversation.reply.like',
                'uses' => 'LikesController@like'
            ]
        );

        /**
         * Route POST to do unlike a reply
         */
        post(
            '/conversation/{slug}/reply/unlike',
            [
                'as' => 'forum.conversation.reply.unlike',
                'uses' => 'LikesController@unlike'
            ]
        );

        /**
         * Route POST to check correct answer
         */
        post(
            '/conversation/{slug}/reply/{conversation_user_id}/correct-answer',
            [
                'as' => 'forum.conversation.reply.correct-answer',
                'uses' => 'RepliesController@correctAnswer'
            ]
        );

        /**
         * Route GET to edit a reply
         */
        get('/conversation/{slug}/reply/{reply_id}/edit', [
            'as' => 'forum.conversation.reply.edit',
            'uses' => 'RepliesController@edit'
        ]);

        /**
         * Route POST to edit a reply
         */
        post('/conversation/{slug}/reply/{reply_id}/edit', [
            'as' => 'forum.conversation.reply.edit',
            'uses' => 'RepliesController@update'
        ]);

        /**
         * Route POST to destroy a reply
         */
        post('/conversation/{slug}/reply/{reply_id}/destroy', [
            'as' => 'forum.conversation.reply.destroy',
            'uses' => 'RepliesController@destroy'
        ]);


        /**
         * Route to profile.
         */
        get(
            '/{id}/profile',
            [
                'as' => 'forum.user.profile',
                'uses' => 'ProfileController@show'
            ]
        );
    }
);
