<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Responses\RedirectToProfileAfterRegister;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use App\Http\Requests\Auth\LoginRequest as AppLoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FortifyLoginRequest::class, AppLoginRequest::class);
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        $this->app->singleton(RegisterResponse::class, RedirectToProfileAfterRegister::class);

        Fortify::registerView(fn () => view('auth.register'));
        Fortify::loginView(fn () => view('auth.login'));


        RateLimiter::for('login', function (Request $request) {
            $email = (string) ($request->email ?? 'guest');
            return Limit::perMinute(10)->by($email.$request->ip());
        });
    }
}
