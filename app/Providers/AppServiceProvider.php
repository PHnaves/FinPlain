<?php

namespace App\Providers;

use App\Models\Notificacao;
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
            $naoLidas = 0;
    
            if (Auth::check()) {
                $naoLidas = Notificacao::where('id_user', Auth::id())->where('lida', false)->count();
            }
    
            $view->with('naoLidas', $naoLidas);
        });
    }
}
