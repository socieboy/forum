<?php

return [

    /*
     * Define the path to your master view on your "resources/view" folder.
     */

    'template'  => 'app',


    /*
     * Define @yield( $content ) area where the forum views will be displayed on your app.
     */

    'content'   => 'content',

    /*
     * Define topics for the forum
     */

    'topics' => [
        'general' => 'General',
    ],


    /**
     * User settings
     */

    'user' => [

        /**
         * Path to your user model.
         */

        'model'         => 'App\User',

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

        'username'    => 'name',


        /**
         * By default the forum uses gravatar.
         *
         * Set this to false to use your own avatars on the users table
         */

        'gravatar' => true,

        /*
         * If you don't want to use gravatar
         * Place this key to true to use your own avatars.
         */

        'avatar'        => false,

        /**
         * Required if the avatar key is true.
         *
         * Define the field avatar on your users table.
         */

        'user-avatar'  => 'avatar',



        /**
         * Require links to user profile
         */

        'profile' => false,

        /**
         * Route name to user profile.
         * Has to accept one parameter > user ID.
         */

        'profile-route' => 'forum.user.profile'

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


];
