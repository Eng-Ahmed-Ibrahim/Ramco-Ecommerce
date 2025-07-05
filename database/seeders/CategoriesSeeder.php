<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'slug' => 'kitchen_appliances',
                'name' => 'Kitchen Appliances',
            ],
            [
                'slug' => 'home_appliances',
                'name' => 'Home Appliances',
            ],
            [
                'slug' => 'accessories',
                'name' => 'Accessories',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
