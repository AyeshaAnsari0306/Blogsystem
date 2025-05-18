<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;  
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Route;


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
    public function boot()
    {
        Gate::define('admin', function ($user) {
            return $user->is_admin;
        });
        Event::listen(
            Registered::class,
            SendEmailVerificationNotification::class
        );
        
        Route::middleware('web') // <== ADD THIS IF MISSING
            ->group(base_path('routes/auth.php'));
    }
}
