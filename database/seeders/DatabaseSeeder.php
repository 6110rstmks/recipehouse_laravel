<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(2)->create();

        // $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(RecipeSeeder::class);
        // $this->call(AdminSeeder::class);
        $this->call(TagSeeder::class);
    }
}
