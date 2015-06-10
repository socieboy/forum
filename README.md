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
This command will create three migration files, for conversations, replies, and like_replies. Then just excute your migration.
```
php artisan migrate
```

## Configuration

1.- if you are using less and the app.less file integrated with laravel just import the forum.less file to your app.less

2.- on the config/forum.php file, set the right information of your app.

a.- This is the master template view of your project. Laravel by default has a file app.blade.php on your views folder, whish is referenced on the forum configuration by the key template.

```
    'template'  => 'app',
```

b.- The key content is the name of your yield tag on your template file.
```
    'content'   => 'content',
```

With those values the forum can be adapted to your project really easy and match with your application design.

c.- Define the array of topics for your forum. (By default this include just the general tag, you can add as many you want)
```
    'topics' => [
        'general' => 'General',
    ],
```

d.- The user configuration with the forum includes.

The key model, set the namespace + class name of your users model. By default is App\User as Laravel use.
```
'model'         => 'App\User',
```
The key username is the field on your users table that would be used to display the nake of the user who post a conversation or reply other conversation. you can set any field like email, username, full_name, name, etc.
```
    'username'    => 'name',
```

e.- Do you have avatars for the users on your project. (Set the key avatar to true/false if you want to use avatars).
```
   'avatar'        => true,
```
Then define the field where the url or link to the image/avatar is saved.
```
   'user-avatar'  => 'avatar',
```
f.- If you want to include link to profile users, (When you hit the avatar or the name of other users display a user profile)
```
   'profile' => true,
```

By the fault the forum include a simple user profile. If you want to implement your own just set the route name on this key, ust make sure that the route name recive the ID of the user.
```
'profile-route' => 'forum.user.profile'
```

You are ready to go!

hit the route your-domain.com/forum
