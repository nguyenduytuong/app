<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Channels\DatabaseChannel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;
use Illuminate\Notifications\DatabaseNotification as BaseNotification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
        if (env('ENABLE_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel());
        // $this->app->instance(BaseNotification::class, new Notification());

        Relation::morphMap([
            'user' => User::class,
        ]);
    }
}
