<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $view->with('user', $user);
                
                //Add today's follow-ups count to all views
                $todayFollowUpsCount = $user->clients()
                    ->whereDate('next_follow_up', today())
                    ->count();
                $view->with('todayFollowUpsCount', $todayFollowUpsCount);
            }
        });
    }
}