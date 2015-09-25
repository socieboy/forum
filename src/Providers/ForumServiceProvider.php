<?php
namespace Reflex\Forum\Providers;

use Illuminate\Support\ServiceProvider;
use Reflex\Forum\Commands\MigrateForumCommand;
use Illuminate\Support\Facades\App;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishFiles();
        $this->shareGlobalVariables();
        $this->loadViewsFrom(__DIR__ . '/../Views', 'Forum');
        $this->loadTranslationsFrom(__DIR__ . '/../Lang', 'Forum');

        $this->app->bind(
          'Reflex\Forum\Entities\Auth\AuthRepositoryInterface',
          config('forum.auth-repo')
        );
    }

    /**
     * Register the application services.
     *
     * @return void
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
        include __DIR__ . '/../routes.php';
    }

    /**
     * Publish config files for the forum.
     */
    protected function publishFiles()
    {
        $this->publishes(
            [
                __DIR__ . '/../Config/forum.php' => base_path('config/forum.php'),
                __DIR__ . '/../Style/forum' => base_path('resources/assets/less/forum'),
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

        $auth = $this->app->make('Reflex\Forum\Entities\Auth\AuthRepositoryInterface');
        view()->share('loggedIn', $auth->check());
        view()->share('currentUser', $auth->getActiveUser());
    }
}
