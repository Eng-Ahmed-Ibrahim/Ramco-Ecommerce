<?php 
namespace App\Console\Commands;

use App\Models\Setting;
use App\Helpers\Helpers;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RefreshAppCache extends Command
{
    protected $signature = 'custom:refresh-cache';
    
    protected $description = 'Rebuild custom app cache (settings, categories, etc)';

    public function handle()
    {
        $this->info('🔁 Refreshing custom cache...');

        Helpers::cache_categories();
        Helpers::cache_sub_categories();
        Helpers::cache_home_banner();
        Helpers::cache_best_products();
        Helpers::cache_best_sellers();
    
        $this->info('✅ Custom cache updated!');
    }
}
