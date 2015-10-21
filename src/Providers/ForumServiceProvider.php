<?php

namespace Reflex\Forum\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Reflex\Forum\Commands\MigrateForumCommand;
use Reflex\Forum\Entities\Categories\CategoryRepo;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishFiles();
        $this->loadViewsFrom(__DIR__.'/../Views', 'Forum');
        $this->loadTranslationsFrom(__DIR__.'/../Lang', 'Forum');

        $this->app->bind(
          'Reflex\Forum\Entities\Auth\AuthRepositoryInterface',
          config('forum.auth-repo')
        );

        $this->shareGlobalVariables();
        $this->shareTemplateVariables();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        App::register(\EasySlug\EasySlug\EasySlugServiceProvider::class);

        $this->app->bindShared(
            'command.forum.table',
            function ($app) {
                return new MigrateForumCommand();
            }
        );

        $this->commands('command.forum.table');
        include __DIR__.'/../routes.php';
    }

    /**
     * Publish config files for the forum.
     */
    protected function publishFiles()
    {
        $this->publishes(
            [
                __DIR__.'/../Config/forum.php' => base_path('config/forum.php'),
                __DIR__.'/../Style/forum' => base_path('resources/assets/less/forum'),
            ]
        );
    }

    /**
     * Share variables across the views.
     */
    protected function shareGlobalVariables()
    {
        view()->share('template', config('forum.template'));
        view()->share('content', config('forum.content'));

        $auth = $this->app->make(config('forum.auth-repo'));
        view()->share('loggedIn', $auth->check());
        view()->share('currentUser', $auth->getActiveUser());
    }

    /**
     * Share template variables.
     */
    public function shareTemplateVariables()
    {
        $views = [
            'Forum::Partials.topics-menu',
            'Forum::Topics.index',
            'Forum::Conversations.Partials.form',
        ];
        view()->composer($views, function ($view) {
            $repo = new CategoryRepo();
            $categories = $repo->all();
            $view->with('categories', $categories);
        });
    }
}
