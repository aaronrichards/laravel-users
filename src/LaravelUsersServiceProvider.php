<?php

namespace aaronrichards\laravelusers;

use Illuminate\Support\ServiceProvider;

class LaravelUsersServiceProvider extends ServiceProvider
{
    private $_packageTag = 'laravelusers';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views/', $this->_packageTag);
        $this->mergeConfigFrom(__DIR__.'/config/'.$this->_packageTag.'.php', $this->_packageTag);
        $this->publishFiles();
        $this->app->make('aaronrichards\laravelusers\App\Http\Controllers\UsersManagementController');
        $this->app->singleton(aaronrichards\laravelusers\App\Http\Controllers\UsersManagementController\UsersManagementController::class, function () {
            return new App\Http\Controllers\UsersManagementController();
        });
        $this->app->alias(UsersManagementController::class, 'laravelusers');
    }

    /**
     * Publish files for the package.
     *
     * @return void
     */
    private function publishFiles()
    {
        $publishTag = $this->_packageTag;

        $this->publishes([
            __DIR__.'/config/'.$this->_packageTag.'.php' => base_path('config/'.$this->_packageTag.'.php'),
        ], $publishTag);

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/'.$this->_packageTag),
        ], $publishTag);
    }
}
