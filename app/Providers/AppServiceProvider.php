<?php

namespace App\Providers;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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
        View::composer('web.*', function ($view) {
            $siteSettings = [
                'categories' => Helpers::get_categories(),
            ];

            $view->with('siteSettings', $siteSettings);
        });
    }
}
