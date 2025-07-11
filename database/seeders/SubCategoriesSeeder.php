<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sub_categories')->insert([
            [
                'id' => 1,
                'name' => 'Water Dispensers',
                'slug' => 'water-dispensers',
                'category_id' => 2,
                'created_at' => '2025-07-05 15:15:39',
                'updated_at' => '2025-07-05 15:15:39',
            ],
            [
                'id' => 2,
                'name' => 'Electric Fans',
                'slug' => 'electric-fans',
                'category_id' => 2,
                'created_at' => '2025-07-05 15:16:22',
                'updated_at' => '2025-07-05 15:16:22',
            ],
            [
                'id' => 3,
                'name' => 'Washing Machines',
                'slug' => 'washing-machines',
                'category_id' => 2,
                'created_at' => '2025-07-05 15:18:24',
                'updated_at' => '2025-07-05 15:18:24',
            ],
            [
                'id' => 4,
                'name' => 'Iron',
                'slug' => 'iron',
                'category_id' => 2,
                'created_at' => '2025-07-05 15:19:09',
                'updated_at' => '2025-07-05 15:19:09',
            ],
            [
                'id' => 5,
                'name' => 'Vacuum Cleaners',
                'slug' => 'vacuum-cleaners',
                'category_id' => 2,
                'created_at' => '2025-07-05 15:36:47',
                'updated_at' => '2025-07-05 15:36:47',
            ],
            [
                'id' => 6,
                'name' => 'Hair Dryers',
                'slug' => 'hair-dryers',
                'category_id' => 2,
                'created_at' => '2025-07-05 15:36:56',
                'updated_at' => '2025-07-05 15:36:56',
            ],
            [
                'id' => 7,
                'name' => 'Induction Cookers',
                'slug' => 'induction-cookers',
                'category_id' => 2,
                'created_at' => '2025-07-05 15:37:05',
                'updated_at' => '2025-07-05 15:37:05',
            ],
            [
                'id' => 8,
                'name' => 'Blender',
                'slug' => 'blender',
                'category_id' => 1,
                'created_at' => '2025-07-05 15:38:41',
                'updated_at' => '2025-07-05 15:38:41',
            ],
            [
                'id' => 9,
                'name' => 'Meat Grinder',
                'slug' => 'meat-grinder',
                'category_id' => 1,
                'created_at' => '2025-07-05 15:38:49',
                'updated_at' => '2025-07-05 15:38:49',
            ],
            [
                'id' => 10,
                'name' => 'Juicer',
                'slug' => 'juicer',
                'category_id' => 1,
                'created_at' => '2025-07-05 15:38:57',
                'updated_at' => '2025-07-05 15:38:57',
            ],
            [
                'id' => 11,
                'name' => 'Stand Mixer',
                'slug' => 'stand-mixer',
                'category_id' => 1,
                'created_at' => '2025-07-05 15:39:04',
                'updated_at' => '2025-07-05 18:01:04',
            ],
        ]);
    }
}
