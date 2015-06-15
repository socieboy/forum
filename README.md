# Laravel Forum Integration Package

## Installation

1.- Add to composer.json file the package
```
"socieboy/forum" : "dev-master"
```

2.- After install this package you ahve to set the service provider on your config/app.php file
```
'Socieboy\Forum\Providers\ForumServiceProvider',
```

3.- Publish the forum config file on your config folder and publish the default template to your resources/assets/less/ folder, hit the fallow command.
```
php artisan vendor:publish
```

4.- Create migrations for the forum, make sure you have a migration already created for users. Type the command:
```
php artisan forum:migrate
```
This command will create the migration files, for conversations, replies, and like_replies. Then just excute your migration.
```
php artisan migrate
```

## Configuration

#### General

The forum provide a simple custom template, this is published on the resoruces/assets directory, feel free to edit.

On the config/forum.php file, set the right information of your app.

#### Template

This is the master template view of your project.
```
    'template'  => 'app',
```

The key content is the name of your yield tag on your master template file where you would like to have display the forum.
```
    'content'   => 'content',
```

With those values the forum can be adapted to your project really easy and match with your application design.


#### Topics or Categories

Define the array of topics for your forum. (By default this include just the general tag, you can add as many you want)
```
    'topics' => [
        'general' => 'General',
    ],
```

#### User settings

The user configuration with the forum includes.

The model key, set the namespace + class name of your users model. By default is App\User as Laravel use.
```
'model'         => 'App\User',
```

The username key is the field on your users table that would be used to display the name of the user who post a conversation/reply. You can set any field like email, username, full_name, name, etc, (Must be a field on your users table).
```
    'username'    => 'name',
```

Do you have avatars for the users on your project. (Set the key avatar to true if you want to use avatars).
```
   'avatar'        => true,
```

Then define the field on your users table where the url to the image (avatar) is stored.
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

#### Emails

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

No that's it, easy and you are ready to go!
