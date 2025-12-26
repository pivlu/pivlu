<?php

namespace Pivlu\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Pivlu\Providers\FortifyServiceProvider;
use Pivlu\Providers\ViewServiceProvider;
use Pivlu\Console\Commands\InstallCommand;
use Pivlu\Console\Commands\UpdateCommand;
use Pivlu\Console\Commands\CreateSamplePostsCommand;
use Pivlu\Http\Middleware\WebsiteMiddleware;
use Pivlu\Http\Middleware\LoggedIsInternalMiddleware;
use Pivlu\Http\Middleware\LoggedMiddleware;
use Pivlu\Http\Middleware\LoggedIsAdminMiddleware;
use Pivlu\Http\Middleware\LoggedIsRegisteredMiddleware;
use Pivlu\Models\Module;

class PivluServiceProvider extends ServiceProvider
{

   public function boot()
   {
      // Implicitly grant "admin" role all permission checks using can()
      Gate::before(function ($user, $ability) {
         if ($user->hasRole('admin')) {
            return true;
         }
      });

      Paginator::useBootstrapFive();

      // Register our package's middlewares.
      $this->app['router']->aliasMiddleware('website_middleware', WebsiteMiddleware::class);
      $this->app['router']->aliasMiddleware('logged_middleware', LoggedMiddleware::class);
      $this->app['router']->aliasMiddleware('logged_is_internal_middleware', LoggedIsInternalMiddleware::class);
      $this->app['router']->aliasMiddleware('logged_is_admin_middleware', LoggedIsAdminMiddleware::class);
      $this->app['router']->aliasMiddleware('logged_is_registered_middleware', LoggedIsRegisteredMiddleware::class);

      // Publish configuration file.
      $this->publishes([
         __DIR__ . '/../../config/pivlu.php' => config_path('pivlu/pivlu.php'),
         __DIR__ . '/../../config/blocks.php' => config_path('pivlu/blocks.php'),
      ], 'config');

      // Register routes.
      $this->registerRoutes();

      // Register views.
      $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'pivlu');

      // Publish assets.
      $this->publishes([__DIR__ . '/../../resources/assets/' => public_path('assets')], 'assets'); // <- The tag ("assets") is defined here will be used in `php artisan vendor:publish --tag=assets` command.

      // Publish migrations.
      $this->publishes([__DIR__ . '/../../database/migrations' => database_path('migrations')], 'migrations');  // <- The tag ("migrations") is defined here will be used in `php artisan vendor:publish --tag=migrations` command.

      if ($this->app->runningInConsole()) {
         // Register commands.
         $this->commands([
            InstallCommand::class,
            UpdateCommand::class,
            CreateSamplePostsCommand::class,
         ]);
      }
   }


   public function register()
   {
      $this->app->register(FortifyServiceProvider::class);
      $this->app->register(ViewServiceProvider::class);

      // Merge configuration.
      $this->mergeConfigFrom(__DIR__ . '/../../config/core.php', 'pivlu_core');
      //$this->mergeConfigFrom(__DIR__ . '/config/pivlu/pivlu.php','pivlu');
      //$this->mergeConfigFrom(__DIR__ . '/config/permission.php','permission');
   }

   protected function registerRoutes()
   {
      Route::group($this->routeAdminConfiguration(), function () {
         $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');
      });

      Route::group($this->routeWebConfiguration(), function () {
         $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
      });
   }

   protected function routeAdminConfiguration()
   {
      return [
         'middleware' => ['web', 'auth', 'verified', 'logged_middleware', 'logged_is_internal_middleware'],
      ];
   }

   protected function routeWebConfiguration()
   {
      return [
         'middleware' => ['web', 'logged.middleware', 'website_middleware'],
      ];
   }
}
