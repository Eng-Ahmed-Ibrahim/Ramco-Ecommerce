<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings=[
            [
                "key"=>"site_header_logo",
                "value"=>"asf",
            ],
            [
                "key"=>"site_footer_logo",
                "value"=>"asf",
            ],
            [
                "key"=>"site_favicon",
                "value"=>"asf",
            ],
        ];
        DB::table('settings')->insert($settings);
    }
}
