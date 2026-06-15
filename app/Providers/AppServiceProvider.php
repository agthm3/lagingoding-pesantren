<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Kontak;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share unread count helper globally to dashboard layout if the table exists
        if (Schema::hasTable('kontaks')) {
            View::composer('layouts.dashboard', function ($view) {
                $unreadKontakCount = Kontak::where('is_read', false)->count();
                $view->with('unreadKontakCount', $unreadKontakCount);
            });
        }
    }
}