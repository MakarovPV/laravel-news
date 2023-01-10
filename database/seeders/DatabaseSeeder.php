<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();
        \App\Models\ForumCategories::factory(3)->create();
        \App\Models\ForumSubcategories::factory(50)->create();
        \App\Models\ForumSubcategoriesComments::factory(200)->create();
        \App\Models\NewsComments::factory(500)->create();
    }
}
