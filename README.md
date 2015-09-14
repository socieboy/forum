# Socieboy Forum
Package for Laravel 5.1

[![Total Downloads](https://poser.pugx.org/socieboy/forum/d/total.svg)](https://packagist.org/packages/socieboy/forum)
[![Latest Stable Version](https://poser.pugx.org/socieboy/forum/v/stable.svg)](https://packagist.org/packages/socieboy/forum)
[![Latest Unstable Version](https://poser.pugx.org/socieboy/forum/v/unstable.svg)](https://packagist.org/packages/socieboy/forum)
[![License](https://poser.pugx.org/socieboy/forum/license.svg)](https://packagist.org/packages/socieboy/forum)

## Features

- Create conversations.
- Reply existing conversations.
- Support for gravatar and custom avatars.
- Fire email to the conversation owner when some user left a reply.
- Broadcast notifications to the conversation owner when someone left a reply.
- Include LESS files.

## Installation

1.- Add to composer.json file the package
```
"socieboy/forum" : "1.0.*"
```

2.- After installing this package, you have to set the service provider on your config/app.php file
```
Socieboy\Forum\Providers\ForumServiceProvider::class,
```

3.- Publish the forum config file on your config folder and publish the default template to your resources/assets/less/ folder, hit the follow command.
```
php artisan vendor:publish
```

4.- Create migrations for the forum, make sure you have a migration already created for users. Type the command:
```
php artisan forum:migrate
```
This command will create the migration files, for conversations, replies, and like_replies. Then just execute your migration:
```
php artisan migrate
```

## Configuration

### General

The forum provides a simple custom template, this is published on the resoruces/assets directory, feel free to edit.

On the config/forum.php file, set the right information of your app.

### Template

This is the master template view of your project:
```
'template'  => 'app',
```

The key content is the name of your yield tag on your master template file where you would like to display the forum:
```
'content'   => 'content',
```

With those values the forum can be adapted to your project really easily and match your application design.


### Topics

Define the array of topics for your forum.
Now you can define the key for the topic, give a name and the representative icon for the topic, you can use any font class of your preference here.
Also you can set the representative color for this topic in the las parameter (color is optional).
```
'topics' => [
    'general' => [
        'name' => 'General',
        'icon' => 'fa fa-tags',
        'color' => 'rgb(78, 137, 218)'
    ]
],
```

### Database

Customatize your own prefix for the forum database tables.
```
'database' => [
    'prefix' => 'forum'
],
```

### User settings

The user configuration with the forum includes.

The model key, set the namespace + class name of your users model. By default is App\User as Laravel uses.
```
'model'         => \App\User::class,
```

The username key is the field on your users table that would be used to display the name of the user who post a conversation/reply. You can set any field like email, username, full_name, name, etc, (Must be a field on your users table).
```
'username'    => 'name',
```

Do you have avatars for the users on your project? (Set the key avatar to true if you want to use avatars).
```
'avatar'        => true,
```

If you prefer to use gravatar for your avatars set the key gravatar to true.
```
'gravatar' => true,
```

If you want to use your own avatars, then define the field on your users table where the url to the image (avatar) is stored.
```
'user-avatar'  => 'avatar',
```

If you want to include link to profile users, (When you hit the avatar or the name of other users display a user profile)
```
'profile' => true,
```

By the fault the forum include a simple user profile. If you want to implement your own just set the route name on this key, just make sure that the route name recive the ID of the user.
```
'profile-route' => 'forum.user.profile'
```

Now if the user is not log in, the button for start a conversation will redirect the user to your login page, just set the url of your login page in this key. 
```
'auth' => [
    'login-url' => 'auth/login'
],
```

If you want you can change the icons to do like and choise the best answer on replies.
```
'icons' => [
    'like'              => 'glyphicon glyphicon-thumbs-up',
    'correct-answer'    => 'glyphicon glyphicon-ok',
],
```

### Emails

On the array emails are 4 different values.

The key fire is set by the default false, no email would be fired when someone left a reply. Change to true if you want to implement fire emails to the conversation owner when some user left a reply.
```
'fire' => false,
```

The from key is the email of the admin of your app or whatever account that wouldbe used to send the emails.
```
'from' => '',
```

The from-name key is the real name of the administrator of the forum or who is going to send the emails.
```
'from-name' => '',
```

Finally just set the subject for the emails fired.
```
'subject' => 'My app Forum - you have a new reply on your post',
```


### Broadcasting events

When some user left a reply on the conversation, the owner of the conversation will receive an notification on real time only if he is in the application.

Set the key broadcasting to true on the forum config file and also add your Pusher keys to the broadcasting config file of Laravel.
https://pusher.com/
```
'broadcasting' => false,
```

Also on the bottom of you app or where your scripts section is located add this code.
```
@include('Forum::Broadcasting.index');
```

Now that's it, easy and you are ready to go!

http://socieboy.com/forum


### Help with translations

Currently the forum is developed in English and Spanish language but it's already configured to support other languages, if you want to contribute in this package with your native language copy the folder
src/Lang/en/ and translate all keys to your language and send a pull request.