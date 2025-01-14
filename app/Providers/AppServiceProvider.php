<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;


class AppServiceProvider extends ServiceProvider
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
        Gate::define('is-admin', function(User $user) {
            return $user->is_admin == 1 ? Response::allow() : Response::deny('You must be an administrator or higher.');

        });

        Gate::define('is-user', function(User $user) {
            return $user->is_admin == 0 ? Response::allow() : Response::deny('Please Use User Account to Continue.');

        });

    }
}
