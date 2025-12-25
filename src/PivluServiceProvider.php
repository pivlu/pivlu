<?php

namespace Pivlu\Cms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Pivlu\Cms\Providers\FortifyServiceProvider;
use Pivlu\Cms\Console\Commands\InstallCommand;
use Pivlu\Cms\Console\Commands\UpdateCommand;
use Pivlu\Cms\Console\Commands\CreateSamplePostsCommand;
use Pivlu\Cms\Http\Middleware\CheckWebsiteMiddleware;
use Pivlu\Cms\Http\Middleware\LoggedIsInternalMiddleware;
use Pivlu\Cms\Http\Middleware\LoggedMiddleware;
use Pivlu\Cms\Http\Middleware\LoggedIsAdminMiddleware;
use Pivlu\Cms\Http\Middleware\LoggedIsRegisteredMiddleware;
use Pivlu\Cms\Http\Middleware\ThemeMiddleware;

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
      $this->app['router']->aliasMiddleware('check_website.middleware', CheckWebsiteMiddleware::class);
      $this->app['router']->aliasMiddleware('logged_is_internal.middleware', LoggedIsInternalMiddleware::class);
      $this->app['router']->aliasMiddleware('logged_is_admin.middleware', LoggedIsAdminMiddleware::class);
      $this->app['router']->aliasMiddleware('logged.middleware', LoggedMiddleware::class);
      $this->app['router']->aliasMiddleware('logged_is_registered.middleware', LoggedIsRegisteredMiddleware::class);
      $this->app['router']->aliasMiddleware('theme.middleware', ThemeMiddleware::class);

      // Publish configuration file.
      $this->publishes([
         __DIR__ . '/../config/pivlu.php' => config_path('pivlu/pivlu.php'),
         __DIR__ . '/../config/blocks.php' => config_path('pivlu/blocks.php'),
      ], 'config');

      // Register routes.
      $this->registerRoutes();

      // Register views.
      $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pivlu');

      // Publish assets.
      $this->publishes([
         __DIR__ . '/../resources/assets/' => public_path('assets'),
      ], 'assets'); // <- The tag ("assets") is defined here will be used in `php artisan vendor:publish --tag=assets` command.

      // Publish migrations.
      $this->publishes([
         __DIR__ . '/../database/migrations' => database_path('migrations'),
      ], 'migrations');  // <- The tag ("migrations") is defined here will be used in `php artisan vendor:publish --tag=migrations` command.

      /*
      // Publish views.
      $this->publishes([
         __DIR__ . '/resources/views' => resource_path('views/vendor/pivlu/cms'),
      ], 'views');  // <- The tag ("views") is defined here will be used in `php artisan vendor:publish --tag=views` command.
      */

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
      //$this->app->register(PermissionServiceProvider::class);

      // Merge configuration.
      //$this->mergeConfigFrom(__DIR__ . '/config/pivlu/pivlu.php','pivlu');
      //$this->mergeConfigFrom(__DIR__ . '/config/permission.php','permission');
   }

   protected function registerRoutes()
   {
      Route::group($this->routeAdminConfiguration(), function () {
         $this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
      });

      Route::group($this->routeWebConfiguration(), function () {
         $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
      });
   }

   protected function routeAdminConfiguration()
   {
      return [
         'middleware' => ['web', 'auth', 'verified', 'logged.middleware', 'logged_is_internal.middleware'],
      ];
   }

   protected function routeWebConfiguration()
   {
      return [
         'middleware' => ['web', 'logged.middleware', 'theme.middleware', 'check_website.middleware'],
      ];
   }
}
