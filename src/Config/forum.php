<?php

return [
    /*
     * Define the path to your master view on your "resources/view" folder.
     */
    'template' => 'app',

    /*
     * Define @yield( $content ) area where the forum views will be displayed on your app.
     */
    'content'  => 'content',

    /*
     * Define topics for the forum.
     *
     * Create the key for each topic and assign an array with the name and the icon
     * The icon can be anyone of your prefer css framework like glyphicon or Font Awesome
     * Also you can and the key color, with the value of the representative color of the topic.
     */
    'topics'   => [
        'general' => [
            'name'  => 'General',
            'icon'  => 'glyphicon glyphicon-tags',
            'color' => 'rgb(78, 137, 218)',
        ],
    ],

    /**
     * Database configurations
     */
    'database' => [
        /**
         * Prefix for your tables
         */
        'prefix' => '',
    ],

    /**
     * User settings
     */
    'user'     => [
        /**
         * Path to your user model.
         */
        'model'         => \App\User::class,

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
        'username'      => 'name',

        /*
         * Place this key to true to use an avatar in the forum
         */
        'avatar'        => false,

        /**
         * By default the forum uses gravatar.
         *
         * Set this key false to use your own avatars on the users table
         */
        'gravatar'      => true,

        /**
         * If you are using your own avatars specify the name of the column on your users table where the path to the avatar is stored.
         */
        'user-avatar'   => 'avatar',

        /**
         * Require links to user profile
         */
        'profile'       => false,

        /**
         * Specify the slug or identifier of your users for the profile.
         */
        'profile-slug'  => 'id',

        /**
         * Route name to user profile.
         * Has to accept one parameter > user ID.
         */
        'profile-route' => 'forum.user.profile',
    ],

    /**
     * User authentication
     */
    'auth'     => [
        /**
         * Redirect to the login form.
         */
        'login-url' => 'login',
    ],

    /**
     * Set your own icons of your prefer font
     * By default we use icons from bootstrap
     */
    'icons'    => [
        'correct-answer' => 'glyphicon glyphicon-ok',
        'delete'         => 'glyphicon glyphicon-trash',
        'edit'           => 'glyphicon glyphicon-pencil',
        'like'           => 'glyphicon glyphicon-thumbs-up',
        'tags'           => 'glyphicon glyphicon-tags',
        'home'           => 'glyphicon glyphicon-thome',
    ],

    /**
     * Send an email to the conversation owner each time someone left a reply
     */
    'emails'   => [
        'fire'      => false,
        /**
         * Set the email from
         */
        'from'      => '',
        'from-name' => 'Admin',
        'subject'   => 'Forum',
    ],

    /**
     * Fire events and broadcast them.
     */
    'events'   => [
        'fire'      => true,
        'broadcast' => false,
    ],
];
