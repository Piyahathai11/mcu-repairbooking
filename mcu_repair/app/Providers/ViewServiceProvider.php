<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {View::composer('*', function ($view) {
        $user = Auth::user();

        // Default sidebar if user is not logged in
        $sidebar = 'layouts.UserSidebar';

        if ($user) {
            if ($user->role === 'SUPER_ADMIN') {
                $sidebar = 'layouts.AdminSidebar';
            } elseif ($user->role === 'USER') {
                $sidebar = 'layouts.UserSidebar';
            }
        }

        // Share $sidebar with all views
        $view->with('sidebar', $sidebar);
    });
    }
}
