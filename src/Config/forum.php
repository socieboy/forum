<?php

return [
    /*
     * Define the path to your master view on your "resources/view" folder.
     */
    'template' => 'app',

    /*
     * Define @yield( $content ) area where the forum views will be displayed on your app.
     */
    'content' => 'content',

    /*
     * Define topics for the forum.
     *
     * Create the key for each topic and assign an array with the name and the icon
     * The icon can be anyone of your prefer css framework like glyphicon or Font Awesome
     * Also you can and the key color, with the value of the representative color of the topic.
     */
    'topics' => [
        'general' => [
            'name' => 'General',
            'icon' => 'glyphicon glyphicon-tags',
            'color' => 'rgb(78, 137, 218)'
        ]
    ],

    /**
     * Database configurations
     */
    'database' => [
        /**
         * Prefix for your tables
         */
        'prefix' => 'forum'
    ],

    /**
     * User settings
     */
    'user' => [
        /**
         * Path to your user model.
         */
        'model' => \App\User::class,

        /**
         * Define the field on your table user that the forum will use to display the identify user.
         *
         *  examples:
         *
         *  username
         *  name
         *  full_name
         *  email
         *
         *  etc...
         */
        'username' => 'name',

        /*
         * If you don't want to use gravatar
         * Place this key to true to use your own avatars.
         */
        'avatar' => false,

        /**
         * Need avatars on your forum.
         */
        'user-avatar' => 'avatar',

        /**
         * By default the forum uses gravatar.
         *
         * Set this to false to use your own avatars on the users table
         */
        'gravatar' => true,

        /**
         * Require links to user profile
         */
        'profile' => false,

        /**
         * Route name to user profile.
         * Has to accept one parameter > user ID.
         */
        'profile-route' => 'forum.user.profile',
    ],

    /**
     * User authentication
     */
    'auth' => [
        /**
         * Redirect to the login form.
         */
        'login-url' => 'auth/login'
    ],

    /**
     * Set your own icons of your prefer font
     * By default we use icons from bootstrap
     */
    'icons' => [
        'correct-answer'    => 'glyphicon glyphicon-ok',
        'delete'            => 'glyphicon glyphicon-trash',
        'edit'              => 'glyphicon glyphicon-pencil',
        'like'              => 'glyphicon glyphicon-thumbs-up',
        'tags'              => 'glypicon glyphicon-tags'
    ],

    /**
     * Send an email to the conversation owner each time someone left a reply
     */
    'emails' => [
        'fire' => false,
        /**
         * Set the email from
         */
        'from' => '',
        'from-name' => 'Admin',
        'subject' => 'Forum'
    ],

    /**
     * For broadcasting events you must set pusher keys.
     */
    'broadcasting' => false,
];
