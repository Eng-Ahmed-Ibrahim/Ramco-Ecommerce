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
                'cart_count' => CartNumber() ,
                'social_media'=>Helpers::get_social_media(),
                'logos' => Helpers::get_logos(),
            ];

            $view->with('siteSettings', $siteSettings);
        });
            // Composer للـ admin.* فقط
    View::composer('admin.*', function ($view) {
        // اجلب عدد الطلبات مثلا
        $totalOrders = \App\Models\Order::count();
            $siteSettings = [
                'logos' => Helpers::get_logos(),

            ];
        $view->with('totalOrders', $totalOrders)->with('siteSettings', $siteSettings);
    });
    }
}
