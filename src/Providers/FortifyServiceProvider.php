<?php

namespace Pivlu\Providers;

use Pivlu\Actions\Fortify\CreateNewUser;
use Pivlu\Actions\Fortify\ResetUserPassword;
use Pivlu\Actions\Fortify\UpdateUserPassword;
use Pivlu\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        
        Fortify::loginView(function () {
            return view('pivlu::auth.login', []);
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('pivlu::auth.forgot-password');
        });

        Fortify::resetPasswordView(function (Request $request) {
            return view('pivlu::auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('pivlu::auth.verify-email');
        });

        Fortify::confirmPasswordView(function () {
            return view('pivlu::auth.confirm-password');
        });


        Fortify::registerView(function () {
            return view('pivlu::auth.register');
        });

        // register new RegisterResponse
        $this->app->singleton(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            \Pivlu\Cms\Http\Auth\RegisterResponse::class
        );


        // register new LoginResponse
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LoginResponse::class,
            \Pivlu\Cms\Http\Auth\LoginResponse::class
        );

        // register new LogoutResponse
        $this->app->singleton(
            \Laravel\Fortify\Contracts\LogoutResponse::class,
            \Pivlu\Cms\Http\Auth\LogoutResponse::class
        );


        // register new TwofactorLoginResponse
        $this->app->singleton(
            \Laravel\Fortify\Contracts\TwoFactorLoginResponse::class,
            \Pivlu\Cms\Http\Auth\LoginResponse::class
        );
    }
}
