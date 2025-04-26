<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.navigation', function ($view) {
            $unreads = 0;
    
            if (Auth::check()) {
                $unreads = Notification::where('user_id', Auth::id())->where('status', 'unread')->count();
            }
    
            $view->with('unreads', $unreads);
        });
    }
}
